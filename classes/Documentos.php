<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documentos
 *
 * @author João Madeira
 */
class Documentos {

    //put your code here

    function __construct() {

    }

    static function getDocumentos($data) {
        $query     = "SELECT * FROM (SELECT " .
                "idDocuments, " .
                "c.idCourse, " .
                "c.sigla, " .
                "m.`order`, " .
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
                "INNER JOIN course c ON m.idCourse=c.idCourse) as t WHERE true " .
                (key_exists('idCourse', $data) ? "AND (idCourse=" . $data['idCourse'] . ") " : "") .
                (key_exists('search', $data) ? "AND (curso LIKE '%" . $data['search'] . "%' OR " .
                "modulo LIKE '%" . $data['search'] . "%' OR " .
                "mTipo LIKE '%" . $data['search'] . "%' OR " .
                "documento LIKE '%" . $data['search'] . "%' OR " .
                "dTipo LIKE '%" . $data['search'] . "%' OR " .
                "status LIKE '%" . $data['search'] . "%' OR " .
                "document1 LIKE '%" . $data['search'] . "%' OR " .
                "document2 LIKE '%" . $data['search'] . "%' OR " .
                "document3 LIKE '%" . $data['search'] . "%' OR " .
                "document4 LIKE '%" . $data['search'] . "%') " : " ") .
                "ORDER BY sigla , `order` ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function getDocumento($data) {
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

    static function inserirDocumentos($data) {
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
                "idAutor=" . $_SESSION ['users']->id . " " .
                //"datePedagogico='" . date("Y-m-d H:i:s") . "'," .
                //"idPedagogico=" . $_SESSION ['users']->id . ", " .
                //",dateDiretor='" . date("Y-m-d H:i:s") . "',idDiretor=" . $_SESSION ['users']->id . " "
                (($data['action'] == 'equipaExecutiva') ?
                ",dateExecutiva='" . date("Y-m-d H:i:s") . "',idExecutiva=" . $_SESSION ['users']->id . " " :
                " ") .
                "WHERE idDocuments=" . $_SESSION['ficheiros']['idDocuments'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    static function inserirDocumentoFicheiro($data) {
        $query     = "INSERT INTO documents " .
                "(idModules,idCourse,type,document" . $data['filePos'] . ",document" . $data['filePos'] . "Blob,dateAutor,idAutor" .
                (($data['action'] == 'equipaExecutiva') ?
                ",dateExecutiva,idExecutiva " :
                " ") .
                ")" .
                "VALUES " . "(0,0,'" . $data['type'] . "','" . $data['file'] . "','" . $data['content'] . "','" . date("Y-m-d H:i:s") . "'," . $_SESSION['users']->id . " " .
                (($data['action'] == 'equipaExecutiva') ?
                ",'" . date("Y-m-d H:i:s") . "'," . $_SESSION ['users']->id . " " :
                " ") .
                ")";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o ficheiro.'];
        }
        $_SESSION ['ficheiros']['idDocuments']                          = $con->connection->insert_id;
        $_SESSION ['ficheiros']['type']                                 = $data['type'];
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];

        return ['success' => true, 'message' => 'Ficheiro aceite.'];
    }

    static function atualizarDocumentosFicheiro($data) {
        $query     = "UPDATE documents "
                . " SET document" . $data['filePos'] . "='" . $data['file'] . "'," . "document" . $data['filePos'] . "Blob='" . $data['content'] . "' "
                . (($data['action'] == 'equipaExecutiva') ?
                ",dateExecutiva='" . date("Y-m-d H:i:s") . "',idExecutiva=" . $_SESSION ['users']->id . " " :
                " ")
                . " WHERE idDocuments=" . $data['idDocuments'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o ficheiro.'];
        }
        $_SESSION ['ficheiros']['type']                                 = $data['type'];
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];
        return ['success' => true, 'message' => 'Ficheiro aceite.'];
    }

    static function apagarDocumentos($data) {
        $query     = "UPDATE documents SET public='Não',status=IF(status='Ativo','Inativo','Ativo')" .
                (($data['action'] == 'equipaExecutiva') ?
                ",dateExecutiva='" . date("Y-m-d H:i:s") . "',idExecutiva=" . $_SESSION ['users']->id . " " :
                " ")
                . " WHERE idDocuments=" . $data['idDocuments'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }
}