<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Observações</th>
            <th>Documento</th>
        </tr>
    </thead>		
    <tbody>
        {foreach $formandos->informations as $information}		
            <tr>
                <td>{$information['name']}</td>
                <td>{$information['observations']}</td>
                <td><a
                        class="button small icon fa-file"
                        style="cursor: pointer; padding: 0 0 0 5pt"
                        target="_BLANK" title="{$information['document']}" href="{$SCRIPT_NAME}?action=files&task=getInformations&id={$information['idInformations']}"></a>                    
                </td>                
            </tr>
        {/foreach}
    </tbody>
</table>