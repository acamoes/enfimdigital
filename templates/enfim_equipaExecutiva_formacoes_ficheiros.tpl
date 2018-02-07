<div class="table-wrapper">
    <ul style="float: left">
        <form>
            <input type="text" id="{$currentTab}{$currentSubTab}search" name="{$currentTab}{$currentSubTab}search" style="height: 2em; padding: 0 0; display: inline-block;" />
            <a class="button small icon fa-search" title="pesquisar"
               style="box-shadow: 
               -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0); 
               cursor: pointer; padding: 0 0 0 5pt"
               onclick="request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">
            </a>
        </form>
    </ul>
    <ul class="actions"
        onclick="if (confirm('Tem a certeza que pretende restaurar?\nTodo o conteúdo será apagado e reposto.')) {
                    request('action={$action}&task=restaurar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', '{$action}Msg');
                    request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');
                }"
        style="float: right; padding-left:10px;padding-right:10px;">
        <li class="button small"
            style="cursor: pointer; padding: 0 10px 0 10px">restaurar</li>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&docType=Extra&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Extra</li>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&docType=Texto&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Texto de apoio</li>
    </ul>
    <ul class="actions" onclick="request('action={$action}&task=novo&docType=Apresentação&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}', 'form');"
        style="float: right">
        <li class="button small"
            style="cursor: pointer; padding: 0 10pt 0 10pt">Apresentação</li>
    </ul>
</div>
<table>
    <thead>
        <tr>
            <th>Módulo</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Público</th>
            <th>Fich1</th>
            <th>Fich2</th>
            <th>Fich3</th>
            <th>Fich4</th>
            <th>Autorizações</th>
            <th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->contexto['formacoes']['ficheiros'] as $ficheiros}
            <tr>
                <td>{$ficheiros['modulo']}</td>
                <td>{$ficheiros['mTipo']}</td>
                <td style="overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    -o-text-overflow: ellipsis;">{$ficheiros['documento']}</td>
                <td>{$ficheiros['dTipo']}</td>
                <td {if $ficheiros['status'] neq 'Fechado'}style="color: orangered;"{/if}>{$ficheiros['status']}</td>
                <td>{$ficheiros['public']}</td>
                <td>
                    {if $ficheiros['ext1']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$ficheiros['idDocuments']}&filePos=1'" 
                           class="icon fa-file{if $ficheiros['ext1']=='pdf'}-pdf-o{elseif $ficheiros['ext1']=='zip'}-zip-o{/if}" 
                           title="{$ficheiros['document1']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    {if $ficheiros['ext2']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$ficheiros['idDocuments']}&filePos=2'" 
                           class="icon fa-file{if $ficheiros['ext2']=='pdf'}-pdf-o{elseif $ficheiros['ext2']=='zip'}-zip-o{/if}" 
                           title="{$ficheiros['document2']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    {if $ficheiros['ext3']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$ficheiros['idDocuments']}&filePos=3'" 
                           class="icon fa-file{if $ficheiros['ext3']=='pdf'}-pdf-o{elseif $ficheiros['ext3']=='zip'}-zip-o{/if}" 
                           title="{$ficheiros['document3']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    {if $ficheiros['ext4']!=''}
                        <i onclick="location.href = '{$SCRIPT_NAME}?action=files&task=getArchiveAll&id={$ficheiros['idDocuments']}&filePos=4'" 
                           class="icon fa-file{if $ficheiros['ext4']=='pdf'}-pdf-o{elseif $ficheiros['ext1']=='zip'}-zip-o{/if}" 
                           title="{$ficheiros['document4']}" 
                           style="color:#fff;cursor: pointer; padding: 0 0 0 5pt;border-line:none;box-shadow:0 0 0 0">
                        </i>
                    {/if}
                </td>
                <td>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $ficheiros['idAutor']==''}_vazio{/if}.svg" 
                         title="Carregado: {$ficheiros['dateAutor']}&#013;Autor: {$ficheiros['autor']}"/>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $ficheiros['idDiretor']==''}_vazio{/if}.svg" 
                         title="Carregado: {$ficheiros['dateDiretor']}&#013;Diretor: {$ficheiros['diretor']}"/>
                    <img style="width:15px;height:15px" 
                         src="images/star{if $ficheiros['idExecutiva']==''}_vazio{/if}.svg" 
                         title="Carregado: {$ficheiros['dateExecutiva']}&#013;EE: {$ficheiros['executiva']}"/>
                </td>
                <td class="actions" align="right"><a
                        class="button small icon fa-file" title="ver"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        onclick="request('action={$action}&task=ver&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idDocuments={$ficheiros['idDocuments']}', 'form');"></a>
                    <a class="button small icon fa-edit" title="editar"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="request('action={$action}&task=editar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idDocuments={$ficheiros['idDocuments']}', 'form');"></a>
                    <a class="button small icon fa-eraser" title="apagar"
                       style="cursor: pointer; padding: 0 0 0 5pt"                       
                       onclick="if (confirm('Tem a certeza que pretende apagar o registo?')) {ldelim}
                                   $.when(request('action={$action}&task=apagar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idDocuments={$ficheiros['idDocuments']}', '{$action}Msg')).
                                           then(request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value, 'SST{$currentTab}{$currentSubTab}'));}"> </a>
                    <a class="button small icon fa-check-circle-o"
                       style="cursor: pointer; padding: 0 0 0 5pt"
                       onclick="if (confirm('Tem a certeza que pretende aprovar')) {ldelim}
                                   $.when(request('action={$action}&task=aprovar&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&idDocuments={$ficheiros['idDocuments']}', '{$action}Msg')).
                                           then(request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&equipaExecutivaFormacoesIdCourses={$equipaExecutivaFormacoesIdCourses}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value, 'SST{$currentTab}{$currentSubTab}'));}"></a>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>