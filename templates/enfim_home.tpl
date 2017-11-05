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
                        <?php
                        $myAgenda = $_SESSION ['user']->getMyAgenda ();									
                        if (is_array ( $myAgenda ))
                        {
                        for($i = 0; $i < count ( $myAgenda ); $i ++)
                        {
                        ?>
                        <tbody>
                            <tr style="cursor:pointer;" onclick="javascript:location.href = 'formadores.php?id=<?=$myAgenda[$i]['ctIdCourses']?>'">
                                <td><?=$myAgenda[$i]['ctType']?></td>
                                <td><?=$myAgenda[$i]['csCourse']?></td>
                                <td><?=$myAgenda[$i]['csCompleteName']?></td>
                                <td><?=date_format(date_sub(new DateTime($myAgenda[$i]['csStartDate']),new DateInterval('P30D')),'Y-m-d')?></td>
                                <td><?=$myAgenda[$i]['csStartDate']?></td>
                                <td><?=$myAgenda[$i]['csLocal']?></td>
                                <td><?=$myAgenda[$i]['csVacancy']?></td>
                                <td><?=$myAgenda[$i]['csStatus']?></td>
                            </tr>
                        </tbody>
                        <?php }}?>
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
                        <?php
                        $myCourses = $_SESSION ['user']->getMyCourses ();
                        if (is_array ( $myCourses ))
                        {
                        for($i = 0; $i < count ( $myCourses ); $i ++)
                        {
                        ?>
                        <tbody>
                            <tr style="cursor:pointer;" onclick="javascript:location.href = 'formandos.php?id=<?=$myCourses[$i]['csIdCourses']?>'">
                                <td><?=$myCourses[$i]['csStartDate']?></td>
                                <td><?=$myCourses[$i]['csCompleteName']?></td>
                                <td><?=$myCourses[$i]['csStatus']?></td>
                                <td><?=$myCourses[$i]['ucAttended']?></td>
                                <td><?=$myCourses[$i]['ucPassedCourse']?></td>
                                <td><?=$myCourses[$i]['ucPassedInternship']?></td>
                                <td><?=$myCourses[$i]['ucPassed']?></td>
                                <td><?=$myCourses[$i]['ucBoCourse']?></td>
                            </tr>
                        </tbody>
                        <?php }}?>
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
