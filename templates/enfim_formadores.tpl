{include file="enfim_header.tpl"}
<section id="wrapper">
    <header>
        <h2>{$formadores->curso}</h2>
    </header>
    <div class="wrapper">
        <div class="inner">
            <div class="wrapper">
                <div class="inner" style="margin-left: 1em;">
                    <div class="row uniform" style="width: 100%">
                        <div style="float: left; margin-left: -1em">
                            <label for="name">Curso</label> <input required name="{$action}"
                                                                   id="{$action}" type="hidden" value="{$formadores->idCourse}" />
                        </div>
                        <div style="float: right; margin-left: -1em; cursor: pointer" id="{$action}Msg" onclick="this.innerHTML = '';"></div>
                    </div>
                    <div class="row uniform" style="padding-left: 10px">
                        {foreach $objTabs as $tabs}
                            {foreach $tabs as $k=>$tab}
                                <h4 class="major tabs" id="{$tab->tab}"
                                    onclick="openTab('{$tab->tab}', 'ST');"
                                    style="
                                    {if $k==0}border-bottom:6px solid #77f; color:#77f;
                                    {else}border-bottom: 6px solid #ccc; color: #ccc;
                                    {/if}
                                    cursor: pointer; width: 100px; white-space: nowrap; margin-right: 10px; padding-left: 0px; padding-bottom: 2px">
                                    {$tab->text|capitalize}</h4>
                                {/foreach}
                            {/foreach}
                    </div>
                </div>
                <section id="subForm" style="width: 100%;">
                    {include file="enfim_tabs.tpl"}
                </section>
            </div>									
        </div>
    </div>
</section>
{include file="enfim_footer.tpl"}