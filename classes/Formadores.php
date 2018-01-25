<?php

class Formadores {
    public $idCourses;
    public $tabs;
    public $idCourse;
    public $curso;
    public $inscritos;
    public $equipa;
    public $sessoes;
    public $ficheiros;
    public $avaliacoesFormandos;
    public $avaliacoesFormandores;
    public $documentos;

    function __construct($data) {
        $this->getTabs();
        $this->idCourses = $data['idCourses'];
        $this->getCourse($data);
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":['
                . '{"text":"Inscritos","tab":"inscritos"},'
                . '{"text":"Equipa","tab":"equipa"},'
                . '{"text":"Sessões","tab":"sessoes"},'
                . '{"text":"Ficheiros","tab":"ficheiros"},'
                . '{"text":"Informações","tab":"informacoes"},'
                . '{"text":"Avaliações","tab":"avaliacaoFormandos"},'
                . '{"text":"Formadores","tab":"avaliacaoFormadores"},'
                . '{"text":"Documentos","tab":"documentos"}'
                . ' ]}');
    }

    function getCourse($data) {
        $query        = "SELECT c.*,ct.*,cs.completeName,cs.course FROM courses c " .
                "INNER JOIN courses_team ct ON c.idCourses=ct.idCourses " .
                "INNER JOIN courses cs ON cs.idCourses=ct.idCourses " .
                "WHERE ct.idCourses=" . $data['idCourses'] . " AND ct.idUsers=" . $_SESSION['users']->id . " ";
        $con          = new Database ();
        $this->course = $con->get($query);
        if (!$this->course) {
            return false;
        }
        $this->idCourse             = $this->course[0]['idCourse'];
        $this->curso                = $this->course[0]['course'];
        $data['idCourse']           = $this->idCourse;
        $this->inscritos            = Formacoes::getFormacoesInscritos($data);
        $this->equipa               = Formacoes::getEquipa($data);
        $this->sessoes              = Formacoes::getSessoes($data);
        $this->ficheiros            = Formacoes::getFicheiros($data);
        $this->informacoes          = Formacoes::getFormacoesInformacoes($data);
        $this->avaliacoesFormandos  = Formacoes::getFormacoesAvaliacoes($data);
        $this->avaliacoesFormadores = Formacoes::getFormacoesAvaliacoes($data);
        $this->documentos           = Documentos::getDocumentos($data);
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

    function getEvaluation($data) {
        $query = "SELECT * FROM ";
        $con   = new Database ();
        $lista = $con->get($query);
        if (!$lista) {
            return false;
        }
        return $lista;
    }
}