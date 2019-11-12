
cd /var/www/html || exit
echo LANG="ru_RU.UTF-8" >> /etc/default/locale
echo LC_ALL="ru_RU.UTF-8" >> /etc/default/locale
usr/bin/python3.5 ./run_anb.py