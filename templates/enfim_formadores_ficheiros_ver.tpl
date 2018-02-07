<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>   
                    <div class="row uniform" style="padding-top: 1.75em">
                        <div style="float: right">
                            <label style="float: right; cursor: pointer"
                                   onclick="$('#form').html('');
                                           request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                Close</label>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="idModules">Módulo</label> 
                            <input required type="text"
                                   name="name" id="name" style="width: 300px"  readonly='readonly'  value="{$ficheiros['modulo']}"/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="name">Documento</label>
                            <input required type="text"
                                   name="name" id="name" style="width: 200px"  readonly='readonly'  value="{$ficheiros['documento']}"/>
                        </div>
                        <div style="float: right">
                            <label for="public">Para o formando?</label> 
                            <input required type="text"
                                   name="name" id="name" style="width: 300px"  readonly='readonly'  value="{$ficheiros['public']}"/>
                        </div>
                    </div>
                    {if $action eq "equipaExecutiva"}
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Estado</label> 
                                <input required type="text"
                                       name="name" id="name" style="width: 200px"  readonly='readonly'  value="{$ficheiros['status']}"/>
                            </div>
                        </div>
                    {/if}
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="observations">Observações</label>
                            <textarea cols="5" rows="3" name="observations" id="observations"  readonly='readonly' style="width: 630px">{$ficheiros['observations']}</textarea>
                        </div>
                    </div>
                    {if $docType=='Apresentação'}        
                        <div class="row uniform" id="file1">
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

                </section>
            </div>
        </div>
    </section>
</section>