<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipaExecutiva
 *
 * @author João Madeira
 */
class EquipaExecutiva {
//put your code here

    public $tabs;
    public $utilizadores;
    public $cursos;
    public $modulos;
    public $documentos;
    public $calendarios;
    public $formacoes;
    public $avaliacoes;

    function __construct($data) {
        $this->getTabs();
        $this->utilizadores = $this->getUtilizadores($data);
        $this->cursos       = $this->getCursos($data);
        $this->modulos      = $this->getModulos($data);
        $this->documentos   = $this->getDocumentos($data);
        $this->calendarios  = $this->getCalendarios($data);
        $this->formacoes    = $this->getFormacoes($data);
        $this->avaliacoes   = $this->getAvaliacoes($data);
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":[{"text":"Utilizadores","tab":"utilizadores"},{"text":"Cursos","tab":"cursos"},{"text":"Módulos","tab":"modulos"},{"text":"Documentos","tab":"documentos"},{"text":"Calendários","tab":"calendarios"},{"text":"Formações","tab":"formacoes"},{"text":"Avaliações","tab":"avaliacoes"} ]}');
    }

    function getUtilizadores($data) {
        $query     = "SELECT u.*,TIMESTAMPDIFF(YEAR, birthDate, NOW()) as age FROM users u WHERE " .
                "username like '%" . $data['search'] . "%' OR " .
                "name like '%" . $data['search'] . "%' OR " .
                "permission like '%" . $data['search'] . "%' OR " .
                "aepId like '%" . $data['search'] . "%' OR " .
                "status like '%" . $data['search'] . "%' OR " .
                "mobile like '%" . $data['search'] . "%' " .
                "ORDER BY status,permission,name ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getCursos($data) {
        $query     = "SELECT * FROM course " .
                "WHERE name LIKE '%" . $data['search'] . "%' OR " .
                "sigla LIKE '%" . $data['search'] . "%' OR " .
                "level LIKE '%" . $data['search'] . "%' OR " .
                "internship LIKE '%" . $data['search'] . "%' OR " .
                "status LIKE '%" . $data['search'] . "%' " .
                "ORDER BY level";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getModulos($data) {
        $query     = "SELECT m.idModules,c.sigla,c.name as curso,m.order,m.name as modulo,m.type,m.duration,m.status " .
                "FROM course c INNER JOIN modules m ON c.idCourse=m.idCourse " .
                "WHERE (c.name LIKE '%" . $data['search'] . "%' OR " .
                "c.sigla LIKE '%" . $data['search'] . "%' OR " .
                "m.name LIKE '%" . $data['search'] . "%' OR " .
                "m.type LIKE '%" . $data['search'] . "%' OR " .
                "m.status LIKE '%" . $data['search'] . "%') " .
                "AND m.status='Fechado' ORDER BY c.idCourse,m.order,m.idModules";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getDocumentos($data) {
        $query     = "SELECT * FROM (SELECT " .
                "idDocuments, " .
                "c.sigla, " .
                "c.name as curso, " .
                "m.name as modulo, " .
                "m.type as mTipo, " .
                "d.name as documento, " .
                "d.type as dTipo, " .
                "d.public, " .
                "d.status, " .
                "d.document1," .
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
                "FROM documents d INNER JOIN modules m ON d.idModules=m.idModules " .
                "INNER JOIN course c ON m.idCourse=c.idCourse) as t " .
                "WHERE status<>'Inativo' AND (curso LIKE '%" . $data['search'] . "%' OR " .
                "modulo LIKE '%" . $data['search'] . "%' OR " .
                "mTipo LIKE '%" . $data['search'] . "%' OR " .
                "documento LIKE '%" . $data['search'] . "%' OR " .
                "dTipo LIKE '%" . $data['search'] . "%' OR " .
                "status LIKE '%" . $data['search'] . "%' OR " .
                "document1 LIKE '%" . $data['search'] . "%' OR " .
                "document2 LIKE '%" . $data['search'] . "%' OR " .
                "document3 LIKE '%" . $data['search'] . "%' OR " .
                "document4 LIKE '%" . $data['search'] . "%') ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getCalendarios($data) {
        $query     = "SELECT cs.idCourses AS csIdCourses,cs.year AS csYear,cs.course AS csCourse,cs.completeName AS csCompleteName,cs.startDate AS csStartDate,cs.endDate AS csEndDate," .
                "cs.local AS csLocal,cs.vacancy AS csVacancy,cs.idCourse AS csIdCourse,cs.internship AS csInternship,cs.status AS csStatus,cs.observations AS csObservations, " .
                "c.idCourse AS cIdCourse,c.name AS cName,c.sigla as cSigla,c.level AS cLevel,c.internship AS cInternship,c.status AS cStatus " .
                /* ",ct.idCourses as ctIdCourses,ct.idUsers as ctIdUsers,ct.type as ctType,".
                  "u.idUsers as uIdUsers,u.username as uUsername,u.email as uEmail,u.name as uName,u.sigla as uSigla,u.permission as uPermission,u.status as uSatus,".
                  "u.birthDate as uBirthDate,u.address as uAddress,u.zipCode as uZipCode,u.local as uLocal,u.mobile as uMobile,u.telephone as uTelephone,u.observations as uObservations,".
                  "u.iban as uIban,u.aepId as uAepId ".
                 */"FROM courses cs " .
                "INNER JOIN course c ON cs.idCourse=c.idCourse AND cs.status<>'Inativo' " .
                /* "INNER JOIN courses_team ct ON ct.idCourses=cs.idCourses " .
                  "INNER JOIN users u ON ct.idUsers=u.idUsers " .
                 */"ORDER BY level";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getFormacoes($data) {
        $query     = "SELECT " . "c.* "
                /* .",ct.idUsers, "
                  ."ct.type, "
                  ."u.name, "
                  ."u.sigla, "
                  ."u.email, "
                  ."u.permission "
                 */ . "FROM " . "courses c " .
// ."INNER JOIN courses_team ct ON c.idCourses=ct.idCourses "
// ."INNER JOIN users u ON ct.idUsers=u.idUsers ".($id!=''?"AND ct.idUsers=".$id." ":" ")
                "ORDER BY startDate";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getAvaliacoes($data) {
        $query     = "SELECT * FROM courses_evaluations ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    function getUtilizador($data) {
        $query     = "SELECT * FROM users WHERE idUsers=" . $data['idUsers'];
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    function inserirUtilizadores($data): array {
        $data ['local']    = substr($data ['zipCode'], 9);
        $data ['zipCode']  = substr($data ['zipCode'], 0, 8);
        $data ['password'] = $_SESSION['users']->generatePassword(8);

        $query     = "INSERT INTO users " .
                "(username,password,email,name,sigla,permission,status," .
                "birthDate,address,zipCode,local,mobile,telephone,observations,iban,aepId) " .
                "VALUES " .
                "('" . $data ['username'] .
                "',md5('" . $data ['password'] . "'),'" .
                $data ['email'] . "','" .
                $data ['name'] . "','" .
                $data ['sigla'] . "','" .
                $data ['permission'] . "','" .
                $data ['status'] . "'," . "'" .
                ($data ['birthDate'] == '' ? '0000-00-00' : $data ['birthDate']) . "','" .
                $data ['address'] . "','" .
                $data ['zipCode'] . "','" .
                $data ['local'] . "','" .
                $data ['mobile'] . "','" .
                $data ['telephone'] . "','" .
                $data ['observations'] . "'," . "'" .
                $data ['iban'] . "','" .
                $data ['aepId'] . "')";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    function atualizarUtilizadores($data): array {
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
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    function apagarUtilizadores($data): array {
        $query     = "UPDATE users SET status=IF(status='Ativo','Inativo','Ativo') WHERE idUsers=" . $data['idUsers'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    function getCurso($data): array {
        $query     = "SELECT * FROM course WHERE idCourse=" . $data['idCourse'];
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    function inserirCursos($data): array {
        $query     = "INSERT INTO course " .
                "(name,sigla,level,internship,status) " .
                "VALUES " .
                "('" . $data ['name'] .
                "','" . $data ['sigla'] .
                "','" . $data ['level'] .
                "','" . $data ['internship'] .
                "','" . $data ['status'] . "')";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    function atualizarCursos($data): array {
        $query     = "UPDATE course SET " .
                "name='" . $data ['name'] .
                "'," . "sigla='" . $data ['sigla'] .
                "'," . "level='" . $data ['level'] .
                "'," . "internship='" . $data ['internship'] .
                "'," . "status='" . $data ['status'] .
                "' " . "WHERE idCourse=" . $data ['idCourse'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    function apagarCursos($data): array {
        $query     = "UPDATE course SET status=IF(status='Ativo','Inativo','Ativo') WHERE idCourse=" . $data['idCourse'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    function getModulo($data) {
        $query     = "SELECT m.idModules,c.idCourse,c.sigla,c.name as curso,m.order,m.name as modulo,m.type,m.duration,m.status " .
                "FROM course c INNER JOIN modules m ON c.idCourse=m.idCourse " .
                "WHERE m.idModules=" . $data['idModules'];
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    function inserirModulos($data) {
        $query     = "INSERT INTO modules " .
                "(idCourse,name,`order`,type,duration,status) " .
                "VALUES " . "('" .
                $data ['idCourse'] . "','" .
                $data ['name'] . "'," .
                $data ['order'] . ",'" .
                $data ['type'] . "'," .
                $data ['duration'] . ",'" .
                $data ['status'] . "')";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    function atualizarModulos($data) {
        $query     = "UPDATE modules SET " .
                "idCourse=" . $data ['idCourse'] . "," .
                "name='" . $data ['name'] . "'," .
                "`order`=" . $data ['order'] . "," .
                "type='" . $data ['type'] . "'," .
                "duration=" . $data ['duration'] . "," .
                "status='" . $data ['status'] . "' " .
                "WHERE idModules=" . $data ['idModules'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    function apagarModulos($data): array {
        $query     = "UPDATE modules SET status=IF(status='Ativo','Inativo','Ativo') WHERE idModules=" . $data['idModules'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    function getDocumento($data) {
        $query     = "SELECT * FROM (SELECT " .
                "idDocuments, " .
                "c.idCourse, " .
                "c.sigla, " .
                "c.name as curso, " .
                "m.idModules, " .
                "m.name as modulo, " .
                "m.type as mTipo, " .
                "d.name as documento, " .
                "d.observations, " .
                "d.type as dTipo, " .
                "d.public, " .
                "d.status, " .
                "d.document1," .
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
                "FROM documents d INNER JOIN modules m ON d.idModules=m.idModules " .
                "INNER JOIN course c ON m.idCourse=c.idCourse) as t " .
                "WHERE idDocuments=" . $data['idDocuments'];
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    function inserirDocumentos($data) {
        $query     = "UPDATE documents SET " .
                "idModules=" . $data ['idModules'] . "," .
                "idCourse=" . $data ['idCourse'] . "," .
                "name='" . $data ['name'] . "'," .
                "type='" . $data ['type'] . "'," .
                "public='" . $data ['public'] . "'," .
                "observations='" . $data ['observations'] . "'," .
                "status='" . (key_exists('status', $data) ?
                $data ['status'] :
                ($_SESSION['users']->permission == 'Equipa Executiva' ?
                "Fechado" :
                "Pendente")) . "'," .
                "dateAutor='" . date("Y-m-d H:i:s") . "'," .
                "idAutor=" . $_SESSION ['users']->id . ", " .
                "datePedagogico='" . date("Y-m-d H:i:s") . "'," .
                "idPedagogico=" . $_SESSION ['users']->id . ", " .
                "dateDiretor='" . date("Y-m-d H:i:s") . "'," .
                "idDiretor=" . $_SESSION ['users']->id . ", " .
                "dateExecutiva='" . date("Y-m-d H:i:s") . "'," .
                "idExecutiva=" . $_SESSION ['users']->id . " " .
                "WHERE idDocuments=" . $_SESSION ['idDocument'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    function inserirDocumentoFicheiro($data) {
        $query     = "INSERT INTO documents " .
                "(idModules,idCourse,document" . $data['type'] . ",document" . $data['type'] . "Blob)" .
                "VALUES " . "(0,0,'" . $data['file'] . "','" . $data['content'] . "')";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o ficheiro.'];
        }
        $_SESSION ['idDocument'] = $con->connection->insert_id;
        return ['success' => true, 'message' => 'Ficheiro aceite.'];
    }

    function atualizarDocumentosFicheiro($data) {
        $query     = "UPDATE documents "
                . " SET document" . $data['type'] . "='" . $data['file'] . "'," . "document" . $data['type'] . "Blob='" . $data['content'] . "' "
                . " WHERE idDocuments=" . $data['idDocuments'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o ficheiro.'];
        }
        $_SESSION ['idDocument'] = $con->connection->insert_id;
        return ['success' => true, 'message' => 'Ficheiro aceite.'];
    }

    function atualizarDocumentos($data) {
        return $this->inserirDocumento($data);
    }

    function apagarDocumentos($data) {
        $query     = "UPDATE documents SET public='Não',status=IF(status='Ativo','Inativo','Ativo') WHERE idDocuments=" . $data['idDocuments'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }
}