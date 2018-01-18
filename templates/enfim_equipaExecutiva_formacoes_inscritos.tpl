<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}{$currentSubTab}search" name="{$currentTab}{$currentSubTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses='+document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">
            </a>
        </form>
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
            <th>AEP</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Mobile</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $equipaExecutiva->contexto['formacoes']['inscritos'] as $inscritos}
            <tr>
                <td>{$inscritos['aepId']}</td>
                <td>{$inscritos['name']}</td>
                <td class="actions" align="left"><a
                        class="button big icon fa-envelope"
                        style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                        title="{$inscritos['email']}"></a>{$inscritos['email']}</td>
                <td class="actions" align="right"><a
                        class="button big icon fa-mobile-phone"
                        style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                        title="{$inscritos['mobile']}"></a>{$inscritos['mobile']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idUsers={$inscritos['idUsers']}','form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idUsers={$inscritos['idUsers']}','form');"></a>
                    <a class="button small icon fa-eraser"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                           request('action={$action}&task=apagar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idUsers={$inscritos['idUsers']}','{$action}Msg');
                       request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses='+document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');}"></a>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>