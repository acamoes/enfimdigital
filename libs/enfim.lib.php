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
        $this->db  = new Database();
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

        $data  = $this->safePost($request);
        $users = new Users();
        if ($users->userExists($data['username'])) {
            $email             = $users->getEmailByUsername($data['username']);
            $password          = $users->generatePassword();
            $users->setPasswordByUsername($data['username'], $password);
            $mail              = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth    = true;
            $mail->SMTPSecure  = 'ssl';
            $mail->Host        = 'smtp.gmail.com';
            $mail->Port        = '465';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isHTML();
            $mail->Username    = MAIL_USERNAME;
            $mail->Password    = MAIL_PASSWORD;
            $mail->SetFrom(MAIL_USERNAME);
            $mail->Subject     = 'ENFIM DIGITAL - RECUPERACAO de PASSWORD';
            $mail->Body        = 'ENFIM DIGITAL<br/><br/>Nova password: <strong>' . $password . '</strong><br/>';
            $mail->AddAddress($email);
            $mail->Send();
        }
        session_destroy();
        $this->error = 'Verifique o seu email dos @escoteiros.pt';
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('enfim_login.tpl');
    }

    function home() {
        $_SESSION['users']->getMyAgenda() ?
                        $this->tpl->assign('myAgenda',
                                           $_SESSION['users']->myAgenda) :
                        $this->tpl->assign('myAgenda', array());
        $_SESSION['users']->getMyCourses() ?
                        $this->tpl->assign('myCourses',
                                           $_SESSION['users']->myCourses) :
                        $this->tpl->assign('myCourses', array());
        $this->tpl->assign('users', $_SESSION['users']);
        $this->tpl->display('enfim_home.tpl');
    }

    function formandos($request) {
        $data      = $this->safePost($request);
        $formandos = new Formandos($data);
        if (empty($formandos->course)) {
            return;
        }
        switch ($data['task']) {
            case "getCourse":
                $this->tpl->assign('users', $_SESSION['users']);
                $this->tpl->assign('modulo', 'formandos');
                $this->tpl->assign('formandos', $formandos);
                $this->tpl->assign('objTabs', $formandos->tabs);
                $this->tpl->display('enfim_formandos.tpl');
                break;
            case "getEvaluation":
                $html = $formandos->buildEvaluation($data);
                $this->tpl->assign('error', '');
                $this->tpl->assign('title', 'Questionário');
                $this->tpl->assign('html', $html);
                $this->tpl->display('enfim_evaluation.tpl');
                break;
            case "saveEvaluation":
                $formandos->saveEvaluation($data);
                $this->tpl->display('enfim_close.tpl');
                break;
            default:
                $this->clearAllAssign();
                $this->home();
                break;
        }
    }

    function formadores($request) {
        $data       = $this->safePost($request);
        $formadores = new Formadores($data);
        if (empty($formadores->course)) {
            return;
        }
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

    static function cleanString($_string) {
        $string = str_replace(' ', '-', $_string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    function clearAllAssign() {
        $this->tpl->clearAllAssign();
    }
}