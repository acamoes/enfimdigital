<section id="wrapper" style="width: 400px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}Adicionar").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'adicionar'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                            datastring.push({ldelim}name: 'idCourses', value: '{$idCourses}'});
                                                                    datastring.push({ldelim}name: 'idCourse', value: '{$data['idCourse']}'});
                                                                            datastring.push({ldelim}name: 'idModules', value: '{$data['idModules']}'});
                                                                            datastring.push({ldelim}name: 'searchUtilizadores', value: '1'});
                                                                                    $.ajax({
                                                                                        url: '{$SCRIPT_NAME}',
                                                                                        data: datastring,
                                                                                        success: function (result) {
                                                                                            $('#formMsg').html(result);
                                                                                        }
                                                                                    });
                                                                                }

                    </script>
                    <form id="{$currentTab}Adicionar" name="{$currentTab}Adicionar"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#smallForm').html('');request('action={$action}&task=search&idCourses={$idCourses}&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="formador">Módulo</label>
                                <select name="formador" id="formador" style="width: 200px">
                                    {foreach $resultadoSessoes as $sessoes}
                                        <option value="{$sessoes['idUsers']}">{$sessoes['name']}</option>
                                    {/foreach}
                                </select>
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