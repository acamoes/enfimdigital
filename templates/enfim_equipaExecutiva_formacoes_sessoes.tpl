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
               onclick="request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions"
        onclick="if (confirm('Tem a certeza que pretende restaurar?\nTodo o conteúdo será apagado e reposto.')) {
                    request('action={$action}&task=restaurar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', '{$action}Msg');
                    request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');
                }"
        style="float: right; padding-left:10px;padding-right:10px;">
        <li class="button small"
            style="cursor: pointer; padding: 0 10px 0 10px">restaurar</li>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">novo</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Módulo</th>
            <th>Duração (m)</th>
            <th>Tipo</th>
            <th>Formador</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $equipaExecutiva->contexto['formacoes']['sessoes'] as $sessoes}
            <tr>
                <td {if $sessoes['status'] != 'Fechado'}style="color: orangered;"{/if}>{$sessoes['name']}</td>
                <td>{$sessoes['duration']}</td>
                <td class="actions" align="left">{$sessoes['type']}</td>
                <td class="actions" align="left">{$sessoes['formador']}</td>
                <td class="actions" align="right">
                    <a  class="button small icon fa-user" title="adicionar formador"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="
                                document.getElementById('smallForm').style.top = event.screenY + 'px';
                                document.getElementById('smallForm').style.left = (event.screenX - 150) + 'px';
                                request('action={$action}&task=novo&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idModules={$sessoes['idModules']}&idCourse={$sessoes['idCourse']}&searchUtilizadores=1', 'smallForm');"></a>
                    {if $sessoes['name'] eq 'DIREÇÃO' || $users->permission eq 'Equipa Executiva'}
                        <a class="button small icon fa-edit" title="editar"
                           style="cursor: pointer; padding: 0 0 0 5pt"
                           onclick="request('action={$action}&task=editar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idModules={$sessoes['idModules']}&idCourse={$sessoes['idCourse']}', 'form');"></a>
                        <a class="button small icon fa-eraser" title="apagar"
                           style="cursor: pointer; padding: 0 0 0 5pt"                       
                           onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                                       $.when(request('action={$action}&task=apagar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idModules={$sessoes['idModules']}&idCourse={$sessoes['idCourse']}', '{$action}Msg')).
                                               then(request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}'));}"></a>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>