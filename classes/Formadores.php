<?php

class Formadores
{
    public $idCourses;
    public $tabs;
    public $idCourse;
    public $status;
    public $curso;
    public $inscritos;
    public $equipa;
    public $sessoes;
    public $ficheiros;
    public $avaliacoes;
    public $avaliacoesFormandores;
    public $avaliacoesFormandoresStatus = 'Fechado';
    public $documentos;

    public function __construct($data)
    {
        $this->getTabs();
        $this->idCourses = $data['idCourses'];
        $this->getCourse($data);
    }

    function getTabs()
    {
        $this->tabs = json_decode('{"tabs":['
            .'{"text":"Inscritos","tab":"inscritos"},'
            .'{"text":"Equipa","tab":"equipa"},'
            .'{"text":"Sessões","tab":"sessoes"},'
            .'{"text":"Ficheiros","tab":"ficheiros"},'
            .'{"text":"Informações","tab":"informacoes"},'
            .'{"text":"Avaliações","tab":"avaliacoes"},'
            .'{"text":"Formadores","tab":"avaliacaoFormadores"},'
            .'{"text":"Documentos","tab":"documentos"}'
            .' ]}');
    }

    function getCourse($data)
    {
        $query        = "SELECT c.*,ct.*,cs.completeName,cs.course,cs.status as csStatus FROM courses c ".
            "INNER JOIN courses_team ct ON c.idCourses=ct.idCourses ".
            "INNER JOIN courses cs ON cs.idCourses=ct.idCourses ".
            "WHERE ct.idCourses=".$data['idCourses']." AND ct.idUsers=".$_SESSION['users']->idUsers." ";
        $con          = new Database();
        $this->course = $con->get($query);
        if (!$this->course) {
            return false;
        }
        $this->idCourse             = $this->course[0]['idCourse'];
        $this->curso                = $this->course[0]['course'];
        $this->status               = $this->course[0]['csStatus'];
        $data['idCourse']           = $this->idCourse;
        $data['documentosEstado']   = 'Ativo';
        $this->inscritos            = Formacoes::getFormacoesInscritos($data);
        $this->equipa               = Formacoes::getEquipa($data);
        $this->sessoes              = Formacoes::getSessoes($data);
        $this->ficheiros            = Formacoes::getFicheiros($data);
        $this->informacoes          = Formacoes::getFormacoesInformacoes($data);
        $this->avaliacoes           = Formacoes::getFormacoesAvaliacoes($data);
        $this->avaliacoesFormadores = Formacoes::getFormacoesAvaliacoesFormadores($data);
        $this->documentos           = Documentos::getDocumentos($data);
        return true;
    }

    public static function listaFormadores($idCourses)
    {
        $query = "SELECT u.idUsers,ct.type,u.name FROM courses_team ct INNER JOIN users u ON ct.idUsers=u.idUsers WHERE ct.idCourses=".$idCourses." ";
        $con   = new Database();
        $lista = $con->get($query);
        if (!$lista) {
            return false;
        }
        return $lista;
    }

    function getEquipa($data)
    {
        return Formacoes::getFormacoesEquipa($data);
    }

    function getFicheiro($data)
    {
        return Formacoes::getFicheiro($data);
    }

    function getInformacao($data)
    {
        return Formacoes::getInformacao($data);
    }

    function getInscritos($data)
    {
        return Formacoes::getFormacoesInscritos($data);
    }

    function getInscrito($data)
    {
        return Formacoes::getInscrito($data);
    }

    function atualizarInscritos($data)
    {
        return Formacoes::atualizarFormacoesInscritos($data);
    }

    function getSessao($data)
    {
        return Formacoes::getSessao($data);
    }

    function getDocumento($data)
    {
        return Documentos::getDocumento($data);
    }

    function participouInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function passouCursoInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function passouEstagioInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function passouEtapaInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function resetInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function getUtilizadoresSemEquipa($data)
    {
        return Formacoes::getUtlizadoresSemEquipa($data);
    }

    function adicionarEquipa($data)
    {
        return Formacoes::adicionarFormacoesEquipa($data);
    }

    function atualizarEquipa($data)
    {
        return Formacoes::atualizarFormacoesEquipa($data);
    }

    function restaurarSessoes($data)
    {
        return Formacoes::restaurarFormacoesSessoes($data);
    }

    function getSessoes($data)
    {
        return Formacoes::getSessoes($data);
    }

    function inserirSessoes($data)
    {
        return Formacoes::inserirFormacoesSessoes($data);
    }

    function atualizarSessoes($data)
    {
        return Formacoes::inserirFormacoesSessoes($data);
    }

    function apagarSessoes($data)
    {
        return Formacoes::apagarFormacoesSessoes($data);
    }

    function adicionarSessoes($data)
    {
        return Formacoes::adicionarFormacoesSessoes($data);
    }

    function getUtlizadoresEquipa($data)
    {
        return Formacoes::getUtlizadoresEquipa($data);
    }

    function restaurarFicheiros($data)
    {
        return Formacoes::restaurarFormacoesFicheiros($data);
    }

    function getFicheiros($data)
    {
        return Formacoes::getFicheiros($data);
    }

    function getModulos($data)
    {
        return Formacoes::getFormacoesModulos($data);
    }

    function inserirFicheiro($data)
    {
        return Formacoes::inserirFormacoesFicheiro($data);
    }

    function inserirFicheiros($data)
    {
        return Formacoes::inserirFormacoesFicheiros($data);
    }

    function atualizarFicheiros($data)
    {
        return $this->atualizarFicheiro($data);
    }

    function atualizarFicheiro($data)
    {
        return Formacoes::atualizarFormacoesFicheiro($data);
    }

    function apagarFicheiros($data)
    {
        return Formacoes::apagarFormacoesFicheiros($data);
    }

    function aprovarFicheiros($data)
    {
        if ($_SESSION['users']->isDiretor($data['idCourses'])) {
            return Formacoes::aprovarFormacoesFicheiros($data);
        }
        return ['success' => false, 'message' => 'Acesso negado.'];
        ;
    }

    function inserirInformacao($data)
    {//vem do upload.php
        return Formacoes::inserirFormacoesInformacao($data);
    }

    function inserirInformacoes($data)
    {
        return $this->atualizarInformacao($data);
    }

    function atualizarInformacoes($data)
    {
        return $this->atualizarInformacao($data);
    }

    function atualizarInformacao($data)
    {//vem do upload.php
        return Formacoes::atualizarFormacoesInformacao($data);
    }

    function getInformacoes($data)
    {
        return Formacoes::getInformacao($data);
    }

    function apagarInformacoes($data)
    {
        return Formacoes::apagarFormacoesInformacoes($data);
    }

    function distribuirAvaliacoesAvaliacoes($data)
    {
        return Formacoes::distribuirAvaliacoesFormacoesAvaliacoes($data);
    }

    function fecharAvaliacoesAvaliacoes($data)
    {
        return Formacoes::fecharAvaliacoesFormacoesAvaliacoes($data);
    }
    
    function resetPasswordInscritos($data){
        $users=new Users();
        $data['username']=$users->getUsernameByIdUsers($data['idUsers']);
        return ($users->recover($data)?
            ['success' => true, 'message' => 'Renovação com sucesso.']:
            ['success' => false, 'message' => 'Não foi possível renovar.']);
    }

    function buildEvaluation($data)
    {
        $query            = "SELECT e.idEvaluations,e.idCourse,e.target,ce.idCourses,e.template,ce.evaluation,ce.status "
            ."FROM evaluations e INNER JOIN courses_evaluations ce ON e.idCourse=ce.idCourse AND e.status='Ativo' "
            ."WHERE ce.idUsers=".$_SESSION['users']->idUsers
            ." AND e.idEvaluations=".$data['idEvaluations']
            ." AND e.idCourse=".$this->idCourse
            ." AND ce.idCourses=".$this->idCourses
            ." ";
        $con              = new Database();
        $this->evaluation = $con->get($query);
        if (!$this->evaluation) {
            return false;
        } else {
            $this->avaliacoesFormandoresStatus = $this->evaluation[0]['status'];
            $evaluation                        = new Evaluation($this->evaluation[0]);
            return $evaluation->build();
        }
    }

    function saveEvaluation($data)
    {
        $query            = "SELECT e.idEvaluations,e.idCourse,e.target,ce.idCourses,e.template,ce.evaluation,ce.status "
            ."FROM evaluations e INNER JOIN courses_evaluations ce ON e.idCourse=ce.idCourse AND e.status='Ativo' "
            ."WHERE ce.idUsers=".$_SESSION['users']->idUsers
            ." AND e.idEvaluations=".$data['idEvaluations']
            ." AND e.idCourse=".$this->idCourse
            ." AND ce.idCourses=".$this->idCourses
            ." ";
        $con              = new Database();
        $this->evaluation = $con->get($query);
        $evaluation       = new Evaluation($this->evaluation[0]);
        $responses        = $evaluation->saveEvaluation($this->evaluation[0]['template'],
            $data);
        $responsesJson    = json_encode($responses, JSON_UNESCAPED_UNICODE);
        $query            = "UPDATE courses_evaluations SET "
            ."evaluation = '".$responsesJson."', "
            ."date = '".date('Y-m-d H:i:s')."' "
            ."WHERE idEvaluations = ".$data['idEvaluations']
            ." AND idUsers=".$_SESSION['users']->idUsers
            ." AND idCourses=".$this->idCourses
            ." AND idCourse=".$this->idCourse." AND status<>'Fechado' ";
        $resultado        = $con->set($query);
        if (!$resultado) {
            return ['success' => false, 'message' => 'Não foi guardado.'];
        }
        return ['success' => true, 'message' => 'Foi guardado com sucesso.'];
    }
}
