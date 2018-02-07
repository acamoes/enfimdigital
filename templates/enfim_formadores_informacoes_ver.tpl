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
                                           request('action={$action}&task=search&idCourses={$idCourses}&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                Close</label>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div id="formMsg"></div>                            
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="name">Documento</label>
                            <input required type="text"
                                   name="name" id="name" style="width: 300px" readonly  value="{$informacoes['name']}"/>
                        </div>
                    </div>
                    <div style="float: left">
                        <label for="public">Estado</label> 
                        <input required type="text"
                               name="status" id="status" style="width: 100px" readonly  value="{$informacoes['status']}"/>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="observations">Observações</label>
                            <textarea cols="5" rows="3" name="observations" id="observations" readonly style="width: 630px">{$informacoes['observations']}</textarea>
                        </div>
                    </div>
                    {if $docType=='Informações'}  
                        <div class="row uniform" id="file5">                                
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
                </section>
            </div>
        </div>
    </section>
</section>