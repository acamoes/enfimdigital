<?php

class Enfim
{
    // database object
    var $database = null;
    // smarty template object
    var $tpl      = null;
    // error messages
    var $error    = null;

    /**
     * class constructor
     */
    public function __construct()
    {
        $this->database = new Database();
        $this->tpl      = new Enfim_Smarty;
    }

    function login($error = '')
    {
        $this->log($error);
        $this->tpl->assign('error', $error);
        $this->tpl->display('enfim_login.tpl');
    }

    function authentication($request)
    {
        $data = $this->safePost($request);
        if (isset($data['recoverPassword'])) {
            session_destroy();
            $this->tpl->assign('error', $this->error);
            $this->tpl->assign('botKey', BOT_KEY);
            $this->tpl->display('enfim_recover.tpl');
        } else {
            $_SESSION['users'] = new Users();
            if ($_SESSION['users']->login($data['username'], $data['password'])) {
                $this->home();
            } else {
                session_destroy();
                $this->error = 'Credenciais incorretas';
                $this->tpl->assign('error', $this->error);
                $this->tpl->display('enfim_login.tpl');
            }
        }
    }

    function recover($request)
    {

        $data  = $this->safePost($request);
        $users = new Users();
        if (!$users->recover($data)) {
            $this->error = 'Contactar a Equipa Executiva da ENFIM.';
        } else {
            $this->error = 'Verifique o seu email.';
        }
        session_destroy();
        $this->tpl->assign('error', $this->error);
        $this->tpl->display('enfim_login.tpl');
    }

    function home()
    {
        $_SESSION['users']->getMyAgenda() ?
                $this->tpl->assign('myAgenda', $_SESSION['users']->myAgenda) :
                $this->tpl->assign('myAgenda', array());
        $_SESSION['users']->getMyCourses() ?
                $this->tpl->assign('myCourses', $_SESSION['users']->myCourses) :
                $this->tpl->assign('myCourses', array());
        $this->tpl->assign('users', $_SESSION['users']);
        $this->tpl->display('enfim_home.tpl');
    }

    function formandos($request)
    {
        $data = $this->safePost($request);
        if (!$_SESSION['users']->isFormando($request['idCourses'])) {
            $this->login('Acesso negado');
            return;
        }
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
                $this->tpl->assign('estado', $formandos->evaluationStatus);
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

    function servicosCentrais($request)
    {
        if ($_SESSION['users']->permission != 'Serviços Centrais') {
            $this->login('Acesso negado');
            return;
        }
        $data              = $this->safePost($request);
        !isset($data['search']) && $data['search']    = '';
        !isset($data['tab']) && $data['tab']       = 'utilizadores';
        ($data['tab'] != 'formacoes') && $data['subTab']    = '';
        (!isset($data['subTab']) && $data['tab'] == 'formacoes') && $data['subTab']    = 'inscritos';
        isset($data['docType']) && $this->tpl->assign('docType', $data['docType']);
        isset($data['servicosCentraisFormacoesIdCourses']) && $this->tpl->assign('servicosCentraisFormacoesIdCourses',
                $data['servicosCentraisFormacoesIdCourses']);
        isset($data['servicosCentraisFormacoesIdCourses']) && $data['idCourses'] = $data['servicosCentraisFormacoesIdCourses'];

        $this->log($data);

        $_SESSION['servicosCentrais'] = new ServicosCentrais($data);
        $this->tpl->assign('users', $_SESSION['users']);
        $this->tpl->assign('servicosCentrais', $_SESSION['servicosCentrais']);
        $this->tpl->assign('action', 'servicosCentrais');
        $this->tpl->assign('objTabs', $_SESSION['servicosCentrais']->tabs);
        $this->tpl->assign('tabActive', $data['tab']);
        $this->tpl->assign('currentTab', $data['tab']);
        $this->tpl->assign('objSubTabs', (new Formacoes())->getServicosCentraisTabs());
        $this->tpl->assign('subTabActive', $data['subTab']);
        $this->tpl->assign('currentSubTab', $data['subTab']);
        switch ($data['task']) {
            case "dashboard":
                $this->tpl->display('enfim_servicosCentrais.tpl');
                break;
            case "contexto":
                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_contexto.tpl');
                break;
            case "search":
                if ($data['tab'] != 'formacoes') {
                    $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'.tpl');
                } else {
                    $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'.tpl');
                }
                break;
            case "adicionar":
                if ($data['tab'] == 'formacoes') {
                    if (isset($data['searchUtilizadores'])) {
                        $this->tpl->assign('error',
                            $_SESSION['servicosCentrais']->{$data['task'].ucfirst($data['tab']).ucfirst($data['subTab'])}($data));
                        $this->tpl->display('enfim_error.tpl');
                    }
                }
                break;
            case "novo":
                unset($_SESSION ['ficheiros']);
                if ($data['tab'] == 'formacoes') {
                    if (isset($data['searchUtilizadores'])) {
                        if ($data['subTab'] == 'inscritos') {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['servicosCentrais']->getUtlizadoresNaoInscritos($data));
                        } elseif ($data['subTab'] == 'equipa') {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['servicosCentrais']->getUtlizadoresSemEquipa($data));
                        } else {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['servicosCentrais']->{'get'.ucfirst($data['subTab'])}($data));
                        }
                        $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'_resultado.tpl');
                    } else {
                        $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                    }
                } else {
                    $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['task'].'.tpl');
                }
                break;
            case "ver":
                unset($_SESSION ['ficheiros']);
                switch ($data['tab']) {
                    case "utilizadores":
                        $this->tpl->assign('utilizador', $_SESSION['servicosCentrais']->getUtilizador($data));
                        ($data['tab'] != 'formacoes') ?
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['task'].'.tpl') :
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                        break;
                    case "calendarios":
                        $this->tpl->assign('calendario', $_SESSION['servicosCentrais']->getCalendario($data));
                        ($data['tab'] != 'formacoes') ?
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['task'].'.tpl') :
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                        break;
                    case "formacoes":
                        if ($data['subTab'] == 'inscritos' || $data['subTab'] == 'equipa') {
                            $this->tpl->assign('utilizador', $_SESSION['servicosCentrais']->getInscrito($data));
                        }
                        ($data['tab'] != 'formacoes') ?
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['task'].'.tpl') :
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                        break;
                    default: break;
                }
                break;
            case "editar":
                unset($_SESSION ['ficheiros']);
                switch ($data['tab']) {
                    case "utilizadores":
                        $this->tpl->assign('utilizador', $_SESSION['servicosCentrais']->getUtilizador($data));
                        ($data['tab'] != 'formacoes') ?
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['task'].'.tpl') :
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                        break;
                    case "formacoes":
                        if ($data['subTab'] == 'inscritos') {
                            $this->tpl->assign('utilizador', $_SESSION['servicosCentrais']->getInscrito($data));
                        }
                        ($data['tab'] != 'formacoes') ?
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['task'].'.tpl') :
                                $this->tpl->display('enfim_servicosCentrais_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                        break;
                    default: break;
                }
                break;
            case "inserir":
            case "atualizar":
            case "apagar":
            case "resetPassword":
                if ($data['tab'] == 'formacoes') {
                    $this->tpl->assign('error',
                        $_SESSION['servicosCentrais']->{$data['task'].ucfirst($data['tab']).ucfirst($data['subTab'])}($data));
                    $this->tpl->display('enfim_error.tpl');
                } else {
                    $this->tpl->assign('error',
                        $_SESSION['servicosCentrais']->{$data['task'].ucfirst($data['tab'])}($data));
                    $_SESSION['servicosCentrais']->{$data['tab']} = $_SESSION['servicosCentrais']->{'get'.ucfirst($data['tab'])}($data);
                    $this->tpl->display('enfim_error.tpl');
                }
                break;
            case "form":
                echo $_SESSION['servicosCentrais']->{$data['func']}($data);
                break;
            case "getEAEP":
                echo $_SESSION['servicosCentrais']->getUtilizadoresEAEP($data);
                break;
            default:
                $this->clearAllAssign();
                $this->home();
                break;
        }
    }

    function equipaExecutiva($request)
    {

        if ($_SESSION['users']->permission != 'Equipa Executiva') {
            $this->login('Acesso negado');
            return;
        }
        $data              = $this->safePost($request);
        !isset($data['search']) && $data['search']    = '';
        !isset($data['tab']) && $data['tab']       = 'utilizadores';
        ($data['tab'] != 'formacoes') && $data['subTab']    = '';
        (!isset($data['subTab']) && $data['tab'] == 'formacoes') && $data['subTab']    = 'inscritos';
        isset($data['docType']) && $this->tpl->assign('docType', $data['docType']);
        isset($data['equipaExecutivaFormacoesIdCourses']) && $this->tpl->assign('equipaExecutivaFormacoesIdCourses',
                $data['equipaExecutivaFormacoesIdCourses']);
        isset($data['equipaExecutivaFormacoesIdCourses']) && $data['idCourses'] = $data['equipaExecutivaFormacoesIdCourses'];

        $this->log($data);

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
                $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_contexto.tpl');
                break;
            case "search":
                if ($data['tab'] != 'formacoes') {
                    $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'.tpl');
                } else {
                    $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['subTab'].'.tpl');
                }
                break;
            case "adicionar":
                if ($data['tab'] == 'formacoes') {
                    if (isset($data['searchUtilizadores'])) {
                        $this->tpl->assign('error',
                            $_SESSION['equipaExecutiva']->{$data['task'].ucfirst($data['tab']).ucfirst($data['subTab'])}($data));
                        $this->tpl->display('enfim_error.tpl');
                    }
                }
                break;
            case "novo":
                unset($_SESSION ['ficheiros']);
                if ($data['tab'] == 'formacoes') {
                    if (isset($data['searchUtilizadores'])) {
                        if ($data['subTab'] == 'inscritos') {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['equipaExecutiva']->getUtlizadoresNaoInscritos($data));
                        } elseif ($data['subTab'] == 'equipa') {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['equipaExecutiva']->getUtlizadoresSemEquipa($data));
                        } elseif ($data['subTab'] == 'sessoes') {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['equipaExecutiva']->getUtlizadoresEquipa($data));
                            $this->tpl->assign('data', $data);
                        } else {
                            $this->tpl->assign('resultado'.ucfirst($data['subTab']),
                                $_SESSION['equipaExecutiva']->{'get'.ucfirst($data['subTab'])}($data));
                        }
                        $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'_resultado.tpl');
                    } else {
                        if ($data['subTab'] == 'ficheiros') { //JM
                            $this->tpl->assign('modulos'.ucfirst($data['subTab']),
                                $_SESSION['equipaExecutiva']->getFormacoesModulos($data));
                        }
                        $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                    }
                } else {
                    $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['task'].'.tpl');
                }
                break;
            case "ver":
            case "editar":
                unset($_SESSION ['ficheiros']);
                switch ($data['tab']) {
                    case "utilizadores": $this->tpl->assign('utilizador',
                            $_SESSION['equipaExecutiva']->getUtilizador($data));
                        break;
                    case "cursos": $this->tpl->assign('curso', $_SESSION['equipaExecutiva']->getCurso($data));
                        break;
                    case "modulos": $this->tpl->assign('modulo', $_SESSION['equipaExecutiva']->getModulo($data));
                        break;
                    case "calendarios": $this->tpl->assign('calendario',
                            $_SESSION['equipaExecutiva']->getCalendario($data));
                        break;
                    case "avaliacoes": $this->tpl->assign('avaliacao', $_SESSION['equipaExecutiva']->getAvaliacao($data));
                        break;
                    case "documentos":
                        $docs                                 = $_SESSION['equipaExecutiva']->getDocumento($data);
                        $_SESSION['ficheiros']['idDocuments'] = $docs['idDocuments'];
                        $this->tpl->assign('docType', $docs['dTipo']);
                        $this->tpl->assign('documento', $docs);
                        break;
                    case "formacoes":
                        if ($data['subTab'] == 'inscritos' || $data['subTab'] == 'equipa') {
                            $this->tpl->assign('utilizador', $_SESSION['equipaExecutiva']->getInscrito($data));
                        } elseif ($data['subTab'] == 'sessoes') {
                            $this->tpl->assign('sessao', $_SESSION['equipaExecutiva']->getSessao($data));
                        } elseif ($data['subTab'] == 'ficheiros') {
                            $this->tpl->assign('modulos'.ucfirst($data['subTab']),
                                $_SESSION['equipaExecutiva']->getFormacoesModulos($data));
                            $docs                                 = $_SESSION['equipaExecutiva']->getFicheiro($data);
                            $_SESSION['ficheiros']['idDocuments'] = $docs['idDocuments'];
                            $this->tpl->assign('docType', $docs['dTipo']);
                            $this->tpl->assign('ficheiros', $docs);
                        } elseif ($data['subTab'] == 'informacoes') {
                            $docs                                    = $_SESSION['equipaExecutiva']->getInformacao($data);
                            $docs['dTipo']                           = 'Informações';
                            $_SESSION['ficheiros']['idInformations'] = $docs['idInformations'];
                            $this->tpl->assign('docType', $docs['dTipo']);
                            $this->tpl->assign('informacoes', $docs);
                        }
                        break;
                    default: break;
                }
                ($data['tab'] != 'formacoes') ?
                        $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['task'].'.tpl') :
                        $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');

                break;
            case "participou":
            case "passouCurso":
            case "passouEstagio":
            case "passouEtapa":
            case "reset":
                $this->tpl->assign('error',
                    $_SESSION['equipaExecutiva']->{$data['task'].ucfirst($data['tab']).ucfirst($data['subTab'])}($data));
                $this->tpl->display('enfim_error.tpl');
                break;
            case "aprovar":
            case "inserir":
            case "atualizar":
            case "apagar":
            case "restaurar":
            case "resetPassword":
            case "selecionar":
                if ($data['tab'] == 'formacoes') {
                    $this->tpl->assign('error',
                        $_SESSION['equipaExecutiva']->{$data['task'].ucfirst($data['tab']).ucfirst($data['subTab'])}($data));
                    $this->tpl->display('enfim_error.tpl');
                } else {
                    $this->tpl->assign('error',
                        $_SESSION['equipaExecutiva']->{$data['task'].ucfirst($data['tab'])}($data));
                    $_SESSION['equipaExecutiva']->{$data['tab']} = $_SESSION['equipaExecutiva']->{'get'.ucfirst($data['tab'])}($data);
                    $this->tpl->display('enfim_error.tpl');
                }
                break;
            case "fecharAvaliacoes":
            case "distribuirAvaliacoes";
                if ($data['tab'] == 'formacoes' && $data['subTab'] == 'avaliacoes') {
                    $this->tpl->assign('error',
                        $_SESSION['equipaExecutiva']->{$data['task'].ucfirst($data['tab']).ucfirst($data['subTab'])}($data));
                    $this->tpl->display('enfim_error.tpl');
                }
                break;
            case "form":
                echo $_SESSION['equipaExecutiva']->{$data['func']}($data);
                break;
            case "getEAEP":
                echo $_SESSION['equipaExecutiva']->getUtilizadoresEAEP($data);
                break;
            case "relatoriosAvaliacoes":
                $this->tpl->display('enfim_equipaExecutiva_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                break;
            default:
                $this->clearAllAssign();
                $this->home();
                break;
        }
    }

    function formadores($request)
    {
        $data = $this->safePost($request);
        if (!$_SESSION['users']->isFormador($data['idCourses']) && !$_SESSION['users']->isDiretor($data['idCourses'])) {
            $this->login('Acesso negado');
            return;
        }
        $_SESSION['formadores'] = new Formadores($data);
        if (empty($_SESSION['formadores']->idCourse)) {
            $this->login('Acesso negado');
            return;
        }
        $data['idCourse'] = $_SESSION['formadores']->idCourse;
        !isset($data['search']) && $data['search']   = '';
        !isset($data['tab']) && $data['tab']      = 'inscritos';
        unset($data['subTab']);
        isset($data['docType']) && $this->tpl->assign('docType', $data['docType']);
        $this->tpl->assign('idCourses', $data['idCourses']);

        $this->log($data);

        $this->tpl->assign('users', $_SESSION['users']);
        $this->tpl->assign('formadores', $_SESSION['formadores']);
        $this->tpl->assign('action', 'formadores');
        $this->tpl->assign('objTabs', $_SESSION['formadores']->tabs);
        $this->tpl->assign('tabActive', $data['tab']);
        $this->tpl->assign('currentTab', $data['tab']);

        switch ($data['task']) {
            case "getCourse":
                $this->tpl->display('enfim_formadores.tpl');
                break;
            case "ver":
            case "editar":
                unset($_SESSION ['ficheiros']);
                switch ($data['tab']) {
                    case "inscritos":
                        $this->tpl->assign('utilizador', $_SESSION['formadores']->getInscrito($data));
                        break;
                    case "equipa":
                        $this->tpl->assign('utilizador', $_SESSION['formadores']->getEquipa($data));
                        break;
                    case "sessoes":
                        $this->tpl->assign('sessao', $_SESSION['formadores']->getSessao($data));
                        break;
                    case "ficheiros":
                        $this->tpl->assign('modulos'.ucfirst($data['tab']), $_SESSION['formadores']->getModulos($data));
                        $docs                                    = $_SESSION['formadores']->getFicheiro($data);
                        $_SESSION['ficheiros']['idDocuments']    = $docs['idDocuments'];
                        $this->tpl->assign('docType', $docs['dTipo']);
                        $this->tpl->assign('ficheiros', $docs);
                        break;
                    case "informacoes":
                        $docs                                    = $_SESSION['formadores']->getInformacao($data);
                        $docs['dTipo']                           = 'Informações';
                        $_SESSION['ficheiros']['idInformations'] = $docs['idInformations'];
                        $this->tpl->assign('docType', $docs['dTipo']);
                        $this->tpl->assign('informacoes', $docs);
                        break;
                    case "avaliacoes":
                        $this->tpl->assign('avaliacoesFormandos', $_SESSION['formadores']->getAvaliacaoFormandos($data));
                        break;
                    case "avaliacoesFormadores":
                        $this->tpl->assign('avaliacoesFormandos', $_SESSION['formadores']->getAvaliacaoFormadores($data));
                        break;
                    case "documentos":
                        $docs                                    = $_SESSION['formadores']->getDocumento($data);
                        $_SESSION['ficheiros']['idDocuments']    = $docs['idDocuments'];
                        $this->tpl->assign('docType', $docs['dTipo']);
                        $this->tpl->assign('documento', $docs);
                        break;
                    default:
                        break;
                }
                $this->tpl->display('enfim_formadores_'.$data['tab'].'_'.$data['task'].'.tpl');
                break;
            case "novo":
                unset($_SESSION ['ficheiros']);
                if (isset($data['searchUtilizadores'])) {
                    if ($data['tab'] == 'inscritos') {
                        $this->tpl->assign('resultado'.ucfirst($data['tab']),
                            $_SESSION['formadores']->getUtlizadoresNaoInscritos($data));
                    } elseif ($data['tab'] == 'equipa') {
                        $this->tpl->assign('resultado'.ucfirst($data['tab']),
                            $_SESSION['formadores']->getUtilizadoresSemEquipa($data));
                    } elseif ($data['tab'] == 'sessoes') {
                        $this->tpl->assign('resultado'.ucfirst($data['tab']),
                            $_SESSION['formadores']->getUtlizadoresEquipa($data));
                        $this->tpl->assign('data', $data);
                    } else {
                        $this->tpl->assign('resultado'.ucfirst($data['tab']),
                            $_SESSION['formadores']->{'get'.ucfirst($data['tab'])}($data));
                    }
                    $this->tpl->display('enfim_formadores_'.$data['tab'].'_'.$data['task'].'_resultado.tpl');
                } else {
                    if ($data['tab'] == 'ficheiros') {
                        $this->tpl->assign('modulos'.ucfirst($data['tab']), $_SESSION['formadores']->getModulos($data));
                    }
                    $this->tpl->display('enfim_formadores_'.$data['tab'].'_'.$data['task'].'.tpl');
                }

                break;
            case "participou":
            case "passouCurso":
            case "passouEstagio":
            case "passouEtapa":
            case "reset":
                $this->tpl->assign('error', $_SESSION['formadores']->{$data['task'].ucfirst($data['tab'])}($data));
                $this->tpl->display('enfim_error.tpl');
                break;
            case "aprovar":
            case "inserir":
            case "atualizar":
            case "apagar":
            case "restaurar":
            case "resetPassword":
            case "selecionar":
                $this->tpl->assign('error', $_SESSION['formadores']->{$data['task'].ucfirst($data['tab'])}($data));
                $_SESSION['formadores']->{$data['tab']} = $_SESSION['formadores']->{'get'.ucfirst($data['tab'])}($data);
                $this->tpl->display('enfim_error.tpl');
                break;
            case "adicionar":
                if (isset($data['searchUtilizadores'])) {
                    $this->tpl->assign('error', $_SESSION['formadores']->{$data['task'].ucfirst($data['tab'])}($data));
                    $this->tpl->display('enfim_error.tpl');
                }
                break;
            case "search":
                $this->tpl->display('enfim_formadores_'.$data['tab'].'.tpl');
                break;
            case "fecharAvaliacoes":
            case "distribuirAvaliacoes":
                if ($data['tab'] == 'avaliacoes') {
                    $this->tpl->assign('error', $_SESSION['formadores']->{$data['task'].ucfirst($data['tab'])}($data));
                    $this->tpl->display('enfim_error.tpl');
                }
                break;
            case "getEvaluation":
                $html = $_SESSION['formadores']->buildEvaluation($data);
                $this->tpl->assign('error', '');
                $this->tpl->assign('estado', $_SESSION['formadores']->avaliacoesFormandoresStatus);
                $this->tpl->assign('title', 'Questionário');
                $this->tpl->assign('html', $html);
                $this->tpl->display('enfim_evaluation.tpl');
                break;
            case "getEAEP":
                echo $_SESSION['formadores']->getUtilizadoresEAEP($data);
                break;
            case "saveEvaluation":
                $_SESSION['formadores']->saveEvaluation($data);
                $this->tpl->display('enfim_close.tpl');
                break;
            case "relatoriosAvaliacoes":
                $this->tpl->display('enfim_formadores_'.$data['tab'].'_'.$data['subTab'].'_'.$data['task'].'.tpl');
                break;
            default:
                $this->clearAllAssign();
                $this->home();
                break;
        }
    }

    function files($request)
    {
        $data  = $this->safePost($request);
        $files = new Files();
        if ($data['task'] == "getInformations") {
            $files->getInformations($data['id']);
        } elseif ($data['task'] == "getArchive") {
            $files->getArchive($data['id'], $data['filePos']);
        } elseif ($data['task'] == "getArchiveAll") {
            $files->getArchiveAll($data['id'], $data['filePos']);
        } elseif ($data['task'] == "getFormacoesArchiveAll") {
            $files->getFormacoesArchiveAll($data['id'], $data['filePos']);
        }
    }

    function log($data)
    {
        if (!array_key_exists('users', $_SESSION)) {
            return;
        }
        $query     = "INSERT INTO log (idUser,session,data,trace,date) VALUES (".
            $_SESSION['users']->idUsers.",'".session_id()."','".
            json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_APOS | JSON_HEX_QUOT)."','".
            json_encode(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 0))."','".
            date("Y-m-d H:i:s")."')";
        $con       = new Database();
        $resultado = $con->set($query);
        return $resultado;
    }

    function safePost($data)
    {
        foreach ($data as $k => $v) {
            $data[$k] = stripslashes($this->database->connection->real_escape_string(strip_tags($v)));
        }
        return $data;
    }

    public static function cleanString($_string)
    {
        $string = str_replace(' ', '-', $_string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    function clearAllAssign()
    {
        $this->tpl->clearAllAssign();
    }
    /* public static function s($texto, $tamanho) {
      return "<span title='" . $texto . "' style='cursor:pointer'>" . substr($texto, 0, $tamanho) . "</span>";
      } */
}
