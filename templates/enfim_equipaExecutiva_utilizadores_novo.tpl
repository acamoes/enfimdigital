<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}Novo").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'inserir'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                    $.ajax({
                                                        url: '{$SCRIPT_NAME}',
                                                        data: datastring,
                                                        success: function (result) {
                                                            $('#form').html('');
                                                            $('#{$action}Msg').html(result);
                                                        }
                                                    });
                                                }

                    </script>
                    <form id="{$currentTab}Novo" name="{$currentTab}Novo"
                          onSubmit="submeter();
                                  return false;">    
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
                            <div style="float: left">
                                <label for="username">Username</label><input required
                                                                             type="text" name="username" id="username" style="width: 200px"
                                                                             {literal}pattern="[a-z0-9._@%+-]{6,}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="email">Email</label><input required type="text"
                                                                       name="email" id="email" style="width: 350px"
                                                                       {literal}pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="sigla">Sigla</label><input type="text" name="sigla"
                                                                       id="sigla" maxlength="3" style="width: 100px"
                                                                       {literal}pattern="[A-Z]{2,3}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="name">Nome</label><input required type="text"
                                                                     name="name" id="name" style="width: 400px" />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="permission">Nível</label> <select name="permission"
                                                                              id="permission" style="width: 200px">
                                    <option value="Equipa Executiva">Equipa Executiva</option>
                                    <option value="Serviços Centrais">Serviços Centrais</option>
                                    <option value="Formador">Formador</option>
                                    <option value="Formando">Formando</option>
                                </select>
                            </div>
                            <div style="float: right">
                                <label for="status">Estado</label> <input type="radio"
                                                                          id="Ativo" name="status" value="Ativo" checked=""><label
                                                                          for="Ativo">Ativo</label> <input type="radio" id="Inativo"
                                                                          name="status" value="Inativo"><label for="Inativo">Inativo</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="birthDate">Nascimento</label><input type="text"
                                                                                name="birthDate" id="birthDate" maxlength="10"
                                                                                style="width: 150px" 
                                                                                {literal}pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="aepId">NrAssoc</label>
                                <ul class="actions" onclick="
                                        if (isPositiveInteger(document.getElementById('aepId').value))
                                    {ldelim}
                                                requestAPI('action={$action}&task=getEAEP&tab={$currentTab}&aepId=' + document.getElementById('aepId').value, 'formMsg');
                                            }"
                                    style="float: right">
                                    <li class="button small"
                                        style="cursor: pointer; padding: 0 10pt 0 10pt; line-height: 3em; height: 3em;background-color: darkgreen;">e-aep</li>
                                </ul>
                                <input required type="text" name="aepId" id="aepId" maxlength="6" style="width: 150px"
                                       {literal}pattern="[0-9]{5,}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="address">Morada</label><input type="text"
                                                                          name="address" id="address" style="width: 400px" />
                            </div>
                            <div style="float: right">
                                <label for="mobile">Telemóvel</label><input type="text"
                                                                            name="mobile" id="mobile" maxlength="9" style="width: 150px"
                                                                            {literal}pattern="[0-9]{9}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="zipCode">Código Postal</label> <input required
                                                                                  type="text" name="zipCode" id="zipCode" style="width: 300px"
                                                                                  {literal}pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="telephone">Telefone</label><input type="text"
                                                                              name="telephone" id="telephone" maxlength="9"
                                                                              style="width: 150px" 
                                                                              {literal}pattern="[0-9]{9}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="iban">IBAN</label><input type="text" name="iban"
                                                                     id="iban" maxlength="25" style="width: 630px"
                                                                     {literal}pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations"
                                          id="observations" style="width: 630px"></textarea>
                            </div>
                        </div>
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