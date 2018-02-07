<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}Atualizar").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'atualizar'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                    datastring.push({ldelim}name: 'idCourse', value: '{$curso['idCourse']}'});
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
                                               request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="sigla">Sigla</label><input required type="text"
                                                                       name="sigla" id="sigla" style="width: 150px" maxlength="10"
                                                                       value="{$curso['sigla']}"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Curso</label><input required type="text"
                                                                      name="name" id="name" style="width: 350px"
                                                                      value="{$curso['name']}"/>
                            </div>
                            <div style="float: right">
                                <label for="level">Nível</label> <select name="level" id="level"
                                                                         style="width: 200px">
                                    <option value="Etapa Informativa" {if $curso['level'] eq "Etapa Informativa"}selected{/if}>Etapa Informativa</option>
                                    <option value="Etapa Avançada" {if $curso['level'] eq "Etapa Avançada"}selected{/if}>Etapa Avançada</option>
                                    <option value="Instrutor" {if $curso['level'] eq "Instrutor"}selected{/if}>Instrutor</option>
                                    <option value="Monográfico" {if $curso['level'] eq "Monográfico"}selected{/if}>Monográfico</option>
                                    <option value="Extra" {if $curso['level'] eq "Extra"}selected{/if}>Extra</option>
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="internship">Tem estágio?</label> <input type="radio"
                                                                                    id="Sim" name="internship" value="Sim"
                                                                                    {if $curso['internship'] eq "Sim"}checked="checked"{/if}><label
                                                                                    for="Sim">Sim</label> <input type="radio"
                                                                                    id="Não" name="internship" value="Não"
                                                                                    {if $curso['internship'] eq "Não"}checked="checked"{/if}><label
                                                                                    for="Não">Não</label>
                            </div>
                            <div style="float: right">
                                <label for="status">Estado</label> <input type="radio"
                                                                          id="Ativo" name="status" value="Ativo"
                                                                          {if $curso['status'] eq "Ativo"}checked="checked"{/if}>
                                <label
                                    for="Ativo">Ativo</label> <input type="radio" 
                                    id="Inativo" name="status" value="Inativo"
                                    {if $curso['status'] eq "Inativo"}checked="checked"{/if}>
                                <label for="Inativo">Inativo</label>
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