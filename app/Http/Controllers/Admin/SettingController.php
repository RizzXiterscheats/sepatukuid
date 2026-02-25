<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings form.
     */
    public function index()
    {
        // Mengambil semua settings dalam format associative array
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // Definisikan default values jika belum ada di database
        $defaults = [
            'store_name' => 'SepatuWara',
            'store_description' => 'Toko sepatu online termurah dan terpercaya',
            'store_phone' => '08123456789',
            'store_email' => 'admin@sepatuwara.com',
            'store_address' => 'Jl. Kebon Jeruk No. 123, Jakarta Barat',
            'social_instagram' => 'https://instagram.com/',
            'social_facebook' => 'https://facebook.com/',
        ];

        // Merge array untuk memastikan selalu ada nilainya di view
        $settings = array_merge($defaults, $settings);

        return view('admin.pengaturan.index', compact('settings'));
    }

    /**
     * Update the settings in storage.
     */
    public function update(Request $request)
    {
        // Karena input dinamis, kita validasi manual yang esensial
        $request->validate([
            'settings' => 'required|array',
            'settings.store_name' => 'required|string|max:100',
        ]);

        // Simpan setiap key-value setting
        foreach ($request->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan toko berhasil diperbarui.');
    }
}
