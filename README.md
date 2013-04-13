Laravel 4 vhost generator
=====================================


This simple php script can be used to create vhost for your new Laravel4 App

Download CreateVhostCommand.php and ShowVhostCommand.php and put it in app/commands folder

## Installation

To install update artisan.php in app/start/artisan.php with
      
      Artisan::add(new CreateVhostCommand);
      Artisan::add(new ShowVhostCommand);
      
## Usage

      php artisan vhost:create
      
follow the onscreen instruction to create virtual host on windows  system

      Do you want to create vhost[y/n]?
      >>Yes

it will open  your host file, on windows it will open

      C:\Windows\System32\drivers\etc\hosts
      
you can see your previous host mapping and create a new one

      Write host map 127.0.0.5 laravel.app
      
After this your new host file will be displayed again

      Do you want to edit apache conf file [y/n]?
      >>yes
      
      use default apache httpd-vhost.conf [y/n]?
      >>yes

-Note : by default it will look for httpd-vhost.conf in

      C:\xampp\apache\conf\extra\httpd-vhosts.conf
      
You can overide this as follows

      use default apache httpd-vhost.conf [y/n]?
      >>no
      please give path to your httpd-vhost.conf
      >>path to your file
      
Thats it your virtual host for you laravel 4 app is created just restart you apache server for changes to take affect

To see your current host confugration file run following command cmd

      php artisan vhost:show

Currently this only works in Windows


      

