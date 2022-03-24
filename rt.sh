#!/bin/bash -e
#sudo chmod +x "${ENV_SCRIPT}"

cd tests
./makeTestCerts.sh
sudo chown -R mosquitto:mosquitto certs
mosquitto -c "${GITHUB_ACTION_PATH}/tests/mosquitto.conf" -d
cd ..
#make test
