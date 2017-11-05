<?php
define('PROD', false);
session_start();
// define our application directory
define('ENFIM_DIR', "");
// define smarty lib directory
define('SMARTY_DIR', "libs/");
// include the setup script
include(ENFIM_DIR . "libs/enfim_setup.php");
// create guestbook object
$enfim = new Enfim;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
switch($_action) {
    case 'submit':
        $enfim->authentication($_POST);       
        break;
    case 'view':
        $enfim->login();        
        break;   
}



