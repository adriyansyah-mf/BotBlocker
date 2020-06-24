<p align="center">
    <h1>Bot Blocker</h1>
</p>

-----------------------------------------

Bot Blocker is a PHP helper to help you detects bots in your website.

### Setup

1. Copy and paste the bot blocker helper file in app folder or anywhere in your laravel project directory. ( this tutorial use app folder for the bot blocker helper file )

2. Open <b>composer.json</b> file of your laravel project, and look for autoload key in the json schema, then add files key with array value which is the helper location inside.

```json
    "autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "App\\": "app/"
        },
        "files" : ["app/bot_blocker.php"]
    }
```
Now you can use your helper anywhere in your controllers, service container, etc.

### Usage

##### Detect by IP range
```php

if( detectIpRange() ){
    // do anything when its true
}

```

##### Detect by Hostname
```php

$ip = file_get_contents("http://ipecho.net/plain");
$hostname = gethostbyaddr($ip);
$agent = $request->server('HTTP_USER_AGENT');

if( detectHostname($ip, $agent, $hostname) ){
    // do anything when its true
}

```

##### Detect by Referrer Domain
```php

if( detectReferrer() ){
    // do anything when its true
}

```

### License
The Bot Blocker script is released under the <a href="LICENSE">LGPL License</a>.

### Credits
* StackOverflow
* Muhammad Fauzan on <a href="https://facebook.com/fauzandotjs" target="_blank">Facebook</a>