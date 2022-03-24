#!/bin/sh
set -e

echo "Tests"
pwd
./makeTestCerts.sh
sudo chown -R mosquitto:mosquitto certs
mosquitto -c mosquitto.conf -d
cd ..
make test
