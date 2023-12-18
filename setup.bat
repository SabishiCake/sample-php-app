@echo off
setlocal enabledelayedexpansion

REM Note: This script is intended to be run from the command line.
echo This script is intended to be run from the command line. Press any key to continue...
pause >nul

REM press crtl+c to exit
echo Press Ctrl+C to exit...
echo ---------------------------------------------------
echo.
echo.

REM Ask for XAMPP installation path
set /p XAMPP_PATH=Enter the path to your XAMPP installation (e.g., C:\xampp):

REM Check if the provided path exists
if not exist "%XAMPP_PATH%\xampp-control.exe" (
    echo XAMPP installation not found at the specified path.
    exit /b 1
)

REM Get database details with defaults
set /p DB_USER=Enter the database username (default is 'root'): 
if "%DB_USER%"=="" set DB_USER=root

set /p DB_PASS=Enter the database password (default is ''): 

set /p DB_NAME=Enter the database name to create: 

REM Define host and port with defaults
set /p DB_HOST=Enter the database host (default is 'localhost'): 
if "%DB_HOST%"=="" set DB_HOST=localhost

set /p DB_PORT=Enter the database port (default is '3306'): 
if "%DB_PORT%"=="" set DB_PORT=3306

REM Set the current directory to the script's directory
cd /d "%~dp0"

REM Check if the SQL script exists
set SQL_SCRIPT=user.sql
if not exist "%SQL_SCRIPT%" (
    echo SQL script not found at the specified path. Exiting...
    exit /b 1
)

REM Create the database if it doesn't exist
echo Creating the database if it doesn't exist...
"%XAMPP_PATH%\mysql\bin\mysql.exe" -h !DB_HOST! -P !DB_PORT! -u %DB_USER% -p%DB_PASS% -e "CREATE DATABASE IF NOT EXISTS %DB_NAME%;"
IF %ERRORLEVEL% NEQ 0 (
    echo Error: Failed to create the database.
    exit /b 1
)

REM Import SQL script
echo Importing SQL script...
"%XAMPP_PATH%\mysql\bin\mysql.exe" -h !DB_HOST! -P !DB_PORT! -u %DB_USER% -p%DB_PASS% %DB_NAME% < "%SQL_SCRIPT%"
IF %ERRORLEVEL% NEQ 0 (
    echo Error: Failed to import SQL script.
    exit /b 1
)

REM Writing database connection details to config.ini
echo Updating config.ini...
(
    echo host = "!DB_HOST!"
    echo port = "!DB_PORT!"
    echo username = "%DB_USER%"
    echo password = "%DB_PASS%"
    echo dbname = "%DB_NAME%"
) > "%~dp0config.ini"


IF %ERRORLEVEL% EQU 0 (
    echo Database setup, SQL script import, and config.php update completed successfully.
) ELSE (
    echo Error: Failed to update config.php.
    exit /b 1
)

echo.
echo ---------------------------------------------------
echo.

REM Ask user if they want to start the application
set /p START_APP=Do you want to start the application now? (Y/N): 
echo.
if /i "%START_APP%"=="Y" (
    echo Starting the application...
    call "%~dp0start.bat"
) else (
    echo Application not started.
    exit /b 0
)
