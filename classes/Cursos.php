<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cursos
 *
 * @author João Madeira
 */
class Cursos
{

    //put your code here
    public function __construct()
    {
        //empty
    }

    public static function listaModulos($idCourses)
    {
        $query = "SELECT idModules,name FROM courses_modules cm WHERE idCourses=".$idCourses." AND status='Fechado' AND duration>0 ORDER BY cm.order";
        $con   = new Database();
        $lista = $con->get($query);
        if (!$lista) {
            return false;
        }
        return $lista;
    }

    public static function getCursos($data)
    {
        $query     = "SELECT * FROM course ".
            "WHERE name LIKE '%".$data['search']."%' OR ".
            "sigla LIKE '%".$data['search']."%' OR ".
            "level LIKE '%".$data['search']."%' OR ".
            "internship LIKE '%".$data['search']."%' OR ".
            "status LIKE '%".$data['search']."%' ".
            "ORDER BY level";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getCurso($data): array
    {
        $query     = "SELECT * FROM course WHERE idCourse=".$data['idCourse'];
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function inserirCursos($data): array
    {
        $query     = "INSERT INTO course ".
            "(name,sigla,level,internship,status) ".
            "VALUES ".
            "('".$data ['name'].
            "','".$data ['sigla'].
            "','".$data ['level'].
            "','".$data ['internship'].
            "','".$data ['status']."')";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function atualizarCursos($data): array
    {
        $query     = "UPDATE course SET ".
            "name='".$data ['name'].
            "',"."sigla='".$data ['sigla'].
            "',"."level='".$data ['level'].
            "',"."internship='".$data ['internship'].
            "',"."status='".$data ['status'].
            "' "."WHERE idCourse=".$data ['idCourse'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function apagarCursos($data): array
    {
        $query     = "UPDATE course SET status=IF(status='Ativo','Inativo','Ativo') WHERE idCourse=".$data['idCourse']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }
}
