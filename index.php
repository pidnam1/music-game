<?php
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
spl_autoload_register(function($classname) {
    include "$classname.php";
});


// Join session or start one
session_start();

// Parse the URL
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = str_replace("/musicgame/", "", $path);
$parts = explode("/", $path);



// If the user's email is not set in the session, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!



print_r($parts[0]);
// Instantiate the controller and run
$game = new GameController();
$game->run($parts[0]);