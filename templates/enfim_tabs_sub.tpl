{foreach $objTabs as $tabs}
    {foreach $tabs as $k=>$tab}
        <section class="features subTabs" id="ST{$tab->tab}"
                 style="display:
                 {if $k==0}
                     block
                 {else}
                     none
                 {/if}; width: 100%;">
                 {include file="enfim_"|cat:{$modulo}|cat:"_"|cat:{$tab->tab}|cat:".tpl"}
        </section>
    {/foreach}
{/foreach}