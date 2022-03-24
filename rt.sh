#!/bin/bash -e
#sudo chmod +x "${ENV_SCRIPT}"

cd tests
sudo systemctl stop mosquitto
./makeTestCerts.sh
sudo chown -R mosquitto:mosquitto certs
echo "$GITHUB_ACTION_PATH"
id
ls -al certs
mosquitto -c mosquitto.conf
cd ..
#make test
