@echo off
echo ==========================================
echo   Starting Laravel Development Server
echo   with PHP 8.3.29 (Laragon)
echo ==========================================
echo.
echo Server akan berjalan di:
echo   - http://localhost:8000
echo   - http://127.0.0.1:8000
echo.
echo Browser akan terbuka otomatis dalam 3 detik...
echo Tekan Ctrl+C untuk stop server
echo.

REM Buka browser setelah 3 detik
start /B cmd /c "timeout /t 3 /nobreak >nul && start http://localhost:8000"

REM Start Laravel server dengan PHP Laragon 8.3.29
C:\laragon\bin\php\php-8.3.29-nts-Win32-vs16-x64\php.exe artisan serve --host=0.0.0.0 --port=8000
