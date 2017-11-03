<?php

class Enfim {

  // database object
  var $db = null;
  // smarty template object
  var $tpl = null;
  // error messages
  var $error = null;

  /* set database settings here! */
  // PDO database type
  var $dbtype = 'mysql';
  // PDO database name
  var $dbname = 'enfim_digital';
  // PDO database host
  var $dbhost = 'localhost';
  // PDO database username
  var $dbuser = 'root';
  // PDO database password
  var $dbpass = 'escoteiros';


  /**
  * class constructor
  */
  function __construct() {

    // instantiate the pdo object
    try {
      $this->db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname, 3306);
    } catch (mysqli_sql_exception $e) {
      print "Error!: " . $e->getMessage();
      die();
    }	

    // instantiate the template object
    $this->tpl = new Enfim_Smarty;

  }

  /**
  * display the guestbook entry form
  *
  * @param array $formvars the form variables
  */
  function displayForm($formvars = array()) {

    // assign the form vars
    $this->tpl->assign('post',$formvars);
    // assign error message
    $this->tpl->assign('error', $this->error);
    $this->tpl->display('enfim_form.tpl');

  }

  /**
  * fix up form data if necessary
  *
  * @param array $formvars the form variables
  */
  function mungeFormData(&$formvars) {

    // trim off excess whitespace
    $formvars['Name'] = trim($formvars['Name']);
    $formvars['Comment'] = trim($formvars['Comment']);

  }

  /**
  * test if form information is valid
  *
  * @param array $formvars the form variables
  */
  function isValidForm($formvars) {

    // reset error message
    $this->error = null;

    // test if "Name" is empty
    if(strlen($formvars['Name']) == 0) {
      $this->error = 'name_empty';
      return false; 
    }

    // test if "Comment" is empty
    if(strlen($formvars['Comment']) == 0) {
      $this->error = 'comment_empty';
      return false; 
    }

    // form passed validation
    return true;
  }

  /**
  * add a new guestbook entry
  *
  * @param array $formvars the form variables
  */
   function addEntry($formvars) {
    try {
      $rh = $this->db->prepare("insert into ENFIM values(0,?,NOW(),?)");
      $rh->execute(array($formvars['Name'],$formvars['Comment']));
    } catch (mysqli_sql_exception $e) {
      print "Error!: " . $e->getMessage();
      return false;
    }
    return true;
  }

  /**
  * get the guestbook entries
  */
  function getEntries() {
    try {
        foreach ($this->db->query("select * from Enfim order by EntryDate DESC") as $row) {
                $rows[] = $row;
            }
        } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      return false;
    } 	
    return $rows;   
  }

  /**
  * display the guestbook
  *
  * @param array $data the guestbook data
  */
  function displayBook($data = array()) {

    $this->tpl->assign('data', $data);
    $this->tpl->display('enfim.tpl');        

  }
}


