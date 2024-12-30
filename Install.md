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
 php7.4-gd php7.4-zip git -y

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



#Kiosk Mode

Use raspi-config to enable autologin

sudo apt install --no-install-recommends xserver-xorg x11-xserver-utils xinit openbox chromium

#Bookworm Only
sudo apt install gldriver-test
sudo nano /etc/xdg/openbox/environment
export DISPLAY=':0.0'
xrandr --output HDMI0 --rotate right

sudo nano /etc/xdg/openbox/autostart

  # Disable any form of screen saver / screen blanking / power management
  xset s off
  xset s noblank
  xset -dpms

  # Allow quitting the X server with CTRL-ATL-Backspace
  setxkbmap -option terminate:ctrl_alt_bksp

  # Start Chromium in kiosk mode
  sed -i 's/"exited_cleanly":false/"exited_cleanly":true/' ~/.config/chromium/'Local State'
  sed -i 's/"exited_cleanly":false/"exited_cleanly":true/; s/"exit_type":"[^"]\+"/"exit_type":"Normal"/' ~/.config/chromium/Default/Preferences
  chromium --no-memcheck --disable-infobars --kiosk http://movieposter

sudo nano .bash_profile
[[ -z $DISPLAY && $XDG_VTNR -eq 1 ]] && startx -- -nocursor



