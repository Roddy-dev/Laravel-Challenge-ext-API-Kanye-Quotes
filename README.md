## In response to a Laracasts post about recruitment

### A challenge was added by BOBBYBOUWMANN

-   [laracasts discussion](https://laracasts.com/discuss/channels/code-review/how-to-assess-coding-skills-specific-to-php-and-laravel)

asking for the following:

The challenge
The challenge will contain a few core features most applications have. That includes connecting to an API, basic MVC, exposing an API, and finally tests.
The API we want you to connect to is https://kanye.rest/
The application should have the following features
A web page that shows 5 random Kayne West quotes (must)
There should be a button to refresh the quotes (must)
Authentication for this page should be done with a password (must)
An API route should be available to fetch 5 random Kayne West quotes (must)
The API route is secured with a token (nice to have)
Above features are tested with Feature tests (must)
Above features are tested with Unit tests (nice to have)
Provide a README on we can set up and test the application (must)
Notes
HTML/CSS/JS styling is not part of this, it doesn’t matter how it looks like.

## This repo is my solution to the above problem

1st part of the problem was there was no easy way for the orininal API to return 5 quotes without doing 5 http requests. So I found the JSon of 122 quotes in a github repo and used that instead.
I made an HTTP client(uses guzzel) request to the git hub repo [here](https://raw.githubusercontent.com/ajzbc/kanye.rest/refs/heads/master/src/quotes.json)

And stored the result in a cache using the SQLite db cache table.

I extracted this logic to a service for testability.

The /quotes web route consumes this service and gets in return 5 (configurable) random quotes either from the external API or cached quotes.
This is sent to the /quotes page.

There were tests for hitting the api through regular rendering of pages and other tests for faking the HTTP response and testing the quotes service.

I used laravel debugbar to see if cache was being used. It worked as expected, getting fresh data after a time or reading from cache otherwise.

Also I pondered what to do about the refresh button. And settled on alpineJS and alpine-ajax to just update the list itself without a full page reload.
I got the link tag working 1st without js and then set about adding alpine, this is called progressive enhancement and so if the js doesn't work it will fall back gracefully. At 1st it wouldn't work after installing with npm, but then I added a cdn in the app.blade.php and it refreshed the list without reloading the page.

I have used laravel 11 using the breeze starter kit and alpine JS. I only included the relevant files that I modified for succinctness. If you wish to run this, you will need to install your own version of laravel 11 and use these files.

Please feel to browse and use as you wish.
