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
</div>
<table>
    <thead>
        <tr>
            <th>AEP</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Cargo</th>
            <th>Órgão</th>
            <th>Contatos</th>
            <th>Observações</th>
            <th>Progresso</th>
            <th
                {if $formadores->inscritos[0]['inscritos'] gt $formadores->inscritos[0]['vacancy']} 
                    style='text-align:right;color:#ff8888;'
                {else} 
                    style='text-align:right;color:#88ff88;'
                {/if}>
                {$formadores->inscritos[0]['inscritos']}/{$formadores->inscritos[0]['vacancy']}
            </th>
        </tr>
    </thead>		
    <tbody>
        {foreach $formadores->inscritos as $inscritos}
            <tr>
                <td>{$inscritos['aepId']}</td>
                <td>{$inscritos['name']}</td>			
                <td>{$inscritos['age']}</td>
                <td>{$inscritos['rank']}</td>
                <td>{$inscritos['unit']}</td>
                <td>M:{$inscritos['mobile']}&nbsp;T:{$inscritos['telephone']}</td>
                <td>{$inscritos['observations']}</td>
                <td><div class="w3-progress-container w3-small w3-round">
                        <div class="w3-progressbar w3-green w3-round" 
                             {if $inscritos['cInternship'] eq 'Sim'}
                                 {if $inscritos['passed'] eq 'on'} style="width:100%; coursor:pointer" title="Aproveitamento na Etapa"
                                 {elseif $inscritos['passedInternship'] eq 'on'} style="width:75%; coursor:pointer" title="Aproveitamento no Estágio"
                                 {elseif $inscritos['passedCourse'] eq 'on'} style="width:50%; coursor:pointer" title="Aproveitamento no Curso"
                                 {elseif $inscritos['attended'] eq 'on'} style="width:25%; coursor:pointer" title="Participou no Curso"
                                 {/if}
                             {else}
                                 {if $inscritos['passed'] eq 'on'} style="width:100%; coursor:pointer" title="Aproveitamento na Etapa"
                                 {elseif $inscritos['passedCourse'] eq 'on'} style="width:66%; coursor:pointer" title="Aproveitamento no Curso"
                                 {elseif $inscritos['attended'] eq 'on'} style="width:33%; coursor:pointer" title="Participou no Curso"
                                 {/if}
                             {/if}  				
                             ></div>
                    </div>
                </td>
                <td class="actions" align="right">
                    <a  class="button small icon fa-edit" title="editar"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=editar&tab={$currentTab}&idCourses={$idCourses}&idUsers={$inscritos['idUsers']}', 'form');"></a>
                    {if $inscritos['attended'] neq 'on'}
                        <a class="button small icon fa-check-circle-o" style="cursor: pointer; padding: 0 0 0 5pt" title="Participou?" 
                           onclick="if (confirm('Participou?')) {ldelim}
                                               $.when(request('action={$action}&task=participou&tab={$currentTab}&idCourses={$idCourses}&idUsers={$inscritos['idUsers']}', '{$action}Msg')).
                                                       then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                                           }"></a>
                    {elseif $inscritos['passedCourse'] neq 'on'}
                        <a class="button small icon fa-check-circle-o" style="cursor: pointer; padding: 0 0 0 5pt" title="Passou no Curso?" 
                           onclick="if (confirm('Passou no Curso?')) {ldelim}
                                               $.when(request('action={$action}&task=passouCurso&tab={$currentTab}&idCourses={$idCourses}&idUsers={$inscritos['idUsers']}', '{$action}Msg')).
                                                       then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                                           }"></a>
                    {elseif $inscritos['passedInternship'] neq 'on' && $inscritos['cInternship'] eq 'Sim'}
                        <a class="button small icon fa-check-circle-o" style="cursor: pointer; padding: 0 0 0 5pt" title="Passou no Estágio?" 
                           onclick="if (confirm('Passou no Estágio?')) {ldelim}
                                               $.when(request('action={$action}&task=passouEstagio&tab={$currentTab}&idCourses={$idCourses}&idUsers={$inscritos['idUsers']}', '{$action}Msg')).
                                                       then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                                           }"></a>
                    {elseif $inscritos['passed'] neq 'on'}
                        <a class="button small icon fa-check-circle-o" style="cursor: pointer; padding: 0 0 0 5pt" title="Passou na Etapa?" 
                           onclick="if (confirm('Passou na Etapa?')) {ldelim}
                                               $.when(request('action={$action}&task=passouEtapa&tab={$currentTab}&idCourses={$idCourses}&idUsers={$inscritos['idUsers']}', '{$action}Msg')).
                                                       then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                                           }"></a>
                    {else}
                        <a class="button small icon fa-check-circle-o" style="cursor: pointer; padding: 0 0 0 5pt" title="Limpar avaliação?" 
                           onclick="if (confirm('Limpar avaliação?')) {ldelim}
                                               $.when(request('action={$action}&task=reset&tab={$currentTab}&idCourses={$idCourses}&idUsers={$inscritos['idUsers']}', '{$action}Msg')).
                                                       then(request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}'));
                                           }"></a>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>