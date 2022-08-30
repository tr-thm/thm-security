# Prevent Username Enumeration

WordPress usernames can be acquired using these methods:

- Author Query Redirection
    - /?author=1  ->  /author/admin/

- REST Endpoints
  - /wp-json/wp/v2/users
  - /?rest_route=/wp/v2/users

- RSS Feed
  - /feed/

- WP Sitemaps
  - /wp-sitemap-users-1.xml

- Author Name in Source Code
  - /hello-world/

- Login Errors
    - wp-login.php
    - XMLRPC.php