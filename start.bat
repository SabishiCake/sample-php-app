@echo off
REM This is the start.bat file.

echo This script is intended to be run from the command line. Press any key to continue...
pause >nul
echo Press Ctrl+C to exit...

echo ---------------------------------------------------

set /p SERVER=Enter the server name (default is 'localhost'):
if "%SERVER%"=="" set SERVER=localhost

set /p PORT=Enter the port number (default is '8000'):
if "%PORT%"=="" set PORT=8000

echo ---------------------------------------------------

echo Starting PHP localhost server...

php -S %SERVER%:%PORT%
echo Server started at http://%SERVER%:%PORT%
