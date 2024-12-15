echo yes | php artisan admin:install
echo yes | php artisan db:seed
php artisan cache:clear
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf