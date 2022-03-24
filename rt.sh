#!/bin/bash -e
#sudo chmod +x "${ENV_SCRIPT}"

cd tests
sudo systemctl stop mosquitto
./makeTestCerts.sh
sudo chown -R runner:runner certs
ls -al certs
mosquitto -c mosquitto.conf -d
cd ..
make test
