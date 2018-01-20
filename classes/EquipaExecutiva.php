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
        return $this->inserirDocumentos($data);
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

        if (key_exists("idCourses", $data) && key_exists("idDocuments", $data)) {
            $query .= " AND (idCourses=" . $data['idCourses'] . " AND idDocuments=" . $data['idDocuments'] . " ) ";
        }
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getFicheiro($data) {
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
                " AND  d.idCourses=" . $data['idCourses'] . " AND m.idCourses=" . $data['idCourses'] . " ORDER BY m.order) t WHERE true ";

        if (key_exists("idCourses", $data) && key_exists("idDocuments", $data)) {
            $query .= " AND (idCourses=" . $data['idCourses'] . " AND idDocuments=" . $data['idDocuments'] . " ) ";
        }
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
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
        if ($con->connection->error != '') {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $resultado = $con->set('COMMIT');
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

    function inserirFormacoesFicheiro($data) {//vem do upload.php
        $con       = new Database ();
        $resultado = $con->set('START TRANSACTION');
        $query     = "INSERT INTO documents (idModules,idCourse) VALUES (0,0) ";
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $_SESSION ['ficheiros']['idDocuments'] = $con->connection->insert_id;

        $query     = "DELETE FROM documents WHERE idDocuments=" . $_SESSION ['ficheiros']['idDocuments'];
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $query     = "SELECT idCourse FROM courses WHERE idCourses=" . $data['idCourses'];
        $resultado = $con->get($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $_SESSION['ficheiros']['idCourse']                              = $resultado[0]['idCourse'];
        $_SESSION ['ficheiros']['type']                                 = $data['type'];
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];
        $query                                                          = "INSERT INTO courses_documents " .
                "(idCourses, idDocuments, idModules, idCourse, " .
                "status, type, document" . $data['filePos'] . ", document" . $data['filePos'] . "Blob, idAutor, dateAutor)" .
                "VALUES " . "(" . $data['idCourses'] . "," . $_SESSION ['ficheiros']['idDocuments'] . ",0," . $_SESSION ['ficheiros']['idCourse'] . ",'Pendente'," .
                "'" . $data['type'] . "','" . $data['file'] . "','" . $data['content'] . "'," .
                "dateAutor='" . date("Y-m-d H:i:s") . "', idAutor=" . $_SESSION ['users']->id . ") ";
        $resultado                                                      = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Ficheiro inserido.'];
    }

    function atualizarFormacoesFicheiro($data) {//vem do upload.php
        $con       = new Database ();
        $query     = "SELECT idCourse FROM courses WHERE idCourses=" . $data['idCourses'];
        $resultado = $con->get($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi inserido o registo.'];
        }

        $_SESSION['ficheiros']['idCourse']                              = $resultado[0]['idCourse'];
        $_SESSION ['ficheiros']['type']                                 = $data['type'];
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];

        $query = "UPDATE courses_documents "
                . " SET document" . $data['filePos'] . "='" . $data['file'] . "'," . "document" . $data['filePos'] . "Blob='" . $data['content']
                . "', status='Pendente', "
                . "dateAutor='" . date("Y-m-d H:i:s") . "', idAutor=" . $_SESSION ['users']->id . ", "
                . "dateDiretor=NULL, idDiretor=NULL, "
                . "datePedagogico=NULL, idPedagogico=NULL, "
                . "dateExecutiva=NULL, idExecutiva=NULL "
                . " WHERE idCourse=" . $_SESSION['ficheiros']['idCourse'] . " AND idCourses=" . $data['idCourses'] .
                " AND idDocuments=" . $_SESSION ['ficheiros']['idDocuments'];

        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    function inserirFormacoesFicheiros($data) {

        $query     = "UPDATE courses_documents SET " .
                "idModules=" . $data['idModules'] . ",name='" . $data['name'] . "',public='" . $data['public'] . "',status='Pendente',observations='" . $data['observations'] . "', " .
                "type='" . $_SESSION ['ficheiros']['type'] . "',idAutor=" . $_SESSION['users']->id . ",dateAutor='" . date("Y-m-d H:i:s") . "', " .
                "dateDiretor=NULL, idDiretor=NULL, " .
                "datePedagogico=NULL, idPedagogico=NULL, " .
                "dateExecutiva=NULL, idExecutiva=NULL " .
                "WHERE idCourses=" . $data['idCourses'] . " AND idCourse=" . $_SESSION['ficheiros']['idCourse'] .
                " AND idDocuments=" . $_SESSION ['ficheiros']['idDocuments'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi inserido o registo.'];
        }
        return ['success' => true, 'message' => 'Registo inserido.'];
    }

    function apagarFormacoesFicheiros($data) {
        $query     = "DELETE FROM courses_documents WHERE " .
                " idDocuments=" . $data['idDocuments'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi apagado.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    function aprovarFormacoesFicheiros($data) {//<?=$docs[$i]['idCourse']."_".$docs[$i]['idCourses']."_".$docs[$i]['idModules']."_".$docs[$i]['idDocuments']
        $con       = new Database ();
        $result    = $con->set('START TRANSACTION');
        $query     = "SELECT count(*) as equipa,`type` FROM courses_team WHERE idUsers=" . $_SESSION['users']->id . " AND idCourses=" . $data['idCourses'] . " ";
        $resultado = $con->get($query);
        if (!$resultado) {
            $result = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não ficou aprovado.'];
        }
        $resultado   = $resultado[0];
        $newModuleId = 0;
        $newId       = 0;
        if ($resultado['equipa'] == 0 && $_SESSION['users']->permission == 'Equipa Executiva') { //Não pertence à equipa de curso, mas é equipa executiva
            $query          = "SELECT * FROM courses_documents WHERE idCourses=" . $data['idCourses'] . " AND idDocuments=" . $data['idDocuments'];
            $rowData        = $con->get($query);
            $rowData        = $rowData[0];
            $idCourse       = $rowData['idCourse'];
            $idModules      = $rowData['idModules'];
            $query          = "SELECT count(*),cm.* FROM courses_modules cm WHERE idCourses=" . $data['idCourses'] . " AND idModules=" . $idModules . " AND idCourse=" . $idCourse . " AND status='Pendente' ";
            $rowModulesData = $con->get($query);
            $rowModulesData = $rowModulesData[0];

            if ($rowModulesData['type'] == 'novo' || $rowModulesData['type'] == 'extra' || $rowModulesData['type'] == 'proposto') {
                $type   = ($rowModulesData['type'] == 'novo' ? 'base' : 'extra');
                $query  = "UPDATE courses_modules SET type='" . $type . "', status='Fechado' WHERE idCourses=" . $data['idCourses'] . " AND idModules=" . $idModules . " AND idCourse=" . $idCourse . " ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $query  = "UPDATE modules SET status='Inativo' WHERE idModules=" . $idModules . " ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
            }
            $query  = "UPDATE courses_documents SET status='Fechado', dateExecutiva='" . date("Y-m-d H:i:s") . "' ,idExecutiva=" . $_SESSION['users']->id .
                    " WHERE idCourses=" . $data['idCourses'] . " AND idDocuments=" . $data['idDocuments'] . " AND idModules=" . $idModules . " AND idCourse=" . $idCourse . " ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
            $query  = "UPDATE documents SET status='Inativo' WHERE idDocuments=" . $data['idDocuments'] . " ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }

            if ($rowModulesData['type'] == 'novo' || $rowModulesData['type'] == 'extra' || $rowModulesData['type'] == 'proposto') {
                $type   = ($rowModulesData['type'] == 'novo' ? 'base' : 'extra');
                $query  = "INSERT INTO modules (idCourse,`order`,name,duration,type,status) VALUES (" . $rowModulesData['idCourse'] . "," . $rowModulesData['order'] . ",'" . $rowModulesData['name'] . "'," . $rowModulesData['duration'] . ",'" . $type . "','Fechado')";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $newModuleId = $con->connection->insert_id;
            }
            $query  = "INSERT INTO documents (idModules,idCourse,name,type,public,observations,status," .
                    "document1,document1Blob,document2,document2Blob,document3,document3Blob,document4,document4Blob," .
                    "dateAutor,idAutor,dateDiretor,idDiretor,datePedagogico,idPedagogico,dateExecutiva,idExecutiva) " .
                    " SELECT " . ($newModuleId != 0 ? $newModuleId : "idModules") . ",idCourse,name,type,public,observations,status," .
                    "document1,document1Blob,document2,document2Blob,document3,document3Blob,document4,document4Blob," .
                    "dateAutor,idAutor,dateDiretor,idDiretor,datePedagogico,idPedagogico,dateExecutiva,idExecutiva " .
                    "FROM courses_documents WHERE idCourses=" . $data['idCourses'] . " AND idDocuments=" . $data['idDocuments'] . " AND idModules=" . $idModules . " AND idCourse=" . $idCourse . " ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
            $newId  = $con->connection->insert_id;
            $query  = "UPDATE courses_documents " .
                    "SET idDocuments=" . $newId . ", status='Fechado',name='" . $rowData['name'] . "',type='" . $rowData['type'] . "',public='" . $rowData['public'] . "', " .
                    "observations='" . $rowData['observations'] . "', " .
                    "document1='" . $rowData['document1'] . "',document1Blob='" . $rowData['document1Blob'] . "', " .
                    "document2='" . $rowData['document2'] . "',document2Blob='" . $rowData['document2Blob'] . "', " .
                    "document3='" . $rowData['document3'] . "',document3Blob='" . $rowData['document3Blob'] . "', " .
                    "document4='" . $rowData['document4'] . "',document4Blob='" . $rowData['document4Blob'] . "', " .
                    "dateAutor='" . $rowData['dateAutor'] . "',idAutor='" . $rowData['idAutor'] . "', " .
                    "dateDiretor='" . $rowData['dateDiretor'] . "',idDiretor='" . $rowData['idDiretor'] . "', " .
                    "datePedagogico='" . $rowData['datePedagogico'] . "',idPedagogico='" . $rowData['idPedagogico'] . "', " .
                    "dateExecutiva='" . $rowData['dateExecutiva'] . "',idExecutiva='" . $rowData['idExecutiva'] . "' " .
                    "WHERE idDocuments=" . $data['idDocuments'] . " AND idModules=" . $idModules . " AND idCourse=" . $idCourse . " ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
            if ($rowModulesData['type'] == 'novo' || $rowModulesData['type'] == 'extra' || $rowModulesData['type'] == 'proposto') {
                $type   = ($rowModulesData['type'] == 'novo' ? 'base' : 'extra');
                $query  = "UPDATE courses_modules SET idModules=" . $newModuleId . " WHERE idModules=" . $idModules . " AND idCourses=" . $data['idCourses'] . " AND idCourse=" . $idCourse . " ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $query  = "UPDATE courses_documents SET idModules=" . $newModuleId . " WHERE idModules=" . $idModules . " AND idCourses=" . $data['idCourses'] . " AND idCourse=" . $idCourse . " ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $query  = "UPDATE documents SET idModules=" . $newModuleId . " WHERE idModules=" . $idModules . " AND idCourse=" . $data['idCourses'] . " AND status='Fechado' ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
            }
            $query  = "UPDATE courses_documents SET idDocuments=" . $newId . " WHERE idDocuments=" . $data['idDocuments'] . " AND idCourses=" . $data['idCourses'] . " AND idCourse=" . $idCourse . " ";
            $result = $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
        }
        else if ($resultado['type'] == 'Diretor') {
            $query  = "UPDATE courses_documents SET status='Pendente', dateDiretor='" . date("Y-m-d H:i:s") . "' ,idDiretor=" . $_SESSION['users']->id .
                    " WHERE idCourses=" . $data['idCourses'] . " AND idDocuments=" . $data['idDocuments'] . " ";
            $result = $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
        }
        $result = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Aprovado.'];
    }
}