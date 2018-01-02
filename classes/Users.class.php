<?php

class Users {

    public $id;
    public $username;
    public $email;
    public $name;
    public $sigla;
    public $permission;
    public $status = "Inactive";
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

    function login($user, $pass) {
        $query = "SELECT * FROM users WHERE password=MD5('$pass') AND username='$user' AND status='Ativo'";
        $con = new enfim_db ();
        $rows = $con->get($query);
        if (count($rows) > 0) {
            $rows = $rows[0];
            $this->username = $user;
            $this->password = $pass;
            $this->id = $rows ['idUsers'];
            $this->username = $rows ['username'];
            $this->email = $rows ['email'];
            $this->name = $rows ['name'];
            $this->sigla = $rows ['sigla'];
            $this->permission = $rows ['permission'];
            $this->status = $rows ['status'];
            $this->lastLogin = date("Y-m-d H:i:s");
            $this->lastLogin();
            $this->birthDate = $rows ['birthDate'];
            $this->address = $rows ['address'];
            $this->zipCode = $rows ['zipCode'];
            $this->local = $rows ['local'];
            $this->mobile = $rows ['mobile'];
            $this->telephone = $rows ['telephone'];
            $this->observations = $rows ['observations'];
            $this->iban = $rows ['iban'];
            $this->aepId = $rows ['aepId'];
            $this->getMyAgendaIds();
            return true;
        } else {
            $this->error = "Username or Password is invalid";
            return false;
        }
    }

    function lastLogin() {
        $query = "UPDATE users SET lastLogin='$this->lastLogin' WHERE idUsers='$this->id'";
        $con = new enfim_db ();
        $con->set($query);
    }

    function getMyAgendaIds() {
        $query = "SELECT ct.idCourses as ctIdCourses,ct.type " .
                "FROM courses_team ct INNER JOIN courses cs ON ct.idCourses=cs.idCourses " .
                "AND ct.idUsers=$this->id INNER JOIN course c ON cs.idCourse=c.idCourse " .
                "WHERE cs.status NOT IN ('Cancelado') AND c.status='Ativo' " .
                "ORDER BY cs.startDate ASC";
        $con = new enfim_db ();
        $this->agenda = $con->get($query);
        return true;
    }

    function getMyAgenda() {
        $query = "SELECT ct.idCourses as ctIdCourses,ct.idUsers as ctIdUsers,ct.type as ctType," .
                "cs.idCourses as csIdCourses,cs.year as csYear,cs.course as csCourse,cs.completeName as csCompleteName," .
                "DATE_SUB(cs.startDate, INTERVAL 30 DAY) as limitDate,cs.startDate as csStartDate,cs.endDate as csEndDate," .
                "cs.local as csLocal,cs.vacancy as csVacancy,cs.idCourse as csIdCourse,cs.internship as csInternship,cs.status as csStatus,cs.observations as csObservations," .
                "c.idCourse as cIdCourse,c.name as cIdName,c.level as cLevel,c.internship as cInternship,c.status as cStatus " .
                "FROM courses_team ct INNER JOIN courses cs ON ct.idCourses=cs.idCourses " .
                "AND ct.idUsers=$this->id INNER JOIN course c ON cs.idCourse=c.idCourse " .
                "WHERE cs.status NOT IN ('Fechado','Cancelado') AND c.status='Ativo' " .
                "ORDER BY cs.startDate ASC";
        $con = new enfim_db ();
        $this->myAgenda = $con->get($query);
        return true;
    }

    function getMyCourses() {
        $query = "SELECT uc.idUsers as ucIdUsers, uc.idCourses as ucIdCourses, uc.unit as ucUnit, uc.unitType as ucUnitType, uc.rank as ucRank, uc.boRank as ucBoRank, uc.qa as ucQa, " .
                "uc.value as ucValue,uc.receipt as ucReceipt,uc.observations as ucObervations,uc.attended as ucAttended,uc.passedCourse as ucPassedCourse, " .
                "uc.passedInternship as ucPassedInternship,uc.passed as ucPassed,uc.boCourse as ucBoCourse," .
                "cs.idCourses as csIdCourses,cs.year as csYear,cs.course as csCourse,cs.completeName as csCompleteName,cs.startDate as csStartDate,cs.endDate as csEndDate,cs.local as csLocal," .
                "cs.vacancy as csVacancy,cs.idCourse as csIdCourse,cs.internship as csInternship,cs.status as csStatus,cs.observations as csObservations," .
                "c.idCourse as cIdCourse,c.name as cName,c.level as cLevel,c.internship as cInternship,c.status as cStatus " .
                "FROM users_courses uc INNER JOIN courses cs ON uc.idCourses=cs.idCourses " .
                "AND uc.idUsers=$this->id INNER JOIN course c ON cs.idCourse=c.idCourse " .
                // "WHERE (cs.status='Em espera' OR uc.attended='Sim') AND c.status='ativo' ".
                "ORDER BY cs.startDate DESC";
        $con = new enfim_db ();
        $this->myCourses = $con->get($query);
        return true;
    }

    /*
      function director($idCourse) {
      if (count($this->myAgenda) > 0) {
      for ($i = 0; $i < count($this->myAgenda); $i++) {
      if ($this->myAgenda[$i]['ctIdCourses'] == $idCourse && $this->myAgenda[$i]['type'] == 'Diretor') {
      return true;
      }
      }
      }
      return false;
      }

      function formador($idCourse) {
      if (count($this->myAgenda) > 0) {
      for ($i = 0; $i < count($this->myAgenda); $i++) {
      if ($this->myAgenda[$i]['ctIdCourses'] == $idCourse && $this->myAgenda[$i]['type'] == 'Formador') {
      return true;
      }
      }
      }
      return false;
      }

      function getStatus() {
      $query = "SELECT status FROM users WHERE idUsers='$this->id'";
      $con = new Connection ();
      $con->connect();
      $result = $con->connection->query($query);
      $rows = $result->fetch_row();
      return $rows [0];
      }



      function getUsers($search) {
      $query = "SELECT * FROM users WHERE " .
      "username like '%" . $search . "%' OR " .
      "name like '%" . $search . "%' OR " .
      "permission like '%" . $search . "%' OR " .
      "aepId like '%" . $search . "%' OR " .
      "status like '%" . $search . "%' OR " .
      "mobile like '%" . $search . "%' " .
      "ORDER BY status,permission,name ";
      $con = new Connection ();
      $con->connect();
      $result = $con->connection->query($query);
      if (!$result) {
      return true;
      } else {
      return $result->fetch_all(MYSQLI_ASSOC);
      }
      }

      function getUser($id) {
      $query = "SELECT * FROM users WHERE idUsers=" . $id;
      $con = new Connection ();
      $con->connect();
      $result = $con->connection->query($query);
      return $result->fetch_all(MYSQLI_ASSOC);
      }

      function getUsersHtml($post) {
      $search = "";
      if (is_array($post)) {
      if (key_exists('searchUtilizadores', $post)) {
      $search = $post ["searchUtilizadores"];
      }
      }
      ?>
      <div class="table-wrapper">
      <ul style="float: left">
      <form id="formSearchUtilizadores"
      onSubmit="post('user_getUsersHtml', this, 'TUtilizadores');return false;"
      method="post" style="margin: 0 0 1em 0">
      <input type="text" name="searchUtilizadores" id="searchUtilizadores"
      style="height: 2em; padding: 0 0; display: inline-block;" /><a
      class="button small icon fa-search"
      style="box-shadow: -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); cursor: pointer; padding: 0 0 0 5pt"
      onclick="if (document.getElementById('searchUtilizadores').value != '') {
      document.getElementById('formSearchUtilizadores').onsubmit.call(document.getElementById('formSearchUtilizadores'));
      }"></a>
      </form>
      </ul>
      <ul class="actions" onclick="vRequest('user_novo', 'form');"
      style="float: right">
      <li class="button small"
      style="cursor: pointer; padding: 0 10pt 0 10pt">novo</li>
      </ul>
      <table>
      <thead>
      <tr>
      <th>NrAssoc</th>
      <th>Nome</th>
      <th>Tipo</th>
      <th>Estado</th>
      <th>Contato</th>
      <th>Idade</th>
      <th>IBAN</th>
      <th></th>
      </tr>
      </thead>
      <?php
      $usersList = $this->getUsers($search);
      if (is_array($usersList)) {
      for ($i = 0; $i < count($usersList); $i ++) {
      ?>
      <tbody>
      <tr>
      <td><?= $usersList[$i]['aepId'] ?></td>
      <td><?= $usersList[$i]['name'] ?></td>
      <td><?= $usersList[$i]['permission'] ?></td>
      <td><?= $usersList[$i]['status'] ?></td>
      <td>M:<?= $usersList[$i]['mobile'] ?>&nbsp;T:<?= $usersList[$i]['telephone'] ?></td>
      <td><?= date_diff(new DateTime($usersList[$i]['birthDate']), new DateTime('NOW'))->format('%y') ?></td>
      <td><?= $usersList[$i]['iban'] ?></td>
      <td class="actions" align="right"><a
      class="button small icon fa-file"
      style="cursor: pointer; padding: 0 0 0 5pt"
      onclick="vRequest('user_ver_<?= $usersList[$i]['idUsers'] ?>', 'form');"></a>
      <a class="button small icon fa-edit"
      style="cursor: pointer; padding: 0 0 0 5pt"
      onclick="vRequest('user_editar_<?= $usersList[$i]['idUsers'] ?>', 'form');"></a>
      <a class="button small icon fa-eraser"
      style="cursor: pointer; padding: 0 0 0 5pt"
      onclick="if (confirm('Tem a certeza que pretende remover?')) {
      vRequest('user_delete_<?= $usersList[$i]['idUsers'] ?>_<?= $usersList[$i]['status'] ?>', 'executivaMsg');
      vRequest('user_getUsersHtml', 'TUtilizadores');
      }"></a></td>
      </tr>
      </tbody>
      <?php }
      } ?>
      </table>
      </div>
      <?php
      return null;
      }

      function novo($post) {
      ?>
      <section id="wrapper" style="width: 700px;">
      <section id="one" class="wrapper spotlight left style2"
      style="border-radius: 5px; width: 100%;">
      <div class="inner">
      <div class="content">
      <section>
      <form method="post"
      onSubmit="post('user_insert', this, 'formMsg');return false;">
      <div class="row uniform" style="padding-top: 1.75em">
      <div style="float: right">
      <label style="float: right; cursor: pointer"
      onclick="getElementById('form').innerHTML = '';vRequest('user_getUsersHtml', 'TUtilizadores');">X
      Close</label>
      </div>
      </div>
      <div class="row uniform">
      <div id="formMsg"></div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="username">Username</label><input required
      type="text" name="username" id="username" style="width: 200px"
      pattern="[a-z0-9._%+-]{6,}$" />
      </div>
      <div style="float: right">
      <label for="email">Email</label><input required type="text"
      name="email" id="email" style="width: 350px"
      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="sigla">Sigla</label><input type="text" name="sigla"
      id="sigla" maxlength="3" style="width: 100px"
      pattern="[A-Z]{2,3}$" />
      </div>
      <div style="float: right">
      <label for="name">Nome</label><input required type="text"
      name="name" id="name" style="width: 400px" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="permission">Nível</label> <select name="permission"
      id="permission" style="width: 200px">
      <option value="Equipa Executiva">Equipa Executiva</option>
      <option value="Serviços Centrais">Serviços Centrais</option>
      <option value="Formador">Formador</option>
      <option value="Formando">Formando</option>
      </select>
      </div>
      <div style="float: right">
      <label for="status">Estado</label> <input type="radio"
      id="ativo" name="status" value="Ativo" checked=""><label
      for="ativo">Ativo</label> <input type="radio" id="inativo"
      name="status" value="Inativo"><label for="inativo">Inativo</label>
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="birthDate">Nascimento</label><input type="text"
      name="birthDate" id="birthDate" maxlength="10"
      style="width: 150px" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />
      </div>
      <div style="float: right">
      <label for="aepId">NrAssoc</label><input required type="text"
      name="aepId" id="aepId" maxlength="6" style="width: 150px"
      pattern="[0-9]{5,}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="address">Morada</label><input type="text"
      name="address" id="address" style="width: 400px" />
      </div>
      <div style="float: right">
      <label for="mobile">Telemóvel</label><input type="text"
      name="mobile" id="mobile" maxlength="9" style="width: 150px"
      pattern="[0-9]{9}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="zipCode">Código Postal</label> <input required
      type="text" name="zipCode" id="zipCode" style="width: 300px"
      pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />
      </div>
      <div style="float: right">
      <label for="telephone">Telefone</label><input type="text"
      name="telephone" id="telephone" maxlength="9"
      style="width: 150px" pattern="[0-9]{9}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="iban">IBAN</label><input type="text" name="iban"
      id="iban" maxlength="25" style="width: 630px"
      pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="observations">Observações</label>
      <textarea cols="5" rows="3" name="observations"
      id="observations" style="width: 630px"></textarea>
      </div>
      </div>
      <div class="row uniform">
      <div style="float: right;">
      <input type="submit" name="submit" value="Submit" />
      </div>
      </div>
      </form>
      </section>
      </div>
      </div>
      </section>
      </section>
      <?php
      }

      function ver($post) {
      $func = explode("_", $post ['action']);
      $row = $this->getUser($func [2]);
      $row = $row [0];
      ?>
      <section id="wrapper" style="width: 700px;">
      <section id="one" class="wrapper spotlight left style2"
      style="border-radius: 5px; width: 100%;">
      <div class="inner">
      <div class="content">
      <section>
      <div class="row uniform" style="padding-top: 1.75em">
      <div style="float: right">
      <label style="float: right; cursor: pointer"
      onclick="getElementById('form').innerHTML = '';
      vRequest('user_getUsersHtml', 'TUtilizadores');">X
      Close</label>
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="username">Username</label><input value="<?= $row['username'] ?>"
      readonly required type="text" name="username" id="username"
      style="width: 200px" pattern="[a-z0-9._%+-]{6,}$" />
      </div>
      <div style="float: right">
      <label for="email">Email</label><input value="<?= $row['email'] ?>"
      readonly required type="text" name="email" id="email"
      style="width: 350px"
      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="sigla">Sigla</label><input value="<?= $row['sigla'] ?>"
      readonly type="text" name="sigla" id="sigla" maxlength="3"
      style="width: 100px" pattern="[A-Z]{2,3}$" />
      </div>
      <div style="float: right">
      <label for="name">Nome</label><input value="<?= $row['name'] ?>"
      readonly required type="text" name="name" id="name"
      style="width: 400px" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="permission">Nível</label><input value="<?= $row['permission'] ?>"
      readonly required type="text" name="permission" id="permission"
      style="width: 200px" />
      </div>
      <div style="float: right">
      <label for="status">Estado</label><input value="<?= $row['status'] ?>"
      readonly required type="text" name="status" id="status"
      style="width: 200px" />
      </div>
      </div>

      <div class="row uniform">
      <div style="float: left">
      <label for="birthDate">Nascimento</label><input
      value="<?= $row['birthDate'] ?>" readonly type="text" name="birthDate"
      id="birthDate" maxlength="10" style="width: 150px"
      pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />
      </div>
      <div style="float: right">
      <label for="aepId">NrAssoc</label><input value="<?= $row['aepId'] ?>"
      readonly required type="text" name="aepId" id="aepId"
      maxlength="6" style="width: 150px" pattern="[0-9]{5,}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="address">Morada</label><input value="<?= $row['address'] ?>"
      readonly type="text" name="address" id="address"
      style="width: 400px" />
      </div>
      <div style="float: right">
      <label for="mobile">Telemóvel</label><input value="<?= $row['mobile'] ?>"
      readonly type="text" name="mobile" id="mobile" maxlength="9"
      style="width: 150px" pattern="[0-9]{9}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="zipCode">Código Postal</label><input
      value="<?= $row['zipCode'] . " " . $row['local'] ?>" readonly required type="text"
      name="zipCode" id="zipCode" style="width: 300px"
      pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />
      </div>
      <div style="float: right">
      <label for="telephone">Telefone</label><input
      value="<?= $row['telephone'] ?>" readonly type="text" name="telephone"
      id="telephone" maxlength="9" style="width: 150px"
      pattern="[0-9]{9}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="iban">IBAN</label><input value="<?= $row['iban'] ?>"
      readonly type="text" name="iban" id="iban" maxlength="25"
      style="width: 630px" pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="observations">Observações</label>
      <textarea readonly cols="5" rows="3" name="observations"
      id="observations" style="width: 630px"><?= $row['observations'] ?></textarea>
      </div>
      </div>
      </section>
      </div>
      </div>
      </section>
      </section>
      <?php
      return;
      }

      function editar($post) {
      $func = explode("_", $post ['action']);
      $row = $this->getUser($func [2]);
      $row = $row [0];
      ?>
      <section id="wrapper" style="width: 700px;">
      <section id="one" class="wrapper spotlight left style2"
      style="border-radius: 5px; width: 100%;">
      <div class="inner">
      <div class="content">
      <section>
      <form method="post"
      onSubmit="post('user_edit', this, 'formMsg');
      return false;">
      <div class="row uniform" style="padding-top: 1.75em">
      <div style="float: right">
      <label style="float: right; cursor: pointer"
      onclick="getElementById('form').innerHTML = '';vRequest('user_getUsersHtml', 'TUtilizadores');">X
      Close</label>
      </div>
      </div>
      <div class="row uniform">
      <div id="formMsg"></div>
      <input value="<?= $row['idUsers'] ?>" type="hidden" name="idUsers"
      id="idUsers" />
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="username">Username</label><input
      value="<?= $row['username'] ?>" required type="text" name="username"
      id="username" style="width: 200px" pattern="[a-z0-9._%+-]{6,}$" />
      </div>
      <div style="float: right">
      <label for="email">Email</label><input value="<?= $row['email'] ?>"
      required type="text" name="email" id="email"
      style="width: 350px"
      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="sigla">Sigla</label><input value="<?= $row['sigla'] ?>"
      type="text" name="sigla" id="sigla" maxlength="3"
      style="width: 100px" pattern="[A-Z]{2,3}$" />
      </div>
      <div style="float: right">
      <label for="name">Nome</label><input value="<?= $row['name'] ?>"
      required type="text" name="name" id="name" style="width: 400px" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="permission">Nível</label> <select name="permission"
      id="permission" style="width: 200px">
      <option value="Equipa Executiva"
      <?= ($row['permission'] == "Equipa Executiva") ? "selected" : ""; ?>>Equipa
      Executiva</option>
      <option value="Serviços Centrais"
      <?= ($row['permission'] == "Serviços Centrais") ? "selected" : ""; ?>>Serviços
      Centrais</option>
      <option value="Formador"
      <?= ($row['permission'] == "Formador") ? "selected" : ""; ?>>Formador</option>
      <option value="Formando"
      <?= ($row['permission'] == "Formando") ? "selected" : ""; ?>>Formando</option>
      </select>
      </div>
      <div style="float: right">
      <label for="status">Estado</label> <input type="radio"
      id="ativo" name="status" value="Ativo"
      <?= ($row['status'] == "Ativo") ? "checked" : ""; ?>><label for="ativo">Ativo</label>
      <input type="radio" id="inativo" name="status" value="Inativo"
      <?= ($row['status'] == "Inativo") ? "checked" : ""; ?>><label for="inativo">Inativo</label>
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="birthDate">Nascimento</label><input
      value="<?= $row['birthDate'] ?>" type="text" name="birthDate"
      id="birthDate" maxlength="10" style="width: 150px"
      pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />
      </div>
      <div style="float: right">
      <label for="aepId">NrAssoc</label><input value="<?= $row['aepId'] ?>"
      required type="text" name="aepId" id="aepId" maxlength="6"
      style="width: 150px" pattern="[0-9]{5,}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="address">Morada</label><input value="<?= $row['address'] ?>"
      type="text" name="address" id="address" style="width: 400px" />
      </div>
      <div style="float: right">
      <label for="mobile">Telemóvel</label><input
      value="<?= $row['mobile'] ?>" type="text" name="mobile" id="mobile"
      maxlength="9" style="width: 150px" pattern="[0-9]{9}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="zipCode">Código Postal</label> <input
      value="<?= $row['zipCode'] . " " . $row['local'] ?>" required type="text"
      name="zipCode" id="zipCode" style="width: 300px"
      pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />
      </div>
      <div style="float: right">
      <label for="telephone">Telefone</label><input
      value="<?= $row['telephone'] ?>" type="text" name="telephone"
      id="telephone" maxlength="9" style="width: 150px"
      pattern="[0-9]{9}$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="iban">IBAN</label><input value="<?= $row['iban'] ?>"
      type="text" name="iban" id="iban" maxlength="25"
      style="width: 630px" pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />
      </div>
      </div>
      <div class="row uniform">
      <div style="float: left">
      <label for="observations">Observações</label>
      <textarea cols="5" rows="3" name="observations"
      id="observations" style="width: 630px"><?= $row['observations'] ?></textarea>
      </div>
      </div>
      <div class="row uniform">
      <div style="float: right;">
      <input type="submit" name="submit" value="Submit" />
      </div>
      </div>
      </form>
      </section>
      </div>
      </div>
      </section>
      </section>
      <?php
      }

      function insert($post) {
      $post ['local'] = substr($post ['zipCode'], 9);
      $post ['zipCode'] = substr($post ['zipCode'], 0, 8);
      $post ['password'] = $this->generatePassword(8);

      $query = "INSERT INTO users " .
      "(username,password,email,name,sigla,permission,status," .
      "birthDate,address,zipCode,local,mobile,telephone,observations,iban,aepId) " .
      "VALUES " .
      "('" . $post ['username'] .
      "',md5('" . $post ['password'] . "'),'" .
      $post ['email'] . "','" .
      $post ['name'] . "','" .
      $post ['sigla'] . "','" .
      $post ['permission'] . "','" .
      $post ['status'] . "'," . "'" .
      ($post ['birthDate'] == '' ? '0000-00-00' : $post ['birthDate']) . "','" .
      $post ['address'] . "','" .
      $post ['zipCode'] . "','" .
      $post ['local'] . "','" .
      $post ['mobile'] . "','" .
      $post ['telephone'] . "','" .
      $post ['observations'] . "'," . "'" .
      $post ['iban'] . "','" .
      $post ['aepId'] . "')";

      $con = new Connection ();
      $con->connect();
      $result = $con->connection->query($query);
      if ($con->connection->error != '') {
      ?>
      <h3 class="alert" title="<?= $con->connection->error ?>"
      style="cursor: help;">Não foi aceite o registo.</h3>
      <?php
      } else {
      ?>
      <h3 class="success" title="<?= $con->connection->error ?>">Registo aceite.</h3>
      <?php
      }
      return;
      }

      function edit($post) {
      $post ['local'] = substr($post ['zipCode'], 9);
      $post ['zipCode'] = substr($post ['zipCode'], 0, 8);
      // $post['password']=$this->generatePassword(8);
      $query = "UPDATE users SET " .
      "username='" . $post ['username'] . "'," .
      "email='" . $post ['email'] . "'," .
      "name='" . $post ['name'] . "'," .
      "sigla='" . $post ['sigla'] . "'," .
      "status='" . $post ['status'] . "'," .
      "birthDate='" . $post ['birthDate'] . "'," .
      "address='" . $post ['address'] . "'," .
      "zipCode='" . $post ['zipCode'] . "'," .
      "local='" . $post ['local'] . "'," .
      "mobile='" . $post ['mobile'] . "'," .
      "telephone='" . $post ['telephone'] . "'," .
      "observations='" . $post ['observations'] . "'," .
      "iban='" . $post ['iban'] . "'," .
      "aepId='" . $post ['aepId'] . "' " .
      "WHERE idUsers=" . $post ['idUsers'];
      $con = new Connection ();
      $con->connect();
      $result = $con->connection->query($query);
      if ($con->connection->error != '') {
      ?>
      <h3 class="alert" title="<?= $con->connection->error ?>"
      style="cursor: help;">Não foi aceite o registo.</h3>
      <?php
      } else {
      ?>
      <h3 class="success" title="<?= $con->connection->error ?>">Registo aceite.</h3>
      <?php
      }
      return;
      }

      function delete($post) {
      $action = explode("_", $post ['action']);
      $query = "UPDATE users SET " .
      "status='" . ($action [3] == 'Ativo' ? 'Inativo' : 'Ativo') . "' " .
      "WHERE idUsers=" . $action [2];
      $con = new Connection ();
      $con->connect();
      $result = $con->connection->query($query);
      if ($con->connection->error != '') {
      ?>
      <h3 class="alert" title="<?= $con->connection->error ?>"
      style="cursor: help;">Não foi aceite o registo.</h3>
      <?php
      } else {
      ?>
      <h3 class="success" title="<?= $con->connection->error ?>">Registo aceite.</h3>
      <?php
      }
      return;
      }
     */

    function generatePassword($length = 8) {
        $password = "";
        $possible = "0123456789bcdfghjkmnpqrstvwxyz";
        $i = 0;
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!strstr($password, $char)) {
                $password .= $char;
                $i ++;
            }
        }
        return $password;
    }

}
