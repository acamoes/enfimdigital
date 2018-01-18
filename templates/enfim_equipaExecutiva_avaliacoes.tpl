<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}search" name="{$currentTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
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
            <th>Curso</th>
            <th>Nome</th>
            <th>Alvo</th>
            <th>Estado</th>
            <th>Data</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $equipaExecutiva->avaliacoes as $avaliacoes}						
            <tr>
                <td>{$avaliacoes['curso']}</td>
                <td>{$avaliacoes['name']}</td>
                <td>{$avaliacoes['target']}</td>
                <td {if $avaliacoes['status'] eq 'Inativo'}style="color: orangered;"{/if}>{$avaliacoes['status']}</td>
                <td>{$avaliacoes['dateExecutiva']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&idEvaluations={$avaliacoes['idEvaluations']}', 'form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&idEvaluations={$avaliacoes['idEvaluations']}', 'form');"></a>
                    <a class="button small icon fa-eraser"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                                   request('action={$action}&task=apagar&tab={$currentTab}&idEvaluations={$avaliacoes['idEvaluations']}', '{$action}Msg');
                                   request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');}"> </a></td>
            </tr>
        {/foreach}
    </tbody>
</table>