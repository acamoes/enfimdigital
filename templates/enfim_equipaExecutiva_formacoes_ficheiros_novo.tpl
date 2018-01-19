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
                                       onclick="$('#form').html('');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                            <input type="hidden" name="idCourses" id="idCourses"
                                   value="{$equipaExecutivaFormacoesIdCourses}" /> 
                            <input type="hidden" name="idDocumento" id="idDocument" />
                            <input type="hidden" name="type" id="type" value="{$docType}"/>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="idModules">Módulo</label> 
                                <select required
                                        name="idModules" id="idModules" style="width: 400px">
                                    {foreach $modulosFicheiros as $modulo}
                                        <option 
                                            {if $modulo['status'] neq 'Fechado'}style="color: orangered;"{/if}
                                            value="{$modulo['idModules']}">{$modulo['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Documento</label>
                                <input required type="text"
                                       name="name" id="name" style="width: 300px" />
                            </div>
                            <div style="float: right">
                                <label for="public">Para o formando?</label> <select
                                    name="public" id="public" style="width: 200px">
                                    <option value="Sim">Sim</option>
                                    <option value="Não" selected>Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations" id="observations" style="width: 630px"></textarea>
                            </div>
                        </div>
                        {if $docType=='Apresentação'}        
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Apresentação editável:</label>
                                    <iframe src="{$current_dir}upload.php?type=1&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div class="row uniform" id="file4">
                                <div style="float: left">
                                    <label for="ficheiro">Apresentação para os formandos (PDF):</label>
                                    <iframe src="{$current_dir}upload.php?type=4&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div class="row uniform" id="file2">
                                <div style="float: left">
                                    <label for="ficheiro">Plano de Sessão editável:</label>
                                    <iframe src="{$current_dir}upload.php?type=2&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div class="row uniform" id="file3">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos de apoio ao Plano de Sessão (ZIP):</label>
                                    <iframe src="{$current_dir}upload.php?type=3&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                        {elseif $docType=='Texto'}
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Texto de apoio editável:</label>
                                    <iframe src="{$current_dir}upload.php?type=1&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div class="row uniform" id="file2">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos anexos editáveis (ZIP):</label>
                                    <iframe src="{$current_dir}upload.php?type=2&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div class="row uniform" id="file3">
                                <div style="float: left">
                                    <label for="ficheiro">Texto de apoio para os formandos (PDF):</label>
                                    <iframe src="{$current_dir}upload.php?type=3&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div class="row uniform" id="file4">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos anexos para os formandos em PDF (ZIP):</label>
                                    <iframe src="{$current_dir}upload.php?type=4&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                        {else}
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Documento:</label>
                                    <iframe src="{$current_dir}upload.php?type=1&tab={$currentTab}&subTab={$currentSubTab}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                            </div>
                            <div id="file2"></div>
                            <div id="file3"></div>
                            <div id="file4"></div>
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