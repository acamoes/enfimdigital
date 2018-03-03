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
class Evaluation
{
    private $edit       = false;
    private $template   = null;
    private $tpl        = "";
    private $target     = "";
    private $evaluation = null;

    public function __construct($evaluation)
    {
        $this->evaluation = $evaluation;
        $this->target     = $this->evaluation['target'];
        $this->tpl        = new Enfim_Smarty;
        if (strlen($this->evaluation['evaluation']) > strlen($this->evaluation['template'])) {
            $this->template = json_decode($this->evaluation['evaluation']);
        } else {
            $this->template = json_decode($this->evaluation['template']);
        }
        if ($evaluation['status'] == 'Aberto') {
            $this->edit = true;
        } else {
            $this->edit = false;
        }
    }

    public function build()
    {
        $html = "<input type='hidden' id='idCourses' name='idCourses' value='".$this->evaluation['idCourses']."'/>";
        $html .= "<input type='hidden' id='idEvaluations' name='idEvaluations' value='".$this->evaluation['idEvaluations']."'/>";
        for ($i = 0, $c = count($this->template->avaliacao->itens); $i < $c; $i++) {
            $html .= "<br/><br/>";
            $html .= "<h4 class='major'>".$this->template->avaliacao->itens[$i]->tema."</h4><div class='field'>";
            if (property_exists($this->template->avaliacao->itens[$i], 'itens')) {
                for ($j = 0, $sc = count($this->template->avaliacao->itens[$i]->itens); $j < $sc; $j++) {
                    $html .= "<div stlye='display: flex;flex-direction: row; width:1200px'>";
                    if ($this->template->avaliacao->itens[$i]->itens[$j]->tema != 'name') {
                        if (property_exists(
                                $this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao'
                            )) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                $html .= $this->radio(
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema.'-avaliacao',
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response ?? null
                                );
                            }
                        }
                        if (property_exists(
                                $this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos'
                            )) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->tipo == 'longText') {
                                $html .= $this->textArea(
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema.'-pontos_positivos',
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->intervalo,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response ?? null
                                );
                            }
                        }
                        if (property_exists(
                                $this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar'
                            )) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->tipo == 'longText') {
                                $html .= $this->textArea(
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema.'-pontos_a_melhorar',
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->intervalo,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response ?? null
                                );
                            }
                        }
                        if (property_exists(
                                $this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes'
                            )) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->tipo == 'longText') {
                                $html .= $this->textArea(
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema.'-recomendacoes',
                                    $this->template->avaliacao->itens[$i]->itens[$j]->tema,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->intervalo,
                                    $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response ?? null
                                );
                            }
                        }
                    } else {
                        if ($this->template->avaliacao->itens[$i]->tema == 'Formadores') {
                            $listaFormadores = Formadores::listaFormadores($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaFormadores); $k < $f; $k++) {
                                $formador                  = $listaFormadores[$k];
                                $parts                     = explode(
                                    ' ', $formador['name']
                                );
                                $formador['firstLastName'] = $parts[0].' '.$parts[count($parts) - 1];
                                $html                      .= "<br/>";
                                $html                      .= "<h4 class='major'>".$formador['firstLastName']."</h4><div class='field'>";
                                $html                      .= "<input type='hidden' name='formadores_".$formador['idUsers']."_".$formador['type']."'/>";

                                $temas = "";
                                if ($this->target == 'Formador') {
                                    $temas = ['Direção de Curso', 'Participação no Curso',
                                        'Clareza na Exposição', 'Domínio no assunto',
                                        'Métodos e técnicas utilizadas', 'Relacionamento com os formandos',
                                        'Acompanhameno de estágios'];
                                } else {
                                    $temas = ['Clareza na Exposição',
                                        'Domínio do assunto',
                                        'Métodos e técnicas utilizadas',
                                        'Relacionamento com os formandos'];
                                }

                                foreach ($temas as $temas) {
                                    $html .= "<div stlye='display: flex;flex-direction: row; width:1200px'>";
                                    if (property_exists(
                                            $this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao'
                                        )) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                            $html .= $this->radio(
                                                'formador-avaliacao-'.$temas.'-'.$formador['idUsers'], $temas,
                                                $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo,
                                                (
                                                $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('formador-avaliacao-'.$temas.'-'.$formador['idUsers'])}
                                                    ?? null
                                                )
                                            );
                                        }
                                    }

                                    if (property_exists(
                                            $this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos'
                                        )) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                'formador-pontos_positivos-'.$temas.'-'.$formador['idUsers'], $temas,
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->intervalo,
                                                (
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('formador-pontos_positivos-'.$temas.'-'.$formador['idUsers'])}
                                                    ?? null
                                                )
                                            );
                                        }
                                    }
                                    if (property_exists(
                                            $this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar'
                                        )) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                'formador-pontos_a_melhorar-'.$temas.'-'.$formador['idUsers'], $temas,
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->intervalo,
                                                (
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('formador-pontos_a_melhorar-'.$temas.'-'.$formador['idUsers'])}
                                                    ?? null
                                                )
                                            );
                                        }
                                    }
                                    if (property_exists(
                                            $this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes'
                                        )) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                'formador-recomendacoes-'.$temas.'-'.$formador['idUsers'], $temas,
                                                $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->intervalo,
                                                (
                                                $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('formador-recomendacoes-'.$temas.'-'.$formador['idUsers'])}
                                                    ?? null
                                                )
                                            );
                                        }
                                    }
                                    $html .= "<br style='clear: left;' /></div>";
                                }
                            }
                        }

                        if ($this->template->avaliacao->itens[$i]->tema == 'Módulos') {
                            $listaModulos = Cursos::listaModulos($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaModulos); $k < $f; $k++) {
                                $modulo = $listaModulos[$k];
                                $html   .= "<h4 class='major'>".$modulo['name']."</h4><div class='field'>";
                                $html   .= "<input type='hidden' name='modulo_".$modulo['idModules']."'/>";
                                $html   .= "<div stlye='display: flex;flex-direction: row; width:1200px'>";
                                if (property_exists(
                                        $this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao'
                                    )) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                        $html .= $this->radio(
                                            'modulo-avaliacao-'.$modulo['name'].'-'.$modulo['idModules'], '',
                                            $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo,
                                            (
                                            $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('modulo-avaliacao-'.$modulo['name'].'-'.$modulo['idModules'])}
                                                ?? null
                                            )
                                        );
                                    }
                                }
                                if (property_exists(
                                        $this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos'
                                    )) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->tipo == 'longText') {
                                        $html .= $this->textArea(
                                            'modulo-pontos_positivos-'.$modulo['name'].'-'.$modulo['idModules'], '',
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->intervalo,
                                            (
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('modulo-pontos_positivos-'.$modulo['name'].'-'.$modulo['idModules'])}
                                                ?? null
                                            )
                                        );
                                    }
                                }
                                if (property_exists(
                                        $this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar'
                                    )) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->tipo == 'longText') {
                                        $html .= $this->textArea(
                                            'modulo-pontos_a_melhorar-'.$modulo['name'].'-'.$modulo['idModules'], '',
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->intervalo,
                                            (
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('modulo-pontos_a_melhorar-'.$modulo['name'].'-'.$modulo['idModules'])}
                                                ?? null
                                            )
                                        );
                                    }
                                }
                                if (property_exists(
                                        $this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes'
                                    )) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->tipo == 'longText') {
                                        $html .= $this->textArea(
                                            'modulo-recomendacoes-'.$modulo['name'].'-'.$modulo['idModules'], '',
                                            $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->intervalo,
                                            (
                                            $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('modulo-recomendacoes-'.$modulo['name'].'-'.$modulo['idModules'])}
                                                ?? null
                                            )
                                        );
                                    }
                                }
                                $html .= "<br style='clear: left;' /></div>";
                            }
                        }
                    }

                    $html .= "<br style='clear: left;' /></div>";
                }
            }
            $html .= "</div>";
        }
        return $html;
    }

    public function radio($idInput, $nome, $intervalo, $selecionado): string
    {
        $tag   = null;
        //$tag   = "<div class='row uniform'>";
        $tag   .= "<div style='float: left; padding: 5px 5px 5px 5px; width:350px'>";
        $tag   .= "<label for='".ENFIM::cleanString($idInput)."'>$nome</label>";
        $range = explode('-', $intervalo);
        for ($i = $range[0]; $i <= $range[1]; $i++) {
            $tag .= "<input type='radio' id='".ENFIM::cleanString($idInput)."-$i' name='".ENFIM::cleanString($idInput)."' value='$i' ".($selecionado
                == $i ? "checked=''" : "")." style='padding-left: 2.0em;'>"
                ."<label for='".ENFIM::cleanString($idInput)."-$i' style='padding-left: 2.0em;'>$i</label>";
        }
        $tag .= "</div>";
        //$tag .= "</div>";
        return $tag;
    }

    public function textArea($idInput, $nome, $intervalo, $selecionado): string
    {
        if (strpos($idInput, 'pontos_positivos') !== false) {
            $nome = "Pontos positivos";
        } elseif (strpos($idInput, 'pontos_a_melhorar') !== false) {
            $nome = "Pontos a melhorar";
        } else {
            $nome = "Recomendações";
        }
        $tag   = null;
        //$tag   = "<div class='row uniform'>";
        $tag   .= "<div style='float: left; padding: 5px 5px 5px 5px; width:400px'>";
        $tag   .= "<label for='".ENFIM::cleanString($idInput)."'>$nome</label>";
        $range = explode('-', $intervalo);
        $tag   .= "<textarea cols = '$range[1]' rows = '$range[0]' name = '".ENFIM::cleanString($idInput)."' id = '".ENFIM::cleanString($idInput)."' style = 'width: 350px'>$selecionado</textarea>";
        $tag   .= "</div>";
        //$tag .= "</div>";
        return $tag;
    }

    public function saveEvaluation($template, $responses)
    {
        $this->template = json_decode($template);

        for ($i = 0, $c = count($this->template->avaliacao->itens); $i < $c; $i++) {
            if (property_exists($this->template->avaliacao->itens[$i], 'itens')) {
                for ($j = 0, $sc = count($this->template->avaliacao->itens[$i]->itens); $j < $sc; $j++) {
                    if ($this->template->avaliacao->itens[$i]->itens[$j]->tema != 'name') {
                        if (property_exists(
                                $this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao'
                            )) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema.'-avaliacao')]
                                    ?? "");
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema.'-pontos_positivos')]
                                    ?? "");
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema.'-pontos_a_melhorar')]
                                    ?? "");
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema.'-recomendacoes')]
                                    ?? "");
                        }
                    } else {
                        if ($this->template->avaliacao->itens[$i]->tema == 'Formadores') {
                            $listaFormadores = Formadores::listaFormadores($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaFormadores); $k < $f; $k++) {
                                $formador                  = $listaFormadores[$k];
                                $parts                     = explode(' ', $formador['name']);
                                $formador['firstLastName'] = $parts[0].' '.$parts[count($parts) - 1];
                                $temas                     = "";
                                if ($this->target == 'Formador') {
                                    $temas = ['Direção de curso', 'Participação no curso',
                                        'Clareza na exposição', 'Domínio no assunto',
                                        'Métodos e técnicas utilizadas', 'Relacionamento com os formandos',
                                        'Acompanhameno de estágios'];
                                } else {
                                    $temas = ['Clareza na exposição',
                                        'Domínio do assunto',
                                        'Métodos e técnicas utilizadas',
                                        'Relacionamento com os formandos'];
                                }
                                foreach ($temas as $temas) {
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-avaliacao-'.$temas.'-'.$formador['idUsers']),
                                                $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao,
                                                    'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('formador-avaliacao-'.$temas.'-'.$formador['idUsers'])}
                                                = $responses[ENFIM::cleanString('formador-avaliacao-'.$temas.'-'.$formador['idUsers'])];
                                        }
                                    }

                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j],
                                            'pontos_positivos')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-pontos_positivos-'.$temas.'-'.$formador['idUsers']),
                                                $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos,
                                                    'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response
                                                    = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('formador-pontos_positivos-'.$temas.'-'.$formador['idUsers'])}
                                                = $responses[ENFIM::cleanString('formador-pontos_positivos-'.$temas.'-'.$formador['idUsers'])];
                                        }
                                    }
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j],
                                            'pontos_a_melhorar')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-pontos_a_melhorar-'.$temas.'-'.$formador['idUsers']),
                                                $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar,
                                                    'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response
                                                    = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('formador-pontos_a_melhorar-'.$temas.'-'.$formador['idUsers'])}
                                                = $responses[ENFIM::cleanString('formador-pontos_a_melhorar-'.$temas.'-'.$formador['idUsers'])];
                                        }
                                    }
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j],
                                            'recomendacoes')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-recomendacoes-'.$temas.'-'.$formador['idUsers']),
                                                $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes,
                                                    'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response
                                                    = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('formador-recomendacoes-'.$temas.'-'.$formador['idUsers'])}
                                                = $responses[ENFIM::cleanString('formador-recomendacoes-'.$temas.'-'.$formador['idUsers'])];
                                        }
                                    }
                                }
                            }
                        }

                        if ($this->template->avaliacao->itens[$i]->tema == 'Módulos') {
                            $listaModulos = Cursos::listaModulos($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaModulos); $k < $f; $k++) {
                                $modulo = $listaModulos[$k];
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao,
                                            'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('modulo-avaliacao-'.$modulo['name'].'-'.$modulo['idModules'])}
                                        = ($responses[ENFIM::cleanString('modulo-avaliacao-'.$modulo['name'].'-'.$modulo['idModules'])]
                                            ?? "");
                                }

                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos,
                                            'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('modulo-pontos_positivos-'.$modulo['name'].'-'.$modulo['idModules'])}
                                        = ($responses[ENFIM::cleanString('modulo-pontos_positivos-'.$modulo['name'].'-'.$modulo['idModules'])]
                                            ?? "");
                                }

                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j],
                                        'pontos_a_melhorar')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar,
                                            'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('modulo-pontos_a_melhorar-'.$modulo['name'].'-'.$modulo['idModules'])}
                                        = ($responses[ENFIM::cleanString('modulo-pontos_a_melhorar-'.$modulo['name'].'-'.$modulo['idModules'])]
                                            ?? "");
                                }
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes,
                                            'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('modulo-recomendacoes-'.$modulo['name'].'-'.$modulo['idModules'])}
                                        = ($responses[ENFIM::cleanString('modulo-recomendacoes-'.$modulo['name'].'-'.$modulo['idModules'])]
                                            ?? "");
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->template;
    }

    public static function evaluationReport($data)
    {
        $query  = "SELECT * FROM courses_evaluations WHERE idcourse=1 AND idCourses=1 AND evaluation IS NOT NULL ORDER BY name ";
        $con    = new Database();
        $result = $con->get($query);
        $report = array();
        foreach ($result as $eval) { // Todas avaliações
            $json = json_decode($eval['evaluation']);
            //Não existe o tipo de avaliação Formador, Formando, Curso
            if (!array_key_exists($eval['name'], $report)) {
                $report[$eval['name']] = array();
            }
            foreach ($json->avaliacao->itens as $avaliacao) {
                //echo $avaliacao->tema.PHP_EOL;
                if (!array_key_exists($avaliacao->tema, $report[$eval['name']])) {
                    $report[$eval['name']][$avaliacao->tema] = array();
                }
                if ($avaliacao->tema == 'Módulos') {
                    foreach ($avaliacao->itens as $pontos) {
                        foreach ($pontos->avaliacao->response as $modulos => $detalhes) {
                            //echo $modulos.PHP_EOL;
                            $modulo          = str_replace('modulo-avaliacao-', '', $modulos);
                            $pontospositivos = 'modulo-pontospositivos-'.$modulo;
                            $pontosamelhorar = 'modulo-pontosamelhorar-'.$modulo;
                            $recomendacoes   = 'modulo-recomendacoes-'.$modulo;
                            $matches         = explode('-', $modulo);
                            $idModulo        = $matches[count($matches) - 1];
                            unset($matches[count($matches) - 1]);
                            $modulo          = implode(' ', $matches);
                            if (!array_key_exists($idModulo, $report[$eval['name']][$avaliacao->tema])) {
                                $report[$eval['name']][$avaliacao->tema][$idModulo]                  = array();
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['modulo']        = null;
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['idModulo']      = null;
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['contador']      = 0;
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['respostas']     = 0;
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['positivos']     = '';
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['melhorar']      = '';
                                $report[$eval['name']][$avaliacao->tema][$idModulo]['recomendacoes'] = '';
                            }
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['modulo']        = Modulos::getModuloName($idModulo);
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['contador'] ++;
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['idModulo']      = $idModulo;
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['respostas']     += $pontos->avaliacao->response->{$modulos};
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['positivos']     .= (!empty($pontos->pontos_positivos->response->{$pontospositivos})
                                    ? '\r\n#'.$pontos->pontos_positivos->response->{$pontospositivos} : '');
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['melhorar']      .= (!empty($pontos->pontos_a_melhorar->response->{$pontosamelhorar})
                                    ? '\r\n#'.$pontos->pontos_a_melhorar->response->{$pontosamelhorar} : '');
                            $report[$eval['name']][$avaliacao->tema][$idModulo]['recomendacoes'] .= (!empty($pontos->recomendacoes->response->{$recomendacoes})
                                    ? '\r\n#'.$pontos->recomendacoes->response->{$recomendacoes} : '');
                        }
                    }
                } elseif ($avaliacao->tema == 'Formadores') {
                    foreach ($avaliacao->itens as $pontos) {
                        foreach ($pontos->avaliacao->response as $formadores => $detalhes) {
                            //echo $modulos.PHP_EOL;
                            $formador        = str_replace('formador-avaliacao-', '', $formadores);
                            $pontospositivos = 'formador-pontospositivos-'.$formador;
                            $pontosamelhorar = 'formador-pontosamelhorar-'.$formador;
                            $recomendacoes   = 'formador-recomendacoes-'.$formador;
                            $matches         = explode('-', $formador);
                            $idFormador      = $matches[count($matches) - 1];
                            unset($matches[count($matches) - 1]);
                            $criterio        = implode(' ', $matches);
                            $criterio        = str_ireplace(['Direo de curso', 'Participao no curso', 'na exposio', 'Domnio no', 'Mtodos e tcnicas',
                                'de estgio'],
                                ['Direção de curso', 'Participação no curso', 'na exposição', 'Domínio no', 'Métodos e técnicas', 'de estágio'],
                                $criterio);
                            if (!array_key_exists($idFormador, $report[$eval['name']][$avaliacao->tema])) {
                                $report[$eval['name']][$avaliacao->tema][$idFormador] = array();
                            }
                            if (!array_key_exists($criterio, $report[$eval['name']][$avaliacao->tema][$idFormador])) {
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]                  = array();
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['formador']      = null;
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['idFormador']    = null;
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['contador']      = 0;
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['respostas']     = 0;
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['positivos']     = '';
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['melhorar']      = '';
                                $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['recomendacoes'] = '';
                            }
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['formador']      = Users::getName($idFormador);
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['contador'] ++;
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['idFormador']    = $idFormador;
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['respostas']     += $pontos->avaliacao->response->{$formadores};
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['positivos']     .= (!empty($pontos->pontos_positivos->response->{$pontospositivos})
                                    ? '\r\n#'.$pontos->pontos_positivos->response->{$pontospositivos} : '');
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['melhorar']      .= (!empty($pontos->pontos_a_melhorar->response->{$pontosamelhorar})
                                    ? '\r\n#'.$pontos->pontos_a_melhorar->response->{$pontosamelhorar} : '');
                            $report[$eval['name']][$avaliacao->tema][$idFormador][$criterio]['recomendacoes'] .= (!empty($pontos->recomendacoes->response->{$recomendacoes})
                                    ? '\r\n#'.$pontos->recomendacoes->response->{$recomendacoes} : '');
                        }
                    }
                } else {
                    foreach ($avaliacao->itens as $pontos) {
                        //echo $pontos->tema.PHP_EOL;
                        if (!array_key_exists($pontos->tema, $report[$eval['name']][$avaliacao->tema])) {
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]                  = array();
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['contador']      = 0;
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['respostas']     = 0;
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['positivos']     = '';
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['melhorar']      = '';
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['recomendacoes'] = '';
                        }
                        if (!empty($pontos->avaliacao->response)) {
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['contador'] ++;
                            $report[$eval['name']][$avaliacao->tema][$pontos->tema]['respostas'] += $pontos->avaliacao->response;
                        }
                        $report[$eval['name']][$avaliacao->tema][$pontos->tema]['positivos']     .= (!empty($pontos->pontos_positivos->response)
                                ? '\r\n#'.$pontos->pontos_positivos->response : '');
                        $report[$eval['name']][$avaliacao->tema][$pontos->tema]['melhorar']      .= (!empty($pontos->pontos_a_melhorar->response)
                                ? '\r\n#'.$pontos->pontos_a_melhorar->response : '');
                        $report[$eval['name']][$avaliacao->tema][$pontos->tema]['recomendacoes'] .= (!empty($pontos->recomendacoes->response)
                                ? '\r\n#'.$pontos->recomendacoes->response : '');
                    }
                }
            }
        }
        return $report;
    }
}
