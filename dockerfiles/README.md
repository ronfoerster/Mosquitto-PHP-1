# Dockerfiles for Mosquitto-PHP-Extension

uses the libmosquitto from the distro repository

## How to use

### Simple example:
Create Docker-Image:
````
docker build -f Dockerfile.alpine -t alpine-php81-mosq .
````

Test-Container with output of PHP modules
````
docker run -it --rm alpine-php81-mosq php -m
````

Example with Debian Bullseye and PHP-FPM:
````
docker build -f Dockerfile.bullseye -t by-php81-mosq .
docker run -it --rm by-php81-mosq php -m
````
