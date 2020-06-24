<p align="center">
    <h1>Bot Blocker</h1>
</p>

-----------------------------------------

Bot Blocker is a PHP helper to help you detects bots in your website.

### Setup

##### PHP

###### include helper file as required file in your PHP file.
```php
<?php 
    require_once('bot_blocker.php');

?>
```

##### Laravel

See the laravel setup introduction <a href="LARAVEL-INTRODUCTION.md">here</a>

### Usage

##### Detect by IP range
```php
<?php 
    require_once('bot_blocker.php');

    if( detectIpRange() ){
        // do anything when its true
    }
?>
```

##### Detect by Hostname
```php
<?php 
    require_once('bot_blocker.php');

    $ip = file_get_contents("http://ipecho.net/plain");
    $hostname = gethostbyaddr($ip);
    $agent = $_SERVER['HTTP_USER_AGENT'];

    if( detectHostname($ip, $agent, $hostname) ){
        // do anything when its true
    }
?>
```

##### Detect by Referrer Domain
```php
<?php 
    require_once('bot_blocker.php');

    if( detectReferrer() ){
        // do anything when its true
    }
?>
```

### License
The Bot Blocker script is released under the <a href="LICENSE">LGPL License</a>.

### Credits
* StackOverflow
* Muhammad Fauzan on <a href="https://facebook.com/fauzandotjs" target="_blank">Facebook</a>