## SWI     Installation Document
--------------------------------


## During this installation I'm going to assume a few things.

1) that you know your way around a shell
2) that you have some understanding of the mysql cli client tool
3) That you have Xtheme IRC Services (or Atheme forks) running with both the httpd and xmlrpc modules running.

## First your going to need to obtain a copy of SWI one can be found here

http://www.Xtheme.org/SWI/

Next up you're going to have to edit the swi/config/config.php file to reflect the settings of your web server and Xtheme/Atheme installation.

## Cleaner URI's (Optional)

You may want to remove the index.php in the URI.

http://www.yournetwork.net/swi/index.php/more/stuffhere
to something like

http://www.yournetwork.net/swi/more/stuffhere
This is current supported on Apache, Lighttpd, Nginx and any other web server that supports some form of URI re-writing. Below I've included a few example of re-writes.

## Apache

<IfModule mod_rewrite.c>
    RewriteEngine On

    # You need to change the path to match that of your installation.
    # For example if you installed the SWI system to http://www.yournetwork.net/swi/ you would 
    # change that line to read:
    # RewriteBase /swi/
    #     
    # Alternately if your install was located on a subdomain example: http://services.yournetwork.net 
    # we would change the RewriteBase line to read:
    # RewriteBase /

    RewriteBase /swi/

    RewriteCond %{REQUEST_URI} ^system.*
    RewriteRule ^(.*)$ /index.php?/$1 [L]

    RewriteCond %{REQUEST_URI} ^application.*
    RewriteRule ^(.*)$ /index.php?/$1 [L]

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?/$1 [L]
</IfModule>

<IfModule !mod_rewrite.c>
    ErrorDocument 404 /index.php
</IfModule>

## Lighthttpd

url.rewrite-once = (
    "/(.*)\.(.*)" => "$0",
    "/(css|files|img|js|stats)/" => "$0",
    "^/([^.]+)$" => "/index.php/$1"
)

## Nginx

server {

    listen   80;

    root /var/www/nginx-default/;
    access_log  /var/log/nginx/localhost.access.log;
    index index.php index.html index.htm;

    error_page 500 502 503 504  /50x.html;

    location /swi/ {

        if (-f $request_filename) {
            expires max;
            break;
        }

        if (!-e $request_filename) {
            rewrite ^/swi/(.*)$ /swi/index.php/$1 last;
        }
    }

    location = /50x.html {
        root /var/www/nginx-default;
    }

    location /swi/index.php {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME /var/www/nginx-default/swi/index.php;
        include fastcgi_params;
    }
}

## All Done!

That's it! You should be able to direct your browser to http://www.yournetwork.net/swi/ and login using your Xtheme/Atheme Nickserv account nickname and password.

## Stay up to date with XthemeOrg

For News, Updates and Security Advisories, please subscribe to the XthemeOrg News mailing list at:
https://www.irc4fun.net/xtheme-news/
