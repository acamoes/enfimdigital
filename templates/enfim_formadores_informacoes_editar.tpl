<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}Atualizar").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'atualizar'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                            datastring.push({ldelim}name: 'idCourses', value: '{$idCourses}'});
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
                    <form id="{$currentTab}Atualizar" name="{$currentTab}Atualizar"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#form').html('');
                                               request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                            <input type="hidden" name="idCourses" id="idCourses" value="{$idCourses}" /> 
                            <input type="hidden" name="idInformations" id="idInformations" value="{$informacoes['idInformations']}" />
                            <input type="hidden" name="idCourse" id="idDocuments" value="{$informacoes['idCourse']}" />
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Documento</label>
                                <input required type="text"
                                       name="name" id="name" style="width: 300px"   value="{$informacoes['name']}"/>
                            </div>
                        </div>
                        <div style="float: left">
                            <label for="public">Estado</label> 
                            <select
                                name="status" id="public" style="width: 200px">
                                <option value="Ativo" {if $informacoes['status'] eq 'Ativo'}selected='selected'{/if}>Ativo</option>
                                <option value="Inativo" {if $informacoes['status'] eq 'Inativo'}selected='selected'{/if}>Inativo</option>
                            </select>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations" id="observations" style="width: 630px">{$informacoes['observations']}</textarea>
                            </div>
                        </div>
                        {if $docType=='Informações'}  
                            <div class="row uniform" id="file5">
                                <div style="float: left">
                                    <label for="ficheiro">Informação aos formandos:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=5&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $informacoes['document']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$informacoes['idInformations']}&filePos=5'" 
                                           class="icon fa-file
                                           {if $informacoes['ext'] eq 'pdf'}-pdf-o
                                           {elseif $informacoes['ext'] eq 'zip'}-zip-o{/if}"
                                           title="{$informacoes['document']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$informacoes['document']}
                                    {/if}
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