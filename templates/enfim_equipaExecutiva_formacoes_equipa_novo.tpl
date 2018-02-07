<section id="wrapper" style="width: 900px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 900px;">
        <div class="inner">
            <div class="content">
                <section>
                    <form id="{$currentTab}{$currentSubTab}Novo" name="{$currentTab}{$currentSubTab}Novo"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#form').html('');
                                               request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <input type="hidden" name="idCourses" id="idCourses"
                                       value="{$equipaExecutivaFormacoesIdCourses}" /> 
                                <input type="text"
                                       name="searchUtilizadores" id="searchUtilizadores"
                                       style="height: 2em; padding: 0 0; display: inline-block;" /> 
                                <a class="button small icon fa-search" title="adicionar formador"
                                   style="box-shadow: -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); cursor: pointer; padding: 0 0 0 5pt"
                                   onclick="request('action={$action}&task=novo&tab={$currentTab}&subTab={$currentSubTab}&idCourses=' + document.getElementById('idCourses').value + '&searchUtilizadores=' + document.getElementById('searchUtilizadores').value, 'resultado{$currentSubTab|ucfirst}');"></a>

                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: Left" id="resultado{$currentSubTab|ucfirst}"></div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>