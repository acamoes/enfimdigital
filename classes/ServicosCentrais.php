<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicosCentrais
 *
 * @author João Madeira
 */
class ServicosCentrais
{
    public $tabs;
    public $utilizadores;
    public $calendarios;
    public $formacoes;
    public $contexto;
    
    public function __construct($data)
    {
        $this->getTabs();
        $this->utilizadores = $this->getUtilizadores($data);
        $this->calendarios  = $this->getCalendarios($data);
        $this->formacoes    = $this->getFormacoes($data);
        if (key_exists("idCourses", $data)) {
            $this->contexto['formacoes']['inscritos']   = $this->getInscritos($data);
            $this->contexto['formacoes']['equipa']      = $this->getEquipa($data);
        } else {
            $this->contexto['formacoes']['inscritos']   = array();
            $this->contexto['formacoes']['equipa']      = array();
        }
    }
    
    public function getTabs()
    {
        $this->tabs = json_decode('{"tabs":[{"text":"Utilizadores","tab":"utilizadores"},{"text":"Calendários","tab":"calendarios"},{"text":"Formações","tab":"formacoes"}]}');
    }

    public function getUtilizadores($data)
    {
        return Utilizadores::getUtilizadores($data);
    }
    
    public function getCalendarios($data)
    {
        return Calendarios::getCalendarios($data);
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
    
    public function getCalendario($data)
    {
        return Calendarios::getCalendario($data);
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
    
    public function getEquipa1($data)
    {//just search
        return Formacoes::getEquipa1($data);
    }

    public function getEquipa($data)
    {
        return Formacoes::getEquipa($data);
    }
    
    public function getUtilizadoresEAEP($data)
    {
        $users = new Users();
        return $users->getEAEP($data);
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
