<section id="wrapper" style="width: 900px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 900px;">
        <div class="inner">
            <div class="content">
                <section>
                    <form id="{$currentTab}Novo" name="{$currentTab}Novo"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#form').html('');request('action={$action}&task=search&idCourses={$idCourses}&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left"> 
                                <input type="text"
                                       name="searchUtilizadores" id="searchUtilizadores"
                                       style="height: 2em; padding: 0 0; display: inline-block;" /> 
                                <a class="button small icon fa-search" title="adicionar formador"
                                       style="box-shadow: -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); cursor: pointer; padding: 0 0 0 5pt"
                                       onclick="request('action={$action}&task=novo&tab={$currentTab}&idCourses={$idCourses}&searchUtilizadores='+document.getElementById('searchUtilizadores').value, 'resultado{$currentTab|ucfirst}');"></a>
                                
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: Left" id="resultado{$currentTab|ucfirst}"></div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>