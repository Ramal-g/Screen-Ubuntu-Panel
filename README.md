#Este Programa aun no esta finalizazo

Screen Ubuntu panel es un panel administrativo de Screens de Ubuntu con un sistema de usuarios y screens comodo
Este programa fue testeado en Ubuntu 22

#Comandos de instalación

git clone https://github.com/Ramal-g/Screen-Ubuntu-Panel.git
sudo rm -r /var/www/html
sudo mv Screen-Ubuntu-Panel /var/www/html
systemctl reload apache2
sudo chown -R www-data:www-data /var/www/html
sudo chown -R 770 /var/www/html


Usuario por defecto: master
Contraseña por defecto: master
