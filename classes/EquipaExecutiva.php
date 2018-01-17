<?php

/**
 * Description of EquipaExecutiva
 *
 * @author João Madeira
 */
class EquipaExecutiva {
    public $tabs;
    public $utilizadores;
    public $cursos;
    public $modulos;
    public $documentos;
    public $calendarios;
    public $formacoes;
    public $avaliacoes;
    public $contexto;

    function __construct($data) {
        $this->getTabs();
        $this->utilizadores                       = $this->getUtilizadores($data);
        $this->cursos                             = $this->getCursos($data);
        $this->modulos                            = $this->getModulos($data);
        $this->documentos                         = $this->getDocumentos($data);
        $this->calendarios                        = $this->getCalendarios($data);
        $this->formacoes                          = $this->getFormacoes($data);
        $this->avaliacoes                         = $this->getAvaliacoes($data);
        $this->contexto['formacoes']['inscritos'] = $this->getInscritos($data);
        /* $this->contexto['formacoes']['equipa'] = $this->getEquipa($data);
          $this->contexto['formacoes']['sessoes'] = $this->getSessoes($data);
          $this->contexto['formacoes']['ficheiros'] = $this->getFicheiros($data);
          $this->contexto['formacoes']['avaliacoes'] = $this->getAvaliacoes($data); */
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":[{"text":"Utilizadores","tab":"utilizadores"},{"text":"Cursos","tab":"cursos"},{"text":"Módulos","tab":"modulos"},{"text":"Documentos","tab":"documentos"},{"text":"Calendários","tab":"calendarios"},{"text":"Formações","tab":"formacoes"},{"text":"Avaliações","tab":"avaliacoes"} ]}');
    }

    function getUtilizadores($data) {
        return Utilizadores::getUtilizadores($data);
    }

    function getCursos($data) {
        return Cursos::getCursos($data);
    }

    function getModulos($data) {
        return Modulos::getModulos($data);
    }

    function getDocumentos($data) {
        return Documentos::getDocumentos($data);
    }

    function getCalendarios($data) {
        return Calendarios::getCalendarios($data);
    }

    function getAvaliacoes($data) {
        return Avaliacoes::getAvaliacoes($data);
    }

    function getUtilizador($data) {
        return Utilizadores::getUtilizador($data);
    }

    function inserirUtilizadores($data): array {
        return Utilizadores::inserirUtilizadores($data);
    }

    function atualizarUtilizadores($data): array {
        return Utilizadores::atualizarUtilizadores($data);
    }

    function apagarUtilizadores($data): array {
        return Utilizadores::apagarUtilizadores($data);
    }

    function getCurso($data): array {
        return Cursos::getCurso($data);
    }

    function inserirCursos($data): array {
        return Cursos::inserirCursos($data);
    }

    function atualizarCursos($data): array {
        return Cursos::atualizarCursos($data);
    }

    function apagarCursos($data): array {
        return Cursos::apagarCursos($data);
    }

    function getModulo($data) {
        return Modulos::getModulo($data);
    }

    function inserirModulos($data) {
        return Modulos::inserirModulos($data);
    }

    function atualizarModulos($data) {
        return Modulos::atualizarModulos($data);
    }

    function apagarModulos($data): array {
        return Modulos::apagarModulos($data);
    }

    function getDocumento($data) {
        return Documentos::getDocumento($data);
    }

    function inserirDocumento($data) {
        return Documentos::inserirDocumento($data);
    }

    function inserirDocumentoFicheiro($data) {
        return Documentos::inserirDocumentoFicheiro($data);
    }

    function atualizarDocumentosFicheiro($data) {
        return Documentos::atualizarDocumentosFicheiro($data);
    }

    function atualizarDocumentos($data) {
        return $this->inserirDocumento($data);
    }

    function apagarDocumentos($data) {
        return Documentos::apagarDocumentos($data);
    }

    function getModulosCurso($data) {
        return Modulos::getModulosCurso($data);
    }

    function getCalendario($data) {
        return Calendarios::getCalendario($data);
    }

    function inserirCalendarios($data) {
        return Calendarios::inserirCalendarios($data);
    }

    function atualizarCalendarios($data) {
        return Calendarios::atualizarCalendarios($data);
    }

    function apagarCalendarios($data) {
        return Calendarios::apagarCalendarios($data);
    }

    function getAvaliacao($data) {
        return Avaliacoes::getAvaliacao($data);
    }

    function inserirAvaliacoes($data) {
        return Avaliacoes::inserirAvaliacoes($data);
    }

    function atualizarAvaliacoes($data) {
        return Avaliacoes::atualizarAvaliacoes($data);
    }

    function apagarAvaliacoes($data) {
        return Avaliacoes::apagarAvaliacoes($data);
    }

    function getModulosCursoOption($data) {
        return Modulos::getModulosCursoOption($data);
    }

    function getFormacoes($data) {
        return Formacoes::getFormacoes($data);
    }

    function getInscritos($data) {
        return Formacoes::getFormacoesInscritos($data);
    }

    function getInscrito($data) {
        $query     = "SELECT * " . "FROM users_courses uc " . "INNER JOIN users u " . "ON uc.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? "AND uc.idCourses=" . $data ['idCourses'] . " " : " ") .
                (key_exists("idUsers", $data) ? "AND uc.idUsers=" . $data ['idUsers'] . " " : " ");
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    function getUtlizadoresNaoInscritos($data) {
        $query     = "SELECT * FROM users u " .
                "WHERE u.idUsers NOT IN (SELECT idUsers FROM users_courses WHERE idCourses=" . $data['idCourses'] . ") " .
                "AND (name LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR email LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR aepId LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR permission LIKE '%" . $data['searchUtilizadores'] . "%' )";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function adicionarFormacoesInscritos($data) {
        $query     = "INSERT INTO users_courses (idUsers,idCourses) " .
                "VALUES (" . $data['idUsers'] . "," . $data['idCourses'] . ") ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    function apagarFormacoesInscritos($data) {
        $query     = "DELETE FROM users_courses WHERE idUsers=" . $data['idUsers'] . " AND idCourses=" . $data['idCourses'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    function atualizarFormacoesInscritos($data) {
        $data ['local']   = substr($data ['zipCode'], 9);
        $data ['zipCode'] = substr($data ['zipCode'], 0, 8);
// $data['password']=$this->generatePassword(8);
        $query            = "UPDATE users SET " .
                "username='" . $data ['username'] . "'," .
                "email='" . $data ['email'] . "'," .
                "name='" . $data ['name'] . "'," .
                "sigla='" . $data ['sigla'] . "'," .
                "status='" . $data ['status'] . "'," .
                "birthDate='" . $data ['birthDate'] . "'," .
                "address='" . $data ['address'] . "'," .
                "zipCode='" . $data ['zipCode'] . "'," .
                "local='" . $data ['local'] . "'," .
                "mobile='" . $data ['mobile'] . "'," .
                "telephone='" . $data ['telephone'] . "'," .
                "observations='" . $data ['observations'] . "'," .
                "iban='" . $data ['iban'] . "'," .
                "aepId='" . $data ['aepId'] . "' " .
                "WHERE idUsers=" . $data ['idUsers'];
        $con              = new Database ();
        $resultado        = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        $query     = "UPDATE users_courses SET " .
                "unit='" . $data ['unit'] . "'," .
                "unitType='" . $data ['unitType'] . "'," .
                "observations='" . $data ['observations'] . "', " .
                "rank='" . $data ['rank'] . "'," .
                "boRank='" . $data ['boRank'] . "'," .
                "qa='" . (key_exists('qa', $data) ? 'on' : '') . "'," .
                "payment='" . (key_exists('payment', $data) ? 'on' : '') . "'," .
                "value=" . ($data ['value'] == '' ? 0 : $data ['value']) . " , " .
                "receipt='" . $data ['receipt'] . "'," .
                "boCourse='" . $data ['boCourse'] . "', " .
                "attended='" . (key_exists('attended', $data) ? 'on' : '') . "', " .
                "passedCourse='" . (key_exists('passedCourse', $data) ? 'on' : '') . "', " .
                "passedInternship='" . (key_exists('passedInternship', $data) ? 'on' : '') . "', " .
                "passed='" . (key_exists('passed', $data) ? 'on' : '') . "' " .
                "WHERE idUsers=" . $data ['idUsers'] . " AND idCourses=" . $data ['idCourses'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }
}