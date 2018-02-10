<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
declare(strict_types = 1);

/**
 * Description of Avaliacoes
 *
 * @author João Madeira
 */
class Avaliacoes
{

    //put your code here
    public function __construct()
    {
        //empty
    }

    public static function apagarAvaliacoes($data)
    {
        $query     = "UPDATE evaluations SET status=IF(status='Ativo','Inativo','Ativo') WHERE idEvaluations=".$data['idEvaluations']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    public static function atualizarAvaliacoes($data)
    {
        $query     = "UPDATE evaluations SET idCourse=".$data['idCourse'].", name='".$data ['name']."', target='".$data ['target']."'"
            .",template='".$data ['template']."',status='".$data ['status']."',dateExecutiva='".date("Y-m-d H:i:s")."',idExecutiva=".$_SESSION['users']->idUsers
            ." WHERE idEvaluations=".$data ['idEvaluations'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function getAvaliacao($data)
    {
        $query     = "SELECT e.*,(SELECT c.name FROM course c WHERE c.idCourse=e.idCourse ) as 'curso' FROM evaluations e WHERE e.idEvaluations = ".$data['idEvaluations']." ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function getAvaliacoes($data)
    {
        $query     = "SELECT e.*, (SELECT c.name FROM course c WHERE c.idCourse=e.idCourse ) as 'curso' FROM evaluations e ".
            " WHERE name LIKE '%".$data['search']."%' ".
            "OR target LIKE '%".$data['search']."%' ".
            "OR status LIKE '%".$data['search']."%' ".
            "OR 'curso' LIKE '%".$data['search']."%' ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function inserirAvaliacoes($data)
    {
        $query     = "INSERT INTO evaluations ".
            "(idCourse,name,target,status,template,dateExecutiva,idExecutiva) ".
            "VALUES ".
            "(".$data ['idCourse'].
            ",'".$data ['name'].
            "','".$data ['target'].
            "','".$data ['status'].
            "','".$data ['template'].
            "','".date("Y-m-d H:i:s").
            "',".$_SESSION['users']->idUsers.")";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }
}
