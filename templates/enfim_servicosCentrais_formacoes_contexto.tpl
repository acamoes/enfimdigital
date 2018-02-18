<div class="row uniform" style="padding-left: 30px; padding-top: 20px">
    {foreach $objSubTabs as $subTabs}
        {foreach $subTabs as $k=>$subTab}
            <h4 class="major subTabs" id="{$currentTab}{$subTab->tab}"
                onclick="openSubTab('{$currentTab}{$subTab->tab}', 'SST');"
                style="
                {if $k==0}border-bottom:6px solid #77f; color:#77f;
                {else}border-bottom: 6px solid #ccc; color: #ccc;
                {/if}
                cursor: pointer; width: 100px; white-space: nowrap; margin-right: 10px; padding-left: 0px; padding-bottom: 2px">
                {$subTab->text|capitalize}</h4>
            {/foreach}
        {/foreach}
</div>
<section>
    <div class="row uniform">
        <div style="width:100%">
            {foreach $objSubTabs as $subTabs}
                {foreach $subTabs as $k=>$subTab}
                    <section class="features subTabsBox" id="SST{$currentTab}{$subTab->tab}"                 
                             style="display:    
                             {if isset($subTabActive)}
                                 {if $subTabActive=={$subTab->tab}}
                                     block
                                 {else}
                                     none
                                 {/if}                     
                             {elseif !isset($subTabActive) && $k==0}
                                 block
                             {else}
                                 none
                             {/if}; width: 100%;">
                        {assign var="currentSubTab" value="{$subTab->tab}" scope=global}
                        {assign var="currentSubTabText" value="{$subTab->text}" scope=global}
                        {include file="enfim_"|cat:{$action}|cat:"_"|cat:{$currentTab}|cat:"_"|cat:{$currentSubTab}|cat:".tpl"}
                    </section>
                {/foreach}
            {/foreach}
        </div>
    </div>
</section>
