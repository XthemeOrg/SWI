# SWI (Services Web Interface)

## About

**author** siniStar (Austin Ellis)

**author email** siniStar [at] IRC4Fun [dot] net

**author url** http://atheme.github,io

**version** 3.3.2

- - -

## Legal
This file is part of SWI.

SWI is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

SWI is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with SWI.  If not, see http://www.gnu.org/licenses/

- - -

## SWI Web Panel for Atheme IRC Services (and Atheme forks)

SWI is a simple web panel for Atheme IRC services. It aims to be clean, sleek and fast. With minimul installation and configuration required.
SWI is a fork of EGs (https://bitbucket.org/jnewing/egs) with some bug fixes, cosmetic improvements and additional features and consoles in
an effort to give users of networks running Atheme Services the ultimate control over their IRC accounts, nicknames, channels, memos, vhosts
and BotServ use via the World Wide Web.

## Notable New Features:

    1) NickServ Settings page
	2) ChanServ Settings page
	3) ChanServ WAITING list added to OperServ dashboard for networks running chanserv/moderate with Atheme (optional)
	4) HostServ WAITING list added to OperServ dashboard (optional)
	5) BotServ consoles added: BOTLIST, ASSIGN, UNASSIGN and BOT MANAGEMENT (add/change/delete) for Services Operators
    6) Current Sessions page added to main dashboard
	7) Facebook & Twitter links for networks (optional)
	8) GroupServ console & functionality added (optional)
	9) ReCaptcha v2
	10) Configure whether to show +qah in flags assistance to users based on how the network is configured.

- - -

## Support

If you need support please come talk to me on irc.IRC4Fun.net in #SWI however before doing that make sure you read this file, at
least twice.  You can also find me on Freenode (chat.freenode.net) in #SWI

- - -

## Installation

During this installation I'm going to assume a few things.

    1) that you know your way around a shell
    2) that you have some understanding of the mysql cli client tool
    3) That you have Atheme IRC Services (or an Atheme fork) experience running with both the httpd and xmlrpc modules running.


First your going to need to obtain a copy of SWI one can be found here

	https://github.com/atheme/SWI/

Next up you're going to have to edit the swi/config/config.php file to reflect the settings of your web server and Atheme installation.

Cleaner URI's (**Optional**)

You may want to remove the index.php in the URI.

	http://www.yournetwork.net/swi/index.php/more/stuffhere

to something like

	http://www.yournetwork.net/swi/more/stuffhere

This is current supported on Apache, Lighttpd, Nginx and any other web server that supports some form of URI re-writing. Below I've included a few example of re-writes.

**Apache**

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


**Lighthttpd**

	url.rewrite-once = (
 		"/(.*)\.(.*)" => "$0",
 		"/(css|files|img|js|stats)/" => "$0",
 		"^/([^.]+)$" => "/index.php/$1"
	)

**Nginx**

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

 - - -

## Finished

That's it! You should be able to direct your browser to http://www.yournetwork.net/swi/ and login using your Atheme Nickserv account nickname and password.

## Issues/Bugs

Please report all issues/bugs to Issues (https://github.com/atheme/SWI/issues) (in addition to IRC). 




