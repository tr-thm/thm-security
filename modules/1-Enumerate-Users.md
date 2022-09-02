# Prevent Username Enumeration

WordPress usernames can be acquired using various URLs:

  - http://localhost/?author=1
  - http://localhost/author/admin
  - http://localhost/feed/
  - http://localhost/hello-world/
  - http://localhost/wp-json/wp/v2/users
  - http://localhost/wp-json/wp/v2/users/1
  - http://localhost/wp-json/oembed/1.0/embed?url=http://localhost/hello-world&format=json
  - http://localhost/wp-sitemap-users-1.xml


Interesting hooks:

  - author_link
  - body_class
  - (comment_class)
  - document_title_parts
  - get_comment_author
  - get_the_author_display_name
  - oembed_response_data
  - rest_endpoints
  - the_author