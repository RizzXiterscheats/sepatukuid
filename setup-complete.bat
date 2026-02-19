@echo off
title SEPATUKUID - DATABASE SETUP
color 0A
cls

echo =====================================================
echo    SEPATUKUID - DATABASE MIGRATION SETUP
echo =====================================================
echo.
echo Script ini akan:
echo 1. Membuat migration files (users, sessions)
echo 2. Membuat DatabaseSeeder
echo 3. Menjalankan migrasi dan seeder
echo.
echo Pastikan Anda menjalankan ini di ROOT project Laravel!
echo.
pause
cls

:: =====================================================
:: STEP 1: CREATE MIGRATION FILES
:: =====================================================
echo [1/4] Creating migration files...

:: Get current timestamp for migration files
for /f "tokens=2 delims==" %%a in ('wmic OS Get localdatetime /value') do set "dt=%%a"
set "YEAR=%dt:~0,4%"
set "MONTH=%dt:~4,2%"
set "DAY=%dt:~6,2%"
set "HOUR=%dt:~8,2%"
set "MINUTE=%dt:~10,2%"
set "SECOND=%dt:~12,2%"

set "TIMESTAMP1=%YEAR%_%MONTH%_%DAY%_%HOUR%%MINUTE%01"
set "TIMESTAMP2=%YEAR%_%MONTH%_%DAY%_%HOUR%%MINUTE%02"

:: Create migrations folder if not exists
if not exist database\migrations mkdir database\migrations

:: Create users migration
(
echo ^<?php
echo.
echo use Illuminate\Database\Migrations\Migration;
echo use Illuminate\Database\Schema\Blueprint;
echo use Illuminate\Support\Facades\Schema;
echo.
echo return new class extends Migration {
echo     public function up^(^)^: void
echo     {
echo         Schema::create^('users', function (Blueprint $table^) {
echo             $table-^>id^(^);
echo             $table-^>string^('name'^);
echo             $table-^>string^('email'^)-^>unique^(^);
echo             $table-^>string^('password'^);
echo             $table-^>enum^('role', ['user', 'admin', 'petugas']^)-^>default^('user'^);
echo             $table-^>timestamps^(^);
echo         }^);
echo     }
echo.
echo     public function down^(^)^: void
echo     {
echo         Schema::dropIfExists^('users'^);
echo     }
echo };
) > "database\migrations\%TIMESTAMP1%_create_users_table.php"

echo   - Users migration created

:: Create sessions migration
(
echo ^<?php
echo.
echo use Illuminate\Database\Migrations\Migration;
echo use Illuminate\Database\Schema\Blueprint;
echo use Illuminate\Support\Facades\Schema;
echo.
echo return new class extends Migration
echo {
echo     public function up^(^)^: void
echo     {
echo         Schema::create^('sessions', function (Blueprint $table^) {
echo             $table-^>string^('id'^)-^>primary^(^);
echo             $table-^>foreignId^('user_id'^)-^>nullable^(^)-^>index^(^);
echo             $table-^>string^('ip_address', 45^)-^>nullable^(^);
echo             $table-^>text^('user_agent'^)-^>nullable^(^);
echo             $table-^>longText^('payload'^);
echo             $table-^>integer^('last_activity'^)-^>index^(^);
echo         }^);
echo     }
echo.
echo     public function down^(^)^: void
echo     {
echo         Schema::dropIfExists^('sessions'^);
echo     }
echo };
) > "database\migrations\%TIMESTAMP2%_create_sessions_table.php"

echo   - Sessions migration created
echo Done.
echo.

:: =====================================================
:: STEP 2: CREATE SEEDER
:: =====================================================
echo [2/4] Creating DatabaseSeeder.php...

if not exist database\seeders mkdir database\seeders

(
echo ^<?php
echo.
echo namespace Database\Seeders;
echo.
echo use Illuminate\Database\Seeder;
echo use App\Models\User;
echo.
echo class DatabaseSeeder extends Seeder
echo {
echo     public function run^(^)^: void
echo     {
echo         // Hapus data lama
echo         User::truncate^(^);
echo.
echo         // Admin
echo         User::create^([
echo             'name' =^> 'Admin Sepatukuid',
echo             'email' =^> 'admin@sepatukuid.test',
echo             'password' =^> 'admin123',
echo             'role' =^> 'admin',
echo         ]^);
echo.
echo         // Petugas
echo         User::create^([
echo             'name' =^> 'Petugas Gudang',
echo             'email' =^> 'petugas@sepatukuid.test',
echo             'password' =^> 'petugas123',
echo             'role' =^> 'petugas',
echo         ]^);
echo.
echo         // User biasa
echo         User::create^([
echo             'name' =^> 'User Biasa',
echo             'email' =^> 'user@sepatukuid.test',
echo             'password' =^> 'user123',
echo             'role' =^> 'user',
echo         ]^);
echo.
echo         \$this-^>command-^>info^('====================================='^);
echo         \$this-^>command-^>info^('USERS CREATED SUCCESSFULLY!'^);
echo         \$this-^>command-^>info^('====================================='^);
echo         \$this-^>command-^>info^('Admin   : admin@sepatukuid.test / admin123'^);
echo         \$this-^>command-^>info^('Petugas : petugas@sepatukuid.test / petugas123'^);
echo         \$this-^>command-^>info^('User    : user@sepatukuid.test / user123'^);
echo         \$this-^>command-^>info^('====================================='^);
echo     }
echo };
) > database\seeders\DatabaseSeeder.php

echo   - DatabaseSeeder.php created
echo Done.
echo.

:: =====================================================
:: STEP 3: UPDATE USER MODEL
:: =====================================================
echo [3/4] Updating User Model for plain text password...

:: Backup existing User.php if exists
if exist app\Models\User.php (
    copy app\Models\User.php app\Models\User.php.backup > nul
    echo   - Existing User.php backed up
)

:: Create/Update User.php
(
echo ^<?php
echo.
echo namespace App\Models;
echo.
echo use Illuminate\Database\Eloquent\Factories\HasFactory;
echo use Illuminate\Foundation\Auth\User as Authenticatable;
echo use Illuminate\Notifications\Notifiable;
echo.
echo class User extends Authenticatable
echo {
echo     use HasFactory, Notifiable;
echo.
echo     protected $fillable = [
echo         'name',
echo         'email',
echo         'password',
echo         'role',
echo     ];
echo.
echo     protected $hidden = [
echo         'password',
echo         'remember_token',
echo     ];
echo.
echo     protected $casts = [
echo         'email_verified_at' =^> 'datetime',
echo     ];
echo.
echo     // Method untuk cek role
echo     public function isAdmin^(^)
echo     {
echo         return \$this-^>role === 'admin';
echo     }
echo.
echo     public function isPetugas^(^)
echo     {
echo         return \$this-^>role === 'petugas';
echo     }
echo.
echo     // OVERRIDE: Untuk password plain text (HANYA DEVELOPMENT!)
echo     public function setPasswordAttribute^($value^)
echo     {
echo         \$this-^>attributes['password'] = $value; // Simpan tanpa hash
echo     }
echo }
) > app\Models\User.php

echo   - User.php updated for plain text passwords
echo Done.
echo.

:: =====================================================
:: STEP 4: RUN MIGRATIONS AND SEEDER
:: =====================================================
echo [4/4] Running migrations and seeder...
echo.

:: Clear cache first
echo Clearing cache...
php artisan optimize:clear
echo Done.
echo.

:: Run migrations
echo Running migrations...
php artisan migrate:fresh
echo Done.
echo.

:: Run seeder
echo Running seeder...
php artisan db:seed
echo Done.
echo.

:: Show database tables
echo Current tables in database:
php artisan db:show --database=mysql --tables 2>nul || echo (Run manually: php artisan db:show)
echo.

:: =====================================================
:: COMPLETED
:: =====================================================
echo =====================================================
echo    DATABASE SETUP COMPLETED!
echo =====================================================
echo.
echo Migration files created:
echo   - database\migrations\%TIMESTAMP1%_create_users_table.php
echo   - database\migrations\%TIMESTAMP2%_create_sessions_table.php
echo.
echo Users created:
echo   Admin   : admin@sepatukuid.test / admin123
echo   Petugas : petugas@sepatukuid.test / petugas123
echo   User    : user@sepatukuid.test / user123
echo.
echo To check users in database:
echo   php artisan tinker
echo   ^>^> App\Models\User::all^(^);
echo.
echo =====================================================
pause