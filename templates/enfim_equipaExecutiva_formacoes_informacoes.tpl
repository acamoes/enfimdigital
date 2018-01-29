<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}{$currentSubTab}search" name="{$currentTab}{$currentSubTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search" title="pesquisar"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&docType=Informações&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Novo</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Documento</th>
            <th>Ficheiro</th>
            <th>Estado</th>
            <th>Informações</th>
            <th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->contexto['formacoes']['informacoes'] as $informacoes}
            <tr>
                <td>{$informacoes['name']}</td>
                <td style="overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    -o-text-overflow: ellipsis;">{$informacoes['document']}</td>
                <td {if $informacoes['status'] neq 'Ativo'}style="color: orangered;"{/if}>{$informacoes['status']}</td>
                <td>
                    {if $informacoes['ext']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$informacoes['idInformations']}&filePos=5'" 
                           class="icon fa-file{if $informacoes['ext']=='pdf'}-pdf-o{elseif $informacoes['ext']=='zip'}-zip-o{/if}" 
                           title="{$informacoes['document']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file" title="ver"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idInformations={$informacoes['idInformations']}', 'form');"></a>
                    <a class="button small icon fa-edit" title="editar"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idInformations={$informacoes['idInformations']}', 'form');"></a>
                    <a class="button small icon fa-eraser" title="apagar"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                           $.when(request('action={$action}&task=apagar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idInformations={$informacoes['idInformations']}', '{$action}Msg')).
                           then(request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value, 'SST{$currentTab}{$currentSubTab}'));}"> </a>                   
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>