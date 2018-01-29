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
                                       onclick="$('#form').html('');request('action={$action}&task=search&idCourses={$idCourses}&tab={$currentTab}&search='+document.getElementById('{$currentTab}search').value,'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                            <input type="hidden" name="idCourses" id="idCourses" value="{$idCourses}" /> 
                            <input type="hidden" name="idDocuments" id="idDocuments" value="{$ficheiros['idDocuments']}" />
                            <input type="hidden" name="idCourse" id="idDocuments" value="{$ficheiros['idCourse']}" />
                            <input type="hidden" name="type" id="type" value="{$ficheiros['dTipo']}"/>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="idModules">Módulo</label> 
                                <select required
                                        name="idModules" id="idModules" style="width: 400px">
                                    {foreach $modulosFicheiros as $modulo}
                                        <option 
                                            {if $modulo['status'] neq 'Fechado'}style="color: orangered;"{/if}
                                            value="{$modulo['idModules']}" {if $modulo['idModules'] eq $ficheiros['idModules']}selected="selected"{/if}>{$modulo['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Documento</label>
                                <input required type="text"
                                       name="name" id="name" style="width: 300px"  value="{$ficheiros['documento']}"/>
                            </div>
                            <div style="float: right">
                                <label for="public">Para o formando?</label> 
                                <select
                                    name="public" id="public" style="width: 200px">
                                    <option value="Sim" {if $ficheiros['public'] eq 'Sim'}selected='selected'{/if}>Sim</option>
                                    <option value="Não" {if $ficheiros['public'] eq 'Não'}selected='selected'{/if}>Não</option>
                                </select>
                            </div>
                        </div>
                        {if $action eq "equipaExecutiva"}
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="status">Estado</label> <select
                                        name="status" id="status" style="width: 150px">
                                        <option value="Pendente" {if  $ficheiros['status'] eq "Pendente"}selected='selected'{/if}>Pendente</option>
                                        <option value="Revisão" {if  $ficheiros['status'] eq "Revisão"}selected='selected'{/if}>Revisão</option>
                                        <option value="Fechado" {if  $ficheiros['status'] eq "Fechado"}selected='selected'{/if}>Fechado</option>
                                        <option value="Ativo" {if  $ficheiros['status'] eq "Ativo"}selected='selected'{/if}>Ativo</option>
                                        <option value="Inativo" {if  $ficheiros['status'] eq "Inativo"}selected='selected'{/if}>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        {/if}
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations" id="observations" style="width: 630px">{$ficheiros['observations']}</textarea>
                            </div>
                        </div>
                        {if $docType=='Apresentação'}        
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Apresentação editável:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=1&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document1']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=1'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext1'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext1'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document1']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file4">
                                <div style="float: left">
                                    <label for="ficheiro">Apresentação para os formandos (PDF):</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=4&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document4']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=4'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext4'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext4'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document4']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document4']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file2">
                                <div style="float: left">
                                    <label for="ficheiro">Plano de Sessão editável:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=2&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document2']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=2'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext2'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext2'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document2']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document2']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file3">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos de apoio ao Plano de Sessão (ZIP):</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=3&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document3']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=3'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext3'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext3'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document3']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document3']}
                                    {/if}
                                </div>
                            </div>
                        {elseif $docType=='Texto'}
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Texto de apoio editável:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=1&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document1']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=1'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext1'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext1'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document1']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file2">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos anexos editáveis (ZIP):</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=2&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document2']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=2'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext2'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext2'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document2']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document2']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file3">
                                <div style="float: left">
                                    <label for="ficheiro">Texto de apoio para os formandos (PDF):</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=3&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document3']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=3'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext3'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext3'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document3']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document3']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file4">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos anexos para os formandos em PDF (ZIP):</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=4&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document4']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=4'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext4'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext4'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document4']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document4']}
                                    {/if}
                                </div>
                            </div>
                        {else}
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Documento:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=1&tab={$currentTab}&idCourses={$idCourses}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $ficheiros['document1']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getFormacoesArchiveAll&id={$ficheiros['idDocuments']}&filePos=1'" 
                                           class="icon fa-file
                                           {if $ficheiros['ext1'] eq 'pdf'}-pdf-o
                                           {elseif $ficheiros['ext1'] eq 'zip'}-zip-o{/if}"
                                           title="{$ficheiros['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                                        </i>&nbsp;{$ficheiros['document1']}
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