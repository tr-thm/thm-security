# Prevent Username Enumeration

WordPress usernames can be acquired using various URLs:

  - http://localhost/author/admin
  - http://localhost/?author=1
  - http://localhost/wp-sitemap-users-1.xml
  - http://localhost/hello-world/
  - http://localhost/feed/
  - http://localhost/wp-json/wp/v2/users
  - http://localhost/wp-json/wp/v2/users/1
  - http://localhost/wp-json/oembed/1.0/embed?url=http://localhost/hello-world&format=json


Interesting hooks:

  - get_the_author_display_name
  - get_comment_author
  - rest_endpoints
  - document_title_parts
  - oembed_response_data