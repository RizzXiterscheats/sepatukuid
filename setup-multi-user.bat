@echo off
title SEPATUKUID - AUTO SETUP
color 0A
cls

echo =====================================================
echo        SEPATUKUID - AUTO SETUP
echo =====================================================
echo.

echo [1/6] Clear cache...
php artisan optimize:clear
echo Done.
echo.

echo [2/6] Generate key...
php artisan key:generate
echo Done.
echo.

echo [3/6] Jalankan migrasi...
php artisan migrate
echo Done.
echo.

echo [4/6] Jalankan seeder...
php artisan db:seed
echo Done.
echo.

echo [5/6] Buat storage link...
php artisan storage:link
echo Done.
echo.

echo [6/6] Jalankan server...
start http://localhost:8000
php artisan serve
echo.

echo =====================================================
echo        SETUP SELESAI!
echo =====================================================
echo.
echo Akun Testing:
echo ----------------------------------------
echo Admin   : admin@sepatukuid.com / admin123
echo Petugas : petugas@sepatukuid.com / petugas123
echo User    : user@sepatukuid.com / user123
echo ----------------------------------------
echo.
echo Akses:
echo Login    : http://localhost:8000/login
echo Register : http://localhost:8000/register
echo Admin    : http://localhost:8000/admin/dashboard
echo Petugas  : http://localhost:8000/petugas/dashboard
echo.
echo Tekan Ctrl+C untuk menghentikan server
echo =====================================================
pause