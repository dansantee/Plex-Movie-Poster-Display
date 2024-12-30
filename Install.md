#This is a summary of the information contained in the original blog, with my own notes, in the case that it should become unavailable. I don't think it's complete, so I'll update it if I need to reload in the future.

#PMDP scrapes http://IP_ADDRESS_OF_PLEX_SERVER>:32400/status/sessions and displays the poster, current progress, and description of the currently playing movie or TV show on a screen. If the client is not playing any media the script shows random movie posters from the Plex Server.


#RPi Updated Install:

Using a RPi Zero 2 W
Install Bookworm 64 Lite using Raspberry Pi Imager with WiFi and SSH setup
sudo apt update && sudo apt upgrade -y

#Install PHP7.4
sudo apt -y install lsb-release apt-transport-https ca-certificates 
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
sudo apt update

sudo apt install apache2 nginx php7.4 libapache2-mod-php7.4 \
 php7.4-fpm php7.4-xml php7.4-mbstring php7.4-mysql php7.4-curl \
 php7.4-gd php7.4-zip git unclutter -y

sudo a2enmod proxy_fcgi setenvif
sudo a2enconf php8.2-fpm
systemctl reload apache2


#Setup PHP with NGINX

cd /etc/nginx
sudo nano sites-enabled/default

Add index.php to index line (Around line 44)
Before:
index index.html index.htm index.nginx-debian.html
After:
index index.html index.htm index.php;

Uncomment:

location ~ \.php$ {
  include snippets/fastcgi-php.conf;
  fastcgi_pass unix:/run/php/php7.3-fpm.sock;
}

#Increase NGINX File Size Limitation

sudo nano /etc/nginx/nginx.conf

Add the follow in the http section after types_hash_max_size 2048;
client_max_body_size 25M;

#Increase PHP upload_max_filesize
sudo nano /etc/php/8.2/fpm/php.ini

Change upload_max_filesize (Around line 855)
upload_max_filesize = 25M


#Setup PHP information file.
cd /var/www/html/
sudo rm index.html
sudo mv index.nginx-debian.html index.php
sudo nano index.php
Add <?php echo phpinfo(); ?> to top of file.

Reboot

Opening a browser to http://<ip_address_of_your_raspberry_pi> . If everything is installed correctly. you should see the php information screen.


#Setup Plex Movie Poster

sudo git clone --branch dev https://github.com/dansantee/Plex-Movie-Poster-Display.git
cd Plex-Movie-Poster-Display
sudo cp -R * /var/www/html
sudo chmod -R 774 /var/www/html/
sudo chown -R pi:www-data /var/www/html/


#First Time Use
Open Browser to http://<ip_of_raspberry_pi>/settings/login.php and login with username admin and password password1

Once logged into the admin page, you will need to update the Plex Server IP, Plex Token, and Plex Movie Sections in “Server Configuration” before PMDP will work properly.

Important: The Movie Sections input is expecting the ID (#) of the Plex library you want PMPD to use for posters. You can add multiple sections as long as they are comma separated and contain no spaces.

How to find your Plex sections ID(s):
Open your Plex web interface via the browser of your choice.
Select the desired section(s) from menu on the left. (Example: Movies)
Once the section is loaded… Look towards the end of the URL in the browser. You should see something like “source=2”.









Misc Raspberry Pi OS Steps
Full Buster / Raspberry OS Upgrade:

sudo apt update
sudo apt full-upgrade
sudo reboot
Disable Screen Blanking: 

Click on the Raspberry Pi (Menu) icon. Select Preferences, Raspberry Pi Configuration, and then the Display tab. Choose Disable next to Screen Blanking.

Enable SSH:

Click on the Raspberry Pi (Menu) icon. Select Preferences, Raspberry Pi Configuration, and then the Interfaces tab. Choose Enable next to SSH.

Rotate Screen:

Click on the Raspberry Pi (Menu) icon. Select Preferences, and Screen Configuration. Right click on the screen you want to rotate and select orientation.

Chromium Kiosk Mode on Startup
Raspbian Buster / Raspberry OS: 

With Raspbian Buster / Raspberry OS I was not able to use the .desktop file method to auto start Chromium. Instead I had to create a directory and file. I am not sure if this method needs unclutter installed so I left it in the instructions.

sudo nano /etc/xdg/lxsession/LXDE-pi/autostart

- Add the following 
/usr/bin/chromium-browser --kiosk  --disable-restore-session-state http://[PMPD IP Address]/index.php

-Save File
CTRL + O to write changes
CTRL + X to exit

-Reboot to Test

This is the end of the blog steps. I had to change a few things for my installation, including how the kiosk mode worked and force enable HDMI.