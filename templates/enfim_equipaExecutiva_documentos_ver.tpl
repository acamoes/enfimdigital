<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>                    
                    {assign var="current_dir" value=$SCRIPT_NAME|replace:'index.php':''}                         
                    <div class="row uniform" style="padding-top: 1.75em">
                        <div style="float: right">
                            <label style="float: right; cursor: pointer"
                                   onclick="$('#form').html('');
                                           request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                Close</label>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div id="formMsg"></div>                            
                    </div>

                    <div class="row uniform">
                        <input type="hidden" name="type" id="type" readonly value="{$documento['dTipo']}"/>
                        <div style="float: left">
                            <label for="name">Curso</label> 
                            <input required type="text" 
                                   name="curso" id="curso" readonly 
                                   style="width: 400px"
                                   value="{$documento['curso']}"/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="idModules">Módulo</label> 
                            <input required type="text" 
                                   name="modulo" id="modulo" readonly 
                                   style="width: 400px"
                                   value="{$documento['modulo']}"/>
                        </div>
                        <div style="float: right">
                            <label for="status">Estado</label>
                            <input required type="text" 
                                   name="status" id="status" readonly 
                                   style="width: 150px"
                                   value="{$documento['status']}"/>
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
                            <label for="public">Para o formando?</label> 
                            <input required type="text" 
                                   name="public" id="public" readonly 
                                   style="width: 150px"
                                   value="{$documento['public']}"/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="observations">Observações</label>
                            <textarea cols="5" rows="3" name="observations" id="observations" readonly style="width: 630px">{$documento['observations']}</textarea>
                        </div>
                    </div>
                    {if $docType == 'Apresentação' }        
                        <div class="row uniform" id="file1">
                            <div style="float: left">
                                <label for="ficheiro">Apresentação editável:</label>                                    
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
                                    {if $documento['document2']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=2'" 
                                       class="icon fa-file{if $documento['ext2'] eq 'pdf'}-pdf-o{elseif $documento['ext2'] eq 'zip'}-zip-o{/if}" 
                                       title="{$documento['document2']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document2']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file3">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos de apoio ao Plano de Sessão (ZIP):</label>                                    
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
                                    {if $documento['document1']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=1'" 
                                       class="icon fa-file{if $documento['ext1'] eq 'pdf'}-pdf-o{elseif $documento['ext1'] eq 'zip'}-zip-o{/if}" 
                                       title="{$documento['document1']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document1']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file2">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos anexos editáveis (ZIP):</label>                                  
                                    {if $documento['document2']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=2'" 
                                       class="icon fa-file{if $documento['ext2'] eq 'pdf'}-pdf-o{elseif $documento['ext2'] eq 'zip'}-zip-o{/if}" 
                                       title="{$documento['document2']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document2']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file3">
                                <div style="float: left">
                                    <label for="ficheiro">Texto de apoio para os formandos (PDF):</label>                              
                                    {if $documento['document3']!=''}<i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documento['idDocuments']}&filePos=3'" 
                                       class="icon fa-file{if $documento['ext3'] eq 'pdf'}-pdf-o{elseif $documento['ext3'] eq 'zip'}-zip-o{/if}" 
                                       title="{$documento['document3']}" style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0"></i>&nbsp;{$documento['document3']}
                                    {/if}
                                </div>
                            </div>
                            <div class="row uniform" id="file4">
                                <div style="float: left">
                                    <label for="ficheiro">Documentos anexos para os formandos em PDF (ZIP):</label>                             
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
                    </section>
                </div>
            </div>
        </section>
    </section>