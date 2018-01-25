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
            <th>AEP</th>
            <th>Nome</th>
            <th>Colaboração</th>
            <th>Email</th>
            <th>Mobile</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach $formadores->equipa as $equipa}
            <tr>
                <td>{$equipa['aepId']}</td>
                <td>{$equipa['name']}</td>
                <td>{$equipa['type']}</td>
                <td class="actions" align="left"><a
                        class="button big icon fa-envelope"
                        style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                        title="{$equipa['email']}"></a>{$equipa['email']}</td>
                <td class="actions" align="right"><a
                        class="button big icon fa-mobile-phone"
                        style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                        title="{$equipa['mobile']}"></a>{$equipa['mobile']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&idUsers={$equipa['idUsers']}', 'form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&idUsers={$equipa['idUsers']}', 'form');"></a>                    
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>