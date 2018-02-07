<section id="wrapper">
    <div class="wrapper">
        <div class="inner" style="margin-left: 1em;">
            <div class="row uniform" style="width: 100%">
                <div style="float: left; margin-left: -1em">
                    <label for="name">Formações</label> 
                    <input name="{$action}{$currentTab}" id="{$action}{$currentTab}" type="hidden" value="" />
                    <select name="{$action}{$currentTab}IdCourse"
                            id="{$action}{$currentTab}IdCourse" style="width: 250px" 
                            onChange="request('action={$action}&task=contexto&tab={$currentTab}&{$action}{$currentTab|ucfirst}IdCourses=' + this.options[this.selectedIndex].value, 'subSubForm');">
                        <option value="" selected></option>
                        {foreach $equipaExecutiva->calendarios as $calendarios}
                            <option 
                                {if $calendarios['csStatus'] eq 'Inativo'}style="color: orangered;"{/if}
                                value="{$calendarios['csIdCourses']}" data-sigla="{$calendarios['csCourse']}">{$calendarios['csCourse']}</option>
                        {/foreach}
                    </select>
                </div>
                <div style="float: right; margin-left: -1em; cursor: pointer" id="{$action}{$currentTab}Msg" onclick="this.innerHTML = '';"></div>
            </div>            
        </div>
        <section id="subSubForm" style="width: 100%;">
            {if isset($equipaExecutivaFormacoesIdCourse)}
                {include file="enfim_equipaExecutiva_formacoes_contexto.tpl"}
            {/if}
        </section>
    </div>	
</section>



