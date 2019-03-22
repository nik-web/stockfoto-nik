# TODO

This is a TODO list for the function of the application

## Apache Web server setup

### Add to the following file

/etc/hosts
127.0.1.1       stockfoto-nik.local

### Virtual host (development mode)

Create the following file
/etc/apache2/sites-available/stockfoto-nik.local.conf

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apache
<VirtualHost *:80>
    ServerName stockfoto-nik.local
    DocumentRoot /path/to/stockfoto-nik/public
    SetEnv APPLICATION_ENV development
    <Directory /path/to/stockfoto-nik/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```
a2ensite stockfoto-nik.local.conf

systemctl reload apache2

## Calling in the browser

http://stockfoto-nik.local