<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evaluation
 *
 * @author João Madeira
 */
class Evaluation {
    private $edit       = false;
    private $template   = null;
    private $respostas  = null;
    private $tpl        = "";
    private $evaluation = null;

//put your code here
    function __construct($evaluation) {
        $this->evaluation = $evaluation;
        $this->tpl        = new Enfim_Smarty;
        $this->template   = json_decode($evaluation['template']);
        $this->respostas  = json_decode($evaluation['evaluation']);
        if ($evaluation['status'] == 'Aberto') {
            $this->edit = true;
        }
        else {
            $this->edit = false;
        }
        $this->build($this->template);
    }

    function build($template) {
        $this->tpl->assign('error', '');
        $this->tpl->assign('botKey', BOT_KEY);
        $this->tpl->assign('title', 'Questionário');
        $html = "";
        for ($i = 0, $c = count($template->avaliacao->itens); $i < $c; $i++) {
            $html .= "<h4 class='major'>" . $template->avaliacao->itens[$i]->tema . "</h4><div class='field'>";
            if (property_exists($template->avaliacao->itens[$i], 'itens')) {
                for ($j = 0, $sc = count($template->avaliacao->itens[$i]->itens); $j < $sc; $j++) {
                    if ($template->avaliacao->itens[$i]->itens[$j]->tema != 'name') {
                        if (property_exists($template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                            if ($template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                $html .= $this->radio(
                                        $template->avaliacao->itens[$i]->itens[$j]->tema . '-avaliacao', $template->avaliacao->itens[$i]->itens[$j]->tema, $template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo, null);
                            }
                        }
                        if (property_exists($template->avaliacao->itens[$i]->itens[$j], 'observacoes')) {
                            if ($template->avaliacao->itens[$i]->itens[$j]->observacoes->tipo == 'longText') {
                                $html .= $this->textArea(
                                        $template->avaliacao->itens[$i]->itens[$j]->tema . '-observacoes', $template->avaliacao->itens[$i]->itens[$j]->tema, $template->avaliacao->itens[$i]->itens[$j]->observacoes->intervalo, null);
                            }
                        }
                    }
                    else {
                        if ($template->avaliacao->itens[$i]->tema == 'Formadores') {
                            $listaFormadores = Formadores::listaFormadores($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaFormadores); $k < $f; $k++) {
                                $formador                  = $listaFormadores[$k];
                                $parts                     = explode(' ', $formador['name']);
                                $formador['firstLastName'] = $parts[0] . ' ' . $parts[count($parts) - 1];
                                $html                      .= "<h4 class='major'>" . $formador['firstLastName'] . "</h4><div class='field'>";
                                $html                      .= "<input type='hidden' name='formadores_" . $formador['idUsers'] . "_" . $formador['type'] . "'/>";
                                $temas                     = ['Clareza na Exposição',
                                    'Domínio do assunto',
                                    'Métodos e técnicas utilizadas',
                                    'Relacionamento com os formandos'];
                                foreach ($temas as $temas) {
                                    if (property_exists($template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                        if ($template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                            $html .= $this->radio(
                                                    $temas . '-avaliacao-' . $formador['idUsers'], $temas, $template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo, null);
                                        }
                                    }

                                    if (property_exists($template->avaliacao->itens[$i]->itens[$j], 'observacoes')) {
                                        if ($template->avaliacao->itens[$i]->itens[$j]->observacoes->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                    $temas . '-observacoes-' . $formador['idUsers'], $temas, $template->avaliacao->itens[$i]->itens[$j]->observacoes->intervalo, null);
                                        }
                                    }
                                }
                            }
                        }

                        if ($template->avaliacao->itens[$i]->tema == 'Módulos') {
                            $listaModulos = Cursos::listaModulos($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaModulos); $k < $f; $k++) {
                                $modulo = $listaModulos[$k];
                                $html   .= "<h4 class='major'>" . $modulo['name'] . "</h4><div class='field'>";
                                $html   .= "<input type='hidden' name='modulo_" . $modulo['idModules'] . "'/>";
                                if (property_exists($template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                    if ($template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                        $html .= $this->radio(
                                                'modulo-avaliacao-' . $modulo['idModules'], '', $template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo, null);
                                    }
                                }

                                if (property_exists($template->avaliacao->itens[$i]->itens[$j], 'observacoes')) {
                                    if ($template->avaliacao->itens[$i]->itens[$j]->observacoes->tipo == 'longText') {
                                        $html .= $this->textArea(
                                                'modulo-observacoes-' . $modulo['idModules'], '', $template->avaliacao->itens[$i]->itens[$j]->observacoes->intervalo, null);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $html .= "</div>";
        }
        $this->tpl->assign('html', $html);
        $this->tpl->display('enfim_evaluation.tpl');
        exit;
        foreach ($template['Avaliação'] as $tema => $conteudo) {
            if (isset($conteudo->itens)) {
                return $this->build($conteudo);
            }
            else {
                print_r($conteudo);
            }
        }
    }

    function radio($id, $nome, $intervalo, $selecionado): string {
        $tag   = "<div class='row uniform'><div><label for='" . ENFIM::cleanString($id) . "'>$nome</label>";
        $range = explode('-', $intervalo);
        for ($i = $range[0]; $i <= $range[1]; $i++) {
            $tag .= "<input type='radio' id='" . ENFIM::cleanString($id) . "-$i' name='$id' value='$i' " . ($selecionado == $i ? "checked=''" : "") . ">"
                    . "<label for='" . ENFIM::cleanString($id) . "-$i'>$i</label>";
        }
        $tag .= "</div></div>";
        return $tag;
    }

    function textArea($id, $nome, $intervalo, $selecionado): string {
        $tag   = "<div class='row uniform'><div><label for='" . ENFIM::cleanString($id) . "'>Observações</label>";
        $range = explode('-', $intervalo);
        $tag   .= "<textarea cols = '$range[1]' rows = '$range[0]' name = '" . ENFIM::cleanString($id) . "' id = '" . ENFIM::cleanString($id) . "' style = 'width: 630px'>$selecionado</textarea>";
        $tag   .= "</div></div>";
        return $tag;
    }
}