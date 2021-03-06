<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Estado</th>
            <th>Avaliação</th>
        </tr>
    </thead>		
    <tbody>
        {foreach $formandos->evaluations as $evaluations}
            <tr>
                <td>{$evaluations['name']}</td>
                <td>{$evaluations['status']}</td>
                <td>
                    {if empty($evaluations['evaluation']) || $evaluations['status']=='Aberto'}
                        <a
                            class="xlarge icon fa-list-alt"
                            style="cursor: pointer; padding: 0 0 0 5pt" target="_blank" 
                            href="{$SCRIPT_NAME}?action=formandos&task=getEvaluation&idEvaluations={$evaluations['idEvaluations']}&idCourses={$evaluations['idCourses']}&idCourse={$evaluations['idCourse']}"></a>
                    {elseif !empty($evaluations['evaluation'] && $evaluations['status']=='Fechado')}
                        <a
                            class="button small icon fa-check"
                            style="cursor: pointer; padding: 0 0 0 5pt" target="_blank" 
                            href="{$SCRIPT_NAME}?action=formandos&task=getEvaluation&idEvaluations={$evaluations['idEvaluations']}&idCourses={$evaluations['idCourses']}&idCourse={$evaluations['idCourse']}"></a>    
                    {/if}
                </td>                
            </tr>
        {/foreach}
    </tbody>
</table>