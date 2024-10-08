## To replicate the issue:

- with docker: `docker run -p 80:80 -p 443:443 -p 443:443/udp -v $PWD:/app dunglas/frankenphp`
- with static binary: `frankenphp run -c ./Caddyfile`

Then load the page at https://localhost and upload a bunch of pdf (50 should do the trick) to reproduce the issue.
Normally an alert should pop up when all requests have been answered, otherwise you can see in the devTool network tab that the requests are still pending.
