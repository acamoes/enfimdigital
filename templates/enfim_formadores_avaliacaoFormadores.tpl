<div class="table-wrapper">
    <ul style="float: right">
        <form>
            <input type="text" id="{$currentTab}search" name="{$currentTab}search" style="height: 2em; padding: 0 0; display: none;" />
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
            <th>Nome</th>
            <th>Respondido</th>
            <th>Estado</th>
            <th>Avaliação</th>
        </tr>
    </thead>		
    <tbody>
        {foreach $formadores->avaliacoesFormadores as $avaliacoes}
            <tr>
                <td>{$avaliacoes['name']}</td>
                <td>{$avaliacoes['response']}</td>
                <td>{$avaliacoes['status']}</td>
                <td>
                    {if empty($avaliacoes['evaluation']) || $avaliacoes['status']=='Aberto'}
                        <a
                            class="xlarge icon fa-list-alt"
                            style="cursor: pointer; padding: 0 0 0 5pt" target="_blank" 
                            href="{$SCRIPT_NAME}?action={$action}&task=getEvaluation&idEvaluations={$avaliacoes['idEvaluations']}&idCourses={$idCourses}"></a>
                    {elseif !empty($avaliacoes['evaluation'] && $avaliacoes['status']=='Fechado')}
                        <a
                            class="button small icon fa-check"
                            style="cursor: pointer; padding: 0 0 0 5pt" target="_blank" 
                            href="{$SCRIPT_NAME}?action={$action}&task=getEvaluation&idEvaluations={$avaliacoes['idEvaluations']}&idCourses={$idCourses}"></a>    
                    {/if}
                </td>                
            </tr>
        {/foreach}
    </tbody>
</table>