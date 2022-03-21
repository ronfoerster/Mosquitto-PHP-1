#!/bin/bash

echo -e "extension_dir=/usr/lib/php/20210902" >> /etc/php/8.1/cli/conf.d/15-mosquitto-php.ini
echo -e "extension=mosquitto.so" >> /etc/php/8.1/cli/conf.d/15-mosquitto-php.ini
#php --ini
#cat /etc/php/8.1/cli/conf.d/15-mosquitto-php.ini
echo -e "extension_dir=/usr/lib/php/20210902" >> /home/runner/work/Mosquitto-PHP-1/Mosquitto-PHP-1/tmp-php.ini
echo -e "extension=mosquitto.so" >> /home/runner/work/Mosquitto-PHP-1/Mosquitto-PHP-1/tmp-php.ini
