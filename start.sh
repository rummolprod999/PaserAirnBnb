
cd /var/www/html || exit
echo LANG="ru_RU.UTF-8" >> /etc/default/locale
echo LC_ALL="ru_RU.UTF-8" >> /etc/default/locale
java -jar anb-1.0-jar-with-dependencies.jar anb