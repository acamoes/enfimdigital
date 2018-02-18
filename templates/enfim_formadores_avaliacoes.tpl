<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}search" name="{$currentTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search" title="pesquisar"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">
            </a>
        </form>

    </ul>
    <ul class="actions" onclick="if (confirm('Tem a certeza que pretende alterar o estado das avaliações?')) {
                $.when(request('action={$action}&task=fecharAvaliacoes&tab={$currentTab}&idCourses={$idCourses}', '{$action}Msg')).
                        then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
            }"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Alterar estado das avaliações</li>&nbsp;
    </ul>
    <ul class="actions" onclick="if (confirm('Pretende distribuir as avaliações para todos os formandos?')) {
                $.when(request('action={$action}&task=distribuirAvaliacoes&tab={$currentTab}&idCourses={$idCourses}', '{$action}Msg')).
                        then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
            }"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Distribuir avaliações</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Alvo</th>
            <th>Nome</th>
            <th>Respondido</th>
            <th>Estado</th>
        </tr>
    </thead>		
    <tbody>
        {foreach $formadores->avaliacoes as $avaliacoes}
            <tr>
                <td {if $avaliacoes['target'] eq 'Formador'}style='background-color: yellowgreen;color: black;font-weight: bold '{/if}>{$avaliacoes['target']}</td>
                <td>{$avaliacoes['name']}</td>
                <td>{$avaliacoes['response']}</td>
                <td>{$avaliacoes['status']}</td>                
            </tr>
        {/foreach}
    </tbody>
</table>