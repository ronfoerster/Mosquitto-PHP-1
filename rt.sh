#!/bin/bash -e
#sudo chmod +x "${ENV_SCRIPT}"

cd tests
./makeTestCerts.sh
sudo chown -R mosquitto:mosquitto certs
mosquitto -c mosquitto.conf
cd ..
#make test