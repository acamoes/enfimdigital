<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 700px;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}{$currentSubTab}Novo").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'inserir'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                    datastring.push({ldelim}name: 'subTab', value: '{$currentSubTab}'});
                                                            datastring.push({ldelim}name: 'idCourses', value: '{$equipaExecutivaFormacoesIdCourses}'});
                                                                    $.ajax({
                                                                        url: '{$SCRIPT_NAME}',
                                                                        data: datastring,
                                                                        success: function (result) {
                                                                            $('#formMsg').html(result);
                                                                        }
                                                                    });
                                                                }

                    </script>
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
                            <input type="hidden" name="idCourses" id="idCourses"
                                   value="{$equipaExecutivaFormacoesIdCourses}" /> 
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Módulo</label>
                                <input required type="text" name="name" id="name" style="width: 350px" />
                            </div>
                            <div style="float: right">
                                <label for="duration">Duração</label>
                                <input required type="text" name="duration" id="duration" style="width: 150px" {literal}pattern="^[0-9]{2,3}$"{/literal} />
                            </div>
                        </div>							
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea required cols="5" rows="3" name="observations" id="observations" style="width: 630px"></textarea>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: right;">
                                <button>Submit</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>       