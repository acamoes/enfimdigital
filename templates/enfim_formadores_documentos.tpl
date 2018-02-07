<div class="table-wrapper">
    <ul style="float: right">
        <form>
            <input type="text" id="{$currentTab}search" name="{$currentTab}search" style="height: 2em; padding: 0 0; display: none;" />
            <a class="button small icon fa-search" title="pesquisar"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">
            </a>
        </form>
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
        </tr>
    </thead>		
    <tbody>
        {foreach $formadores->documentos as $documentos}
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
                <td {if $documentos['status'] eq 'Inativo'}style="color: orangered;"{/if}>{$documentos['status']}</td>
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
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$documentos['idDocuments']}&filePos=4'" 
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
                         title="Carregado: {$documentos['dateDiretor']}&#013;Diretor: {$documentos['diretor']}"/>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $documentos['idExecutiva']==''}_vazio{/if}.svg" 
                         title="Carregado: {$documentos['dateExecutiva']}&#013;EE: {$documentos['executiva']}"/>
                </td>
            {/foreach}
    </tbody>
</table>