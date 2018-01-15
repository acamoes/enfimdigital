<table>
    <thead>
        <tr>
            <th>NrAssoc</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Contato</th>
            <th>Idade</th>
            <th>IBAN</th>
            <th></th>
        </tr>
    </thead>		
    <tbody>
        {foreach $equipaExecutiva->documentos as $documentos}
            {$documentos|@var_dump}
            <tr>


            </tr>
        {/foreach}
    </tbody>
        </table>