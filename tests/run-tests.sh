#!/bin/bash -e
sudo chmod +x "${ENV_SCRIPT}"

echo "GITHUB_ACTION_PATH: ${GITHUB_ACTION_PATH}"
pwd
./makeTestCerts.sh
sudo chown -R mosquitto:mosquitto certs
mosquitto -c mosquitto.conf -d
cd ..
make test
