<?php

/**
 * Description of enfim_db
 *
 * @author João Madeira
 */
class enfim_db {

    public $connection;
    public $error;

    function __construct() {
        try {
            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        } catch (mysqli_sql_exception $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
        $this->connection->select_db(DB_NAME);
    }

    public function safeQuery($string) {
        return is_null($string) ? '' : $this->connection->real_escape_string($string);
    }

    public function get($sql, $resultType = MYSQLI_ASSOC) {
        //$sql = $this->safeQuery($sql);
        $result = $this->connection->query($sql);
        return $this->fetch_all($result, $resultType);
    }

    public function set($sql) {
        //$sql = $this->safeQuery($sql);
        $result = $this->connection->query($sql);
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }

    public function fetch_all($result, $resultType) {//MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH
        if (is_null($result) || !$result) {
            return false;
        }
        for ($res = array(); $tmp = $result->fetch_array($resultType);) {
            $res[] = $tmp;
        }
        return $res;
    }

}
