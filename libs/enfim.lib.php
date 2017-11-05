<?php

class Enfim {

    // database object
    var $db = null;
    // smarty template object
    var $tpl = null;
    // error messages
    var $error = null;

    /**
     * class constructor
     */
    function __construct() {
        $this->db = new enfim_db();
        $this->tpl = new Enfim_Smarty;
    }

    function getEntries() {
        try {
            foreach ($this->db->query("select * from users") as $row) {
                $rows[] = $row;
            }
        } catch (mysqli_sql_exception $e) {
            print "Error!: " . $e->getMessage();
            return false;
        }
        return $rows;
    }

    function login() {
        $this->tpl->assign('error','');
        $this->tpl->display('enfim_login.tpl');
    }

    function authentication($post) {
        $data = $this->safePost($post);
        $users=new Users();
        if($users->login($data['username'],$data['password']))
        {
            $_SESSION['users']=$users;
            $this->tpl->assign('users',$_SESSION['users']);
            $this->tpl->display('enfim_home.tpl');
        }
        else
        {
            session_destroy();
            $this->tpl->assign('error',$users->error);
            $this->tpl->display('enfim_login.tpl');
        }
    }

    function safePost($post) {
        foreach ($post as $k => $v) {
            $post[$k] = stripslashes(htmlentities($this->db->connection->real_escape_string(strip_tags($v))));
        }
        return $post;
    }

}
