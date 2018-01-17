<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Avaliacoes
 *
 * @author João Madeira
 */
class Avaliacoes {

    //put your code here
    function __construct() {

    }

    static function apagarAvaliacoes($data) {
        $query     = "UPDATE evaluations SET status=IF(status='Ativo','Inativo','Ativo') WHERE idEvaluations=" . $data['idEvaluations'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    static function atualizarAvaliacoes($data) {
        $query     = "UPDATE evaluations SET idCourse=" . $data['idCourse'] . ", name='" . $data ['name'] . "', target='" . $data ['target'] . "'"
                . ",template='" . $data ['template'] . "',status='" . $data ['status'] . "',dateExecutiva='" . date("Y-m-d H:i:s") . "',idExecutiva=" . $_SESSION['users']->id
                . " WHERE idEvaluations=" . $data ['idEvaluations'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    static function getAvaliacao($data) {
        $query     = "SELECT e.*,(SELECT c.name FROM course c WHERE c.idCourse=e.idCourse ) as 'curso' FROM evaluations e WHERE e.idEvaluations = " . $data['idEvaluations'] . " ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    static function getAvaliacoes($data) {
        $query     = "SELECT e.*, (SELECT c.name FROM course c WHERE c.idCourse=e.idCourse ) as 'curso' FROM evaluations e " .
                " WHERE name LIKE '%" . $data['search'] . "%' " .
                "OR target LIKE '%" . $data['search'] . "%' " .
                "OR status LIKE '%" . $data['search'] . "%' " .
                "OR 'curso' LIKE '%" . $data['search'] . "%' ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function inserirAvaliacoes($data) {
        $query     = "INSERT INTO evaluations " .
                "(idCourse,name,target,status,template,dateExecutiva,idExecutiva) " .
                "VALUES " .
                "(" . $data ['idCourse'] .
                ",'" . $data ['name'] .
                "','" . $data ['target'] .
                "','" . $data ['status'] .
                "','" . $data ['template'] .
                "','" . date("Y-m-d H:i:s") .
                "'," . $_SESSION['users']->id . ")";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }
}