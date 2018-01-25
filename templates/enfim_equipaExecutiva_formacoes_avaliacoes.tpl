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
               onclick="request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search='+document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value,'SST{$currentTab}{$currentSubTab}');">
            </a>
        </form>
            
    </ul>
    <ul class="actions" onclick="if (confirm('Tem a certeza que pretende alterar o estado das avaliações?')) {
        $.when(request('action={$action}&task=fecharAvaliacoes&tab={$currentTab}&subTab={$currentSubTab}&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value,'form')).
        then(request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search='+document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value,'SST{$currentTab}{$currentSubTab}'));}"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Alterar estado das avaliações</li>&nbsp;
    </ul>
    <ul class="actions" onclick="if (confirm('Pretende distribuir as avaliações para todos os formandos?')) {
        $.when(request('action={$action}&task=distribuirAvaliacoes&tab={$currentTab}&subTab={$currentSubTab}&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value,'form')).
        then(request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search='+document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value,'SST{$currentTab}{$currentSubTab}'));}"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Distribuir avaliações</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Respondido</th>
            <th>Estado</th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->contexto['formacoes']['avaliacoes'] as $avaliacoes}
            <tr>
                <td>{$avaliacoes['name']}</td>
                <td>{$avaliacoes['response']}</td>
                <td>{$avaliacoes['status']}</td>                
            </tr>
        {/foreach}
    </tbody>
</table>