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
                                       onclick="$('#form').html('');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="curso">Curso</label> 
                                <select required name="idCourse"
                                        id="idCourse" style="width: 350px">
                                    <option value="" selected></option>
                                    {foreach $equipaExecutiva->cursos as $curso}
                                        <option 
                                            {if $curso['status'] eq 'Inativo'}style="color: orangered;"{/if}
                                            value="{$curso['idCourse']}">{$curso['name']}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Nome</label>
                                <input required type="text" name="name" id="name" style="width: 300px" maxlength="100" />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Estado</label> 
                                <input type="radio"
                                       id="Ativo" name="status" value="Ativo" checked=""><label
                                       for="Ativo">Ativo</label> <input type="radio" id="Inativo"
                                       name="status" value="Inativo"><label for="Inativo">Inativo</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="template">Observações</label>
                                <textarea cols="10" rows="5" name="template" id="template" style="width: 630px"></textarea>
                                <a href="#" class="small button" onclick="document.getElementById('templateFormat').innerHTML = JSON.stringify(JSON.parse(document.getElementById('template').value), undefined, 4)">Format</a>

                            </div>
                            <div style="float: right;">
                                <button>Submit</button>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left;">
                                <pre><code id="templateFormat"></code></pre>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>