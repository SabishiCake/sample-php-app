#!/bin/bash
# FILEPATH: /c:/Users/user/Documents/GitHub/istp2/start.sh

echo "This script is intended to be run from the command line. Press any key to continue..."
read -n 1 -s

echo "Press Ctrl+C to exit..."
echo "---------------------------------------------------"

read -p "Enter the server name (default is 'localhost'): " SERVER
SERVER=${SERVER:-localhost}

read -p "Enter the port number (default is '8000'): " PORT
PORT=${PORT:-8000}

echo "---------------------------------------------------"

echo "Starting PHP localhost server..."

php -S $SERVER:$PORT
echo "Server started at http://$SERVER:$PORT"
