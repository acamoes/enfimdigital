<div class="table-wrapper">
</div>
{foreach from=$formadores->relatorios key=titulo item=relatorio}
    <h5>{$titulo}</h5>    
    {foreach from=$relatorio key=itemTitulo item=$item}
        <h5 class='major'>::>{$itemTitulo}</h5><br/><br/>
        {if {$itemTitulo}!='Formadores'}
            {foreach from=$item key=subItemTitulo item=$subItem}
                <div class='row uniform'>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:200px'>
                        <h5>::::>{if isset($subItem['modulo'])}{$subItem['modulo']}{else}{$subItemTitulo}{/if}</h5>
                        <div class="w3-progress-container w3-small w3-round" style="width:100px">
                            <div class="w3-progressbar w3-green w3-round" style="width:{($subItem['respostas']/$subItem['contador'])/5*100}%; coursor:pointer" title="{$subItem['respostas']/$subItem['contador']}">
                            </div>
                        </div>
                        Média: {$subItem['respostas']/$subItem['contador']}<br/><br/>
                    </div>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:400px'>
                        <h6>Pontos positivos</h6>
                        <blockquote>{$subItem['positivos']|replace:'\r\n#':'<br/>'}</blockquote>
                    </div>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:400px'>
                        <h6>Pontos a melhorar</h6>
                        <blockquote>{$subItem['melhorar']|replace:'\r\n#':'<br/>'}</blockquote>                    
                    </div>
                </div>
            {/foreach}
        {else}
            {foreach from=$item key=subItemTitulo item=$subItem}
                {assign var=iterator value=0}
                {foreach from=$subItem key=subSubItemTitulo item=$subSubItem}
                    {if $iterator eq 0}<h5 class='major'>::>{$subSubItem['formador']}</h5><br/><br/>{/if}                      
                    <div class='row uniform'>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:200px'>
                        <h5>::::>{$subSubItemTitulo}</h5>
                        <div class="w3-progress-container w3-small w3-round" style="width:100px">
                            <div class="w3-progressbar w3-green w3-round" style="width:{($subSubItem['respostas']/$subSubItem['contador'])/5*100}%; coursor:pointer" title="{$subSubItem['respostas']/$subSubItem['contador']}">
                            </div>
                        </div>
                        Média: {$subSubItem['respostas']/$subSubItem['contador']}<br/><br/>
                    </div>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:400px'>
                        <h6>Pontos positivos</h6>
                        <blockquote>{$subSubItem['positivos']|replace:'\r\n#':'<br/>'}</blockquote>
                    </div>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:400px'>
                        <h6>Pontos a melhorar</h6>
                        <blockquote>{$subSubItem['melhorar']|replace:'\r\n#':'<br/>'}</blockquote>                    
                    </div>
                </div>
                    {$iterator=$iterator+1}
                {/foreach}
            {/foreach}
        {/if}
    {/foreach}

{/foreach}