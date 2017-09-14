Laravel Ecomerce Application
==============
## Installation
Run the following commands:
```
git clone https://github.com/lisi4ok/credissimo-job-task __DIR__
```
```
cd __DIR__
```
```
composer install
```
```
php artisan migrate
```
Virtual Hosts:
```
<VirtualHost __PROJECT__.dev:80>
    DocumentRoot "__DIR__/__PROJECT__/public"
    ServerName __PROJECT__.dev
    ServerAlias __PROJECT__.dev
    <Directory "__DIR__/__PROJECT__/public">
        Options All
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
