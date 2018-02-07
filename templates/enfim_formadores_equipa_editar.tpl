<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 700px;">
        <div class="inner">
            <div class="content">

                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}Atualizar").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'atualizar'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                    datastring.push({ldelim}name: 'idUsers', value: '{$utilizador['idUsers']}'});
                                                            datastring.push({ldelim}name: 'idCourses', value: '{$idCourses}'});
                                                                    $.ajax({
                                                                        url: '{$SCRIPT_NAME}',
                                                                        data: datastring,
                                                                        success: function (result) {
                                                                            $('#formMsg').html(result);
                                                                        }
                                                                    });
                                                                }

                    </script>
                    <form id="{$currentTab}Atualizar" name="{$currentTab}Atualizar"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#form').html('');
                                               request('action={$action}&task=search&tab={$currentTab}&idCourses={$idCourses}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="sigla">Sigla</label><input type="text" name="sigla"
                                                                       id="sigla" maxlength="3" style="width: 100px"
                                                                       value="{$utilizador['sigla']}"
                                                                       {literal}pattern="[A-Z]{2,3}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="name">Nome</label><input required type="text" readonly
                                                                     name="name" id="name" style="width: 400px"
                                                                     value="{$utilizador['name']}"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="type">Colaboração no curso</label> <select required
                                                                                       name="type" id="type" style="width: 200px">
                                    <option selected></option>
                                    <option value="Diretor"
                                            {if $utilizador['type'] eq "Diretor"}selected='selected'{/if}>Diretor</option>
                                    <option value="Formador"
                                            {if $utilizador['type'] eq "Formador"}selected='selected'{/if}>Formador</option>
                                    <option value="Convidado"
                                            {if $utilizador['type'] eq "Convidado"}selected='selected'{/if}>Convidado</option>
                                    <option value="Externo"
                                            {if $utilizador['type'] eq "Externo"}selected='selected'{/if}>Externo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="iban">IBAN</label>
                                <input value="{$utilizador['iban']}"
                                       type="text" name="iban" id="iban" maxlength="25"
                                       style="width: 630px" 
                                       {literal}pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations"
                                          id="observations" style="width: 630px">{$utilizador['observations']}</textarea>
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