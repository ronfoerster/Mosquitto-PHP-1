#!/bin/bash -e
#sudo chmod +x "${ENV_SCRIPT}"

cd tests
sudo systemctl stop mosquitto
./makeTestCerts.sh
sudo chown -R runner:runner certs
mosquitto -c mosquitto.conf -d
cd ..
make test TESTS="tests/Client/connect.phpt"
php -n -d "extension_dir=./modules/" -d "extension=mosquitto.so" ./tests/Client/publish.phpt
php -n -d "extension_dir=./modules/" -d "extension=mosquitto.so" ./tests/Client/setTlsCertificates.phpt
php -n -d "extension_dir=./modules/" -d "extension=mosquitto.so" ./tests/Client/setTlsPSK.phpt

