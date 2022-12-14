# Setup

Start the server.

```
docker compose up -d
```

Stop the server

```
docker compose down
```

Show error logs
```
docker logs -f thm-security-wordpress-1 1>/dev/null
```

Show access logs
```
docker logs -f thm-security-wordpress-1 2>/dev/null
```

Run WP-Scan on the website to enumerate users

```
docker run -it --rm --network="host" wpscanteam/wpscan --url http://localhost --enumerate u
```

Open a Bash in an Ubuntu for any sort of testing
```
docker run -it --rm --network="host" ubuntu:22.04 bash
```

Mount the current folder into the docker as /data
```
docker run -it --rm --network="host" -v $(pwd):/data ubuntu:22.04 bash
```

# Useful links

- [PHP Documentation](https://www.php.net/manual/de/function.strpos.php)
- [WordPress Documentation](https://developer.wordpress.org/reference/functions/status_header/)
- [The WordPress Hooks Firing Sequence](http://rachievee.com/the-wordpress-hooks-firing-sequence/)
