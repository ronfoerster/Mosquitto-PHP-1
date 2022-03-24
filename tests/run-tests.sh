#!/bin/sh
set -e

pwd
./makeTestCerts.sh
# sudo chown -R mosquitto:mosquitto certs
mosquitto -c mosquitto.conf -d
cd ..
make test
