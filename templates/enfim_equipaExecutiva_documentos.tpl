<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}search" name="{$currentTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&type=Extra&tab={$currentTab}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Extra</li>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&type=Texto&tab={$currentTab}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Texto de apoio</li>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&type=Apresentação&tab={$currentTab}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Apresentação</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Curso</th>
            <th>Módulo</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Público</th>
            <th>Estado</th>
            <th>Fich1</th>
            <th>Fich2</th>
            <th>Fich3</th>
            <th>Fich4</th>
            <th>Autorizações</th>
            <th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->documentos as $documentos}
            <tr>
                <td>{$documentos['sigla']}</td>
                <td>{$documentos['modulo']}</td>
                <td>{$documentos['mTipo']}</td>
                <td style="overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    -o-text-overflow: ellipsis;">{$documentos['documento']}</td>
                <td>{$documentos['dTipo']}</td>
                <td>{$documentos['public']}</td>
                <td>{$documentos['status']}</td>
                <td>
                    {if $documentos['ext1']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documentos['idDocuments']}&filePos=1'" 
                           class="icon fa-file{if $documentos['ext1']=='pdf'}-pdf-o{elseif $documentos['ext1']=='zip'}-zip-o{/if}" 
                           title="{$documentos['document1']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    {if $documentos['ext2']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documentos['idDocuments']}&filePos=2'" 
                           class="icon fa-file{if $documentos['ext2']=='pdf'}-pdf-o{elseif $documentos['ext2']=='zip'}-zip-o{/if}" 
                           title="{$documentos['document2']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    {if $documentos['ext3']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documentos['idDocuments']}&filePos=3'" 
                           class="icon fa-file{if $documentos['ext3']=='pdf'}-pdf-o{elseif $documentos['ext3']=='zip'}-zip-o{/if}" 
                           title="{$documentos['document3']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    {if $documentos['ext4']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documents['idDocuments']}&filePos=4'" 
                           class="icon fa-file{if $documentos['ext4']=='pdf'}-pdf-o{elseif $documentos['ext1']=='zip'}-zip-o{/if}" 
                           title="{$documentos['document4']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
               <td>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $documentos['idAutor']==''}_vazio{/if}.svg" 
                         title="Carregado: {$documentos['dateAutor']}&#013;Autor: {$documentos['autor']}"/>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $documentos['idDiretor']==''}_vazio{/if}.svg" 
                         title="Carregado: {$documentos['dateDiretor']}&#013;Autor: {$documentos['diretor']}"/>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $documentos['idExecutiva']==''}_vazio{/if}.svg" 
                         title="Carregado: {$documentos['dateExecutiva']}&#013;Autor: {$documentos['executiva']}"/>
               </td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&idDocuments={$documentos['idDocuments']}', 'form');"></a>
                    <a class="button small icon fa-edit"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&idDocuments={$documentos['idDocuments']}', 'form');"></a>
                    <a class="button small icon fa-eraser"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="request('action={$action}&task=apagar&tab={$currentTab}&idDocuments={$documentos['idDocuments']}', '{$action}Msg');
                                       request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');"> </a></td>



            </tr>
        {/foreach}
    </tbody>
</table>