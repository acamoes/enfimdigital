<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
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
                    {assign var="current_dir" value=$SCRIPT_NAME|replace:'index.php':''} 
                    <form id="{$currentTab}{$currentSubTab}Novo" name="{$currentTab}{$currentSubTab}Novo"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#form').html('');request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search='+document.getElementById('{$currentTab}{$currentSubTab}search').value+'&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value,'SST{$currentTab}{$currentSubTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                            <input type="hidden" name="idCourses" id="idCourses"
                                   value="{$equipaExecutivaFormacoesIdCourses}" /> 
                            <input type="hidden" name="idInformations" id="idDocument" />
                            <input type="hidden" name="type" id="type" value="{$docType}"/>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Documento</label>
                                <input required type="text"
                                       name="name" id="name" style="width: 300px" />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations" id="observations" style="width: 630px"></textarea>
                            </div>
                        </div>
                        {if $docType=='Informações'}  
                            <div class="row uniform" id="file4">
                                <div style="float: left">
                                    <label for="ficheiro">Informação aos formandos:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=5&tab={$currentTab}&subTab={$currentSubTab}&idCourses={$equipaExecutivaFormacoesIdCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>                       
                        {/if}

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