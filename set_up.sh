#!/bin/sh
echo "Setting up the environment"
sudo service nginx stop
sudo service mysql start
sudo /opt/lampp/lampp start

echo "Navigate here http://127.0.0.1/web_project2.0/"