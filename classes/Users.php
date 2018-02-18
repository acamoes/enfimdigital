<?php

class Users
{
    public $idUsers;
    public $username;
    public $email;
    public $name;
    public $sigla;
    public $permission;
    public $diretor;
    public $formador;
    public $status = "Inativo";
    public $lastLogin;
    public $birthDate;
    public $address;
    public $zipCode;
    public $local;
    public $mobile;
    public $telephone;
    public $observations;
    public $iban;
    public $aepId;
    public $agenda;
    public $myAgenda;
    public $myCourses;
    public $error;

    public function __construct()
    {
        
    }

    function login($user, $pass): bool
    {
        $query = "SELECT * FROM users WHERE password=MD5('$pass') AND username='$user' AND status='Ativo'";
        $con   = new Database();
        $rows  = $con->get($query);
        if (count($rows) > 0) {
            $rows               = $rows[0];
            $this->username     = $user;
            $this->password     = $pass;
            $this->idUsers      = $rows ['idUsers'];
            $this->username     = $rows ['username'];
            $this->email        = $rows ['email'];
            $this->name         = $rows ['name'];
            $this->sigla        = $rows ['sigla'];
            $this->permission   = $rows ['permission'];
            $this->diretor      = $this->getDiretor($rows ['idUsers']);
            $this->formador     = $this->getFormador($rows ['idUsers']);
            $this->formando     = $this->getFormando($rows ['idUsers']);
            $this->status       = $rows ['status'];
            $this->lastLogin    = date("Y-m-d H:i:s");
            $this->lastLogin();
            $this->birthDate    = $rows ['birthDate'];
            $this->address      = $rows ['address'];
            $this->zipCode      = $rows ['zipCode'];
            $this->local        = $rows ['local'];
            $this->mobile       = $rows ['mobile'];
            $this->telephone    = $rows ['telephone'];
            $this->observations = $rows ['observations'];
            $this->iban         = $rows ['iban'];
            $this->aepId        = $rows ['aepId'];
            $this->getMyAgendaIds();
            return true;
        } else {
            $this->error = "Username or Password is invalid";
            return false;
        }
    }

    function loadPermissions()
    {
        $this->permission = $this->getPermission($this->idUsers);
        $this->diretor    = $this->getDiretor($this->idUsers);
        $this->formador   = $this->getFormador($this->idUsers);
        $this->formando   = $this->getFormando($this->idUsers);
    }

    function lastLogin()
    {
        $query = "UPDATE users SET lastLogin='$this->lastLogin' WHERE idUsers='$this->idUsers'";
        $con   = new Database();
        $con->set($query);
    }

    function getPermission($idUsers)
    {
        $query     = "SELECT permission FROM users WHERE idUsers=".$idUsers." AND status='Ativo'";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return array();
        }
        return $resultado[0]['permission'];
    }
    
    function getDiretor($idUsers): array
    {
        $query     = "select idCourses from courses_team where idUsers=".$idUsers." and type='Diretor' ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return array();
        }
        $idCourses = array();
        foreach ($resultado as $diretor) {
            $idCourses[] = $diretor['idCourses'];
        }
        return $idCourses;
    }

    function isDiretor($idUsers)
    {
        return in_array($idUsers, array_values($this->diretor));
    }

    function getFormador($idUsers): array
    {
        $query     = "select idCourses from courses_team where idUsers=".$idUsers." and type='Formador' ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return array();
        }
        $idCourses = array();
        foreach ($resultado as $formador) {
            $idCourses[] = $formador['idCourses'];
        }
        return $idCourses;
    }

    function isFormador($idUsers)
    {
        return in_array($idUsers, array_values($this->formador));
    }

    function getFormando($idUsers): array
    {
        $query     = "select idCourses from users_courses where idUsers=".$idUsers." ";
        $con       = new Database();
        $resultado = $con->get($query);
        if (!$resultado) {
            return array();
        }
        $idCourses = array();
        foreach ($resultado as $formando) {
            $idCourses[] = $formando['idCourses'];
        }
        return $idCourses;
    }

    function isFormando($idUsers)
    {
        return in_array($idUsers, array_values($this->formando));
    }

    function userExists($username): bool
    {
        $query  = "SELECT * FROM users WHERE username='".$username."' AND status='Ativo' ";
        $con    = new Database();
        $result = $con->get($query);
        return count($result) > 0 ? true : false;
    }

    function getEmailByUsername($username): string
    {
        $query  = "SELECT email FROM users WHERE username='$username' AND status='Ativo' ";
        $con    = new Database();
        $result = $con->get($query);
        return count($result) > 0 ? $result[0]['email'] : '';
    }
    
    function getUsernameByIdUsers($idUsers): string
    {
        $query  = "SELECT username FROM users WHERE idUsers='$idUsers' AND status='Ativo' ";
        $con    = new Database();
        $result = $con->get($query);
        return count($result) > 0 ? $result[0]['username'] : '';
    }

    function setPasswordByUsername($username, $password)
    {
        $query = "UPDATE users SET password=MD5('$password') WHERE username='$username' AND status='Ativo'";
        $con   = new Database();
        $con->set($query);
    }

    function getMyAgendaIds(): bool
    {
        $query        = "SELECT ct.idCourses as ctIdCourses,ct.type ".
            "FROM courses_team ct INNER JOIN courses cs ON ct.idCourses=cs.idCourses ".
            "AND ct.idUsers=$this->idUsers INNER JOIN course c ON cs.idCourse=c.idCourse ".
            "WHERE cs.status NOT IN ('Cancelado') AND c.status='Ativo' ".
            "ORDER BY cs.startDate ASC";
        $con          = new Database();
        $this->agenda = $con->get($query);
        return true;
    }

    function getMyAgenda(): bool
    {
        $query          = "SELECT ct.idCourses as ctIdCourses,ct.idUsers as ctIdUsers,ct.type as ctType,".
            "cs.idCourses as csIdCourses,cs.year as csYear,cs.course as csCourse,cs.completeName as csCompleteName,".
            "DATE_SUB(cs.startDate, INTERVAL 30 DAY) as limitDate,cs.startDate as csStartDate,cs.endDate as csEndDate,".
            "cs.local as csLocal,cs.vacancy as csVacancy,cs.idCourse as csIdCourse,cs.internship as csInternship,cs.status as csStatus,cs.observations as csObservations,".
            "c.idCourse as cIdCourse,c.name as cIdName,c.level as cLevel,c.internship as cInternship,c.status as cStatus ".
            "FROM courses_team ct INNER JOIN courses cs ON ct.idCourses=cs.idCourses ".
            "AND ct.idUsers=$this->idUsers INNER JOIN course c ON cs.idCourse=c.idCourse ".
            "WHERE cs.status NOT IN ('Fechado','Cancelado') AND c.status='Ativo' ".
            "ORDER BY cs.startDate ASC";
        $con            = new Database();
        $this->myAgenda = $con->get($query);
        return true;
    }

    function getMyCourses(): bool
    {
        $query           = "SELECT uc.idUsers as ucIdUsers, uc.idCourses as ucIdCourses, uc.unit as ucUnit, uc.unitType as ucUnitType, uc.rank as ucRank, uc.boRank as ucBoRank, uc.qa as ucQa, ".
            "uc.value as ucValue,uc.receipt as ucReceipt,uc.observations as ucObervations,uc.attended as ucAttended,uc.passedCourse as ucPassedCourse, ".
            "uc.passedInternship as ucPassedInternship,uc.passed as ucPassed,uc.boCourse as ucBoCourse,".
            "cs.idCourses as csIdCourses,cs.year as csYear,cs.course as csCourse,cs.completeName as csCompleteName,cs.startDate as csStartDate,cs.endDate as csEndDate,cs.local as csLocal,".
            "cs.vacancy as csVacancy,cs.idCourse as csIdCourse,cs.internship as csInternship,cs.status as csStatus,cs.observations as csObservations,".
            "c.idCourse as cIdCourse,c.name as cName,c.level as cLevel,c.internship as cInternship,c.status as cStatus ".
            "FROM users_courses uc INNER JOIN courses cs ON uc.idCourses=cs.idCourses ".
            "AND uc.idUsers=$this->idUsers INNER JOIN course c ON cs.idCourse=c.idCourse ".
            // "WHERE (cs.status='Em espera' OR uc.attended='Sim') AND c.status='ativo' ".
            "ORDER BY cs.startDate DESC";
        $con             = new Database();
        $this->myCourses = $con->get($query);
        return true;
    }

    function generatePassword($length = 8): string
    {
        $password = "";
        $possible = "0123456789bcdfghjkmnpqrstvwxyz";
        $counter  = 0;
        while ($counter < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!strstr($password, $char)) {
                $password .= $char;
                $counter ++;
            }
        }
        return $password;
    }

    function getEAEP($data)
    {
        if ($_SESSION['users']->permission == 'Equipa Executiva' || $_SESSION['users']->permission
            == 'Serviços Centrais') {

            $api    = new Api();
            $result = $api->get('escoteiro', $data['aepId']);
            if (array_key_exists('message', $result)) {
                return '{"success":"false", "message" : "'.$result->message.'"}';
            }
            return $this->mappingEAEP($result, $data);
        } else {
            return '{"success":"false", "message" : "Acesso negado."}';
        }
    }

    function mappingEAEP($utilizador, $data)
    {
        $escoteiro                 = (object) [];
        $escoteiro->message        = "Dados sincronizados com sucesso (".$utilizador->id_associativo.")";
        $escoteiro->username       = str_replace('@escoteiros.pt', '',
            $utilizador->email);
        $escoteiro->aepId          = $utilizador->id_associativo;
        $escoteiro->email          = $utilizador->email;
        $escoteiro->name           = $utilizador->nome_completo;
        $escoteiro->birthDate      = $utilizador->data_nascimento;
        $escoteiro->mobile         = $utilizador->telemovel;
        $escoteiro->telephone      = $utilizador->contacto_emergencia;
        $escoteiro->address        = $utilizador->morada;
        $escoteiro->zipCode        = $utilizador->codigo_postal." ".$utilizador->localidade;
        $escoteiro->nivelEscotista = $utilizador->nivel_escotista;
        $escoteiro->observations   = "Contato de emergencia: ".$utilizador->nome_emergencia." - ".$utilizador->contacto_emergencia.
            PHP_EOL.PHP_EOL."--- Restrições Alimentares ---".PHP_EOL.
            strip_tags($utilizador->rest_alimentar).
            PHP_EOL.PHP_EOL."--- Saúde ---".PHP_EOL.
            $utilizador->tipo_identificacao.": ".$utilizador->bi.PHP_EOL.
            "Número de utente: ".$utilizador->numero_utente."(".$utilizador->sistema_saude.")".PHP_EOL.
            strip_tags($utilizador->rest_saude).
            PHP_EOL.PHP_EOL."--- Outras notas ---".PHP_EOL.
            strip_tags($utilizador->notas).
            PHP_EOL.PHP_EOL."--- Cargos ---".PHP_EOL;
        usort($utilizador->cargos,
            function ($a, $b) {
            return strcmp($a->unit_type, $b->unit_type);
        });
        if (array_key_exists('idCourses', $data)) {
            $formacoes = (!((new Formacoes())->getFormacao($data)) ? false : true);
        } else {
            $formacoes = false;
        }
        $escoteiro->rank      = "";
        $escoteiro->rankSigla = "";
        $escoteiro->unit      = "";
        $escoteiro->unitType  = "";
        $escoteiro->boRank    = "";
        foreach ($utilizador->cargos as $cargo) {
            $escoteiro->observations .= $cargo->unit_type." - ".$cargo->orgao.": (".$cargo->cargo_abreviatura.") ".$cargo->cargo." / ".$cargo->bo.PHP_EOL;
            if ($formacoes) {
                if ($cargo->unit_type == 'Local') {
                    $escoteiro->rank      = $cargo->cargo;
                    $escoteiro->rankSigla = $cargo->cargo_abreviatura;
                    $escoteiro->unit      = $cargo->orgao;
                    $escoteiro->unitType  = $cargo->unit_type;
                    $escoteiro->boRank    = $cargo->bo;
                }
                if ($escoteiro->rank == "" && $cargo->unit_type != 'Local') {
                    $escoteiro->rank      = $cargo->cargo;
                    $escoteiro->rankSigla = $cargo->cargo_abreviatura;
                    $escoteiro->unit      = $cargo->orgao;
                    $escoteiro->unitType  = $cargo->unit_type;
                    $escoteiro->boRank    = $cargo->bo;
                }
            } else {
                $escoteiro->rank      = $cargo->cargo;
                $escoteiro->rankSigla = $cargo->cargo_abreviatura;
                $escoteiro->unit      = $cargo->orgao;
                $escoteiro->unitType  = $cargo->unit_type;
                $escoteiro->boRank    = $cargo->bo;
            }
        }

        $escoteiro->status = ($utilizador->estado == 1 ? 'Ativo' : 'Inativo');

        return json_encode($escoteiro);
    }
    
    function recover($data){
        if ($this->userExists($data['username'])) {
            $email             = $this->getEmailByUsername($data['username']);
            $password          = $this->generatePassword();
            $this->setPasswordByUsername($data['username'], $password);
            $mail              = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth    = true;
            $mail->SMTPSecure  = 'ssl';
            $mail->Host        = 'smtp.gmail.com';
            $mail->Port        = '465';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isHTML();
            $mail->Username    = MAIL_USERNAME;
            $mail->Password    = MAIL_PASSWORD;
            $mail->SetFrom(MAIL_USERNAME);
            $mail->Subject     = 'ENFIM DIGITAL - RECUPERACAO de PASSWORD';
            $mail->Body        = 'ENFIM DIGITAL<br/><br/>Username: <strong>'.$data['username'].'</strong><br/>Nova password: <strong>'.$password.'</strong><br/><br/><a href="https://enfimdigital.escoteiros.pt" target="_blank">clique aqui</a><br/><br/>';
            $mail->AddAddress($email);
            $mail->Send();
            return true;
        }
        else{
            return false;
        }
    }
}
