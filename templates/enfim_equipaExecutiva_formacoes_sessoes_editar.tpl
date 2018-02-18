<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 700px;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {
                            var datastring = $("#{$currentTab}{$currentSubTab}Atualizar").serializeArray();
                            datastring.push({ldelim}name: 'action', value: '{$action}'});
                                    datastring.push({ldelim}name: 'task', value: 'atualizar'});
                                            datastring.push({ldelim}name: 'tab', value: '{$currentTab}'});
                                                    datastring.push({ldelim}name: 'subTab', value: '{$currentSubTab}'});
                                                            datastring.push({ldelim}name: 'idCourses', value: '{$equipaExecutivaFormacoesIdCourses}'});
                                                                    datastring.push({ldelim}name: 'idCourse', value: '{$sessao['idCourse']}'});
                                                                            datastring.push({ldelim}name: 'idModules', value: '{$sessao['idModules']}'});
                                                                                    $.ajax({
                                                                                        url: '{$SCRIPT_NAME}',
                                                                                        data: datastring,
                                                                                        success: function (result) {
                                                                                            $('#formMsg').html(result);
                                                                                        }
                                                                                    });
                                                                                }

                    </script>
                    <form id="{$currentTab}{$currentSubTab}Atualizar" name="{$currentTab}{$currentSubTab}Atualizar"
                          onSubmit="submeter();
                                  return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="closeModal();
                                               request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                            <input type="hidden" name="idCourses" id="idCourses"
                                   value="{$equipaExecutivaFormacoesIdCourses}" /> 
                            <input type="hidden" name="idCourse" id="idCourse"
                                   value="{$sessao['idCourse']}" />
                            <input type="hidden" name="idModules" id="idModules"
                                   value="{$sessao['idModules']}" /> 
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Módulo</label>
                                <input required type="text" name="name" id="name" value="{$sessao['name']}" style="width: 350px" />
                            </div>
                            <div style="float: right">
                                <label for="duration">Duração</label>
                                <input required type="text" name="duration" id="duration" value="{$sessao['duration']}" style="width: 150px" {literal}pattern="^[0-9]{2,3}$"{/literal} />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="type">Tipo</label> <select name="type" id="type"  style="width: 200px">
                                    <option value="Base" {if $sessao['type'] eq "Base"}selected="selected"{/if}>Base</option>
                                    <option value="Extra" {if $sessao['type'] eq "Extra"}selected="selected"{/if}>Extra</option>
                                    <option value="Proposto" {if $sessao['type'] eq "Proposto"}selected="selected"{/if}>Proposto</option>
                                </select>
                            </div>
                            <div style="float:right">
                                <label for="order">Ordem</label>
                                <input required type="text" name="order" id="order" style="width: 100px" pattern="[0-9]+$" value="{$sessao['order']}"/>
                            </div>        
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Estado</label><select  name="status" id="status" style="width: 200px">
                                    <option value="Pendente" {if $sessao['status'] eq "Pendente"}selected="selected"{/if}>Pendente</option>
                                    <option value="Revisão" {if $sessao['status'] eq "Revisão"}selected="selected"{/if}>Revisão</option>
                                    <option value="Fechado" {if $sessao['status'] eq "Fechado"}selected="selected"{/if}>Fechado</option>
                                    <option value="Ativo" {if $sessao['status'] eq "Ativo"}selected="selected"{/if}>Ativo</option>
                                    <option value="Inativo" {if $sessao['status'] eq "Inativo"}selected="selected"{/if}>Inativo</option>
                                </select>					
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea required cols="5" rows="3" name="observations" id="observations" style="width: 630px">{$sessao['observations']|urldecode}</textarea>
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