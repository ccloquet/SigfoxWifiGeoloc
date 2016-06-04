#!/bin/bash

# quick and dirty
# inspired by a script from Unwired Labs

set -e

interface=($(ifconfig | grep wlan | awk '{print $1}'))
list=($(iwlist "$interface" scanning | grep Address | awk '{print $5}'))

if [[ ! $list ]]
then
  list[0]=""
fi

j=0
b=""
for i in "${list[@]}"
do
  a="${i//:}"
  j=$((j + 1))
  echo "$j $a"
  if [ $j -lt 3 ]
  then
    b="$b$a"
  fi
done

if [ $j = 1 ]; then
  b=$b"000000000000"
fi

echo $b

sudo python /home/pi/iot/sendsigfox.py $b
