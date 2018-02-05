<?php

/**
 * Description of EquipaExecutiva
 *
 * @author João Madeira
 */
class EquipaExecutiva {
    public $tabs;
    public $utilizadores;
    public $cursos;
    public $modulos;
    public $documentos;
    public $calendarios;
    public $formacoes;
    public $avaliacoes;
    public $contexto;

    function __construct($data) {
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
        }
        else {
            $this->contexto['formacoes']['inscritos']   = array();
            $this->contexto['formacoes']['equipa']      = array();
            $this->contexto['formacoes']['sessoes']     = array();
            $this->contexto['formacoes']['ficheiros']   = array();
            $this->contexto['formacoes']['avaliacoes']  = array();
            $this->contexto['formacoes']['informacoes'] = array();
        }
    }

    function getTabs() {
        $this->tabs = json_decode('{"tabs":[{"text":"Utilizadores","tab":"utilizadores"},{"text":"Cursos","tab":"cursos"},{"text":"Módulos","tab":"modulos"},{"text":"Documentos","tab":"documentos"},{"text":"Calendários","tab":"calendarios"},{"text":"Formações","tab":"formacoes"},{"text":"Avaliações","tab":"avaliacoes"} ]}');
    }

    function getUtilizadores($data) {
        return Utilizadores::getUtilizadores($data);
    }

    function getCursos($data) {
        return Cursos::getCursos($data);
    }

    function getModulos($data) {
        return Modulos::getModulos($data);
    }

    function getDocumentos($data) {
        return Documentos::getDocumentos($data);
    }

    function getCalendarios($data) {
        return Calendarios::getCalendarios($data);
    }

    function getAvaliacoes($data) {
        return Avaliacoes::getAvaliacoes($data);
    }

    function getUtilizador($data) {
        return Utilizadores::getUtilizador($data);
    }

    function inserirUtilizadores($data): array {
        return Utilizadores::inserirUtilizadores($data);
    }

    function atualizarUtilizadores($data): array {
        return Utilizadores::atualizarUtilizadores($data);
    }

    function apagarUtilizadores($data): array {
        return Utilizadores::apagarUtilizadores($data);
    }

    function getCurso($data): array {
        return Cursos::getCurso($data);
    }

    function inserirCursos($data): array {
        return Cursos::inserirCursos($data);
    }

    function atualizarCursos($data): array {
        return Cursos::atualizarCursos($data);
    }

    function apagarCursos($data): array {
        return Cursos::apagarCursos($data);
    }

    function getModulo($data) {
        return Modulos::getModulo($data);
    }

    function inserirModulos($data) {
        return Modulos::inserirModulos($data);
    }

    function atualizarModulos($data) {
        return Modulos::atualizarModulos($data);
    }

    function apagarModulos($data): array {
        return Modulos::apagarModulos($data);
    }

    function getDocumento($data) {
        return Documentos::getDocumento($data);
    }

    function inserirDocumentos($data) {
        return Documentos::inserirDocumentos($data);
    }

    function inserirDocumentoFicheiro($data) {
        return Documentos::inserirDocumentoFicheiro($data);
    }

    function atualizarDocumentosFicheiro($data) {
        return Documentos::atualizarDocumentosFicheiro($data);
    }

    function atualizarDocumentos($data) {
        return $this->inserirDocumentos($data);
    }

    function apagarDocumentos($data) {
        return Documentos::apagarDocumentos($data);
    }

    function getModulosCurso($data) {
        return Modulos::getModulosCurso($data);
    }

    function getCalendario($data) {
        return Calendarios::getCalendario($data);
    }

    function inserirCalendarios($data) {
        return Calendarios::inserirCalendarios($data);
    }

    function atualizarCalendarios($data) {
        return Calendarios::atualizarCalendarios($data);
    }

    function apagarCalendarios($data) {
        return Calendarios::apagarCalendarios($data);
    }

    function getAvaliacao($data) {
        return Avaliacoes::getAvaliacao($data);
    }

    function inserirAvaliacoes($data) {
        return Avaliacoes::inserirAvaliacoes($data);
    }

    function atualizarAvaliacoes($data) {
        return Avaliacoes::atualizarAvaliacoes($data);
    }

    function apagarAvaliacoes($data) {
        return Avaliacoes::apagarAvaliacoes($data);
    }

    function getModulosCursoOption($data) {
        return Modulos::getModulosCursoOption($data);
    }

    function getFormacoes($data) {
        return Formacoes::getFormacoes($data);
    }

    function getInscritos($data) {
        return Formacoes::getFormacoesInscritos($data);
    }

    function getInscrito($data) {
        return Formacoes::getInscrito($data);
    }

    function getUtlizadoresNaoInscritos($data) {
        return Formacoes::getUtlizadoresNaoInscritos($data);
    }

    function adicionarFormacoesInscritos($data) {
        return Formacoes::adicionarFormacoesInscritos($data);
    }

    function apagarFormacoesInscritos($data) {
        return Formacoes::apagarFormacoesInscritos($data);
    }

    function atualizarFormacoesInscritos($data) {
        return Formacoes::atualizarFormacoesInscritos($data);
    }

    function adicionarFormacoesEquipa($data) {
        return Formacoes::adicionarFormacoesEquipa($data);
    }

    function atualizarFormacoesEquipa($data) {
        return Formacoes::atualizarFormacoesEquipa($data);
    }

    function getUtlizadoresSemEquipa($data) {
        return Formacoes::getUtlizadoresSemEquipa($data);
    }

    function getEquipa1($data) {//just search
        return Formacoes::getEquipa1($data);
    }

    function getEquipa($data) {
        return Formacoes::getEquipa($data);
    }

    function apagarFormacoesEquipa($data) {
        return Formacoes::apagarFormacoesEquipa($data);
    }

    function getSessoes($data) {
        return Formacoes::getSessoes($data);
    }

    function inserirFormacoesSessoes($data) {
        return Formacoes::inserirFormacoesSessoes($data);
    }

    function atualizarFormacoesSessoes($data) {
        return Formacoes::atualizarFormacoesSessoes($data);
    }

    function restaurarFormacoesSessoes($data) {
        return Formacoes::restaurarFormacoesSessoes($data);
    }

    function apagarFormacoesSessoes($data) {
        return Formacoes::apagarFormacoesSessoes($data);
    }

    function getUtlizadoresEquipa($data) {
        return Formacoes::getUtlizadoresEquipa($data);
    }

    function adicionarFormacoesSessoes($data) {
        return Formacoes::adicionarFormacoesSessoes($data);
    }

    function getSessao($data) {
        return Formacoes::getSessao($data);
    }

    function getFormacoesAvaliacoes($data) {
        return Formacoes::getFormacoesAvaliacoes($data);
    }

    function fecharAvaliacoesFormacoesAvaliacoes($data) {
        return Formacoes::fecharAvaliacoesFormacoesAvaliacoes($data);
    }

    function getFicheiros($data) {
        return Formacoes::getFicheiros($data);
    }

    function getFicheiro($data) {
        return Formacoes::getFicheiro($data);
    }

    function restaurarFormacoesFicheiros($data) {
        return Formacoes::restaurarFormacoesFicheiros($data);
    }

    function getFormacoesModulos($data) {
        return Formacoes::getFormacoesModulos($data);
    }

    function inserirFormacoesInformacao($data) {//vem do upload.php
        return Formacoes::inserirFormacoesInformacao($data);
    }

    function inserirFormacoesInformacoes($data) {
        return $this->atualizarFormacoesInformacao($data);
    }

    function atualizarFormacoesInformacoes($data) {
        return $this->atualizarFormacoesInformacao($data);
    }

    function atualizarFormacoesInformacao($data) {//vem do upload.php
        return Formacoes::atualizarFormacoesInformacao($data);
    }

    function getInformacao($data) {
        return Formacoes::getInformacao($data);
    }

    function inserirFormacoesFicheiro($data) {//vem do upload.php
        return Formacoes::inserirFormacoesFicheiro($data);
    }

    function atualizarFormacoesFicheiros($data) {
        return $this->atualizarFormacoesFicheiro($data);
    }

    function atualizarFormacoesFicheiro($data) {//vem do upload.php
        return Formacoes::atualizarFormacoesFicheiro($data);
    }

    function inserirFormacoesFicheiros($data) {
        return Formacoes::inserirFormacoesFicheiros($data);
    }

    function apagarFormacoesFicheiros($data) {
        return Formacoes::apagarFormacoesFicheiros($data);
    }

    function aprovarFormacoesFicheiros($data) {
        return Formacoes::aprovarFormacoesFicheiros($data);
    }

    function distribuirAvaliacoesFormacoesAvaliacoes($data) {
        return Formacoes::distribuirAvaliacoesFormacoesAvaliacoes($data);
    }

    function getFormacoesInformacoes($data) {
        return Formacoes::getFormacoesInformacoes($data);
    }

    function apagarFormacoesInformacoes($data) {
        return Formacoes::apagarFormacoesInformacoes($data);
    }

    function getUtilizadoresEAEP($data) {
        $eaep = new Users();
        return $eaep->getEAEP($data);
    }
}