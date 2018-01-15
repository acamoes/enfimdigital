<?php
define('PROD', false);
// define our application directory
define('ENFIM_DIR', "");
// define smarty lib directory
define('SMARTY_DIR', "vendor/smarty/smarty/libs/");
// include the setup script
include(ENFIM_DIR . "libs/enfim_setup.php");

session_start();

$enfim   = new Enfim;
// set the current action
$enfim->clearAllAssign();
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'exit';
var_dump($_action);
switch ($_action) {
    case 'servicosCentrais':
        break;
    case 'equipaExecutiva':
        $enfim->equipaExecutiva($_REQUEST);
        break;
    case 'formadores':
        $enfim->formadores($_REQUEST);
        break;
    case 'formandos':
        $enfim->formandos($_REQUEST);
        break;
    case 'home':
        $enfim->home();
        break;
    case 'submit':
        $enfim->authentication($_REQUEST);
        break;
    case 'recover':
        $enfim->recover($_REQUEST);
        break;
    case 'files':
        $enfim->files($_REQUEST);
        break;
    default: // 'exit'
        $enfim->login();
        break;
}



