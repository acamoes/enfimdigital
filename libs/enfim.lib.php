<?php

class Enfim {
    // database object
    var $db    = null;
    // smarty template object
    var $tpl   = null;
    // error messages
    var $error = null;

    /**
     * class constructor
     */
    function __construct() {
        $this->db  = new enfim_db();
        $this->tpl = new Enfim_Smarty;
    }

    function login() {
        $this->tpl->assign('error', '');
        $this->tpl->display('enfim_login.tpl');
    }

    function authentication($request) {
        $data = $this->safePost($request);
        if (isset($data['recoverPassword'])) {
            session_destroy();
            $this->tpl->assign('error', $this->error);
            $this->tpl->assign('botKey', BOT_KEY);
            $this->tpl->display('enfim_recover.tpl');
        }
        else {
            $_SESSION['users'] = new Users();
            if ($_SESSION['users']->login($data['username'], $data['password'])) {
                $this->home();
            }
            else {
                session_destroy();
                $this->error = 'Credenciais incorretas';
                $this->tpl->assign('error', $this->error);
                $this->tpl->display('enfim_login.tpl');
            }
        }
    }

    function recover($request) {
        $data = $this->safePost($request);
        var_dump($data);
        exit;
        if (isset($data['recoverPassword'])) {
            session_destroy();
            $this->tpl->assign('error', $this->error);
            $this->tpl->assign('botKey', BOT_KEY);
            $this->tpl->display('enfim_recover.tpl');
        }
    }

    function home() {
        $_SESSION['users']->getMyAgenda() ?
                        $this->tpl->assign('myAgenda', $_SESSION['users']->myAgenda) :
                        $this->tpl->assign('myAgenda', array());
        $_SESSION['users']->getMyCourses() ?
                        $this->tpl->assign('myCourses', $_SESSION['users']->myCourses) :
                        $this->tpl->assign('myCourses', array());
        $this->tpl->assign('users', $_SESSION['users']);
        $this->tpl->display('enfim_home.tpl');
    }

    function formandos($request) {
        $data                  = $this->safePost($request);
        $_SESSION['formandos'] = new Formandos($data);
        $this->tpl->assign('users', $_SESSION['users']);
        if ($_SESSION['formandos']->getCourse($data['id'])) {
            $this->tpl->assign('modulo', 'formandos');
            $this->tpl->assign('formandos', $_SESSION['formandos']);
            $this->tpl->assign('objTabs', $_SESSION['formandos']->tabs);
            $this->tpl->display('enfim_formandos.tpl');
        }
        else {
            $this->clearAllAssign();
            $this->home();
        }
    }

    function formadores($request) {
        $data                   = $this->safePost($request);
        $_SESSION['formadores'] = new Formadores($data);

        switch ($data['task']) {
            case "getCourse":
                $this->tpl->assign('users', $_SESSION['users']);
                if ($_SESSION['formadores']->getEvaluation($data['id'])) {
                    $this->tpl->assign('modulo', 'formadores');
                    $this->tpl->assign('formadores', $_SESSION['formadores']);
                    $this->tpl->assign('objTabs', $_SESSION['formadores']->tabs);
                    $this->tpl->display('enfim_formadores.tpl');
                }
                break;
            case "getCourse":
                $this->tpl->assign('users', $_SESSION['users']);
                if ($_SESSION['formadores']->getCourse($data['id'])) {
                    $this->tpl->assign('modulo', 'formadores');
                    $this->tpl->assign('formadores', $_SESSION['formadores']);
                    $this->tpl->assign('objTabs', $_SESSION['formadores']->tabs);
                    $this->tpl->display('enfim_formadores.tpl');
                }
                break;
            default:
                $this->clearAllAssign();
                $this->home();
                break;
        }
    }

    function files($request) {
        $data  = $this->safePost($request);
        $files = new Files();
        if ($data['task'] == "getInformations") {
            $files->getInformations($data['id']);
        }
        elseif ($data['task'] == "getArchive") {
            $files->getArchive($data['id'], $data['filePos']);
        }
    }

    function safePost($data) {
        foreach ($data as $k => $v) {
            $data[$k] = stripslashes(htmlentities($this->db->connection->real_escape_string(strip_tags($v))));
        }
        return $data;
    }

    function clearAllAssign() {
        $this->tpl->clearAllAssign();
    }
}