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
            <th>NrAssoc</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Contato</th>
            <th>Idade</th>
            <th>IBAN</th>
            <th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $servicosCentrais->utilizadores as $utilizadores}
            <tr>
                <td {if $utilizadores['status'] eq 'Inativo'}style="color: orangered;"{/if}>{$utilizadores['aepId']}</td>
                <td>{$utilizadores['name']}</td>
                <td>{$utilizadores['permission']}</td>
                <td>{$utilizadores['status']}</td>
                <td>M:{$utilizadores['mobile']}&nbsp;T:{$utilizadores['telephone']}</td>
                <td>{$utilizadores['age']}</td>
                <td>{$utilizadores['iban']}</td>
                <td class="actions" align="right">
                    <a
                        class="button small icon fa-key" title="renovar password"
                        style="cursor: pointer; padding: 0 0 0 5pt;
                        {if strpos($utilizadores['lastLogin'], '0000-00-00 00:00:00') !== false}background-color: red{/if}"
                        onclick="$.when(request('action={$action}&task=resetPassword&tab={$currentTab}&idUsers={$utilizadores['idUsers']}', '{$action}Msg'))
                                    .done(request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));"></a>
                    <a
                        class="button small icon fa-file" title="ver"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&idUsers={$utilizadores['idUsers']}', 'form');"></a>
                    <a class="button small icon fa-edit" title="editar"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&idUsers={$utilizadores['idUsers']}', 'form');"></a>
                    <a class="button small icon fa-eraser" title="apagar"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                                   $.when(request('action={$action}&task=apagar&tab={$currentTab}&idUsers={$utilizadores['idUsers']}', '{$action}Msg'))
                                           .done(request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                               }"></a>
                </td>

            </tr>
        {/foreach}
    </tbody>
</table>