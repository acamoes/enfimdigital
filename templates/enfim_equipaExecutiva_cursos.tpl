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
               onclick="request('action={$modulo}&task=search&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions" onclick="request('action={$modulo}&task=novo&tab={$currentTab}','form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">novo</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Nome</th>
				<th>Nivel</th>
				<th>Estágio</th>
				<th>Estado</th>
				<th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->cursos as $cursos}
            <tr>
                <td>{$cursos['name']}</td>
                <td>{$cursos['level']}</td>
                <td>{$cursos['internship']}</td>
                <td {if $cursos['status'] eq 'Inativo'}style="color: orangered;"{/if}>{$cursos['status']}</td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$modulo}&task=ver&tab={$currentTab}&idCourse={$cursos['idCourse']}','form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$modulo}&task=editar&tab={$currentTab}&idCourse={$cursos['idCourse']}','form');"></a>
                    <a class="button small icon fa-eraser"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="request('action={$modulo}&task=apagar&tab={$currentTab}&idCourse={$cursos['idCourse']}','{$modulo}Msg');
                                request('action={$modulo}&task=search&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}');"> </a></td>
            </tr>
        {/foreach}
    </tbody>
</table>