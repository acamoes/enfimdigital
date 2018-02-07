{include file="enfim_header.tpl"}
<section id="wrapper">
    <header>
        <h2>Agenda</h2>
    </header>
    <div class="wrapper">
        <div class="inner">
            <h3 class="major">Cursos a dar:</h3>
            <section class="features">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Função</th>
                                <th>Referência</th>
                                <th>Curso</th>
                                <th>Data Inscrição</th>
                                <th>Data Início</th>
                                <th>Local</th>
                                <th>Vagas</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        {foreach from=$myAgenda item=agenda}
                            <tbody>
                                <tr style="cursor:pointer;" onclick="javascript:location.href = '{$SCRIPT_NAME}?action=formadores&task=getCourse&idCourses={$agenda.ctIdCourses}'">
                                    <td>{$agenda.ctType}</td>
                                    <td>{$agenda.csCourse}</td>
                                    <td>{$agenda.csCompleteName}</td>
                                    <td>{$agenda.limitDate|date_format:"Y-m-d"}</td>
                                    <td>{$agenda.csStartDate}</td>
                                    <td>{$agenda.csLocal}</td>
                                    <td>{$agenda.csVacancy}</td>
                                    <td>{$agenda.csStatus}</td>
                                </tr>
                            </tbody>
                        {/foreach}
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>
            <h3 class="major">Cursos a frequentar:</h3>
            <section class="features">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Curso</th>
                                <th>Estado</th>
                                <th>Participou</th>
                                <th>Passou no Curso</th>
                                <th>Passou no Estágio</th>
                                <th>Concluiu a etapa</th>
                                <th>Boletim Oficial</th>
                            </tr>
                        </thead>
                        {foreach from=$myCourses item=course}
                            <tbody>
                                <tr style="cursor:pointer;" onclick="javascript:location.href = '{$SCRIPT_NAME}?action=formandos&task=getCourse&idCourses={$course.csIdCourses}'">
                                    <td>{$course.csStartDate}</td>
                                    <td>{$course.csCompleteName}</td>
                                    <td>{$course.csStatus}</td>
                                    <td>{$course.ucAttended}</td>
                                    <td>{$course.ucPassedCourse}</td>
                                    <td>{$course.ucPassedInternship}</td>
                                    <td>{$course.ucPassed}</td>
                                    <td>{$course.ucBoCourse}</td>
                                </tr>
                            </tbody>
                        {/foreach}
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
{include file="enfim_footer.tpl"}
