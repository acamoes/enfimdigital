
{foreach $objTabs as $tabs}
    {foreach $tabs as $k=>$tab}
        <section class="features subTabs" id="ST{$tab->tab}"                 
                 style="display:                 
                 {if isset($tabActive)}
                     {if $tabActive=={$tab->tab}}
                         block
                         {else}
                             none
                         {/if}                     
                 {elseif !isset($tabActive) && $k==0}
                     block
                 {else}
                     none
                 {/if}; width: 100%;">
                 {assign var="currentTab" value="{$tab->tab}"}
                 {include file="enfim_"|cat:{$modulo}|cat:"_"|cat:{$tab->tab}|cat:".tpl"}
        </section>
    {/foreach}
{/foreach}