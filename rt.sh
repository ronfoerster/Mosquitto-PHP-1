#!/bin/bash -e
#sudo chmod +x "${ENV_SCRIPT}"

cd tests
sudo systemctl stop mosquitto
./makeTestCerts.sh
sudo chown -R runner:runner certs
mosquitto -c mosquitto.conf -d
cd ..
php -n -d "extension_dir=./modules/" -d "extension=mosquitto.so" ./tests/Client/connect.phpt
#make test TESTS="tests/Client/connect.phpt"
