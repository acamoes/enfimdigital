<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modulos
 *
 * @author João Madeira
 */
class Modulos
{

    //put your code here

    public function __construct()
    {
        
    }

    public static function getModulos($data)
    {
        $query     = "SELECT m.idModules,c.sigla,c.name as curso,m.order,m.name as modulo,m.type,m.duration,m.status ".
            "FROM course c INNER JOIN modules m ON c.idCourse=m.idCourse ".
            "WHERE (c.name LIKE '%".$data['search']."%' OR ".
            "c.sigla LIKE '%".$data['search']."%' OR ".
            "m.name LIKE '%".$data['search']."%' OR ".
            "m.type LIKE '%".$data['search']."%' OR ".
            "m.status LIKE '%".$data['search']."%') ".
            " ORDER BY c.idCourse,m.order,m.idModules";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getModulo($data)
    {
        $query     = "SELECT m.idModules,c.idCourse,c.sigla,c.name as curso,m.order,m.name as modulo,m.type,m.duration,m.status ".
            "FROM course c INNER JOIN modules m ON c.idCourse=m.idCourse ".
            "WHERE m.idModules=".$data['idModules'];
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }
    
    public static function getModuloName($idModules)
    {
        $query     = "SELECT name ".
            "FROM modules ".
            "WHERE idModules=".$idModules;
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return '';
        }
        return $resultado[0]['name'];
    }

    public static function inserirModulos($data)
    {
        $query     = "INSERT INTO modules ".
            "(idCourse,name,`order`,type,duration,status) ".
            "VALUES "."('".
            $data ['idCourse']."','".
            $data ['name']."',".
            $data ['order'].",'".
            $data ['type']."',".
            $data ['duration'].",'".
            $data ['status']."')";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function atualizarModulos($data)
    {
        $query     = "UPDATE modules SET ".
            "idCourse=".$data ['idCourse'].",".
            "name='".$data ['name']."',".
            "`order`=".$data ['order'].",".
            "type='".$data ['type']."',".
            "duration=".$data ['duration'].",".
            "status='".$data ['status']."' ".
            "WHERE idModules=".$data ['idModules'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function apagarModulos($data): array
    {
        $query     = "UPDATE modules SET status='Inativo' WHERE idModules=".$data['idModules']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    public static function getModulosCurso($data)
    {
        $query     = "SELECT m.idModules,c.idCourse,c.sigla,c.name as curso,m.order,m.name as modulo,m.type,m.duration,m.status ".
            "FROM course c INNER JOIN modules m ON c.idCourse=m.idCourse ".
            "WHERE c.idCourse=".$data['idCourse']." AND m.status<>'Inativo' ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getModulosCursoOption($data)
    {
        $html         = '<option value="" selected></option>';
        $modulosCurso = self::getModulosCurso($data);
        foreach ($modulosCurso as $modulo) {
            if ($data['docType'] != "Extra" && $modulo['modulo'] == "DIREÇÃO") {
                continue;
            }
            $html .= '<option value="'.$modulo['idModules'].'">'.$modulo['modulo'].'</option>';
        }
        return $html;
    }
}
