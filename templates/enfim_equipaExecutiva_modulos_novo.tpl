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
                                       onclick="$('#form').html('');request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Curso</label> <select name="idCourse"
                                                                        id="idCourse" style="width: 400px">
                                    {foreach $equipaExecutiva->cursos as $curso}
                                        <option  
                                            {if $curso['status'] eq 'Inativo'}style="color: orangered;"{/if}
                                            value="{$curso['idCourse']}">{$curso['name']}</option>
                                    {/foreach}
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Módulo</label><input required type="text"
                                                                       name="name" id="name" style="width: 400px" />
                            </div>
                            <div style="float: right">
                                <label for="order">Ordem</label><input required type="text"
                                                                       name="order" id="order" style="width: 100px" pattern="[0-9]+$" />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Tipo</label> <select name="type" id="type"
                                                                         style="width: 200px">
                                    <option value="Base">Base</option>
                                    <option value="Extra">Extra</option>
                                </select>
                            </div>
                            <div style="float: right">
                                <label for="duration">Duração (m)</label><input required
                                                                                type="text" name="duration" id="duration" style="width: 100px"
                                                                                pattern="[0-9]+$" />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Estado</label><select  name="status" id="status" style="width: 200px">
                                    <option value="Pendente">Pendente</option>
                                    <option value="Revisão">Revisão</option>
                                    <option value="Fechado">Fechado</option>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>					
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