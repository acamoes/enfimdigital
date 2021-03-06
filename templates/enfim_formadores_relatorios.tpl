<div class="table-wrapper">
</div>
{foreach from=$formadores->relatorios key=titulo item=relatorio}
    <div class="button special fit" onclick="if(document.getElementById('{$titulo|escape}').style.display=='none')
            {ldelim}
                document.getElementById('{$titulo|escape}').style.display='block';
            {rdelim}
            else {ldelim}
                document.getElementById('{$titulo|escape}').style.display='none';
            {rdelim}">{$titulo}</div>
    <div id="{$titulo|escape}" style="display: none">
    {foreach from=$relatorio key=itemTitulo item=$item}
        <h5 class='major'>::>{$itemTitulo}</h5><br/><br/>
        {if {$itemTitulo}!='Formadores'}
            {foreach from=$item key=subItemTitulo item=$subItem}
                <div class='row uniform'>
                    <div style='float: left; padding: 5px 5px 5px 5px; width:200px'>
                        <h5>::::>{if isset($subItem['modulo'])}{$subItem['modulo']}{else}{$subItemTitulo}{/if}</h5>
                        <div class="w3-progress-container w3-small w3-round" style="width:100px">
                            <div class="w3-progressbar w3-green w3-round" 
                                 style="width:{if $subItem['contador']!=0}{($subItem['respostas']/$subItem['contador'])/5*100}{else}0{/if}%; coursor:pointer" 
                                 title="{if $subItem['contador']!=0}{$subItem['respostas']/$subItem['contador']}{else}0{/if}">
                            </div>
                        </div>
                        Média: {if $subItem['contador']!=0}{{$subItem['respostas']/$subItem['contador']}|string_format:"%.2f"}{else}0{/if}<br/><br/>
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
                            <div class="w3-progressbar w3-green w3-round" 
                                 style="width:{if $subSubItem['contador']!=0}{($subSubItem['respostas']/$subSubItem['contador'])/5*100}{else}0{/if}%; coursor:pointer" 
                                 title="{if $subSubItem['contador']!=0}{$subSubItem['respostas']/$subSubItem['contador']}{else}0{/if}">
                            </div>
                        </div>
                        Média: {if $subSubItem['contador']!=0}{{$subSubItem['respostas']/$subSubItem['contador']}|string_format:"%.2f"}{else}0{/if}<br/><br/>
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
    </div>
{/foreach}