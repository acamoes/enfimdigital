<table>
	<thead>
		<tr>
			<th>AEP</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Mobile</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{foreach $resultadoInscritos as $inscritos}
			<tr>
			<td>{$inscritos['aepId']}</td>
			<td>{$inscritos['name']}</td>
			<td class="actions" align="right"><a
				class="button big icon fa-envelope"
				style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
				title="{$inscritos['email']}"></a></td>
			<td class="actions" align="right"><a
				class="button big icon fa-mobile-phone"
				style="cursor: help; padding: 0 0 0 5pt; box-shadow: none"
				title="{$inscritos['mobile']}"></a></td>
			<td class="actions" align="right"><a
				class="button small icon fa-plus-circle"
				style="cursor: pointer; padding: 0 0 0 5pt"
				onclick="request('action={$action}&task=adicionar&tab={$currentTab}&subTab={$currentSubTab}&idCourses='+document.getElementById('idCourses').value+'&idUsers={$inscritos['idUsers']}&searchUtilizadores=' + document.getElementById('searchUtilizadores').value, 'formMsg');
                                request('action={$action}&task=novo&tab={$currentTab}&subTab={$currentSubTab}&idCourses='+document.getElementById('idCourses').value+'&searchUtilizadores=' + document.getElementById('searchUtilizadores').value, 'resultadoInscritos');"></a>
			</td>
		</tr>
	{/foreach}
		</tbody>
</table>