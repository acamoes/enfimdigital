<?php

class Formadores {

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
        $this->tabs = json_decode('{"tabs":['
                . '{"text":"Informações","tab":"informacoes"},'
                . '{"text":"Inscritos","tab":"inscritos"},'
                . '{"text":"Sessões","tab":"sessoes"},'
                . '{"text":"Ficheiros","tab":"ficheiros"},'
                . '{"text":"Documentos","tab":"documentos"},'
                . '{"text":"Avaliações","tab":"avaliacaoFormandos"},'
                . '{"text":"Formadores","tab":"avaliacaoFormandores"}'
                . ' ]}');
    }

    function getCourse($id) {
        $query = "SELECT * FROM courses c INNER JOIN courses_team ct ON c.idCourses=ct.idCourses WHERE ct.idCourses=" . $id . " AND ct.idUsers=" . $_SESSION['users']->id . " ";
        $con = new enfim_db ();
        $this->course = $con->get($query);
        if (!$this->course) {
            return false;
        }

        $query = "SELECT * FROM courses_documents WHERE idCourses=" . $id . " AND status='Fechado' ";
        $this->documents = $con->get($query);

        $query = "SELECT * FROM courses_informations WHERE idCourses=" . $id . " AND status='Ativo' ";
        $this->informations = $con->get($query);

        $query = "SELECT * FROM courses_evaluations WHERE idCourses=" . $id . " AND idUsers=" . $_SESSION['users']->id . " AND status IN ('Ativo','Fechado') ";
        $this->evaluations = $con->get($query);
        return true;
    }

}
