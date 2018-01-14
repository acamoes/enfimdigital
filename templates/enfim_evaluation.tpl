{include file="enfim_header_out.tpl"}
<section id="wrapper">
    <header>
        <h2>Avaliação Final</h2>
        <h8 style="
                color: #ffffff;
		font-family: Raleway, Helvetica, sans-serif;
		font-weight: 700;
		letter-spacing: 0.1em;
		text-transform: uppercase;
                font-size: 0.7em;
                line-height: 2;
                text-indent: 50px;
                text-align: justify;
                text-justify: auto;
                margin: 10px 120px 20px 120px;">Os resultados desta avaliação permitem à Escola Nacional de Formação de Insígnia de Madeira recolher dados que ajudam a manter os seus cursos adequados à realidade da AEP e a corrigir as eventuais falhas que ocorrem. É por isso de grande importância que esta avaliação seja preenchida de forma cuidadosa e sincera. O preenchimento é individual e deve refletir a opinião do participante. O preenchimento do campo de identificação é opcional. "Na linha de cada parâmetro deve ser colocado o valor que reflete a avaliação desses parâmetro (sendo que 1 corresponderá a "mau" e 5 a "óptimo")."</h8>
    </header>
    <div id="wrapper">
        <div id="one" class="wrapper spotlight left style2">
            <div class="inner">
                <div class="content">
                    <h2 class="major">{$title}</h2><h3 class="alert">{$error}</h3>
                    <form method="post" action="{$SCRIPT_NAME}?action=formandos&task=saveEvaluation" id="saveEvaluation">
                            {$html}                              
                        <ul class="actions">
                            <li><input type="submit" name="submit" id="submit" value="Submeter"></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
{include file="enfim_footer.tpl"}

