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
class Cursos {

    function __construct() {

    }

    static function listaModulos($idCourses) {
        $query = "SELECT idModules,name FROM courses_modules cm WHERE idCourses=" . $idCourses . " AND status='Fechado' AND duration>0 ORDER BY cm.order";
        $con   = new Database ();
        $lista = $con->get($query);
        if (!$lista) {
            return false;
        }
        return $lista;
    }
}