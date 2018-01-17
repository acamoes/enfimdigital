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

    function buildEvaluation($data) {
        $query            = "SELECT e.idEvaluations,e.idCourse,e.target,ce.idCourses,e.template,ce.evaluation,ce.status "
                . "FROM evaluations e INNER JOIN courses_evaluations ce ON e.idCourse=ce.idCourse AND e.status='Ativo' "
                . "WHERE ce.idUsers=" . $_SESSION['users']->id
                . " AND ce.status='Aberto' "
                . " AND e.idEvaluations=" . $data['idEvaluations']
                . " AND e.idCourse=" . $this->idCourse
                . " AND ce.idCourses=" . $this->idCourses
                . " ";
        $con              = new Database ();
        $this->evaluation = $con->get($query);
        if (!$this->evaluation) {
            return false;
        }
        else {
            $evaluation = new Evaluation($this->evaluation[0]);
            return $evaluation->build();
        }
    }

    function saveEvaluation($data) {
        $query            = "SELECT e.idEvaluations,e.idCourse,e.target,ce.idCourses,e.template,ce.evaluation,ce.status "
                . "FROM evaluations e INNER JOIN courses_evaluations ce ON e.idCourse=ce.idCourse AND e.status='Ativo' "
                . "WHERE ce.idUsers=" . $_SESSION['users']->id
                . " AND ce.status='Aberto' "
                . " AND e.idEvaluations=" . $data['idEvaluations']
                . " AND e.idCourse=" . $this->idCourse
                . " AND ce.idCourses=" . $this->idCourses
                . " ";
        $con              = new Database ();
        $this->evaluation = $con->get($query);
        $evaluation       = new Evaluation($this->evaluation[0]);
        $responses        = $evaluation->saveEvaluation($this->evaluation[0]['template'], $data);
        $responsesJson    = json_encode($responses, JSON_UNESCAPED_UNICODE);
        $query            = "UPDATE courses_evaluations SET "
                . "evaluation = '" . $responsesJson . "', "
                . "date = '" . date('Y-m-d H:i:s') . "' "
                . "WHERE idEvaluations = " . $data['idEvaluations']
                . " AND idUsers=" . $_SESSION['users']->id
                . " AND idCourses=" . $this->idCourses
                . " AND idCourse=" . $this->idCourse . " ";
        $result           = $con->set($query);
    }
}