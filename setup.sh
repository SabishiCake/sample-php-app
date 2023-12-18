#!/bin/bash

# Note: This script is intended to be run from the command line.
echo "This script is intended to be run from the command line. Press any key to continue..."
read -n 1 -s

# Press Ctrl+C to exit
echo "Press Ctrl+C to exit..."
echo "---------------------------------------------------"
echo
echo

# Ask for XAMPP installation path
read -p "Enter the path to your XAMPP installation (e.g., /opt/lampp): " XAMPP_PATH

# Check if the provided path exists
if [ ! -f "$XAMPP_PATH/xampp-control.exe" ]; then
    echo "XAMPP installation not found at the specified path."
    exit 1
fi

# Get database details with defaults
read -p "Enter the database username (default is 'root'): " DB_USER
DB_USER=${DB_USER:-root}

read -p "Enter the database password (default is ''): " DB_PASS

read -p "Enter the database name to create: " DB_NAME

# Define host and port with defaults
read -p "Enter the database host (default is 'localhost'): " DB_HOST
DB_HOST=${DB_HOST:-localhost}

read -p "Enter the database port (default is '3306'): " DB_PORT
DB_PORT=${DB_PORT:-3306}

# Set the current directory to the script's directory
cd "$(dirname "$0")"

# Check if the SQL script exists
SQL_SCRIPT="user.sql"
if [ ! -f "$SQL_SCRIPT" ]; then
    echo "SQL script not found at the specified path. Exiting..."
    exit 1
fi

# Create the database if it doesn't exist
echo "Creating the database if it doesn't exist..."
mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;"
if [ $? -ne 0 ]; then
    echo "Error: Failed to create the database."
    exit 1
fi

# Import SQL script
echo "Importing SQL script..."
mysql -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$SQL_SCRIPT"
if [ $? -ne 0 ]; then
    echo "Error: Failed to import SQL script."
    exit 1
fi

# Writing database connection details to config.ini
echo "Updating config.ini..."
{
    echo "host = \"$DB_HOST\""
    echo "port = \"$DB_PORT\""
    echo "username = \"$DB_USER\""
    echo "password = \"$DB_PASS\""
    echo "dbname = \"$DB_NAME\""
} > "$(dirname "$0")/config.ini"

if [ $? -eq 0 ]; then
    echo "Database setup, SQL script import, and config.ini update completed successfully."
else
    echo "Error: Failed to update config.ini."
    exit 1
fi

echo
echo "---------------------------------------------------"
echo

# Ask user if they want to start the application
read -p "Do you want to start the application now? (Y/N): " START_APP
echo
if [[ "$START_APP" == "Y" || "$START_APP" == "y" ]]; then
    echo "Starting the application..."
    bash "$(dirname "$0")/start.sh"
else
    echo "Application not started."
    exit 0
fi
