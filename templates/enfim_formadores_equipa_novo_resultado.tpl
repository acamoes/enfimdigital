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
        {foreach $resultadoEquipa as $equipa}
            <tr>
                <td>{$equipa['aepId']}</td>
                <td style="word-wrap: break-word">{$equipa['name']}</td>
                <td>{$equipa['permission']}</td>
                <td class="actions" align="right"><a
                        class="button big icon fa-envelope"
                        style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                        title="{$equipa['email']}"></a></td>
                <td class="actions" align="right"><a
                        class="button big icon fa-mobile-phone"
                        style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
                        title="{$equipa['mobile']}"></a></td>
                <td class="actions" align="right"><a
                        class="button small icon fa-plus-circle"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="$.when(request('action={$action}&task=adicionar&tab={$currentTab}&idCourses={$idCourses}&idUsers={$equipa['idUsers']}&searchUtilizadores=' + document.getElementById('searchUtilizadores').value, 'formMsg')).
                                        then(request('action={$action}&task=novo&tab={$currentTab}&idCourses={$idCourses}&searchUtilizadores=' + document.getElementById('searchUtilizadores').value, 'resultado{$currentTab|ucfirst}'));"></a>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>