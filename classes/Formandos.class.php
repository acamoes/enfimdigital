<?php

class Formandos {
    public $id;
    public $tabs;
    public $idCourse;
    public $course;
    public $documents;
    public $informations;
    public $evaluations;

    function __construct($data) {
        $this->getTabs();
        $this->idCourse = $data['id'];
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":[{"text":"Informações","tab":"informacoes"},{"text":"Arquivo","tab":"arquivo"},{"text":"Avaliação","tab":"avaliacao"} ]}');
    }

    function getCourse($id) {
        $query        = "SELECT * FROM courses c INNER JOIN users_courses uc ON c.idCourses=uc.idCourses WHERE uc.idCourses=" . $id . " AND uc.idUsers=" . $_SESSION['users']->id . " ";
        $con          = new enfim_db ();
        $this->course = $con->get($query);
        if (!$this->course) {
            return false;
        }

        $query           = "SELECT * FROM courses_documents WHERE idCourses=" . $id . " AND status='Fechado' AND public='Sim' ";
        $this->documents = $con->get($query);

        $query              = "SELECT * FROM courses_informations WHERE idCourses=" . $id . " AND status='Ativo' ORDER BY date DESC";
        $this->informations = $con->get($query);

        $query             = "SELECT * FROM courses_evaluations WHERE idCourses=" . $id . " AND idUsers=" . $_SESSION['users']->id . " AND status IN ('Aberto','Fechado') ";
        $this->evaluations = $con->get($query);
        return true;
    }
}