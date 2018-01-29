<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilizadores
 *
 * @author João Madeira
 */
class Utilizadores {

    //put your code here
    function __construct() {

    }

    static function apagarUtilizadores($data): array {
        $query     = "UPDATE users SET status=IF(status='Ativo','Inativo','Ativo') WHERE idUsers=" . $data['idUsers'] . " ";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'O registo não foi alterado.'];
        }
        return ['success' => true, 'message' => 'Registo alterado.'];
    }

    static function atualizarUtilizadores($data): array {
        $data ['local']   = substr($data ['zipCode'], 9);
        $data ['zipCode'] = substr($data ['zipCode'], 0, 8);
// $data['password']=$this->generatePassword(8);
        $query            = "UPDATE users SET " .
                "username='" . $data ['username'] . "'," .
                "email='" . $data ['email'] . "'," .
                "name='" . $data ['name'] . "'," .
                "sigla='" . $data ['sigla'] . "'," .
                "status='" . $data ['status'] . "'," .
                "permission='" . $data ['permission'] . "'," .
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
        return ['success' => true, 'message' => 'Registo atualizado.'];
    }

    static function getUtilizador($data) {
        $query     = "SELECT * FROM users WHERE idUsers=" . $data['idUsers'];
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado[0];
    }

    static function getUtilizadores($data) {
        $query     = "SELECT u.*,TIMESTAMPDIFF(YEAR, birthDate, NOW()) as age FROM users u WHERE " .
                "username like '%" . $data['search'] . "%' OR " .
                "name like '%" . $data['search'] . "%' OR " .
                "permission like '%" . $data['search'] . "%' OR " .
                "aepId like '%" . $data['search'] . "%' OR " .
                "status like '%" . $data['search'] . "%' OR " .
                "mobile like '%" . $data['search'] . "%' " .
                "ORDER BY status,permission,name ";
        $con       = new Database ();
        $resultado = $con->get($query);
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    static function inserirUtilizadores($data): array {
        $data ['local']    = substr($data ['zipCode'], 9);
        $data ['zipCode']  = substr($data ['zipCode'], 0, 8);
        $data ['password'] = $_SESSION['users']->generatePassword(8);

        $query     = "INSERT INTO users " .
                "(username,password,email,name,sigla,permission,status," .
                "birthDate,address,zipCode,local,mobile,telephone,observations,iban,aepId) " .
                "VALUES " .
                "('" . $data ['username'] .
                "',md5('" . $data ['password'] . "'),'" .
                $data ['email'] . "','" .
                $data ['name'] . "','" .
                $data ['sigla'] . "','" .
                $data ['permission'] . "','" .
                $data ['status'] . "'," . "'" .
                ($data ['birthDate'] == '' ? '0000-00-00' : $data ['birthDate']) . "','" .
                $data ['address'] . "','" .
                $data ['zipCode'] . "','" .
                $data ['local'] . "','" .
                $data ['mobile'] . "','" .
                $data ['telephone'] . "','" .
                $data ['observations'] . "'," . "'" .
                $data ['iban'] . "','" .
                $data ['aepId'] . "')";
        $con       = new Database ();
        $resultado = $con->set($query);
        if ($con->connection->error != '') {
            return ['success' => false, 'message' => 'Não foi aceite o registo.'];
        }
        return ['success' => true, 'message' => 'Registo aceite.'];
    }
}