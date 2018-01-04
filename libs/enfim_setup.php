<?php
require(ENFIM_DIR . 'config/config.php');
require(ENFIM_DIR . 'libs/enfim.lib.php');
require(SMARTY_DIR . 'Smarty.class.php');

$loader               = require(ENFIM_DIR . 'vendor/autoload.php');
$_SERVER['HTTP_HOST'] = 'localhost';
//Eden::DECORATOR;
$loader->add('Database', ENFIM_DIR . 'classes/');
$loader->add('Files', ENFIM_DIR . 'classes/');
$loader->add('Formadores', ENFIM_DIR . 'classes/');
$loader->add('Formandos', ENFIM_DIR . 'classes/');
$loader->add('Users', ENFIM_DIR . 'classes/');

// smarty configuration
class Enfim_Smarty extends Smarty {

    function __construct() {
        parent::__construct();
        $this->setTemplateDir(ENFIM_DIR . 'templates');
        $this->setCompileDir(ENFIM_DIR . 'templates_c');
        $this->setConfigDir(ENFIM_DIR . 'configs');
        $this->setCacheDir(ENFIM_DIR . 'cache');
    }
}