# loeye_sample
loeye2 sample project

apache vhost config sample

```
<VirtualHost *:80>
    DocumentRoot "/home/wwww/loeye_sample/htdocs/"
    ServerName localhost
    ServerAlias localhost
    
    Alias /bootstrap/ "/home/wwww/loeye_sample/vendor/twbs/bootstrap/" 
    <Directory "/home/wwww/loeye_sample/vendor/twbs/bootstrap/">
        Options +Indexes +FollowSymLinks
        AllowOverride all
      <IfDefine APACHE24>
        Require local
      </IfDefine>
      <IfDefine !APACHE24>
        Order Deny,Allow
          Deny from all
          Allow from localhost ::1 127.0.0.1
      </IfDefine>
    </Directory>
    
    <Directory "/home/wwww/loeye_sample/htdocs/">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride None
        <IfDefine APACHE24>
            Require local
        </IfDefine>
        <IfDefine !APACHE24>
            Order Deny,Allow
            Deny from all
            Allow from localhost ::1 127.0.0.1
        </IfDefine>
        
        RewriteEngine on
        RewriteRule ^/bootstrap/.*$  /bootstrap$1
        # 如果请求的是真实存在的文件或目录，直接访问
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond $1 !^(index\.php|upload|static|css|images|img|js|favicon\.ico)
        # 如果请求的不是真实文件或目录，分发请求至 index.php
        RewriteRule . index.php

        php_admin_value upload_max_filesize 128M
        php_admin_value post_max_size 128M
        php_admin_value max_execution_time 360
        php_admin_value max_input_time 360
    </Directory>
</VirtualHost>
```
