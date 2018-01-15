<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="search" name="search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search"
               style="box-shadow: -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$modulo}&task=search&tab=utilizadores&search='+document.getElementById('search').value,'STutilizadores');">
            </a>
        </form>
    </ul>
    <ul class="actions" onclick="request('action={$modulo}&task=novo&tab=utilizadores','form');"
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
        {foreach $equipaExecutiva->utilizadores as $utilizadores}
            <tr>
                <td {if $utilizadores['status'] eq 'Inativo'}style="color: orangered;"{/if}>{$utilizadores['aepId']}</td>
                <td>{$utilizadores['name']}</td>
                <td>{$utilizadores['permission']}</td>
                <td>M:{$utilizadores['mobile']}&nbsp;T:{$utilizadores['telephone']}</td>
                <td>{$utilizadores['age']}</td>
                <td>{$utilizadores['iban']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$modulo}&task=ver&tab=utilizadores&idUsers={$utilizadores['idUsers']}','form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$modulo}&task=editar&tab=utilizadores&idUsers={$utilizadores['idUsers']}','form');"></a>
                    <a class="button small icon fa-eraser"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="request('action={$modulo}&task=apagar&tab=utilizadores&idUsers={$utilizadores['idUsers']}','STutilizadores');"> </a></td>

            </tr>
        {/foreach}
    </tbody>
</table>