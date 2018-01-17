<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formacoes
 *
 * @author João Madeira
 */
class Formacoes {
    public $tabs = "";

    //put your code here

    function __construct() {
        $this->getTabs();
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":[{"text":"Inscritos","tab":"inscritos"},{"text":"Equipa","tab":"equipa"},{"text":"Sessões","tab":"sessoes"},{"text":"Ficheiros","tab":"ficheiros"},{"text":"Avaliacoes","tab":"avaliacoes"}]}');
    }

    static function getFormacoes($data) {
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

    static function getFormacoesInscritos($data) {
        $query     = "SELECT c.idCourses,c.course,c.status as cStatus, " . "uc.*, " .
                "u.aepId,u.name,u.birthDate,u.mobile,u.email,u.status as uStatus " .
                "FROM " . "courses c INNER JOIN users_courses uc ON c.idCourses=uc.idCourses " .
                "INNER JOIN users u ON uc.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? "AND uc.idCourses=" . $data ['idCourses'] . " " : " ") .
                (key_exists("searchInscritos", $data) ?
                "AND (u.name LIKE '%" . $data ['searchInscritos'] . "%' OR
			u.aepId LIKE '%" . $data ['searchInscritos'] . "%' OR
			u.email LIKE '%" . $data ['searchInscritos'] . "%')" :
                " ") . "ORDER BY u.aepId";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function getFormacoesEquipa($data) {
        $query     = "SELECT c.idCourses,c.course,c.status as cStatus, " . "ct.*, " .
                "u.aepId,u.name,u.birthDate,u.mobile,u.email,u.status as uStatus " .
                " FROM " . "courses c INNER JOIN courses_team ct ON c.idCourses=ct.idCourses " . "INNER JOIN users u ON ct.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? "AND ct.idCourses=" . $data ['idCourses'] . " " : " ") .
                (key_exists("searchInscritos", $data) ? "AND (u.name LIKE '%" . $data ['searchInscritos'] . "%' OR
		u.aepId LIKE '%" . $data ['searchInscritos'] . "%' OR
		u.email LIKE '%" . $data ['searchInscritos'] . "%')" : " ") . "ORDER BY u.aepId";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    static function getFormacoesSessoes($data) {
        $query     = "SELECT * FROM (SELECT cm.*, (SELECT a.name FROM users a WHERE a.idUsers=cm.idUsers) as formador " .
                " FROM " .
                " courses_modules cm " .
                //" INNER JOIN modules m ON cm.idModules=m.idModules " .
                //" INNER JOIN course c ON cm.idCourse=c.idCourse INNER JOIN courses cs ON cm.idCourses=cs.idCourses " .
                ") as t WHERE true " .
                (key_exists("searchSessoes", $data) ? " AND (t.name LIKE '%" . $data ['searchSessoes'] . "%' OR t.type LIKE '%" . $data ['searchSessoes'] . "%' OR t.formador LIKE '%" . $data ['searchSessoes'] . "%')" : "") .
                (key_exists("idCourses", $data) ? " AND t.idCourses=" . $data ['idCourses'] . " " : " ") .
                (key_exists("idCourse", $data) ? " AND t.idCourse=" . $data ['idCourse'] . " " : " ") .
                (key_exists("idModules", $data) ? " AND t.idModules=" . $data ['idModules'] . " " : " ") .
                /* (key_exists ( "searchInscritos", $data ) ? "AND (u.name LIKE '%" . $data ['searchInscritos'] . "%' OR
                  u.aepId LIKE '%" . $data ['searchInscritos'] . "%' OR
                  u.email LIKE '%" . $data ['searchInscritos'] . "%')" : " ") . */
                "ORDER BY t.order";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }
}