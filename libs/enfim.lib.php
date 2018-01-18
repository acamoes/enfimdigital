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

    function login($error = '') {
        $this->tpl->assign('error', $error);
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
                        $this->tpl->assign('myAgenda', $_SESSION['users']->myAgenda) :
                        $this->tpl->assign('myAgenda', array());
        $_SESSION['users']->getMyCourses() ?
                        $this->tpl->assign('myCourses', $_SESSION['users']->myCourses) :
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
        $this->tpl->assign('action', 'formandos');
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

    function equipaExecutiva($request) {
        if ($_SESSION['users']->permission != 'Equipa Executiva') {
            $this->login('Acesso negado');
            exit;
        }
        $data                        = $this->safePost($request);
        !isset($data['search']) && $data['search']              = '';
        !isset($data['tab']) && $data['tab']                 = 'utilizadores';
        ($data['tab'] != 'formacoes') && $data['subTab']              = '';
        (!isset($data['subTab']) && $data['tab'] == 'formacoes') && $data['subTab']              = 'inscritos';
        isset($data['docType']) && $this->tpl->assign('docType', $data['docType']);
        isset($data['equipaExecutivaFormacoesIdCourses']) && $this->tpl->assign('equipaExecutivaFormacoesIdCourses', $data['equipaExecutivaFormacoesIdCourses']);
        isset($data['equipaExecutivaFormacoesIdCourses']) && $data['idCourses']           = $data['equipaExecutivaFormacoesIdCourses'];
        $_SESSION['equipaExecutiva'] = new EquipaExecutiva($data);
        $this->tpl->assign('users', $_SESSION['users']);
        $this->tpl->assign('equipaExecutiva', $_SESSION['equipaExecutiva']);
        $this->tpl->assign('action', 'equipaExecutiva');
        $this->tpl->assign('objTabs', $_SESSION['equipaExecutiva']->tabs);
        $this->tpl->assign('tabActive', $data['tab']);
        $this->tpl->assign('currentTab', $data['tab']);
        $this->tpl->assign('objSubTabs', (new Formacoes())->tabs);
        $this->tpl->assign('subTabActive', $data['subTab']);
        $this->tpl->assign('currentSubTab', $data['subTab']);
        switch ($data['task']) {
            case "dashboard":
                $this->tpl->display('enfim_equipaExecutiva.tpl');
                break;
            case "contexto":
                $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_contexto.tpl');
                break;
            case "search":
                if ($data['tab'] != 'formacoes') {
                    $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '.tpl');
                }
                else {
                    $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_' . $data['subTab'] . '.tpl');
                }
                break;
            case "adicionar":
                if ($data['tab'] == 'formacoes') {
                    if (isset($data['searchUtilizadores'])) {
                        $this->tpl->assign('error', $_SESSION['equipaExecutiva']->{$data['task'] . ucfirst($data['tab']) . ucfirst($data['subTab'])}($data));
                        $this->tpl->display('enfim_error.tpl');
                    }
                }
                break;
            case "novo":
                unset($_SESSION ['idDocument']);
                if ($data['tab'] == 'formacoes') {
                    if (isset($data['searchUtilizadores'])) {
                        if ($data['subTab'] == 'inscritos') {
                            $this->tpl->assign('resultado' . ucfirst($data['subTab']), $_SESSION['equipaExecutiva']->getUtlizadoresNaoInscritos($data));
                        }
                        elseif ($data['subTab'] == 'equipa') {
                            $this->tpl->assign('resultado' . ucfirst($data['subTab']), $_SESSION['equipaExecutiva']->getUtlizadoresSemEquipa($data));
                        }
                        elseif ($data['subTab'] == 'sessoes') {
                            $this->tpl->assign('resultado' . ucfirst($data['subTab']), $_SESSION['equipaExecutiva']->getUtlizadoresEquipa($data));
                            $this->tpl->assign('data', $data);
                        }
                        else {
                            $this->tpl->assign('resultado' . ucfirst($data['subTab']), $_SESSION['equipaExecutiva']->{'get' . ucfirst($data['subTab'])}($data));
                        }
                        $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_' . $data['subTab'] . '_' . $data['task'] . '_resultado.tpl');
                    }
                    else {
                        $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_' . $data['subTab'] . '_' . $data['task'] . '.tpl');
                    }
                }
                else {
                    $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_' . $data['task'] . '.tpl');
                }
                break;
            case "ver":
            case "editar":
                switch ($data['tab']) {
                    case "utilizadores": $this->tpl->assign('utilizador', $_SESSION['equipaExecutiva']->getUtilizador($data));
                        break;
                    case "cursos": $this->tpl->assign('curso', $_SESSION['equipaExecutiva']->getCurso($data));
                        break;
                    case "modulos": $this->tpl->assign('modulo', $_SESSION['equipaExecutiva']->getModulo($data));
                        break;
                    case "calendarios": $this->tpl->assign('calendario', $_SESSION['equipaExecutiva']->getCalendario($data));
                        break;
                    case "avaliacoes": $this->tpl->assign('avaliacao', $_SESSION['equipaExecutiva']->getAvaliacao($data));
                        break;
                    case "documentos":
                        $docs                    = $_SESSION['equipaExecutiva']->getDocumento($data);
                        $_SESSION ['idDocument'] = $docs['idDocuments'];
                        $this->tpl->assign('docType', $docs['dTipo']);
                        $this->tpl->assign('documento', $docs);
                        break;
                    case "formacoes":
                        if ($data['subTab'] == 'inscritos' || $data['subTab'] == 'equipa') {
                            $this->tpl->assign('utilizador', $_SESSION['equipaExecutiva']->getInscrito($data));
                        }
                        elseif ($data['subTab'] == 'sessoes') {
                            $this->tpl->assign('sessao', $_SESSION['equipaExecutiva']->getSessao($data));
                        }
                        break;
                    default: break;
                }
                ($data['tab'] != 'formacoes') ?
                                $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_' . $data['task'] . '.tpl') :
                                $this->tpl->display('enfim_equipaExecutiva_' . $data['tab'] . '_' . $data['subTab'] . '_' . $data['task'] . '.tpl');

                break;
            case "inserir":
            case "atualizar":
            case "apagar":
            case "restaurar":
                if ($data['tab'] == 'formacoes') {
                    $this->tpl->assign('error', $_SESSION['equipaExecutiva']->{$data['task'] . ucfirst($data['tab']) . ucfirst($data['subTab'])}($data));
                    $this->tpl->display('enfim_error.tpl');
                }
                else {
                    $this->tpl->assign('error', $_SESSION['equipaExecutiva']->{$data['task'] . ucfirst($data['tab'])}($data));
                    $_SESSION['equipaExecutiva']->{$data['tab']} = $_SESSION['equipaExecutiva']->{'get' . ucfirst($data['tab'])}($data);
                    $this->tpl->display('enfim_error.tpl');
                }
                break;
            case "form":
                echo $_SESSION['equipaExecutiva']->{$data['func']}($data);
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
        elseif ($data['task'] == "getArchiveAll") {
            $files->getArchiveAll($data['id'], $data['filePos']);
        }
    }

    function safePost($data) {
        foreach ($data as $k => $v) {
            $data[$k] = stripslashes($this->db->connection->real_escape_string(strip_tags($v)));
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

    static function s($texto, $tamanho) {
        return "<span title='" . $texto . "' style='cursor:pointer'>" . substr($texto, 0, $tamanho) . "</span>";
    }
}