<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}search" name="{$currentTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search" title="pesquisar"
               style="box-shadow{ 
                   -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
                   -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
                   box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); }
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&tab={$currentTab}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">novo</li>
    </ul>
</div>
<table>
    <thead>				
        <tr>
            <th>Ano</th>
            <th>Curso</th>
            <th>Data Início</th>
            <th>Local</th>
            <th>Vagas</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead><tbody>
        {foreach $equipaExecutiva->calendarios as $calendarios}						
            <tr>
                <td>{$calendarios['csYear']}</td>
                <td>{$calendarios['csCourse']}</td>
                <td>{$calendarios['csStartDate']}</td>
                <td>{$calendarios['csLocal']}</td>
                <td>{$calendarios['csVacancy']}</td>
                <td>{$calendarios['csStatus']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file" title="ver"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&idCourses={$calendarios['csIdCourses']}', 'form');"></a>
                    <a class="button small icon fa-edit" title="editar"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&idCourses={$calendarios['csIdCourses']}', 'form');"></a>
                    <a class="button small icon fa-eraser" title="apagar"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                                   $.when(request('action={$action}&task=apagar&tab={$currentTab}&idCourses={$calendarios['csIdCourses']}', '{$action}Msg')).
                                           then.(request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                               }"> </a></td>
            </tr>

        {/foreach}</tbody>
</table>