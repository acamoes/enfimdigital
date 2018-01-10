<?php

class Formandos {
    public $idCourses;
    public $tabs;
    public $idCourse;
    public $course;
    public $documents;
    public $informations;
    public $evaluations;

    function __construct($data) {
        $this->getTabs();
        $this->idCourses = $data['idCourses'];
        $this->getCourse($this->idCourses);
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":[{"text":"Informações","tab":"informacoes"},{"text":"Arquivo","tab":"arquivo"},{"text":"Avaliação","tab":"avaliacao"} ]}');
    }

    function getCourse($id) {
        $query        = "SELECT * FROM courses c INNER JOIN users_courses uc ON c.idCourses=uc.idCourses WHERE uc.idCourses=" . $id . " AND uc.idUsers=" . $_SESSION['users']->id . " ";
        $con          = new Database ();
        $this->course = $con->get($query);
        if (!$this->course) {
            return false;
        }
        $this->idCourse  = $this->course[0]['idCourse'];
        $query           = "SELECT * FROM courses_documents WHERE idCourses=" . $id . " AND status='Fechado' AND public='Sim' ";
        $this->documents = $con->get($query);

        $query              = "SELECT * FROM courses_informations WHERE idCourses=" . $id . " AND status='Ativo' ORDER BY date DESC";
        $this->informations = $con->get($query);

        $query             = "SELECT * FROM courses_evaluations WHERE idCourses=" . $id . " AND idUsers=" . $_SESSION['users']->id . " AND status IN ('Aberto','Fechado') ";
        $this->evaluations = $con->get($query);
        return true;
    }

    function buildEvaluation($id) {
        $query            = "SELECT e.idEvaluations,e.idCourse,ce.idCourses,ce.idEvaluations as idEvaluation,e.template,ce.evaluation,ce.status "
                . "FROM evaluations e INNER JOIN courses_evaluations ce ON e.idCourse=ce.idCourse AND e.status='Ativo' "
                . "WHERE ce.idUsers=" . $_SESSION['users']->id
                . " AND ce.status='Aberto' "
                . " AND ce.idEvaluations=" . $id['idEvaluation']
                . " AND e.idCourse=" . $this->idCourse
                . " AND ce.idCourses=" . $this->idCourses
                . " ";
        $con              = new Database ();
        $this->evaluation = $con->get($query);
        if (!$this->evaluation) {
            return false;
        }
        else {
            $evaluationForm = new Evaluation($this->evaluation[0]);
            return $evaluationForm;
        }
    }
}