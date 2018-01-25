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
        $this->tabs = json_decode('{"tabs":[{"text":"Inscritos","tab":"inscritos"},{"text":"Equipa","tab":"equipa"},{"text":"Sessões","tab":"sessoes"},{"text":"Ficheiros","tab":"ficheiros"},{"text":"Avaliações","tab":"avaliacoes"},{"text":"Informações","tab":"informacoes"}]}');
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

    static function getInscrito($data) {
        $query     = "SELECT * " . "FROM " .
                (key_exists("subTab", $data) ? ($data['subTab'] == 'inscritos' ? " users_courses " : " courses_team ") : " users_courses ") .
                "uc INNER JOIN users u " . "ON uc.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? "AND uc.idCourses=" . $data ['idCourses'] . " " : " ") .
                (key_exists("idUsers", $data) ? "AND uc.idUsers=" . $data ['idUsers'] . " " : " ");
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    static function getUtlizadoresNaoInscritos($data) {
        $query     = "SELECT * FROM users u " .
                "WHERE u.idUsers NOT IN (SELECT idUsers FROM users_courses WHERE idCourses=" . $data['idCourses'] . ") " .
                "AND (name LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR email LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR aepId LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR permission LIKE '%" . $data['searchUtilizadores'] . "%' )";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function adicionarFormacoesInscritos($data) {
        $query     = "INSERT INTO users_courses (idUsers,idCourses) " .
                "VALUES (" . $data['idUsers'] . "," . $data['idCourses'] . ") ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    static function apagarFormacoesInscritos($data) {
        $query     = "DELETE FROM users_courses WHERE idUsers=" . $data['idUsers'] . " AND idCourses=" . $data['idCourses'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    static function atualizarFormacoesInscritos($data) {
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
        $query     = "UPDATE users_courses SET " .
                "unit='" . $data ['unit'] . "'," .
                "unitType='" . $data ['unitType'] . "'," .
                "observations='" . $data ['observations'] . "', " .
                "rank='" . $data ['rank'] . "'," .
                "boRank='" . $data ['boRank'] . "'," .
                "qa='" . (key_exists('qa', $data) ? 'on' : '') . "'," .
                "payment='" . (key_exists('payment', $data) ? 'on' : '') . "'," .
                "value=" . ($data ['value'] == '' ? 0 : $data ['value']) . " , " .
                "receipt='" . $data ['receipt'] . "'," .
                "boCourse='" . $data ['boCourse'] . "', " .
                "attended='" . (key_exists('attended', $data) ? 'on' : '') . "', " .
                "passedCourse='" . (key_exists('passedCourse', $data) ? 'on' : '') . "', " .
                "passedInternship='" . (key_exists('passedInternship', $data) ? 'on' : '') . "', " .
                "passed='" . (key_exists('passed', $data) ? 'on' : '') . "' " .
                "WHERE idUsers=" . $data ['idUsers'] . " AND idCourses=" . $data ['idCourses'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    static function adicionarFormacoesEquipa($data) {
        $query     = "INSERT INTO courses_team (idUsers,idCourses,type) VALUES (" . $data['idUsers'] . "," . $data['idCourses'] . ",'Formador') ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    static function atualizarFormacoesEquipa($data) {
        $data ['local']   = substr($data ['zipCode'], 9);
        $data ['zipCode'] = substr($data ['zipCode'], 0, 8);
        $query            = "UPDATE users SET " . "username='" . $data ['username'] . "'," . "email='" . $data ['email'] . "'," .
                "name='" . $data ['name'] . "'," . "sigla='" . $data ['sigla'] . "'," . "status='" . $data ['status'] . "'," .
                "birthDate='" . $data ['birthDate'] . "'," . "address='" . $data ['address'] . "'," .
                "zipCode='" . $data ['zipCode'] . "'," . "local='" . $data ['local'] . "'," . "mobile='" . $data ['mobile'] . "'," .
                "telephone='" . $data ['telephone'] . "'," . "observations='" . $data ['observations'] . "'," .
                "iban='" . $data ['iban'] . "'," . "aepId='" . $data ['aepId'] . "' " . "WHERE idUsers=" . $data ['idUsers'];
        $con              = new Database ();
        $resultado        = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        $query     = "UPDATE courses_team SET " . "type='" . $data ['type'] . "' " . "WHERE idUsers=" . $data ['idUsers'] .
                " AND idCourses=" . $data ['idCourses'];
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    static function getUtlizadoresSemEquipa($data) {
        $query     = "SELECT * FROM users u " .
                "WHERE u.idUsers NOT IN (SELECT idUsers FROM courses_team WHERE idCourses=" . $data['idCourses'] . ") " .
                "AND (name LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR email LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR aepId LIKE '%" . $data['searchUtilizadores'] . "%' " .
                "OR permission LIKE '%" . $data['searchUtilizadores'] . "%' ) ORDER BY permission,name";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function getEquipa1($data) {//just search
        $query     = "SELECT * FROM users WHERE " .
                "(username like '%" . $data ['searchEquipa'] . "%' OR " .
                "name like '%" . $data ['searchEquipa'] . "%' OR " .
                "aepId like '%" . $data ['searchEquipa'] . "%' OR " .
                "status like '%" . $data ['searchEquipa'] . "%' OR " .
                "mobile like '%" . $data ['searchEquipa'] . "%') " .
                " AND (permission='Formador' OR permission='Equipa Executiva') " .
                "ORDER BY name ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function getEquipa($data) { // var_dump($data);exit();
        $query     = "SELECT c.idCourses,c.course,c.status as cStatus, " . "ct.*, " . "u.*,u.status as uStatus " .
                " FROM " . "courses c INNER JOIN courses_team ct ON c.idCourses=ct.idCourses " . "INNER JOIN users u ON ct.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? "AND ct.idCourses=" . $data ['idCourses'] . " " : " ") .
                (key_exists("idUsers", $data) ? "AND ct.idUsers=" . $data ['idUsers'] . " " : " ") .
                (key_exists("searchEquipa", $data) ? "AND (u.name LIKE '%" . $data ['searchEquipa'] . "%' OR
					u.aepId LIKE '%" . $data ['searchEquipa'] . "%' OR
					u.email LIKE '%" . $data ['searchEquipa'] . "%')" : " ") . " ORDER BY u.aepId";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function apagarFormacoesEquipa($data) {
        $query     = "DELETE FROM courses_team WHERE idUsers=" . $data ['idUsers'] . " AND idCourses=" . $data ['idCourses'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    static function getSessoes($data) {
        $query     = "SELECT * FROM (SELECT cm.*, (SELECT a.name FROM users a WHERE a.idUsers=cm.idUsers) as formador " .
                " FROM " .
                " courses_modules cm " .
                //" INNER JOIN modules m ON cm.idModules=m.idModules " .
                //" INNER JOIN course c ON cm.idCourse=c.idCourse INNER JOIN courses cs ON cm.idCourses=cs.idCourses " .
                ") as t WHERE true " .
                (key_exists("search", $data) ?
                " AND (t.name LIKE '%" . $data ['search'] . "%' " .
                "OR t.type LIKE '%" . $data ['search'] . "%' OR t.formador LIKE '%" . $data ['search'] . "%')" : "") .
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
        return $resultado;
    }

    static function inserirFormacoesSessoes($data) {
        $con       = new Database ();
        $resultado = $con->set('START TRANSACTION');

        $query     = "SELECT "
                . "(SELECT idCourse FROM courses WHERE idCourses=" . $data['idCourses'] . ") as idCourse, "
                . "(SELECT max(idModules) FROM courses_modules WHERE idCourses=" . $data['idCourses'] . ")+1 as idModules, "
                . "(SELECT max(`order`) FROM courses_modules WHERE idCourses=" . $data['idCourses'] . ")+1 as ordem ";
        $resultado = $con->get($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido o registo.'];
        }
        $row       = $resultado[0];
        $query     = "INSERT INTO courses_modules (idModules,idCourse,idCourses,`order`,name,duration,type,status,observations) " .
                " VALUES (" . $row['idModules'] . "," . $row['idCourse'] . "," . $data['idCourses'] . "," . $row['ordem'] .
                ",'" . $data['name'] . "'," . $data['duration'] . ",'Proposto','Pendente','" . $data['observations'] . "') ";
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    static function restaurarFormacoesSessoes($data) {
        $con       = new Database ();
        $resultado = $con->set('START TRANSACTION');
        $query     = "DELETE FROM courses_modules WHERE idCourses=" . $data['idCourses'];
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $query     = "INSERT INTO courses_modules (idModules,idCourse,idCourses,`order`,name,duration,type,status) " .
                " SELECT m.idModules,m.idCourse," . $data['idCourses'] . ",m.order,m.name,m.duration,m.type,m.status " .
                " FROM modules m " . "INNER JOIN course c ON m.idCourse=c.idCourse " .
                "AND m.status='Fechado' AND m.idCourse=(SELECT idCourse FROM courses WHERE idCourses=" . $data['idCourses'] . ") ";
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Restauração concluída'];
    }

    static function apagarFormacoesSessoes($data) {
        $query     = "DELETE FROM courses_modules WHERE idCourses=" . $data['idCourses'] . " AND idCourse=" . $data['idCourse'] . " AND idModules= " . $data['idModules'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    static function getUtlizadoresEquipa($data) {
        $query     = "SELECT * FROM users u " .
                "WHERE u.idUsers IN (SELECT idUsers FROM courses_team WHERE idCourses=" . $data['idCourses'] . ") " .
                " ORDER BY permission,name";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function adicionarFormacoesSessoes($data) {
        $query     = "UPDATE courses_modules SET idUsers=" . $data['formador'] .
                " WHERE idCourses=" . $data['idCourses'] . " AND idCourse=" . $data['idCourse'] . " AND idModules=" . $data['idModules'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    static function getSessao($data) {
        $query     = "SELECT * FROM (SELECT cm.*, (SELECT a.name FROM users a WHERE a.idUsers=cm.idUsers) as formador " .
                " FROM " .
                " courses_modules cm " .
                //" INNER JOIN modules m ON cm.idModules=m.idModules " .
                //" INNER JOIN course c ON cm.idCourse=c.idCourse INNER JOIN courses cs ON cm.idCourses=cs.idCourses " .
                ") as t WHERE t.idCourses=" . $data ['idCourses'] .
                " AND t.idCourse=" . $data ['idCourse'] .
                " AND t.idModules=" . $data ['idModules'] . " " .
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

    static function getFormacoesAvaliacoes($data) {
        $query     = "SELECT u.name,IFNULL(target,'Formando') as target,if(length(evaluation)>10,'Respondido','Não respondido') as response,IFNULL(ce.status,'Aberto') as status " .
                "FROM users_courses uc INNER JOIN users u ON uc.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? " AND uc.idCourses=" . $data ['idCourses'] . " " : " ") .
                "LEFT JOIN courses_evaluations ce ON u.idUsers=ce.idUsers " .
                "LEFT JOIN evaluations e ON ce.idEvaluations=e.idEvaluations " .
                "UNION " .
                "SELECT u.name,IFNULL(target,'Formador') as target,if(length(evaluation)>10,'Respondido','Não respondido') as response,IFNULL(ce.status,'Aberto') as status " .
                "FROM courses_team uc INNER JOIN users u ON uc.idUsers=u.idUsers " .
                (key_exists("idCourses", $data) ? " AND uc.idCourses=" . $data ['idCourses'] . " " : " ") .
                "LEFT JOIN courses_evaluations ce ON u.idUsers=ce.idUsers " .
                "LEFT JOIN evaluations e ON ce.idEvaluations=e.idEvaluations ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function fecharAvaliacoesFormacoesAvaliacoes($data) {
        $query     = "SELECT status FROM courses_evaluations WHERE idCourse=" . $data ['idCourses'] . " LIMIT 1 ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (empty($resultado)) {
            return false;
        }
        $resultado = $resultado[0];
        if ($resultado['status'] == 'Aberto') {
            $resultado['status'] = 'Fechado';
        }
        else {
            $resultado['status'] = 'Aberto';
        }
        $query     = "UPDATE courses_evaluations SET status='" . $resultado['status'] . "' WHERE idCourses=" . $data ['idCourses'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O estado das avaliações não foi alterado.'];
        }
        return ['success' => true, 'message' => 'O estado das avaliações foi alterado.'];
    }
}