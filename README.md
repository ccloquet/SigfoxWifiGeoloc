# Geolocation without GPS, transmitted to your server without GSM nor Wi-Fi

Its is kind of magic. By combining the Unwired Labs Wifi fingerprints API with the Sigfox transmission network, you get a geolocation device that knows where you are without the need of a GPS device, and transmits your location to a server without GSM nor Wi-Fi connection. 

Ten minutes after you plug your Raspberry Pi, it will start to transmit every 10 minutes the two first Wi-Fi BSSID detected. Sigfox will forward these to your server. A php script will query the Unwired Labs database, which will return the location (lat/lon/accuracy), that you can use for your own purposes.

Just follow the steps !

## You need

### Hardware

* 1 configured [Raspberry Pi](https://www.raspberrypi.org/products/raspberry-pi-3-model-b/)  (eg : version 3)
* 1 power source (eg : [RS PB A 5200](http://uk.rs-online.com/web/p/power-banks/7757508) )
* 1 Sigfox module for Rapsberry Pi (eg : from Yadom : [here](http://yadom.fr/reseaux-iot/solutions/atim-radiocommunications/carte-de-communication-sigfox.html) or [here]
            (http://yadom.fr/reseaux-iot/sigfox/carte-rpisigfox.html) )
* 1 case (optional, eg: [here](http://shop.mchobby.be/boitiers/471-boitier-raspberry-pi-plus-blanc-givre-3232100004719.html))
        
### Software
        
1. sendsigfox.py, from the repository [rpisigfox](https://github.com/SNOC/rpisigfox)
2. loc.sh, that will run on the Raspberry Pi
3. from_sigfox.php, that will run on your web server
    
### Services

* When buying the Yadom Rpi Sigfox card, you get a one-year subscription to the service [telemesure.net](https://www.telemesure.net)
* A token from [Unwired Labs](https://unwiredlabs.com/pricing) (as a developer, you get 50 free per day)
* 1 webserver that can run php scripts and execute curl commands

## How to proceed

1. Start from an working Raspberry Pi
2. Assemble the sigfox module, the antenna & the pi
3. Follow the steps on the repository [rpisigfox](https://github.com/SNOC/rpisigfox) to configure your pi
4. Put sendsigfox.py in /home/pi
5. Put loc.sh in /home/pi
6. in from_sigfox.php, change "00000000000000" to be your token from unwiredlabs
7. Do something with the $ret variable (eg : put the data in a database)
7. put from_sigfox.php on your webserver
8. configure the callback on telemesure.net. Be sure to choose the 'POST' method
9. On your Raspberry pi : sudo crontab -e, and add the following line : */10 * * * * /home/pi/loc.sh

## And that's it !

Ten minutes after you plug your Raspberry Pi, it will start to transmit every 10 minutes the two first Wi-Fi BSSID detected. Sigfox will forward these to your server. The php script will query the Unwired Labs database, which will return the location (lat/lon/accuracy), that you can use for your own purposes.
