@echo off
echo Opening Siakad Polkisma in browser...
start http://localhost/Siakad_Polkisma/public
echo.
echo If the page doesn't load, check that Apache is running.
echo You can use laragon-status.bat to check service status.
timeout /t 2 >nul
