<?php
require(ENFIM_DIR . 'config/config.php');
require(ENFIM_DIR . 'libs/enfim_db.php');
require(ENFIM_DIR . 'libs/enfim.lib.php');
require(ENFIM_DIR . 'classes/Users.php');
require(SMARTY_DIR . 'Smarty.class.php');

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
      
