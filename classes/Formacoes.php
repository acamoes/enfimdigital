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
class Formacoes
{
    public $tabs = "";

    //put your code here

    public function __construct()
    {
        $this->getTabs();
    }

    function getTabs()
    {
        $this->tabs = json_decode('{"tabs":[{"text":"Inscritos","tab":"inscritos"},{"text":"Equipa","tab":"equipa"},{"text":"Sessões","tab":"sessoes"},{"text":"Ficheiros","tab":"ficheiros"},{"text":"Avaliações","tab":"avaliacoes"},{"text":"Relatórios","tab":"relatorios"},{"text":"Informações","tab":"informacoes"}]}');
    }
    
    function getServicosCentraisTabs()
    {
        return json_decode('{"tabs":[{"text":"Inscritos","tab":"inscritos"},{"text":"Equipa","tab":"equipa"}]}');
    }

    public static function getFormacoes(/* $data */)
    {
        $query     = "SELECT "."c.* "
            ."FROM "."courses c ".
            "ORDER BY startDate";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getFormacao($data)
    {
        $query     = "SELECT * ".
            " FROM "."courses cs INNER JOIN course c ON cs.idCourse=c.idCourse ".
            " WHERE cs.idCourses=".$data['idCourses']." AND LEFT(c.sigla,3) NOT IN ('CRA','CIF','ADF','DF') ".
            " ORDER BY cs.startDate";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function getFormacoesInscritos($data)
    {
        $query     = "SELECT c.idCourses,c.course,c.status as cStatus,c.vacancy,c.internship as cInternship, "."uc.*, ".
            "TIMESTAMPDIFF(YEAR, u.birthDate, NOW()) as age, ".
            (key_exists("idCourses", $data) ? "(SELECT count(*) FROM users_courses WHERE idCourses = ".$data ['idCourses'].") as inscritos,"
                : " ").
            "u.aepId,u.name,u.birthDate,u.mobile,u.telephone,u.email,u.status as uStatus,IFNULL(lastLogin,'0000-00-00 00:00:00') as lastLogin ".
            "FROM "."courses c INNER JOIN users_courses uc ON c.idCourses=uc.idCourses ".
            "INNER JOIN users u ON uc.idUsers=u.idUsers ".
            (key_exists("idCourses", $data) ? "AND uc.idCourses=".$data ['idCourses']." "
                : " ").
            (key_exists("search", $data) ?
            "AND (u.name LIKE '%".$data ['search']."%' OR
			u.aepId LIKE '%".$data ['search']."%' OR
			u.email LIKE '%".$data ['search']."%')" :
            " ")."ORDER BY u.aepId";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getFormacoesEquipa($data)
    {
        $query     = "SELECT c.idCourses,c.course,c.status as cStatus, "."ct.*, ".
            "u.aepId,u.sigla,u.name,u.iban,u.observations,u.birthDate,u.mobile,u.email,u.status as uStatus ".
            " FROM "."courses c INNER JOIN courses_team ct ON c.idCourses=ct.idCourses "."INNER JOIN users u ON ct.idUsers=u.idUsers ".
            (key_exists("idCourses", $data) ? "AND ct.idCourses=".$data ['idCourses']." "
                : " ").
            (key_exists("idUsers", $data) ? "AND ct.idUsers=".$data ['idUsers']." "
                : " ").
            " ORDER BY u.aepId";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function getFormacoesSessoes($data)
    {
        $query     = "SELECT * FROM (SELECT cm.*, (SELECT a.name FROM users a WHERE a.idUsers=cm.idUsers) as formador ".
            " FROM ".
            " courses_modules cm ".
            //" INNER JOIN modules m ON cm.idModules=m.idModules " .
            //" INNER JOIN course c ON cm.idCourse=c.idCourse INNER JOIN courses cs ON cm.idCourses=cs.idCourses " .
            ") as t WHERE true ".
            (key_exists("searchSessoes", $data) ? " AND (t.name LIKE '%".$data ['searchSessoes']."%' OR t.type LIKE '%".$data ['searchSessoes']."%' OR t.formador LIKE '%".$data ['searchSessoes']."%')"
                : "").
            (key_exists("idCourses", $data) ? " AND t.idCourses=".$data ['idCourses']." "
                : " ").
            (key_exists("idCourse", $data) ? " AND t.idCourse=".$data ['idCourse']." "
                : " ").
            (key_exists("idModules", $data) ? " AND t.idModules=".$data ['idModules']." "
                : " ").
            /* (key_exists ( "searchInscritos", $data ) ? "AND (u.name LIKE '%" . $data ['searchInscritos'] . "%' OR
              u.aepId LIKE '%" . $data ['searchInscritos'] . "%' OR
              u.email LIKE '%" . $data ['searchInscritos'] . "%')" : " ") . */
            "ORDER BY t.order";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function getInscrito($data)
    {
        $query     = "SELECT * "."FROM ".
            (key_exists("subTab", $data) ? ($data['subTab'] == 'inscritos' ? " users_courses "
                : " courses_team ") : " users_courses ").
            "uc INNER JOIN users u "."ON uc.idUsers=u.idUsers ".
            (key_exists("idCourses", $data) ? "AND uc.idCourses=".$data ['idCourses']." "
                : " ").
            (key_exists("idUsers", $data) ? "AND uc.idUsers=".$data ['idUsers']." "
                : " ");
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function getUtlizadoresNaoInscritos($data)
    {
        $query     = "SELECT * FROM users u ".
            "WHERE u.idUsers NOT IN (SELECT idUsers FROM users_courses WHERE idCourses=".$data['idCourses'].") ".
            "AND (name LIKE '%".$data['searchUtilizadores']."%' ".
            "OR email LIKE '%".$data['searchUtilizadores']."%' ".
            "OR aepId LIKE '%".$data['searchUtilizadores']."%' ".
            "OR permission LIKE '%".$data['searchUtilizadores']."%' )";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function adicionarFormacoesInscritos($data)
    {
        $query     = "INSERT INTO users_courses (idUsers,idCourses) ".
            "VALUES (".$data['idUsers'].",".$data['idCourses'].") ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    public static function selecionarFormacoesInscritos($data)
    {
        $query     = "UPDATE users_courses SET selected=IF(selected='Selecionado','Não selecionado','Selecionado') WHERE idUsers=".$data['idUsers']." AND idCourses=".$data['idCourses']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }
    
    public static function apagarFormacoesInscritos($data)
    {
        $query     = "DELETE FROM users_courses WHERE idUsers=".$data['idUsers']." AND idCourses=".$data['idCourses']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    public static function atualizarFormacoesInscritos($data)
    {
        $data ['local']                = substr($data ['zipCode'], 9);
        $data ['zipCode']              = substr($data ['zipCode'], 0, 8);
// $data['password']=$this->generatePassword(8);
        $query                         = "UPDATE users SET ".
            (($_SESSION['users']->permission = 'Equipa Executiva' || $_SESSION['users']->permission
            = 'Serviços Centrais') ?
            "username='".$data ['username']."',".
            "name='".$data ['name']."', ".
            "sigla='".$data ['sigla']."', ".
            "status='".$data ['status']."', ".
            "iban='".$data ['iban']."', ".
            "aepId='".$data ['aepId']."', ".
            "birthDate='".$data ['birthDate']."', " : "").
            "email='".$data ['email']."', ".
            "address='".$data ['address']."', ".
            "zipCode='".$data ['zipCode']."', ".
            "local='".$data ['local']."', ".
            "mobile='".$data ['mobile']."', ".
            "telephone='".$data ['telephone']."', ".
            "observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."' ".
            "WHERE idUsers=".$data ['idUsers'];
        $con                           = new Database();
        $resultado                     = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        $query                         = "UPDATE users_courses SET ".
            (($_SESSION['users']->permission = 'Equipa Executiva' || $_SESSION['users']->permission
            = 'Serviços Centrais') ?
            "unit='".$data ['unit']."', ".
            "unitType='".$data ['unitType']."', ".
            "rank='".$data ['rank']."', ".
            "boRank='".$data ['boRank']."', ".            
            "qa='".(key_exists('qa', $data) ? 'on' : '')."', ".
            "payment='".(key_exists('payment', $data) ? 'on' : '')."', ".
            "paymentDate=".(empty($data['paymentDate']) ? 'null' : "'".$data['paymentDate']."'").", ".
            "selected='".$data ['selected']."', ".
            "value=".($data ['value'] == '' ? 0 : $data ['value'])." , ".
            "receipt='".$data ['receipt']."', ".
            "boCourse='".$data ['boCourse']."', " : " ").
            "observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."',".
            "attended='".(key_exists('attended', $data) ? 'on' : '')."', ".
            "passedCourse='".(key_exists('passedCourse', $data) ? 'on' : '')."', ".
            "passedInternship='".(key_exists('passedInternship', $data) ? 'on' : '')."', ".
            "passed='".(key_exists('passed', $data) ? 'on' : '')."' ".
            "WHERE idUsers=".$data ['idUsers']." AND idCourses=".$data ['idCourses'];
        $con                           = new Database();
        $resultado                     = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    public static function adicionarFormacoesEquipa($data)
    {
        $query     = "INSERT INTO courses_team (idUsers,idCourses,type) VALUES (".$data['idUsers'].",".$data['idCourses'].",".
            ($_SESSION['users']->permission == 'Equipa Executiva' ? "'Formador'"
                : "'Externo'").
            ") ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    public static function atualizarFormacoesEquipa($data)
    {
        if (key_exists('zipCode', $data)) {
            $data ['local']   = substr($data ['zipCode'], 9);
            $data ['zipCode'] = substr($data ['zipCode'], 0, 8);
        }
        $query = "UPDATE users SET ";
        if ($_SESSION['users']->permission == 'Equipa Executiva') {
            $query .= (key_exists('username', $data) ? "username='".$data ['username']."',"
                    : "").
                (key_exists('email', $data) ? "email='".$data ['email']."'," : "").
                (key_exists('status', $data) ? "status='".$data ['status']."'," : "").
                (key_exists('birthDate', $data) ? "birthDate='".$data ['birthDate']."',"
                    : "").
                (key_exists('address', $data) ? "address='".$data ['address']."',"
                    : "").
                (key_exists('zipCode', $data) ? "zipCode='".$data ['zipCode']."',"
                    : "").
                (key_exists('mobile', $data) ? "mobile='".$data ['mobile']."'," : "").
                (key_exists('telephone', $data) ? "telephone='".$data ['telephone']."',"
                    : "").
                (key_exists('local', $data) ? "local='".$data ['local']."'," : "").
                (key_exists('aepId', $data) ? "aepId='".$data ['aepId']."', " : "")
            ;
        }

        $query     .= "name='".$data ['name']."',".
            "sigla='".$data ['sigla']."',".
            "observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."',".
            "iban='".$data ['iban']."' ".
            " WHERE idUsers=".$data ['idUsers'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        $query     = "UPDATE courses_team SET "."type='".$data ['type']."' "."WHERE idUsers=".$data ['idUsers'].
            " AND idCourses=".$data ['idCourses'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    public static function getUtlizadoresSemEquipa($data)
    {
        $query     = "SELECT * FROM users u ".
            "WHERE u.idUsers NOT IN (SELECT idUsers FROM courses_team WHERE idCourses=".$data['idCourses'].") ".
            ($_SESSION['users']->permission != 'Equipa Executiva' ? " AND permission='Formador' "
                : "").
            " AND (name LIKE '%".$data['searchUtilizadores']."%' ".
            " OR email LIKE '%".$data['searchUtilizadores']."%' ".
            " OR aepId LIKE '%".$data['searchUtilizadores']."%' ".
            " OR permission LIKE '%".$data['searchUtilizadores']."%' ) ORDER BY permission,name";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getEquipa1($data)
    {//just search
        $query     = "SELECT * FROM users WHERE ".
            "(username like '%".$data ['searchEquipa']."%' OR ".
            "name like '%".$data ['searchEquipa']."%' OR ".
            "aepId like '%".$data ['searchEquipa']."%' OR ".
            "status like '%".$data ['searchEquipa']."%' OR ".
            "mobile like '%".$data ['searchEquipa']."%') ".
            " AND (permission='Formador' OR permission='Equipa Executiva') ".
            "ORDER BY name ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getEquipa($data)
    { // var_dump($data);exit();
        $query     = "SELECT c.idCourses,c.course,c.status as cStatus, "."ct.*, ".
            "u.aepId,u.name,u.birthDate,u.mobile,u.email,u.status as uStatus ".
            " FROM "."courses c INNER JOIN courses_team ct ON c.idCourses=ct.idCourses "."INNER JOIN users u ON ct.idUsers=u.idUsers ".
            (key_exists("idCourse", $data) ? "AND c.idCourse=".$data ['idCourse']." "
                : " ").
            (key_exists("idCourses", $data) ? "AND ct.idCourses=".$data ['idCourses']." "
                : " ").
            (key_exists("idUsers", $data) ? "AND ct.idUsers=".$data ['idUsers']." "
                : " ").
            (key_exists("search", $data) ? "AND (u.name LIKE '%".$data ['search']."%' OR
					u.aepId LIKE '%".$data ['search']."%' OR
					u.email LIKE '%".$data ['search']."%')" : " ")." ORDER BY u.aepId";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function apagarFormacoesEquipa($data)
    {
        $query     = "DELETE FROM courses_team WHERE idUsers=".$data ['idUsers']." AND idCourses=".$data ['idCourses']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    public static function getSessoes($data)
    {
        $query     = "SELECT * FROM (SELECT cm.*, (SELECT a.name FROM users a WHERE a.idUsers=cm.idUsers) as formador ".
            " FROM ".
            " courses_modules cm ".
            //" INNER JOIN modules m ON cm.idModules=m.idModules " .
            //" INNER JOIN course c ON cm.idCourse=c.idCourse INNER JOIN courses cs ON cm.idCourses=cs.idCourses " .
            ") as t WHERE true ".
            (key_exists("search", $data) ?
            " AND (t.name LIKE '%".$data ['search']."%' ".
            "OR t.type LIKE '%".$data ['search']."%' OR t.formador LIKE '%".$data ['search']."%')"
                : "").
            (key_exists("idCourses", $data) ? " AND t.idCourses=".$data ['idCourses']." "
                : " ").
            (key_exists("idCourse", $data) ? " AND t.idCourse=".$data ['idCourse']." "
                : " ").
            (key_exists("idModules", $data) ? " AND t.idModules=".$data ['idModules']." "
                : " ").
            /* (key_exists ( "searchInscritos", $data ) ? "AND (u.name LIKE '%" . $data ['searchInscritos'] . "%' OR
              u.aepId LIKE '%" . $data ['searchInscritos'] . "%' OR
              u.email LIKE '%" . $data ['searchInscritos'] . "%')" : " ") . */
            "ORDER BY t.order";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function atualizarFormacoesSessoes($data)
    {
        $con = new Database();
        if ($_SESSION['users']->permission == 'Equipa Executiva' && key_exists('type',
                $data) && key_exists('status', $data)) {
            $resultado = $con->set('START TRANSACTION');
            $query     = "UPDATE courses_modules SET ".
                "`order`=".$data['order'].", ".
                "name='".$data['name']."', ".
                "duration=".$data['duration'].", ".
                "type='".$data['type']."', ".
                "status='".$data['status']."', ".
                "observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."' ".
                "WHERE ".
                "idModules=".$data['idModules']." AND idCourse=".$data['idCourse']." AND idCourses=".$data['idCourses'];
            $resultado = $con->set($query);
            if (!$resultado) {
                $resultado = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não foi inserido o registo.'];
            }
            $query     = "INSERT INTO modules (idModules,idCourse,`order`,name,duration,type,status) ".
                "(SELECT idModules,idCourse,`order`,name,duration,type,status ".
                "FROM courses_modules cm ".
                "WHERE idModules=".$data['idModules']." AND idCourse=".$data['idCourse']." AND idCourses=".$data['idCourses'].") ".
                "ON DUPLICATE KEY UPDATE `order`= cm.`order`,name=cm.name,duration=cm.duration,type=cm.type,status=cm.status";
            $resultado = $con->set($query);
            if (!$resultado) {
                $resultado = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não foi inserido o registo.'];
            }
        } else {
            $resultado = $con->set('START TRANSACTION');
            $query     = "UPDATE courses_modules SET ".
                "name='".$data['name']."', ".
                "duration=".$data['name'].", ".
                "observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."' ".
                "WHERE ".
                "idModules=".$data['idModules']." AND idCourse=".$data['idCourse']." AND idCourses=".$data['idCourses'];
            $resultado = $con->set($query);
            if (!$resultado) {
                $resultado = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não foi inserido o registo.'];
            }
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    public static function inserirFormacoesSessoes($data)
    {
        $con       = new Database();
        $resultado = $con->set('START TRANSACTION');

        $query     = "SELECT "
            ."(SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'].") as idCourse, "
            ."(SELECT max(`order`) FROM courses_modules WHERE idCourses=".$data['idCourses'].")+1 as ordem ";
        $resultado = $con->get($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido o registo.'];
        }
        $row = $resultado[0];

        $query             = "INSERT INTO modules (idCourse,duration) values (".$row['idCourse'].",0)";
        $resultado         = $con->set($query);
        $data['idModules'] = $con->connection->insert_id;
        $query             = "DELETE FROM modules WHERE idCourse=".$row['idCourse']." AND idModules=".$data['idModules'];
        $resultado         = $con->set($query);

        $query     = "INSERT INTO courses_modules (idModules,idCourse,idCourses,`order`,name,duration,type,status,observations) ".
            " VALUES (".$data['idModules'].",".$row['idCourse'].",".$data['idCourses'].",".$row['ordem'].
            ",'".$data['name']."',".$data['duration'].",'Proposto','Pendente','".urldecode(str_replace('rn','\r\n',$data ['observations']))."') ";
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    public static function restaurarFormacoesSessoes($data)
    {
        $con       = new Database();
        $resultado = $con->set('START TRANSACTION');
        $query     = "DELETE FROM courses_modules WHERE idCourses=".$data['idCourses'];
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $query     = "INSERT INTO courses_modules (idModules,idCourse,idCourses,`order`,name,duration,type,status) ".
            " SELECT m.idModules,m.idCourse,".$data['idCourses'].",m.order,m.name,m.duration,m.type,m.status ".
            " FROM modules m "."INNER JOIN course c ON m.idCourse=c.idCourse ".
            "AND m.status='Fechado' AND m.idCourse=(SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'].") ";
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Restauração concluída'];
    }

    public static function apagarFormacoesSessoes($data)
    {
        $query     = "DELETE FROM courses_modules WHERE idCourses=".$data['idCourses']." AND idCourse=".$data['idCourse']." AND idModules= ".$data['idModules']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi apagar o registo.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    public static function getUtlizadoresEquipa($data)
    {
        $query     = "SELECT * FROM users u ".
            "WHERE u.idUsers IN (SELECT idUsers FROM courses_team WHERE idCourses=".$data['idCourses'].") ".
            " ORDER BY permission,name";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function adicionarFormacoesSessoes($data)
    {
        $query     = "UPDATE courses_modules SET idUsers=".$data['formador'].
            " WHERE idCourses=".$data['idCourses']." AND idCourse=".$data['idCourse']." AND idModules=".$data['idModules']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi adicionado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo adicionado.'];
    }

    public static function getSessao($data)
    {
        $query     = "SELECT * FROM (SELECT cm.*, (SELECT a.name FROM users a WHERE a.idUsers=cm.idUsers) as formador ".
            " FROM ".
            " courses_modules cm ".
            //" INNER JOIN modules m ON cm.idModules=m.idModules " .
            //" INNER JOIN course c ON cm.idCourse=c.idCourse INNER JOIN courses cs ON cm.idCourses=cs.idCourses " .
            ") as t WHERE t.idCourses=".$data ['idCourses'].
            " AND t.idCourse=".$data ['idCourse'].
            " AND t.idModules=".$data ['idModules']." ".
            /* (key_exists ( "searchInscritos", $data ) ? "AND (u.name LIKE '%" . $data ['searchInscritos'] . "%' OR
              u.aepId LIKE '%" . $data ['searchInscritos'] . "%' OR
              u.email LIKE '%" . $data ['searchInscritos'] . "%')" : " ") . */
            "ORDER BY t.order";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function getFormacoesAvaliacoes($data)
    {
        $query     = "SELECT * FROM (SELECT u.name,IFNULL(target,'Formando') as target,if(length(evaluation)>10,'Respondido','Não respondido') as response,IFNULL(ce.status,'Aberto') as status ".
            "FROM users_courses uc INNER JOIN users u ON uc.idUsers=u.idUsers ".
            (key_exists("idCourses", $data) ? " AND uc.idCourses=".$data ['idCourses']." ": " ").
            "LEFT JOIN courses_evaluations ce ON u.idUsers=ce.idUsers ".
            (key_exists("idCourses", $data) ? " AND ce.idCourses=".$data ['idCourses']." ": " ").
            "LEFT JOIN evaluations e ON ce.idEvaluations=e.idEvaluations ".
            "UNION ".
            "SELECT u.name,IFNULL(target,'Formador') as target,if(length(evaluation)>10,'Respondido','Não respondido') as response,IFNULL(ce.status,'Aberto') as status ".
            "FROM courses_team uc INNER JOIN users u ON uc.idUsers=u.idUsers ".
            (key_exists("idCourses", $data) ? " AND uc.idCourses=".$data ['idCourses']." " : " ").
            "LEFT JOIN courses_evaluations ce ON u.idUsers=ce.idUsers ".
            (key_exists("idCourses", $data) ? " AND ce.idCourses=".$data ['idCourses']." ": " ").
            "LEFT JOIN evaluations e ON ce.idEvaluations=e.idEvaluations) as t ".
            (key_exists("search", $data) ? "WHERE name LIKE '%".$data['search']."%' ".
            "OR target LIKE '%".$data['search']."%' ".
            "OR status LIKE '%".$data['search']."%' ".
            "OR response LIKE '%".$data['search']."%'" : "").
            " ORDER BY target";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getFormacoesAvaliacoesFormadores($data)
    {
        $query     = "(SELECT (SELECT idCourses FROM courses WHERE idCourses = ce.idCourses) AS idCourses, ".
            "ce.idEvaluations,u.idUsers,u.name,target,if(length(evaluation)>10,'Respondido','Não respondido') as response,".
            "ce.status as status ".
            "FROM courses_team uc INNER JOIN users u ON uc.idUsers=u.idUsers ".            
            "LEFT JOIN courses_evaluations ce ON u.idUsers=ce.idUsers ".
            "LEFT JOIN evaluations e ON ce.idEvaluations=e.idEvaluations ".            
            "WHERE u.idUsers=".$_SESSION['users']->idUsers." ".
            (key_exists("idCourses", $data) ? " AND uc.idCourses=".$data ['idCourses']." AND ce.idCourses=".$data ['idCourses']." "
                : " ").
            "ORDER BY target) "; //.
            /*"UNION ".
            "(SELECT (SELECT idCourses FROM courses WHERE idCourses = ce.idCourses) AS idCourses, ".
            "ce.idEvaluations,u.idUsers,u.name,target,IF(LENGTH(evaluation) > 10,'Respondido','Não respondido') AS response,".
            "ce.status AS status ".
            "FROM courses_team uc INNER JOIN users u ON uc.idUsers = u.idUsers ".
            (key_exists("idCourses", $data) ? " AND uc.idCourses<>".$data ['idCourses']." "
                : " ").
            "LEFT JOIN courses_evaluations ce ON u.idUsers = ce.idUsers ".
            "LEFT JOIN evaluations e ON ce.idEvaluations = e.idEvaluations ".
            "WHERE u.idUsers =".$_SESSION['users']->idUsers." ".
            "AND target = 'Curso' ORDER BY date DESC LIMIT 2,6) ";*/
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function fecharAvaliacoesFormacoesAvaliacoes($data)
    {
        $query     = "SELECT status FROM courses_evaluations WHERE idCourse=".$data ['idCourses']." LIMIT 1 ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (empty($resultado)) {
            return false;
        }
        $resultado = $resultado[0];
        if ($resultado['status'] == 'Aberto') {
            $resultado['status'] = 'Fechado';
        } else {
            $resultado['status'] = 'Aberto';
        }
        $query     = "UPDATE courses_evaluations SET status='".$resultado['status']."' WHERE idCourses=".$data ['idCourses']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'O estado das avaliações não foi alterado.'];
        }
        return ['success' => true, 'message' => 'O estado das avaliações foi alterado.'];
    }

    public static function getFicheiros($data)
    {
        $query = "SELECT * FROM (SELECT ".
            "d.idDocuments, ".
            "d.idCourse, ".
            "d.idCourses, ".
            "d.idModules, ".
            "m.name as modulo, ".
            "m.type as mTipo, ".
            "d.name as documento, ".
            "d.observations, ".
            "d.type as dTipo, ".
            "d.public, ".
            "d.status, ".
            "d.document1, ".
            "RIGHT(d.document1, LOCATE('.', REVERSE(d.document1))-1) as ext1, ".
            "d.document2, ".
            "RIGHT(d.document2, LOCATE('.', REVERSE(d.document2))-1) as ext2, ".
            "d.document3, ".
            "RIGHT(d.document3, LOCATE('.', REVERSE(d.document3))-1) as ext3, ".
            "d.document4, ".
            "RIGHT(d.document4, LOCATE('.', REVERSE(d.document4))-1) as ext4, ".
            "d.dateAutor, ".
            "d.idAutor, ".
            "(SELECT name FROM users WHERE idUsers=d.idAutor) as autor, ".
            "d.dateDiretor, ".
            "d.idDiretor, ".
            "(SELECT name FROM users WHERE idUsers=d.idDiretor) as diretor, ".
            "d.datePedagogico, ".
            "d.idPedagogico, ".
            "(SELECT name FROM users WHERE idUsers=d.idPedagogico) as pedagogico, ".
            "d.dateExecutiva, ".
            "d.idExecutiva, ".
            "(SELECT name FROM users WHERE idUsers=d.idExecutiva) as executiva ".
            " FROM courses_documents d INNER JOIN courses_modules m ON d.idModules=m.idModules AND m.status<>'Inativo' AND d.status<>'Inativo'  ".
            " AND  d.idCourses=".$data['idCourses']." AND m.idCourses=".$data['idCourses']." ORDER BY m.order) t WHERE true ".
            (key_exists("search", $data) ?
            " AND (modulo LIKE '%".$data['search']."%' OR mTipo LIKE '%".$data['search']."%' OR ".
            "document1 LIKE '%".$data['search']."%' OR document2 LIKE '%".$data['search']."%' OR document3 LIKE '%".$data['search']."%' OR document4 LIKE '%".$data['search']."%' OR ".
            "documento LIKE '%".$data['search']."%' OR dTipo LIKE '%".$data['search']."%' )"
                : "");

        if (key_exists("idCourses", $data) && key_exists("idDocuments", $data)) {
            $query .= " AND (idCourses=".$data['idCourses']." AND idDocuments=".$data['idDocuments']." ) ";
        }
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function getFicheiro($data)
    {
        $query = "SELECT * FROM (SELECT ".
            "d.idDocuments, ".
            "d.idCourse, ".
            "d.idCourses, ".
            "d.idModules, ".
            "m.name as modulo, ".
            "m.type as mTipo, ".
            "d.name as documento, ".
            "d.observations, ".
            "d.type as dTipo, ".
            "d.public, ".
            "d.status, ".
            "d.document1, ".
            "RIGHT(d.document1, LOCATE('.', REVERSE(d.document1))-1) as ext1, ".
            "d.document2, ".
            "RIGHT(d.document2, LOCATE('.', REVERSE(d.document2))-1) as ext2, ".
            "d.document3, ".
            "RIGHT(d.document3, LOCATE('.', REVERSE(d.document3))-1) as ext3, ".
            "d.document4, ".
            "RIGHT(d.document4, LOCATE('.', REVERSE(d.document4))-1) as ext4, ".
            "d.dateAutor, ".
            "d.idAutor, ".
            "(SELECT name FROM users WHERE idUsers=d.idAutor) as autor, ".
            "d.dateDiretor, ".
            "d.idDiretor, ".
            "(SELECT name FROM users WHERE idUsers=d.idDiretor) as diretor, ".
            "d.datePedagogico, ".
            "d.idPedagogico, ".
            "(SELECT name FROM users WHERE idUsers=d.idPedagogico) as pedagogico, ".
            "d.dateExecutiva, ".
            "d.idExecutiva, ".
            "(SELECT name FROM users WHERE idUsers=d.idExecutiva) as executiva ".
            " FROM courses_documents d INNER JOIN courses_modules m ON d.idModules=m.idModules AND m.status<>'Inativo' AND d.status<>'Inativo'  ".
            " AND  d.idCourses=".$data['idCourses']." AND m.idCourses=".$data['idCourses']." ORDER BY m.order) t WHERE true ";

        if (key_exists("idCourses", $data) && key_exists("idDocuments", $data)) {
            $query .= " AND (idCourses=".$data['idCourses']." AND idDocuments=".$data['idDocuments']." ) ";
        }
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function restaurarFormacoesFicheiros($data)
    {
        $con       = new Database();
        $resultado = $con->set('START TRANSACTION');
        $query     = "DELETE FROM courses_documents WHERE status='Fechado' AND idCourses=".$data['idCourses'];
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $query     = "INSERT IGNORE INTO courses_documents "
            ."(idCourses,idDocuments,idModules,idCourse,name,type,public,observations,status,"
            ."document1,document1Blob,document2,document2Blob,document3,document3Blob,document4,document4Blob,"
            ."dateAutor,idAutor,dateDiretor,idDiretor,datePedagogico,idPedagogico,dateExecutiva,idExecutiva) "
            ." SELECT ".$data['idCourses'].",d.idDocuments,d.idModules,d.idCourse,d.name,d.type,d.public,d.observations,d.status,"
            ."d.document1,d.document1Blob,d.document2,d.document2Blob,d.document3,d.document3Blob,d.document4,d.document4Blob,"
            ."d.dateAutor,d.idAutor,d.dateDiretor,d.idDiretor,d.datePedagogico,d.idPedagogico,d.dateExecutiva,d.idExecutiva "
            ." FROM documents d INNER JOIN courses_modules cm ON d.idCourse=cm.idCourse AND d.idModules=cm.idModules "
            ." AND d.idCourse IN (SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'].") AND d.status='Fechado' GROUP BY d.idDocuments";
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi restaurado.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Restauração concluída'];
    }

    public static function getFormacoesModulos($data)
    {
        $query     = "SELECT * FROM courses_modules WHERE status<>'Inativo' AND idCourses=".$data['idCourses']." ORDER BY `order` ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function inserirFormacoesInformacao($data)
    {//vem do upload.php
        $con       = new Database();
        $query     = "SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'];
        $resultado = $con->get($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Ficheiro não aceite.'];
        }
        $_SESSION['ficheiros']['idCourse']                              = $resultado[0]['idCourse'];
        $_SESSION ['ficheiros']['type']                                 = $data['type'];
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];

        $query     = "INSERT INTO courses_informations (idCourses,idCourse,name,observations,status,document,documentBlob,date) VALUES (".
            $data['idCourses'].",".$resultado[0]['idCourse'].",'".(key_exists('name',
                $data) ? $data['name'] : '')."','".
            (key_exists('observations', $data) ? urldecode(str_replace('rn','\r\n',$data ['observations'])) : '')."','Inativo','".$_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']."',".
            "'".$_SESSION ['ficheiros']['filePos'][$data['filePos']]['content']."','".date('Y-m-d H:i:s')."')";
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Ficheiro não aceite.'];
        }
        $_SESSION ['ficheiros']['idInformations'] = $con->connection->insert_id;
        return ['success' => true, 'message' => 'Ficheiro aceite.'];
    }

    public static function atualizarFormacoesInformacao($data)
    {//vem do upload.php
        $con       = new Database();
        $query     = "SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'];
        $resultado = $con->get($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Ficheiro não aceite.'];
        }
        $_SESSION['ficheiros']['idCourse'] = $resultado[0]['idCourse'];
        if (key_exists('file', $data)) {
            $_SESSION ['ficheiros']['type']                                 = $data['type'];
            $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
            $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];
        }

        $query     = "UPDATE courses_informations SET idCourse=".$resultado[0]['idCourse'].",".
            (key_exists('name', $data) ? "name='".$data['name']."'," : "").
            (key_exists('observations', $data) ? "observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."',"
                : "").
            (key_exists('status', $data) ? "status='".$data['status']."'," : "status='Inativo',").
            (key_exists('file', $data) ?
            "document='".$_SESSION ['ficheiros']['filePos']['5']['file']."',".
            "documentBlob='".$_SESSION ['ficheiros']['filePos']['5']['content']."',"
                : "").
            "date='".date('Y-m-d H:i:s')."' WHERE ".
            "idCourses=".$data['idCourses']." AND idInformations=".$_SESSION ['ficheiros']['idInformations'];
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado.'];
        }
        return ['success' => true, 'message' => 'Foi atualizado.'];
    }

    public static function getInformacao($data)
    {
        $query = "SELECT ".
            "idInformations, ".
            "idCourse, ".
            "idCourses, ".
            "name, ".
            "observations, ".
            "status, ".
            "document, ".
            "documentBlob, ".
            "RIGHT(document, LOCATE('.', REVERSE(document))-1) as ext ".
            "FROM courses_informations ".
            " WHERE idCourses=".$data['idCourses']." AND idInformations= ".$data['idInformations'];

        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    public static function inserirFormacoesFicheiro($data)
    {//vem do upload.php
        $con       = new Database();
        $resultado = $con->set('START TRANSACTION');
        $query     = "INSERT INTO documents (idModules,idCourse) VALUES (0,0) ";
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $_SESSION ['ficheiros']['idDocuments'] = $con->connection->insert_id;

        $query     = "DELETE FROM documents WHERE idDocuments=".$_SESSION ['ficheiros']['idDocuments'];
        $resultado = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $query     = "SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'];
        $resultado = $con->get($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $_SESSION['ficheiros']['idCourse']                              = $resultado[0]['idCourse'];
        $_SESSION ['ficheiros']['type']                                 = $data['type'];
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
        $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];
        $query                                                          = "INSERT INTO courses_documents ".
            "(idCourses, idDocuments, idModules, idCourse, ".
            "status, type, document".$data['filePos'].", document".$data['filePos']."Blob, idAutor, dateAutor)".
            "VALUES "."(".$data['idCourses'].",".$_SESSION ['ficheiros']['idDocuments'].",0,".$_SESSION ['ficheiros']['idCourse'].",'Pendente',".
            "'".$data['type']."','".$data['file']."','".$data['content']."',".
            "dateAutor='".date("Y-m-d H:i:s")."', idAutor=".$_SESSION ['users']->idUsers.") ";
        $resultado                                                      = $con->set($query);
        if (!$resultado) {
            $resultado = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não foi inserido.'];
        }
        $resultado = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Ficheiro inserido.'];
    }

    public static function atualizarFormacoesFicheiro($data)
    {//vem do upload.php
        $con       = new Database();
        $query     = "SELECT idCourse FROM courses WHERE idCourses=".$data['idCourses'];
        $resultado = $con->get($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi inserido o registo.'];
        }

        $_SESSION['ficheiros']['idCourse'] = $resultado[0]['idCourse'];
        if (key_exists('file', $data)) {
            $_SESSION ['ficheiros']['type']                                 = $data['type'];
            $_SESSION ['ficheiros']['filePos'][$data['filePos']]['file']    = $data['file']; //APAGAR
            $_SESSION ['ficheiros']['filePos'][$data['filePos']]['content'] = $data['content'];
        }

        $query = "UPDATE courses_documents "
            ." SET "
            .(key_exists('file', $data) ? "document".$data['filePos']."='".$data['file']."',"."document".$data['filePos']."Blob='".$data['content']."', "
                : "")
            ."status='Pendente', "
            .(key_exists('public', $data) ? "public='".$data['public']."', " : "public='Não', ")
            .(key_exists('file', $data) ? "dateAutor='".date("Y-m-d H:i:s")."', idAutor=".$_SESSION ['users']->idUsers.", "
                : "")
            ."dateDiretor=NULL, idDiretor=NULL, "
            ."datePedagogico=NULL, idPedagogico=NULL, "
            ."dateExecutiva=NULL, idExecutiva=NULL "
            ." WHERE idCourse=".$_SESSION['ficheiros']['idCourse']." AND idCourses=".$data['idCourses'].
            " AND idDocuments=".$_SESSION ['ficheiros']['idDocuments'];

        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi atualizado o registo.'];
        }
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    public static function inserirFormacoesFicheiros($data)
    {

        $query     = "UPDATE courses_documents SET ".
            "idModules=".$data['idModules'].",name='".$data['name']."',public='".$data['public']."',status='Pendente',observations='".urldecode(str_replace('rn','\r\n',$data ['observations']))."', ".
            "type='".$_SESSION ['ficheiros']['type']."',idAutor=".$_SESSION['users']->idUsers.",dateAutor='".date("Y-m-d H:i:s")."', ".
            "dateDiretor=NULL, idDiretor=NULL, ".
            "datePedagogico=NULL, idPedagogico=NULL, ".
            "dateExecutiva=NULL, idExecutiva=NULL ".
            "WHERE idCourses=".$data['idCourses']." AND idCourse=".$_SESSION['ficheiros']['idCourse'].
            " AND idDocuments=".$_SESSION ['ficheiros']['idDocuments']." ";
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi inserido o registo.'];
        }
        return ['success' => true, 'message' => 'Registo inserido.'];
    }

    public static function apagarFormacoesFicheiros($data)
    {
        $query     = "DELETE FROM courses_documents WHERE ".
            " idDocuments=".$data['idDocuments'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'O registo não foi apagado.'];
        }
        return ['success' => true, 'message' => 'Registo apagado.'];
    }

    public static function aprovarFormacoesFicheiros($data)
    {//<?=$docs[$i]['idCourse']."_".$docs[$i]['idCourses']."_".$docs[$i]['idModules']."_".$docs[$i]['idDocuments']
        $con       = new Database();
        $result    = $con->set('START TRANSACTION');
        $query     = "SELECT count(*) as equipa,`type` FROM courses_team WHERE idUsers=".$_SESSION['users']->idUsers." AND idCourses=".$data['idCourses']." ";
        $resultado = $con->get($query);
        if (!$resultado) {
            $result = $con->set('ROLLBACK');
            return ['success' => false, 'message' => 'Não ficou aprovado.'];
        }
        $resultado   = $resultado[0];
        $newModuleId = 0;
        $newId       = 0;
        if (($resultado['equipa'] == 0 && $_SESSION['users']->permission == 'Equipa Executiva')
            ||
            ($data['action'] == 'equipaExecutiva' && $_SESSION['users']->permission
            == 'Equipa Executiva')) { //Não pertence à equipa de curso, mas é equipa executiva
            $query          = "SELECT * FROM courses_documents WHERE idCourses=".$data['idCourses']." AND idDocuments=".$data['idDocuments'];
            $rowData        = $con->get($query);
            $rowData        = $rowData[0];
            $idCourse       = $rowData['idCourse'];
            $idModules      = $rowData['idModules'];
            $query          = "SELECT count(*),cm.* FROM courses_modules cm WHERE idCourses=".$data['idCourses']." AND idModules=".$idModules." AND idCourse=".$idCourse." AND status='Pendente' ";
            $rowModulesData = $con->get($query);
            $rowModulesData = $rowModulesData[0];

            if ($rowModulesData['type'] == 'novo' || $rowModulesData['type'] == 'extra'
                || $rowModulesData['type'] == 'proposto') {
                $type   = ($rowModulesData['type'] == 'novo' ? 'base' : 'extra');
                $query  = "UPDATE courses_modules SET type='".$type."', status='Fechado' WHERE idCourses=".$data['idCourses']." AND idModules=".$idModules." AND idCourse=".$idCourse." ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $query  = "UPDATE modules SET status='Inativo' WHERE idModules=".$idModules." ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
            }
            $query  = "UPDATE courses_documents SET status='Fechado', dateExecutiva='".date("Y-m-d H:i:s")."' ,idExecutiva=".$_SESSION['users']->idUsers.
                " WHERE idCourses=".$data['idCourses']." AND idDocuments=".$data['idDocuments']." AND idModules=".$idModules." AND idCourse=".$idCourse." ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
            $query  = "UPDATE documents SET status='Inativo' WHERE idDocuments=".$data['idDocuments']." ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }

            if ($rowModulesData['type'] == 'novo' || $rowModulesData['type'] == 'extra'
                || $rowModulesData['type'] == 'proposto') {
                $type   = ($rowModulesData['type'] == 'novo' ? 'base' : 'extra');
                $query  = "INSERT INTO modules (idCourse,`order`,name,duration,type,status) VALUES (".$rowModulesData['idCourse'].",".$rowModulesData['order'].",'".$rowModulesData['name']."',".$rowModulesData['duration'].",'".$type."','Fechado')";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $newModuleId = $con->connection->insert_id;
            }
            $query  = "INSERT INTO documents (idModules,idCourse,name,type,public,observations,status,".
                "document1,document1Blob,document2,document2Blob,document3,document3Blob,document4,document4Blob,".
                "dateAutor,idAutor,dateDiretor,idDiretor,datePedagogico,idPedagogico,dateExecutiva,idExecutiva) ".
                " SELECT ".($newModuleId != 0 ? $newModuleId : "idModules").",idCourse,name,type,public,observations,status,".
                "document1,document1Blob,document2,document2Blob,document3,document3Blob,document4,document4Blob,".
                "dateAutor,idAutor,dateDiretor,idDiretor,datePedagogico,idPedagogico,dateExecutiva,idExecutiva ".
                "FROM courses_documents WHERE idCourses=".$data['idCourses']." AND idDocuments=".$data['idDocuments']." AND idModules=".$idModules." AND idCourse=".$idCourse." ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
            $newId  = $con->connection->insert_id;
            $query  = "UPDATE courses_documents ".
                "SET idDocuments=".$newId.", status='Fechado'".
//                    ",name='" . $rowData['name'] . "',type='" . $rowData['type'] . "',public='" . $rowData['public'] . "', " .
//                    "document1='" . $rowData['document1'] . "',document1Blob='" . $rowData['document1Blob'] . "', " .
//                    "document2='" . $rowData['document2'] . "',document2Blob='" . $rowData['document2Blob'] . "', " .
//                    "document3='" . $rowData['document3'] . "',document3Blob='" . $rowData['document3Blob'] . "', " .
//                    "document4='" . $rowData['document4'] . "',document4Blob='" . $rowData['document4Blob'] . "', " .
//                    "dateAutor='" . $rowData['dateAutor'] . "',idAutor='" . $rowData['idAutor'] . "', " .
//                    (($rowData['dateDiretor'] != '') ? "dateDiretor='" . $rowData['dateDiretor'] . "',idDiretor='" . $rowData['idDiretor'] . "', " : "") .
//                    (($rowData['datePedagogico'] != '') ? "datePedagogico='" . $rowData['datePedagogico'] . "',idPedagogico='" . $rowData['idPedagogico'] . "', " : "") .
//                    (($rowData['dateExecutiva'] != '') ? "dateExecutiva='" . $rowData['dateExecutiva'] . "',idExecutiva='" . $rowData['idExecutiva'] . "', " : "") .
//                    "observations='" . $rowData['observations'] . "' " .
                " WHERE idDocuments=".$data['idDocuments']." AND idModules=".$idModules." AND idCourse=".$idCourse." ";
            $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
            if ($rowModulesData['type'] == 'novo' || $rowModulesData['type'] == 'extra'
                || $rowModulesData['type'] == 'proposto') {
                $type   = ($rowModulesData['type'] == 'novo' ? 'base' : 'extra');
                $query  = "UPDATE courses_modules SET idModules=".$newModuleId." WHERE idModules=".$idModules." AND idCourses=".$data['idCourses']." AND idCourse=".$idCourse." ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $query  = "UPDATE courses_documents SET idModules=".$newModuleId." WHERE idModules=".$idModules." AND idCourses=".$data['idCourses']." AND idCourse=".$idCourse." ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
                $query  = "UPDATE documents SET idModules=".$newModuleId." WHERE idModules=".$idModules." AND idCourse=".$data['idCourses']." AND status='Fechado' ";
                $result = $con->set($query);
                if (!$result) {
                    $result = $con->set('ROLLBACK');
                    return ['success' => false, 'message' => 'Não ficou aprovado.'];
                }
            }
            $query  = "UPDATE courses_documents SET idDocuments=".$newId." WHERE idDocuments=".$data['idDocuments']." AND idCourses=".$data['idCourses']." AND idCourse=".$idCourse." ";
            $result = $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
        } else if ($resultado['type'] == 'Diretor') {
            $query  = "UPDATE courses_documents SET status='Pendente', dateDiretor='".date("Y-m-d H:i:s")."' ,idDiretor=".$_SESSION['users']->idUsers.
                " WHERE idCourses=".$data['idCourses']." AND idDocuments=".$data['idDocuments']." ";
            $result = $result = $con->set($query);
            if (!$result) {
                $result = $con->set('ROLLBACK');
                return ['success' => false, 'message' => 'Não ficou aprovado.'];
            }
        }
        $result = $con->set('COMMIT');
        return ['success' => true, 'message' => 'Aprovado.'];
    }

    public static function distribuirAvaliacoesFormacoesAvaliacoes($data)
    {
        $con       = new Database();
        $query     = "SELECT c.idCourse,e.idEvaluations,e.name,e.target ".
            "FROM courses c ".
            "INNER JOIN evaluations e ON c.idCourse=e.idCourse ".
            "WHERE c.idCourses=".$data['idCourses']." AND target IN ('Formador','Formando','Curso') AND e.status='Ativo' ORDER BY target";
        $resultado = $con->get($query);

        foreach ($resultado as $teste) {
            $idCourse      = $teste['idCourse'];
            $idEvaluations = $teste['idEvaluations'];
            $name          = $teste['name'];
            $target        = $teste['target'];

            $query        = "SELECT uc.idUsers ".
                ($target == 'Formando' ? "FROM users_courses uc " : "FROM courses_team uc ").
                "WHERE uc.idCourses=".$data['idCourses']." ".
                ($target == 'Curso' ? "AND uc.type='Diretor' " : " " ).
                "AND uc.idUsers NOT IN (SELECT idUsers FROM courses_evaluations WHERE idCourses=".$data['idCourses'].")";
            $utilizadores = $con->get($query);
            foreach ($utilizadores as $utilizador) {
                $query  = "INSERT IGNORE INTO courses_evaluations ".
                    "(idEvaluations,idUsers,idCourses,".
                    "idCourse,name,status) ".
                    "VALUES (".$idEvaluations.",".
                    $utilizador['idUsers'].",".$data['idCourses'].",".
                    $idCourse.",'".$name." - ".$target."','Aberto')";
                $result = $con->set($query);
                if (!$result) {
                    return ['success' => false, 'message' => 'Não foi distribuido.'];
                }
            }
        }
        return ['success' => true, 'message' => 'Distribuido com sucesso.'];
    }

    public static function getFormacoesInformacoes($data)
    {
        $query     = "SELECT * FROM (SELECT ci.*,RIGHT(document, LOCATE('.', REVERSE(document))-1) as ext FROM courses_informations ci WHERE idCourses=".$data['idCourses'].") as t ".
            (key_exists('search', $data) ? "WHERE name LIKE '%".$data['search']."%' ".
            "OR document LIKE '%".$data['search']."%' ".
            "OR status LIKE '%".$data['search']."%'" : "");
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    public static function apagarFormacoesInformacoes($data)
    {
        $query     = "DELETE FROM courses_informations WHERE idCourses=".$data['idCourses']." AND idInformations=".$data['idInformations'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não ficou apagado.'];
        }
        return ['success' => true, 'message' => 'Foi apagado.'];
    }

    public static function avaliacaoInscritos($data)
    {
        $query = "UPDATE users_courses SET ";
        if ($data['task'] == 'participou') {
            $query .= " attended='on' ";
        } elseif ($data['task'] == 'passouCurso') {
            $query .= " attended='on', passedCourse='on' ";
        } elseif ($data['task'] == 'passouEstagio') {
            $query .= " attended='on', passedCourse='on', passedInternship='on' ";
        } elseif ($data['task'] == 'passouEtapa') {
            $query .= " attended='on', passedCourse='on',passed='on' ";
        } else {
            $query .= " attended=null, passedCourse=null, passedInternship=null,passed=null ";
        }
        $query     .= " WHERE idCourses=".$data['idCourses']." AND idUsers=".$data['idUsers'];
        $con       = new Database();
        $resultado = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Estado não foi alterado.'];
        }
        return ['success' => true, 'message' => 'estado alterado.'];
    }
}
