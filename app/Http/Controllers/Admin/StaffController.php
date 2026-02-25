<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index(Request $request)
    {
        // Ambil user dengan role admin atau petugas
        $query = User::whereIn('role', ['admin', 'petugas'])
                    ->orderBy('role', 'asc') // Admin di atas
                    ->orderBy('created_at', 'desc');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $staffs = $query->paginate(15)->withQueryString();

        // Statistik
        $totalStaff = User::whereIn('role', ['admin', 'petugas'])->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalPetugas = User::where('role', 'petugas')->count();

        return view('admin.petugas.index', compact('staffs', 'totalStaff', 'totalAdmin', 'totalPetugas'));
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create()
    {
        return view('admin.petugas.create');
    }

    /**
     * Store a newly created staff in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,petugas',
            'password' => 'required|string|min:4', // Min 4 menyesuaikan sistem akademik
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'role'     => $validated['role'],
            'password' => $validated['password'], // Menggunakan setter di User model
        ]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Akun ' . ucfirst($validated['role']) . ' berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit(User $petuga) // Parameter name bound default laravel
    {
        $staff = $petuga; // Alias untuk mempermudah

        // Pastikan bukan user biasa
        if ($staff->role === 'user') {
            abort(404, 'Data petugas tidak ditemukan.');
        }

        return view('admin.petugas.edit', compact('staff'));
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(Request $request, User $petuga)
    {
        $staff = $petuga;

        if ($staff->role === 'user') {
            return back()->with('error', 'Hanya bisa mengedit akun petugas/admin.');
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($staff->id)],
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,petugas',
            'password' => 'nullable|string|min:4',
        ]);

        $staff->name  = $validated['name'];
        $staff->email = $validated['email'];
        $staff->phone = $validated['phone'];
        $staff->role  = $validated['role'];

        // Jika password diisi, maka update. Jika tidak, abaikan.
        if (!empty($validated['password'])) {
            $staff->password = $validated['password'];
        }

        // Mencegah super admin mengganti role diri sendiri menjadi non-admin
        if ($staff->id === auth()->id() && $validated['role'] !== 'admin') {
            return back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        $staff->save();

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Data akun berhasil diperbarui.');
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy(User $petuga)
    {
        $staff = $petuga;

        // Cegah menghapus akun sendiri (Super Admin yang sedang login)
        if ($staff->id === auth()->id()) {
            return back()->with('error', 'Peringatan: Anda tidak dapat menghapus akun yang sedang Anda gunakan saat ini.');
        }

        // Cegah menghapus jika hanya tersisa 1 admin terakhir di sistem
        if ($staff->role === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return back()->with('error', 'Aksi ditolak: Harus ada setidaknya satu Admin Utama di dalam sistem.');
            }
        }

        $staff->delete();

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Akun petugas berhasil dihapus dari sistem.');
    }
}
