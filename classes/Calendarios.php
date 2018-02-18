<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendarios
 *
 * @author João Madeira
 */
class Calendarios
{

    //put your code here
    public function __construct()
    {
        //empty
    }

    public static function getCalendarios($data)
    {
        $query = "SELECT * FROM (SELECT cs.idCourses AS csIdCourses,cs.year AS csYear,cs.course AS csCourse,cs.completeName AS csCompleteName,cs.startDate AS csStartDate,cs.endDate AS csEndDate,".
            "cs.local AS csLocal,cs.vacancy AS csVacancy,cs.idCourse AS csIdCourse,cs.internship AS csInternship,cs.status AS csStatus,cs.observations AS csObservations, ".
            "c.idCourse AS cIdCourse,c.name AS cName,c.sigla as cSigla,c.level AS cLevel,c.internship AS cInternship,c.status AS cStatus ".
            /* ",ct.idCourses as ctIdCourses,ct.idUsers as ctIdUsers,ct.type as ctType,".
              "u.idUsers as uIdUsers,u.username as uUsername,u.email as uEmail,u.name as uName,u.sigla as uSigla,u.permission as uPermission,u.status as uSatus,".
              "u.birthDate as uBirthDate,u.address as uAddress,u.zipCode as uZipCode,u.local as uLocal,u.mobile as uMobile,u.telephone as uTelephone,u.observations as uObservations,".
              "u.iban as uIban,u.aepId as uAepId ".
             */"FROM courses cs ".
            "INNER JOIN course c ON cs.idCourse=c.idCourse ".
            /* "INNER JOIN courses_team ct ON ct.idCourses=cs.idCourses " .
              "INNER JOIN users u ON ct.idUsers=u.idUsers " .
             */"ORDER BY level) as t ".
            (key_exists('search', $data) ? "WHERE csYear LIKE '%".$data['search']."%' ".
            "OR csCompleteName LIKE '%".$data['search']."%' ".
            "OR csLocal LIKE '%".$data['search']."%' ".
            "OR csStatus LIKE '%".$data['search']."%' ".
            "OR cName LIKE '%".$data['search']."%' ".
            "OR cSigla LIKE '%".$data['search']."%' " : "");

        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getCalendario($data)
    {
        $query     = "SELECT cs.internship as csInternship,c.internship as cInternship, c.sigla as cSigla, ".
            "cs.*,c.* FROM courses cs INNER JOIN course c ON cs.idCourse=c.idCourse ".
            "WHERE idCourses=".$data['idCourses'];
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function inserirCalendarios($data)
    {
        $data      += ["year" => substr($data ['course'], -4, 4)];
        $query     = "INSERT INTO courses ".
            "(year,course,completeName,startDate,endDate,local,vacancy,idCourse,internship,status,observations) ".
            "VALUES ".
            "('".$data ['year'].
            "','".$data ['course'].
            "','".$data ['completeName'].
            "','".$data ['startDate'].
            "','".$data ['endDate'].
            "','".$data ['local'].
            "','".$data ['vacancy'].
            "',".$data ['idCourse'].
            ",'".$data ['internship'].
            "','".$data ['status'].
            "','".urldecode(str_replace('rn','\r\n',$data ['observations']))."')";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function atualizarCalendarios($data)
    {
        $data      += ["year" => substr($data ['course'], -4, 4)];
        $query     = "UPDATE courses SET ".
            "year='".$data ['year']."',"."course='".$data ['course']."',"."completeName='".$data ['completeName'].
            "',"."startDate='".$data ['startDate']."',"."endDate='".$data ['endDate'].
            "',"."local='".$data ['local']."',"."vacancy='".$data ['vacancy'].
            "',"."idCourse=".$data ['idCourse'].","."internship='".$data ['internship'].
            "',"."status='".$data ['status']."',"."observations='".urldecode(str_replace('rn','\r\n',$data ['observations'])).
            "' "."WHERE idCourses=".$data ['idCourses'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }

    public static function apagarCalendarios($data)
    {
        $query     = "UPDATE courses SET status=IF(status='Ativo','Inativo','Ativo') WHERE idCourses=".$data['idCourses']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }
}
