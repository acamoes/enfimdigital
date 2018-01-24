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
               onclick="request('action={$action}&task=search&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&tab={$currentTab}','form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">novo</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Curso</th>
				<th>Ordem</th>
				<th>Módulo</th>
				<th>Tipo</th>
				<th>Duração</th>
				<th>Estado</th>
				<th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->modulos as $modulos}
            <tr>
                <td>{$modulos['sigla']}</td>
                <td>{$modulos['order']}</td>
                <td>{$modulos['modulo']}</td>
                <td>{$modulos['type']}</td>
                <td>{$modulos['duration']}</td>
                <td {if $modulos['status'] eq 'Inativo'}style="color: orangered;"{/if}>{$modulos['status']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&idModules={$modulos['idModules']}','form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&idModules={$modulos['idModules']}','form');"></a>
                    <a class="button small icon fa-eraser"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                           $.when(request('action={$action}&task=apagar&tab={$currentTab}&idModules={$modulos['idModules']}','{$action}Msg')).
                                then(request('action={$action}&task=search&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}'));}"> </a></td>

            </tr>
        {/foreach}
    </tbody>
        </table>