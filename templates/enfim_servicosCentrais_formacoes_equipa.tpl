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
</div>
<table>
    <thead>
        <tr>
            <th>AEP</th>
            <th>Nome</th>
            <th>Colaboração</th>
            <th>Email</th>
            <th>Mobile</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $servicosCentrais->contexto['formacoes']['equipa'] as $equipa}
            <tr>
                <td>{$equipa['aepId']}</td>
                <td>{$equipa['name']}</td>
                <td>{$equipa['type']}</td>
                <td class="actions" align="left">
                    <a class="button big icon fa-envelope"
                       style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                       title="{$equipa['email']}"></a>{$equipa['email']}</td>
                <td class="actions" align="right">
                    <a class="button big icon fa-mobile-phone"
                       style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                       title="{$equipa['mobile']}"></a>{$equipa['mobile']}</td>
                <td class="actions" align="right">
                    <a class="button small icon fa-file" title="ver"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=ver&tab={$currentTab}&subTab={$currentSubTab}&servicosCentraisFormacoesIdCourses={$servicosCentraisFormacoesIdCourses}&idUsers={$equipa['idUsers']}', 'form');"></a>                    
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>