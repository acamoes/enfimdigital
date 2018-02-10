<?php
date_default_timezone_set('Europe/Lisbon');
// PROD is set in index.php and upload.php
if (PROD) { //Production
    $_SERVER['HTTP_HOST'] = ''; //domain
    set_time_limit(30);
    define('DB_TYPE', "mysql");
    define('DB_NAME', "");
    define('DB_HOST', "");
    define('DB_USER', "");
    define('DB_PASS', "");
    define('DB_PORT', "");
    define('BOT_KEY', ""); //google BOT KEY PROD
    define('MAIL_USERNAME', ""); //gmail accout
    define('MAIL_PASSWORD', ""); //gmail password
}
else { //Development
    $_SERVER['HTTP_HOST'] = ''; //domain
    set_time_limit(0);
    define('DB_TYPE', "mysql");
    define('DB_NAME', "");
    define('DB_HOST', "");
    define('DB_USER', "");
    define('DB_PASS', "");
    define('DB_PORT', "");
    define('BOT_KEY', ""); //google BOT KEY PROD
    define('MAIL_USERNAME', ""); //gmail accout
    define('MAIL_PASSWORD', ""); //gmail password
}


