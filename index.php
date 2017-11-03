<?php

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
    case 'add':
        // adding a guestbook entry
        $enfim->displayForm();
        break;
    case 'submit':
        // submitting a guestbook entry
        $enfim->mungeFormData($_POST);
        if($enfim->isValidForm($_POST)) {
            $enfim->addEntry($_POST);
            $enfim->displayBook($enfim->getEntries());
        } else {
            $enfim->displayForm($_POST);
        }
        break;
    case 'view':
    default:
        // viewing the guestbook
        $enfim->displayBook($enfim->getEntries());        
        break;   
}



