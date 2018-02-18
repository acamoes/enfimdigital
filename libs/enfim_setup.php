<?php
require(ENFIM_DIR.'config/config.php');
require(ENFIM_DIR.'libs/api.lib.php');
require(ENFIM_DIR.'libs/enfim.lib.php');
require(SMARTY_DIR.'Smarty.class.php');

$loader               = require(ENFIM_DIR.'vendor/autoload.php');
$_SERVER['HTTP_HOST'] = 'localhost';
//Eden::DECORATOR;
$loader->add('Database', ENFIM_DIR.'classes/');
$loader->add('Files', ENFIM_DIR.'classes/');
$loader->add('Formadores', ENFIM_DIR.'classes/');
$loader->add('Formandos', ENFIM_DIR.'classes/');
$loader->add('Users', ENFIM_DIR.'classes/');
$loader->add('Evaluation', ENFIM_DIR.'classes/');
$loader->add('Cursos', ENFIM_DIR.'classes/');
$loader->add('EquipaExecutiva', ENFIM_DIR.'classes/');
$loader->add('ServicosCentrais', ENFIM_DIR.'classes/');
$loader->add('Utilizadores', ENFIM_DIR.'classes/');
$loader->add('Modulos', ENFIM_DIR.'classes/');
$loader->add('Documentos', ENFIM_DIR.'classes/');
$loader->add('Calendarios', ENFIM_DIR.'classes/');
$loader->add('Avaliacoes', ENFIM_DIR.'classes/');
$loader->add('Formacoes', ENFIM_DIR.'classes/');

// smarty configuration
class Enfim_Smarty extends Smarty
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir(ENFIM_DIR.'templates');
        $this->setCompileDir(ENFIM_DIR.'templates_c');
        $this->setConfigDir(ENFIM_DIR.'configs');
        $this->setCacheDir(ENFIM_DIR.'cache');
    }
}
