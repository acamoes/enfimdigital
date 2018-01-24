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
                                                    datastring.push({ldelim}name: 'idDocuments', value: '{$documento['idDocuments']}'});
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
                                       onclick="$('#form').html('');request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>                            
                        </div>

                        <div class="row uniform">
                            <input type="hidden" name="idDocuments" id="idDocuments" value="{$documento['idDocuments']}" />
                            <input type="hidden" name="type" id="type" value="{$documento['dTipo']}"/>
                            <div style="float: left">
                                <label for="name">Curso</label> 
                                <select required 
                                        name="idCourse"
                                        id="idCourse" 
                                        style="width: 400px" 
                                        onChange="
                                                request('action={$action}&task=form&func=getModulosCursoOption&tab={$currentTab}&docType={$docType}&idCourse=' + this.options[this.selectedIndex].value + '&docType={$docType}', 'idModules');
                                                showFiles(this);">
                                    {foreach $equipaExecutiva->cursos as $curso}
                                        <option 
                                            {if $curso['status'] eq 'Inativo'}style="color: orangered;"{/if}
                                            value="{$curso['idCourse']}"
                                            {if  $documento['idCourse'] eq $curso['idCourse']}selected='selected'{/if}
                                            >{$curso['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="idModules">Módulo</label> 
                                <select required
                                        name="idModules" id="idModules" style="width: 400px"
                                        onChange="showFiles(this);">
                                    {foreach $equipaExecutiva->modulos as $modulo}
                                        <option 
                                            {if $modulo['status'] eq 'Inativo'}style="color: orangered;"{/if}
                                            value="{$modulo['idModules']}"
                                            {if  $documento['idModules'] eq $modulo['idModules']}selected='selected'{/if}
                                            >{$modulo['modulo']}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div style="float: right">
                                <label for="status">Estado</label> <select
                                    name="status" id="status" style="width: 150px">
                                    <option value="Pendente" {if  $documento['status'] eq "Pendente"}selected='selected'{/if}>Pendente</option>
                                    <option value="Revisão" {if  $documento['status'] eq "Revisão"}selected='selected'{/if}>Revisão</option>
                                    <option value="Fechado" {if  $documento['status'] eq "Fechado"}selected='selected'{/if}>Fechado</option>
                                    <option value="Ativo" {if  $documento['status'] eq "Ativo"}selected='selected'{/if}>Ativo</option>
                                    <option value="Inativo" {if  $documento['status'] eq "Inativo"}selected='selected'{/if}>Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Documento</label>
                                <input required type="text"
                                       name="name" id="name" style="width: 300px"
                                       value="{$documento['documento']}"/>
                            </div>
                            <div style="float: right">
                                <label for="public">Para o formando?</label> <select
                                    name="public" id="public" style="width: 200px">
                                    <option value="Sim" {if  $documento['public'] eq "Sim"}selected='selected'{/if}>Sim</option>
                                    <option value="Não"{if  $documento['public'] eq "Não"}selected='selected'{/if}>Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations" id="observations" style="width: 630px">{$documento['observations']}</textarea>
                            </div>
                        </div>
                        {if $docType == 'Apresentação' }        
                            <div class="row uniform" id="file1">
                                <div style="float: left">
                                    <label for="ficheiro">Apresentação editável:</label>
                                    <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=1&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                            style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                </div>
                                <div style="float: left">
                                    <label for="ficheiro">Ficheiro</label>                                    
                                    {if $documento['document1']!=''}
                                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=1'" 
                                           class="icon fa-file
                                           {if $documento['ext1'] eq 'pdf'}-pdf-o
                                           {elseif $documento['ext1'] eq 'zip'}-zip-o{/if}"
                                           title="{$documento['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document1']}{/if}
                                    </div>
                                </div>
                                <div class="row uniform" id="file4">
                                    <div style="float: left">
                                        <label for="ficheiro">Apresentação para os formandos (PDF):</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=4&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document4']!=''}
                                            <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=4'" 
                                               class='icon fa-file{if $documento['ext4'] eq 'pdf'}-pdf-o{elseif $documento['ext4'] eq 'zip'}-zip-o{/if}' 
                                               title="{$documento['document4']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document4']}
                                        {/if}
                                    </div>
                                </div>
                                <div class="row uniform" id="file2">
                                    <div style="float: left">
                                        <label for="ficheiro">Plano de Sessão editável:</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=2&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document2']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=2'" 
                                           class="icon fa-file{if $documento['ext2'] eq 'pdf'}-pdf-o{elseif $documento['ext2'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document2']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document2']}
                                        {/if}
                                    </div>
                                </div>
                                <div class="row uniform" id="file3">
                                    <div style="float: left">
                                        <label for="ficheiro">Documentos de apoio ao Plano de Sessão (ZIP):</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=3&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document3']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=3'" 
                                           class="icon fa-file{if $documento['ext3'] eq 'pdf'}-pdf-o{elseif $documento['ext3'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document3']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document3']}
                                        {/if}
                                    </div>
                                </div>
                            {elseif $docType=='Texto'}
                                <div class="row uniform" id="file1">
                                    <div style="float: left">
                                        <label for="ficheiro">Texto de apoio editável:</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=1&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document1']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=1'" 
                                           class="icon fa-file{if $documento['ext1'] eq 'pdf'}-pdf-o{elseif $documento['ext1'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document1']}
                                        {/if}
                                    </div>
                                </div>
                                <div class="row uniform" id="file2">
                                    <div style="float: left">
                                        <label for="ficheiro">Documentos anexos editáveis (ZIP):</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=2&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document2']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=2'" 
                                           class="icon fa-file{if $documento['ext2'] eq 'pdf'}-pdf-o{elseif $documento['ext2'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document2']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document2']}
                                        {/if}
                                    </div>
                                </div>
                                <div class="row uniform" id="file3">
                                    <div style="float: left">
                                        <label for="ficheiro">Texto de apoio para os formandos (PDF):</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=3&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div><div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document3']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=3'" 
                                           class="icon fa-file{if $documento['ext3'] eq 'pdf'}-pdf-o{elseif $documento['ext3'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document3']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document3']}
                                        {/if}
                                    </div>
                                </div>
                                <div class="row uniform" id="file4">
                                    <div style="float: left">
                                        <label for="ficheiro">Documentos anexos para os formandos em PDF (ZIP):</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=4&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document4']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=4'" 
                                           class="icon fa-file{if $documento['ext4'] eq 'pdf'}-pdf-o{elseif $documento['ext4'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document4']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document4']}
                                        {/if}
                                    </div>
                                </div>
                            {else}
                                <div class="row uniform" id="file1">
                                    <div style="float: left">
                                        <label for="ficheiro">Documento:</label>
                                        <iframe src="{$current_dir}upload.php?action={$action}&type={$docType}&filePos=1&tab={$currentTab}&idDocuments={$documento['idDocuments']}"
                                                style="width: 630px; height: 44px; line-height: 0; padding: 0; border-radius: 0.5em"></iframe>
                                    </div>
                                    <div style="float: left">
                                        <label for="ficheiro">Ficheiro</label>                                    
                                        {if $documento['document1']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=1'" 
                                           class="icon fa-file{if $documento['ext1'] eq 'pdf'}-pdf-o{elseif $documento['ext1'] eq 'zip'}-zip-o{/if}" 
                                           title="{$documento['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document1']}
                                        {/if}
                                    </div>
                                </div>
                                <div style="display:none" id="file2"></div>
                                <div style="display:none" id="file3"></div>
                                <div style="display:none" id="file4"></div>
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