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
        $this->utilizadores = $this->getUtilizadores($data);
        $this->cursos       = $this->getCursos($data);
        $this->modulos      = $this->getModulos($data);
        $this->documentos   = $this->getDocumentos($data);
        $this->calendarios  = $this->getCalendarios($data);
        $this->formacoes    = $this->getFormacoes($data);
        $this->avaliacoes   = $this->getAvaliacoes($data);
        if (key_exists("idCourses", $data)) {
            $this->contexto['formacoes']['inscritos']  = $this->getInscritos($data);
            $this->contexto['formacoes']['equipa']     = $this->getEquipa($data);
            $this->contexto['formacoes']['sessoes']    = $this->getSessoes($data);
            $this->contexto['formacoes']['ficheiros']  = $this->getFicheiros($data);
            $this->contexto['formacoes']['avaliacoes'] = $this->getFormacoesAvaliacoes($data);
        }
        else {
            $this->contexto['formacoes']['inscritos']  = array();
            $this->contexto['formacoes']['equipa']     = array();
            $this->contexto['formacoes']['sessoes']    = array();
            $this->contexto['formacoes']['ficheiros']  = array();
            $this->contexto['formacoes']['avaliacoes'] = array();
        }
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

    function inserirDocumentos($data) {
        return Documentos::inserirDocumentos($data);
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
        return Formacoes::getInscrito($data);
    }

    function getUtlizadoresNaoInscritos($data) {
        return Formacoes::getUtlizadoresNaoInscritos($data);
    }

    function adicionarFormacoesInscritos($data) {
        return Formacoes::adicionarFormacoesInscritos($data);
    }

    function apagarFormacoesInscritos($data) {
        return Formacoes::apagarFormacoesInscritos($data);
    }

    function atualizarFormacoesInscritos($data) {
        return Formacoes::atualizarFormacoesInscritos($data);
    }

    function adicionarFormacoesEquipa($data) {
        return Formacoes::adicionarFormacoesEquipa($data);
    }

    function atualizarFormacoesEquipa($data) {
        return Formacoes::atualizarFormacoesEquipa($data);
    }

    function getUtlizadoresSemEquipa($data) {
        return Formacoes::getUtlizadoresSemEquipa($data);
    }

    function getEquipa1($data) {//just search
        return Formacoes::getEquipa1($data);
    }

    function getEquipa($data) {
        return Formacoes::getEquipa($data);
    }

    function apagarFormacoesEquipa($data) {
        return Formacoes::apagarFormacoesEquipa($data);
    }

    function getSessoes($data) {
        return Formacoes::getSessoes($data);
    }

    function inserirFormacoesSessoes($data) {
        return Formacoes::inserirFormacoesSessoes($data);
    }

    function restaurarFormacoesSessoes($data) {
        return Formacoes::restaurarFormacoesSessoes($data);
    }

    function apagarFormacoesSessoes($data) {
        return Formacoes::apagarFormacoesSessoes($data);
    }

    function getUtlizadoresEquipa($data) {
        return Formacoes::getUtlizadoresEquipa($data);
    }

    function adicionarFormacoesSessoes($data) {
        return Formacoes::adicionarFormacoesSessoes($data);
    }

    function getSessao($data) {
        return Formacoes::getSessao($data);
    }

    function getFormacoesAvaliacoes($data) {
        return Formacoes::getFormacoesAvaliacoes($data);
    }

    function fecharAvaliacoesFormacoesAvaliacoes($data) {
        return Formacoes::fecharAvaliacoesFormacoesAvaliacoes($data);
    }

    function getFicheiros($data) {
        $query = "SELECT * FROM (SELECT " .
                "d.idDocuments, " .
                "d.idCourse, " .
                "d.idCourses, " .
                "d.idModules, " .
                "m.name as modulo, " .
                "m.type as mTipo, " .
                "d.name as documento, " .
                "d.observations, " .
                "d.type as dTipo, " .
                "d.public, " .
                "d.status, " .
                "d.document1, " .
                "RIGHT(d.document1, LOCATE('.', REVERSE(d.document1))-1) as ext1, " .
                "d.document2, " .
                "RIGHT(d.document2, LOCATE('.', REVERSE(d.document2))-1) as ext2, " .
                "d.document3, " .
                "RIGHT(d.document3, LOCATE('.', REVERSE(d.document3))-1) as ext3, " .
                "d.document4, " .
                "RIGHT(d.document4, LOCATE('.', REVERSE(d.document4))-1) as ext4, " .
                "d.dateAutor, " .
                "d.idAutor, " .
                "(SELECT name FROM users WHERE idUsers=d.idAutor) as autor, " .
                "d.dateDiretor, " .
                "d.idDiretor, " .
                "(SELECT name FROM users WHERE idUsers=d.idDiretor) as diretor, " .
                "d.datePedagogico, " .
                "d.idPedagogico, " .
                "(SELECT name FROM users WHERE idUsers=d.idPedagogico) as pedagogico, " .
                "d.dateExecutiva, " .
                "d.idExecutiva, " .
                "(SELECT name FROM users WHERE idUsers=d.idExecutiva) as executiva " .
                " FROM courses_documents d INNER JOIN courses_modules m ON d.idModules=m.idModules AND m.status<>'Inativo' AND d.status<>'Inativo'  " .
                " AND  d.idCourses=" . $data['idCourses'] . " AND m.idCourses=" . $data['idCourses'] . " ORDER BY m.order) t WHERE true " .
                (key_exists("search", $data) ?
                " AND (modulo LIKE '%" . $data['search'] . "%' OR mTipo LIKE '%" . $data['search'] . "%' OR " .
                "document1 LIKE '%" . $data['search'] . "%' OR document2 LIKE '%" . $data['search'] . "%' OR document3 LIKE '%" . $data['search'] . "%' OR document4 LIKE '%" . $data['search'] . "%' OR " .
                "documento LIKE '%" . $data['search'] . "%' OR dTipo LIKE '%" . $data['search'] . "%' )" : "");

        if (key_exists("idCourses", $data) && key_exists("idCourse", $data) && key_exists("idModules", $data) && key_exists("idModules", $data)) {
            $query .= " AND (idCourse=" . $data['idCourse'] . " AND idCourses=" . $data['idCourses'] . " AND idModules=" . $data['idModules'] . " AND idDocuments=" . $data['idDocuments'] . " ) ";
        }
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function restaurarFormacoesFicheiros($data) {
        $con       = new Database ();
        $resultado = $con->set('START TRANSACTION');
        $query     = "DELETE FROM courses_documents WHERE status='Fechado' AND idCourses=" . $data['idCourses'];
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $query     = "INSERT IGNORE INTO courses_documents "
                . "(idCourses,idDocuments,idModules,idCourse,name,type,public,observations,status,"
                . "document1,document1Blob,document2,document2Blob,document3,document3Blob,document4,document4Blob,"
                . "dateAutor,idAutor,dateDiretor,idDiretor,datePedagogico,idPedagogico,dateExecutiva,idExecutiva) "
                . " SELECT " . $data['idCourses'] . ",d.idDocuments,d.idModules,d.idCourse,d.name,d.type,d.public,d.observations,d.status,"
                . "d.document1,d.document1Blob,d.document2,d.document2Blob,d.document3,d.document3Blob,d.document4,d.document4Blob,"
                . "d.dateAutor,d.idAutor,d.dateDiretor,d.idDiretor,d.datePedagogico,d.idPedagogico,d.dateExecutiva,d.idExecutiva "
                . " FROM documents d INNER JOIN courses_modules cm ON d.idCourse=cm.idCourse AND d.idModules=cm.idModules "
                . " AND cm.idCourses=" . $data['idCourses'] . " AND d.status='Fechado' ";
        $resultado = $con->set($query);
        $resultado = $con->set('COMMIT');
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        return ['success' => true, 'message' => 'Restauração concluída'];
    }

    function getFormacoesModulos($data) {
        $query     = "SELECT * FROM courses_modules WHERE status<>'Inativo' AND idCourses=" . $data['idCourses'] . " ORDER BY `order` ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function inserirFormacoesFicheiro($post, $file, $content, $type) {
        $query                                = "INSERT INTO documents (idModules,idCourse) VALUES (0,0) ";
        $con                                  = new Connection ();
        $con->connect();
        $result                               = $con->connection->query($query);
        $_SESSION ['idDocument']              = $con->connection->insert_id;
        $query                                = "DELETE FROM documents WHERE idDocuments=" . $_SESSION ['idDocument'];
        $result                               = $con->connection->query($query);
        $query                                = "SELECT idCourse FROM courses WHERE idCourses=" . $post['idCourses'];
        $result                               = $con->connection->query($query);
        $row                                  = $con->fetch_all($result, MYSQLI_ASSOC);
        $_SESSION['ficheiros']['idDocuments'] = $_SESSION ['idDocument'];
        $_SESSION['ficheiros']['idCourse']    = $row[0]['idCourse'];
        $_SESSION['ficheiros']['type']        = $type;

        $query  = "INSERT INTO courses_documents " .
                "(idCourses, idDocuments, idModules, idCourse, " .
                "status, document" . $type . ", document" . $type . "Blob, idAutor, dateAutor)" .
                "VALUES " . "(" . $post['idCourses'] . "," . $_SESSION['ficheiros']['idDocuments'] . ",0," . $_SESSION['ficheiros']['idCourse'] . ",'Pendente'," .
                "'" . $file . "','" . $content . "'," .
                "dateAutor='" . date("Y-m-d H:i:s") . "', idAutor=" . $_SESSION ['user']->id . ") ";
        $result = $con->connection->query($query);
        if ($con->connection->error) {
            return $con->connection->error;
        }
        else {
            $_SESSION ['idDocument'] = $con->connection->insert_id;
            return "Ficheiro carregado com sucesso.";
        }
    }

    function atualizarFormacoesFicheiro($post, $file, $content, $type) {
        $query  = "UPDATE courses_documents "
                . " SET document" . $type . "='" . $file . "'," . "document" . $type . "Blob='" . $content
                . "', status='Pendente', "
                . "dateAutor='" . date("Y-m-d H:i:s") . "', idAutor=" . $_SESSION ['user']->id . ", "
                . "dateDiretor=NULL, idDiretor=NULL, "
                . "datePedagogico=NULL, idPedagogico=NULL, "
                . "dateExecutiva=NULL, idExecutiva=NULL "
                . " WHERE idCourse=" . $post['idCourse'] . " AND idCourses=" . $post['idCourses'] . " AND idDocuments=" . $post['idDocuments'];
        $con    = new Connection ();
        $con->connect();
        $result = $con->connection->query($query);
        if ($con->connection->error) {
            return $con->connection->error;
        }
        else {
            return "Carregado com sucesso.";
        }
    }
}