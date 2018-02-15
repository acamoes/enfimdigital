<?php

/**
 * Description of EquipaExecutiva
 *
 * @author João Madeira
 */
class EquipaExecutiva
{
    public $tabs;
    public $utilizadores;
    public $cursos;
    public $modulos;
    public $documentos;
    public $calendarios;
    public $formacoes;
    public $avaliacoes;
    public $contexto;

    public function __construct($data)
    {
        $this->getTabs();
        $this->utilizadores = $this->getUtilizadores($data);
        $this->cursos       = $this->getCursos($data);
        $this->modulos      = $this->getModulos($data);
        $this->documentos   = $this->getDocumentos($data);
        $this->calendarios  = $this->getCalendarios($data);
        $this->formacoes    = $this->getFormacoes($data);
        $this->avaliacoes   = $this->getAvaliacoes($data);
        if (key_exists("idCourses", $data)) {
            $this->contexto['formacoes']['inscritos']   = $this->getInscritos($data);
            $this->contexto['formacoes']['equipa']      = $this->getEquipa($data);
            $this->contexto['formacoes']['sessoes']     = $this->getSessoes($data);
            $this->contexto['formacoes']['ficheiros']   = $this->getFicheiros($data);
            $this->contexto['formacoes']['avaliacoes']  = $this->getFormacoesAvaliacoes($data);
            $this->contexto['formacoes']['informacoes'] = $this->getFormacoesInformacoes($data);
        } else {
            $this->contexto['formacoes']['inscritos']   = array();
            $this->contexto['formacoes']['equipa']      = array();
            $this->contexto['formacoes']['sessoes']     = array();
            $this->contexto['formacoes']['ficheiros']   = array();
            $this->contexto['formacoes']['avaliacoes']  = array();
            $this->contexto['formacoes']['informacoes'] = array();
        }
    }

    public function getTabs()
    {
        $this->tabs = json_decode('{"tabs":[{"text":"Utilizadores","tab":"utilizadores"},{"text":"Cursos","tab":"cursos"},{"text":"Módulos","tab":"modulos"},{"text":"Documentos","tab":"documentos"},{"text":"Calendários","tab":"calendarios"},{"text":"Formações","tab":"formacoes"},{"text":"Avaliações","tab":"avaliacoes"} ]}');
    }

    public function getUtilizadores($data)
    {
        return Utilizadores::getUtilizadores($data);
    }

    public function getCursos($data)
    {
        return Cursos::getCursos($data);
    }

    public function getModulos($data)
    {
        return Modulos::getModulos($data);
    }

    public function getDocumentos($data)
    {
        return Documentos::getDocumentos($data);
    }

    public function getCalendarios($data)
    {
        return Calendarios::getCalendarios($data);
    }

    public function getAvaliacoes($data)
    {
        return Avaliacoes::getAvaliacoes($data);
    }

    public function getUtilizador($data)
    {
        return Utilizadores::getUtilizador($data);
    }

    public function inserirUtilizadores($data): array
    {
        return Utilizadores::inserirUtilizadores($data);
    }

    public function atualizarUtilizadores($data): array
    {
        return Utilizadores::atualizarUtilizadores($data);
    }

    public function apagarUtilizadores($data): array
    {
        return Utilizadores::apagarUtilizadores($data);
    }

    public function getCurso($data): array
    {
        return Cursos::getCurso($data);
    }

    public function inserirCursos($data): array
    {
        return Cursos::inserirCursos($data);
    }

    public function atualizarCursos($data): array
    {
        return Cursos::atualizarCursos($data);
    }

    public function apagarCursos($data): array
    {
        return Cursos::apagarCursos($data);
    }

    public function getModulo($data)
    {
        return Modulos::getModulo($data);
    }

    public function inserirModulos($data)
    {
        return Modulos::inserirModulos($data);
    }

    public function atualizarModulos($data)
    {
        return Modulos::atualizarModulos($data);
    }

    public function apagarModulos($data): array
    {
        return Modulos::apagarModulos($data);
    }

    public function getDocumento($data)
    {
        return Documentos::getDocumento($data);
    }

    public function inserirDocumentos($data)
    {
        return Documentos::inserirDocumentos($data);
    }

    public function inserirDocumentoFicheiro($data)
    {
        return Documentos::inserirDocumentoFicheiro($data);
    }

    public function atualizarDocumentosFicheiro($data)
    {
        return Documentos::atualizarDocumentosFicheiro($data);
    }

    public function atualizarDocumentos($data)
    {
        return $this->inserirDocumentos($data);
    }

    public function apagarDocumentos($data)
    {
        return Documentos::apagarDocumentos($data);
    }

    public function getModulosCurso($data)
    {
        return Modulos::getModulosCurso($data);
    }

    public function getCalendario($data)
    {
        return Calendarios::getCalendario($data);
    }

    public function inserirCalendarios($data)
    {
        return Calendarios::inserirCalendarios($data);
    }

    public function atualizarCalendarios($data)
    {
        return Calendarios::atualizarCalendarios($data);
    }

    public function apagarCalendarios($data)
    {
        return Calendarios::apagarCalendarios($data);
    }

    public function getAvaliacao($data)
    {
        return Avaliacoes::getAvaliacao($data);
    }

    public function inserirAvaliacoes($data)
    {
        return Avaliacoes::inserirAvaliacoes($data);
    }

    public function atualizarAvaliacoes($data)
    {
        return Avaliacoes::atualizarAvaliacoes($data);
    }

    public function apagarAvaliacoes($data)
    {
        return Avaliacoes::apagarAvaliacoes($data);
    }

    public function getModulosCursoOption($data)
    {
        return Modulos::getModulosCursoOption($data);
    }

    public function getFormacoes($data)
    {
        return Formacoes::getFormacoes($data);
    }

    public function getInscritos($data)
    {
        return Formacoes::getFormacoesInscritos($data);
    }

    public function getInscrito($data)
    {
        return Formacoes::getInscrito($data);
    }

    public function getUtlizadoresNaoInscritos($data)
    {
        return Formacoes::getUtlizadoresNaoInscritos($data);
    }

    public function adicionarFormacoesInscritos($data)
    {
        return Formacoes::adicionarFormacoesInscritos($data);
    }

    public function apagarFormacoesInscritos($data)
    {
        return Formacoes::apagarFormacoesInscritos($data);
    }

    public function atualizarFormacoesInscritos($data)
    {
        return Formacoes::atualizarFormacoesInscritos($data);
    }
    
    function participouFormacoesInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function passouCursoFormacoesInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function passouEstagioFormacoesInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function passouEtapaFormacoesInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    function resetFormacoesInscritos($data)
    {
        return Formacoes::avaliacaoInscritos($data);
    }

    public function adicionarFormacoesEquipa($data)
    {
        return Formacoes::adicionarFormacoesEquipa($data);
    }

    public function atualizarFormacoesEquipa($data)
    {
        return Formacoes::atualizarFormacoesEquipa($data);
    }

    public function getUtlizadoresSemEquipa($data)
    {
        return Formacoes::getUtlizadoresSemEquipa($data);
    }

    public function getEquipa1($data)
    {//just search
        return Formacoes::getEquipa1($data);
    }

    public function getEquipa($data)
    {
        return Formacoes::getEquipa($data);
    }

    public function apagarFormacoesEquipa($data)
    {
        return Formacoes::apagarFormacoesEquipa($data);
    }

    public function getSessoes($data)
    {
        return Formacoes::getSessoes($data);
    }

    public function inserirFormacoesSessoes($data)
    {
        return Formacoes::inserirFormacoesSessoes($data);
    }

    public function atualizarFormacoesSessoes($data)
    {
        return Formacoes::atualizarFormacoesSessoes($data);
    }

    public function restaurarFormacoesSessoes($data)
    {
        return Formacoes::restaurarFormacoesSessoes($data);
    }

    public function apagarFormacoesSessoes($data)
    {
        return Formacoes::apagarFormacoesSessoes($data);
    }

    public function getUtlizadoresEquipa($data)
    {
        return Formacoes::getUtlizadoresEquipa($data);
    }

    public function adicionarFormacoesSessoes($data)
    {
        return Formacoes::adicionarFormacoesSessoes($data);
    }

    public function getSessao($data)
    {
        return Formacoes::getSessao($data);
    }

    public function getFormacoesAvaliacoes($data)
    {
        return Formacoes::getFormacoesAvaliacoes($data);
    }

    public function fecharAvaliacoesFormacoesAvaliacoes($data)
    {
        return Formacoes::fecharAvaliacoesFormacoesAvaliacoes($data);
    }

    public function getFicheiros($data)
    {
        return Formacoes::getFicheiros($data);
    }

    public function getFicheiro($data)
    {
        return Formacoes::getFicheiro($data);
    }

    public function restaurarFormacoesFicheiros($data)
    {
        return Formacoes::restaurarFormacoesFicheiros($data);
    }

    public function getFormacoesModulos($data)
    {
        return Formacoes::getFormacoesModulos($data);
    }

    public function inserirFormacoesInformacao($data)
    {//vem do upload.php
        return Formacoes::inserirFormacoesInformacao($data);
    }

    public function inserirFormacoesInformacoes($data)
    {
        return $this->atualizarFormacoesInformacao($data);
    }

    public function atualizarFormacoesInformacoes($data)
    {
        return $this->atualizarFormacoesInformacao($data);
    }

    public function atualizarFormacoesInformacao($data)
    {//vem do upload.php
        return Formacoes::atualizarFormacoesInformacao($data);
    }

    public function getInformacao($data)
    {
        return Formacoes::getInformacao($data);
    }

    public function inserirFormacoesFicheiro($data)
    {//vem do upload.php
        return Formacoes::inserirFormacoesFicheiro($data);
    }

    public function atualizarFormacoesFicheiros($data)
    {
        return $this->atualizarFormacoesFicheiro($data);
    }

    public function atualizarFormacoesFicheiro($data)
    {//vem do upload.php
        return Formacoes::atualizarFormacoesFicheiro($data);
    }

    public function inserirFormacoesFicheiros($data)
    {
        return Formacoes::inserirFormacoesFicheiros($data);
    }

    public function apagarFormacoesFicheiros($data)
    {
        return Formacoes::apagarFormacoesFicheiros($data);
    }

    public function aprovarFormacoesFicheiros($data)
    {
        return Formacoes::aprovarFormacoesFicheiros($data);
    }

    public function distribuirAvaliacoesFormacoesAvaliacoes($data)
    {
        return Formacoes::distribuirAvaliacoesFormacoesAvaliacoes($data);
    }

    public function getFormacoesInformacoes($data)
    {
        return Formacoes::getFormacoesInformacoes($data);
    }

    public function apagarFormacoesInformacoes($data)
    {
        return Formacoes::apagarFormacoesInformacoes($data);
    }

    public function getUtilizadoresEAEP($data)
    {
        $users = new Users();
        return $users->getEAEP($data);
    }

    public function getRelatorioAvaliacoes($data)
    {
        return Evaluation::evaluationReport($data);
    }
    
    public function resetPasswordFormacoesInscritos($data){
        return $this->resetPasswordUtilizadores($data);
    }
    
    public function resetPasswordUtilizadores($data){
        $users=new Users();
        $data['username']=$users->getUsernameByIdUsers($data['idUsers']);
        return ($users->recover($data)?
            ['success' => true, 'message' => 'Renovação com sucesso.']:
            ['success' => false, 'message' => 'Não foi possível renovar.']);
    }
}
