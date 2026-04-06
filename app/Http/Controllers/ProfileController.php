<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $request->user()->update($validated);

        return Redirect::route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Display the user's order history.
     */
    public function orders(): View
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->latest()
            ->get();

        return view('user.orders', compact('orders'));
    }

    /**
     * Track a specific order's timeline.
     */
    public function trackOrder($id): View
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['items.product', 'tracks' => function($q) {
                $q->orderBy('created_at', 'desc');
            }])
            ->findOrFail($id);

        return view('user.order-track', compact('order'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
