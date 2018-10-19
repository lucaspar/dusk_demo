#!/bin/bash

# download weather images

for number in $(seq 1 50); do

    wget https://assets.hgbrasil.com/weather/images/${number}n.png -P 'public/images/weather'
    wget https://assets.hgbrasil.com/weather/images/${number}.png -P 'public/images/weather'

done
