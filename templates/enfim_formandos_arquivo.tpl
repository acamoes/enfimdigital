<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Documentos</th>
        </tr>
    </thead>		
    <tbody>
        {foreach $formandos->documents as $documents}		
            <tr>
                <td>{$documents['name']}</td>
                <td>{$documents['type']}</td>
                <td>
                    {if $documents['type']=='Apresentação'}
                        {if $documents['document4']!=Null}
                            <a
                                class="button small icon fa-file" title="Apresentação"
                                style="cursor: pointer; padding: 0 0 0 5pt"
                                target="_BLANK" title="{$documents['document4']}" href="{$SCRIPT_NAME}?action=files&task=getArchive&id={$documents['idDocuments']}&filePos=1"></a>
                        {/if}
                    {elseif $documents['type']=='Texto'}
                        {if $documents['document3']!=Null}
                            <a
                                class="button small icon fa-file" title="Texto"
                                style="cursor: pointer; padding: 0 0 0 5pt"
                                target="_BLANK" title="{$documents['document3']}" href="{$SCRIPT_NAME}?action=files&task=getArchive&id={$documents['idDocuments']}&filePos=1"></a>
                        {/if}
                        {if $documents['document4']!=Null}
                            <a
                                class="button small icon fa-file"
                                style="cursor: pointer; padding: 0 0 0 5pt"
                                target="_BLANK" title="{$documents['document4']}" href="{$SCRIPT_NAME}?action=files&task=getArchive&id={$documents['idDocuments']}&filePos=2"></a>
                        {/if}
                    {elseif $documents['type']=='Extra'}
                        {if $documents['document1']!=Null}
                            <a
                                class="button small icon fa-file" title="Extra"
                                style="cursor: pointer; padding: 0 0 0 5pt"
                                target="_BLANK" title="{$documents['document1']}" href="{$SCRIPT_NAME}?action=files&task=getArchive&id={$documents['idDocuments']}&filePos=1"></a>
                        {/if}
                    {/if}
                </td>                
            </tr>
        {/foreach}
    </tbody>
</table>