<?php

class Formadores {
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
        $query        = "SELECT * FROM courses c INNER JOIN courses_team ct ON c.idCourses=ct.idCourses WHERE ct.idCourses=" . $id . " AND ct.idUsers=" . $_SESSION['users']->id . " ";
        $con          = new Database ();
        $this->course = $con->get($query);
        if (!$this->course) {
            return false;
        }
        $this->idCourse  = $this->course[0]['idCourse'];
        $query           = "SELECT * FROM courses_documents WHERE idCourses=" . $id . " AND status='Fechado' ";
        $this->documents = $con->get($query);

        $query              = "SELECT * FROM courses_informations WHERE idCourses=" . $id . " AND status='Ativo' ";
        $this->informations = $con->get($query);

        $query             = "SELECT * FROM courses_evaluations WHERE idCourses=" . $id . " AND idUsers=" . $_SESSION['users']->id . " AND status IN ('Ativo','Fechado') ";
        $this->evaluations = $con->get($query);
        return true;
    }

    static function listaFormadores($idCourses) {
        $query = "SELECT u.idUsers,ct.type,u.name FROM courses_team ct INNER JOIN users u ON ct.idUsers=u.idUsers WHERE ct.idCourses=" . $idCourses . " ";
        $con   = new Database ();
        $lista = $con->get($query);
        if (!$lista) {
            return false;
        }
        return $lista;
    }
}