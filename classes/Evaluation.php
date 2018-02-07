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
    private $tpl        = "";
    private $target     = "";
    private $evaluation = null;

//put your code here
    function __construct($evaluation) {
        $this->evaluation = $evaluation;
        $this->target     = $this->evaluation['target'];
        $this->tpl        = new Enfim_Smarty;
        if (strlen($this->evaluation['evaluation']) > strlen($this->evaluation['template'])) {
            $this->template = json_decode($this->evaluation['evaluation']);
        }
        else {
            $this->template = json_decode($this->evaluation['template']);
        }
        if ($evaluation['status'] == 'Aberto') {
            $this->edit = true;
        }
        else {
            $this->edit = false;
        }
    }

    function build() {
        $html = "<input type='hidden' id='idCourses' name='idCourses' value='" . $this->evaluation['idCourses'] . "'/>";
        $html .= "<input type='hidden' id='idEvaluations' name='idEvaluations' value='" . $this->evaluation['idEvaluations'] . "'/>";
        for ($i = 0, $c = count($this->template->avaliacao->itens); $i < $c; $i++) {
            $html .= "<br/><br/>";
            $html .= "<h4 class='major'>" . $this->template->avaliacao->itens[$i]->tema . "</h4><div class='field'>";
            if (property_exists($this->template->avaliacao->itens[$i], 'itens')) {
                for ($j = 0, $sc = count($this->template->avaliacao->itens[$i]->itens); $j < $sc; $j++) {
                    if ($this->template->avaliacao->itens[$i]->itens[$j]->tema != 'name') {
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                $html .= $this->radio(
                                        $this->template->avaliacao->itens[$i]->itens[$j]->tema . '-avaliacao', $this->template->avaliacao->itens[$i]->itens[$j]->tema, $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo, $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response ?? null);
                            }
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->tipo == 'longText') {
                                $html .= $this->textArea(
                                        $this->template->avaliacao->itens[$i]->itens[$j]->tema . '-pontos_positivos', $this->template->avaliacao->itens[$i]->itens[$j]->tema, $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->intervalo, $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response ?? null);
                            }
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->tipo == 'longText') {
                                $html .= $this->textArea(
                                        $this->template->avaliacao->itens[$i]->itens[$j]->tema . '-pontos_a_melhorar', $this->template->avaliacao->itens[$i]->itens[$j]->tema, $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->intervalo, $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response ?? null);
                            }
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                            if ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->tipo == 'longText') {
                                $html .= $this->textArea(
                                        $this->template->avaliacao->itens[$i]->itens[$j]->tema . '-recomendacoes', $this->template->avaliacao->itens[$i]->itens[$j]->tema, $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->intervalo, $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response ?? null);
                            }
                        }
                    }
                    else {
                        if ($this->template->avaliacao->itens[$i]->tema == 'Formadores') {
                            $listaFormadores = Formadores::listaFormadores($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaFormadores); $k < $f; $k++) {
                                $formador                  = $listaFormadores[$k];
                                $parts                     = explode(' ', $formador['name']);
                                $formador['firstLastName'] = $parts[0] . ' ' . $parts[count($parts) - 1];
                                $html                      .= "<br/>";
                                $html                      .= "<h4 class='major'>" . $formador['firstLastName'] . "</h4><div class='field'>";
                                $html                      .= "<input type='hidden' name='formadores_" . $formador['idUsers'] . "_" . $formador['type'] . "'/>";

                                $temas = "";
                                if ($this->target == 'Formador') {
                                    $temas = ['Direção de Curso', 'Participação no Curso',
                                        'Clareza na Exposição', 'Domínio no assunto',
                                        'Métodos e técnicas utilizadas', 'Relacionamento com os formandos', 'Acompanhameno de estágios'];
                                }
                                else {
                                    $temas = ['Clareza na Exposição',
                                        'Domínio do assunto',
                                        'Métodos e técnicas utilizadas',
                                        'Relacionamento com os formandos'];
                                }

                                foreach ($temas as $temas) {
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                            $html .= $this->radio(
                                                    'formador-avaliacao-' . $temas . '-' . $formador['idUsers'], $temas, $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('formador-avaliacao-' . $temas . '-' . $formador['idUsers'])} ?? null));
                                        }
                                    }

                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                    'formador-pontos_positivos-' . $temas . '-' . $formador['idUsers'], $temas, $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('formador-pontos_positivos-' . $temas . '-' . $formador['idUsers'])} ?? null));
                                        }
                                    }
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                    'formador-pontos_a_melhorar-' . $temas . '-' . $formador['idUsers'], $temas, $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('formador-pontos_a_melhorar-' . $temas . '-' . $formador['idUsers'])} ?? null));
                                        }
                                    }
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                                        if ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->tipo == 'longText') {
                                            $html .= $this->textArea(
                                                    'formador-recomendacoes-' . $temas . '-' . $formador['idUsers'], $temas, $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('formador-recomendacoes-' . $temas . '-' . $formador['idUsers'])} ?? null));
                                        }
                                    }
                                }
                            }
                        }

                        if ($this->template->avaliacao->itens[$i]->tema == 'Módulos') {
                            $listaModulos = Cursos::listaModulos($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaModulos); $k < $f; $k++) {
                                $modulo = $listaModulos[$k];
                                $html   .= "<br/>";
                                $html   .= "<h4 class='major'>" . $modulo['name'] . "</h4><div class='field'>";
                                $html   .= "<input type='hidden' name='modulo_" . $modulo['idModules'] . "'/>";
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->tipo == 'range') {
                                        $html .= $this->radio(
                                                'modulo-avaliacao-' . $modulo['name'] . '-' . $modulo['idModules'], '', $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('modulo-avaliacao-' . $modulo['name'] . '-' . $modulo['idModules'])} ?? null));
                                    }
                                }
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->tipo == 'longText') {
                                        $html .= $this->textArea(
                                                'modulo-pontos_positivos-' . $modulo['name'] . '-' . $modulo['idModules'], '', $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('modulo-pontos_positivos-' . $modulo['name'] . '-' . $modulo['idModules'])} ?? null));
                                    }
                                }
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->tipo == 'longText') {
                                        $html .= $this->textArea(
                                                'modulo-pontos_a_melhorar-' . $modulo['name'] . '-' . $modulo['idModules'], '', $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('modulo-pontos_a_melhorar-' . $modulo['name'] . '-' . $modulo['idModules'])} ?? null));
                                    }
                                }
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                                    if ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->tipo == 'longText') {
                                        $html .= $this->textArea(
                                                'modulo-recomendacoes-' . $modulo['name'] . '-' . $modulo['idModules'], '', $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->intervalo, ($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('modulo-recomendacoes-' . $modulo['name'] . '-' . $modulo['idModules'])} ?? null));
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $html .= "</div>";
        }
        return $html;
    }

    function radio($idInput, $nome, $intervalo, $selecionado): string {
        $tag   = "<div class='row uniform'><div><label for='" . ENFIM::cleanString($idInput) . "'>$nome</label>";
        $range = explode('-', $intervalo);
        for ($i = $range[0]; $i <= $range[1]; $i++) {
            $tag .= "<input type='radio' id='" . ENFIM::cleanString($idInput) . "-$i' name='" . ENFIM::cleanString($idInput) . "' value='$i' " . ($selecionado == $i ? "checked=''" : "") . ">"
                    . "<label for='" . ENFIM::cleanString($idInput) . "-$i'>$i</label>";
        }
        $tag .= "</div></div>";
        return $tag;
    }

    function textArea($idInput, $nome, $intervalo, $selecionado): string {
        if (strpos($idInput, 'pontos_positivos') !== false) {
            $nome = "Pontos positivos";
        }
        elseif (strpos($idInput, 'pontos_a_melhorar') !== false) {
            $nome = "Pontos a melhorar";
        }
        else {
            $nome = "Recomendações";
        }
        $tag   = "<div class='row uniform'><div><label for='" . ENFIM::cleanString($idInput) . "'>$nome</label>";
        $range = explode('-', $intervalo);
        $tag   .= "<textarea cols = '$range[1]' rows = '$range[0]' name = '" . ENFIM::cleanString($idInput) . "' id = '" . ENFIM::cleanString($idInput) . "' style = 'width: 630px'>$selecionado</textarea>";
        $tag   .= "</div></div>";
        return $tag;
    }

    function saveEvaluation($template, $responses) {
        $this->template = json_decode($template);

        for ($i = 0, $c = count($this->template->avaliacao->itens); $i < $c; $i++) {
            if (property_exists($this->template->avaliacao->itens[$i], 'itens')) {
                for ($j = 0, $sc = count($this->template->avaliacao->itens[$i]->itens); $j < $sc; $j++) {
                    if ($this->template->avaliacao->itens[$i]->itens[$j]->tema != 'name') {
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema . '-avaliacao')] ?? "");
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema . '-pontos_positivos')] ?? "");
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema . '-pontos_a_melhorar')] ?? "");
                        }
                        if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                            $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response = ($responses[ENFIM::cleanString($this->template->avaliacao->itens[$i]->itens[$j]->tema . '-recomendacoes')] ?? "");
                        }
                    }
                    else {
                        if ($this->template->avaliacao->itens[$i]->tema == 'Formadores') {
                            $listaFormadores = Formadores::listaFormadores($this->evaluation['idCourses']);
                            for ($k = 0, $f = count($listaFormadores); $k < $f; $k++) {
                                $formador                  = $listaFormadores[$k];
                                $parts                     = explode(' ', $formador['name']);
                                $formador['firstLastName'] = $parts[0] . ' ' . $parts[count($parts) - 1];
                                $temas                     = "";
                                if ($this->target == 'Formador') {
                                    $temas = ['Direção de Curso', 'Participação no Curso',
                                        'Clareza na Exposição', 'Domínio no assunto',
                                        'Métodos e técnicas utilizadas', 'Relacionamento com os formandos', 'Acompanhameno de estágios'];
                                }
                                else {
                                    $temas = ['Clareza na Exposição',
                                        'Domínio do assunto',
                                        'Métodos e técnicas utilizadas',
                                        'Relacionamento com os formandos'];
                                }
                                foreach ($temas as $temas) {
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'avaliacao')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-avaliacao-' . $temas . '-' . $formador['idUsers']), $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao, 'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('formador-avaliacao-' . $temas . '-' . $formador['idUsers'])} = $responses[ENFIM::cleanString('formador-avaliacao-' . $temas . '-' . $formador['idUsers'])];
                                        }
                                    }

                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-pontos_positivos-' . $temas . '-' . $formador['idUsers']), $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos, 'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('formador-pontos_positivos-' . $temas . '-' . $formador['idUsers'])} = $responses[ENFIM::cleanString('formador-pontos_positivos-' . $temas . '-' . $formador['idUsers'])];
                                        }
                                    }
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-pontos_a_melhorar-' . $temas . '-' . $formador['idUsers']), $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar, 'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('formador-pontos_a_melhorar-' . $temas . '-' . $formador['idUsers'])} = $responses[ENFIM::cleanString('formador-pontos_a_melhorar-' . $temas . '-' . $formador['idUsers'])];
                                        }
                                    }
                                    if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                                        if (array_key_exists(ENFIM::cleanString('formador-recomendacoes-' . $temas . '-' . $formador['idUsers']), $responses)) {
                                            if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes, 'response')) {
                                                $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response = (object) null;
                                            }
                                            $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('formador-recomendacoes-' . $temas . '-' . $formador['idUsers'])} = $responses[ENFIM::cleanString('formador-recomendacoes-' . $temas . '-' . $formador['idUsers'])];
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
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->avaliacao, 'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->avaliacao->response->{ENFIM::cleanString('modulo-avaliacao-' . $modulo['name'] . '-' . $modulo['idModules'])} = ($responses[ENFIM::cleanString('modulo-avaliacao-' . $modulo['name'] . '-' . $modulo['idModules'])] ?? "");
                                }

                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_positivos')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos, 'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_positivos->response->{ENFIM::cleanString('modulo-pontos_positivos-' . $modulo['name'] . '-' . $modulo['idModules'])} = ($responses[ENFIM::cleanString('modulo-pontos_positivos-' . $modulo['name'] . '-' . $modulo['idModules'])] ?? "");
                                }

                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'pontos_a_melhorar')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar, 'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->pontos_a_melhorar->response->{ENFIM::cleanString('modulo-pontos_a_melhorar-' . $modulo['name'] . '-' . $modulo['idModules'])} = ($responses[ENFIM::cleanString('modulo-pontos_a_melhorar-' . $modulo['name'] . '-' . $modulo['idModules'])] ?? "");
                                }
                                if (property_exists($this->template->avaliacao->itens[$i]->itens[$j], 'recomendacoes')) {
                                    if (!property_exists($this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes, 'response')) {
                                        $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response = (object) null;
                                    }
                                    $this->template->avaliacao->itens[$i]->itens[$j]->recomendacoes->response->{ENFIM::cleanString('modulo-recomendacoes-' . $modulo['name'] . '-' . $modulo['idModules'])} = ($responses[ENFIM::cleanString('modulo-recomendacoes-' . $modulo['name'] . '-' . $modulo['idModules'])] ?? "");
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->template;
    }

    static function evaluationReport(/* $data */) {
        $query      = "SELECT * FROM
(SELECT
	ce.idEvaluations,
    ce.idCourses,
    ce.idCourse,
    ce.date,
    e.target,
    ce.evaluation,
    cs.year,
    cs.course,
    c.name,
    (SELECT count(*) FROM courses_evaluations ce1 WHERE ce1.evaluation IS NULL) as incompleto,
    (SELECT count(*) FROM courses_evaluations ce1 WHERE ce1.evaluation IS NOT NULL) as completo,
    (SELECT count(*) FROM courses_evaluations ce1) as total
FROM courses_evaluations ce
INNER JOIN evaluations e ON ce.idEvaluations=e.idEvaluations AND e.status='Ativo'
INNER JOIN courses cs ON ce.idCourses=cs.idCourses
INNER JOIN course c ON c.idCourse=cs.idCourse) t
WHERE
idEvaluations=89 AND
idCourses=1 AND
idCourse=1 AND
target='Formando' AND
year='2018' AND
course='CPF 00/2018' AND
name='Curso Preliminar de Formação' ";
        $con        = new Database ();
        $result     = $con->get($query);
        $evaluation = json_decode($result[0]['evaluation']);
        return $evaluation;
    }
}