<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'province',
        'city',
        'district',
        'postal_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // Hapus atau comment 'password' => 'hashed'
    ];

    // Method untuk cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPetugas()
    {
        return $this->role === 'petugas';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // OVERRIDE: Simpan password sebagai plain text (UNTUK TUGAS SEKOLAH)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value; // Langsung simpan tanpa hash
    }

    // Relasi ke order pesanan
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}