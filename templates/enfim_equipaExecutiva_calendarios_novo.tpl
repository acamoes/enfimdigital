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
                                       onclick="closeModal();
                                               request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Curso</label> 
                                <select required name="idCourse"
                                        id="idCourse" style="width: 350px" onChange="document.getElementById('completeName').value = this.options[this.selectedIndex].text;
                                                document.getElementById('course').value = this.options[this.selectedIndex].getAttribute('data-sigla');">
                                    <option value="" selected></option>
                                    {foreach $equipaExecutiva->cursos as $curso}
                                        <option 
                                            {if $curso['status'] eq 'Inativo'}style="color: orangered;"{/if}
                                            value="{$curso['idCourse']}" data-sigla="{$curso['sigla']}">{$curso['name']}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="completeName" id="completeName"/>
                            </div>
                            <div style="float: right">
                                <label for="course">Sigla</label>
                                <input required type="text" name="course" id="course" style="width: 200px" 
                                       {literal} pattern="[A-Z]{2,4}\s([A-Z]{3}\s[0-9]{0,1}\s{0,1}|[0-9]{1}\s|[0-9]{2}[ab]{0,1}\/)*[0-9]{4}$" {/literal} />
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="startDate">Data de Início</label>
                                <input required type="text"
                                       name="startDate" id="startDate" maxlength="10"
                                       style="width: 150px; display: inline-block;" 
                                       {literal}  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"{/literal} />
                                <a class="button small icon fa-calendar" title="selecionar data"
                                  {literal} style="cursor: pointer; padding: 0 0 0 5pt" 
                                      onclick="displayCalendar(document.forms[0].startDate,'yyyy-mm-dd',this)" {/literal} ></a>
                            </div>
                            <div style="float: right">
                                <label for="endDate">Data de Fim</label>
                                <input required type="text"
                                       name="endDate" id="endDate" maxlength="10"
                                       style="width: 150px; display: inline-block;" 
                                       {literal}  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"{/literal} />
                                <a class="button small icon fa-calendar" title="selecionar data"
                                  {literal} style="cursor: pointer; padding: 0 0 0 5pt" 
                                      onclick="displayCalendar(document.forms[0].endDate,'yyyy-mm-dd',this)" {/literal} ></a>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="course">Local</label>
                                <input required type="text" name="local" id="local" style="width: 300px" />
                            </div>
                            <div style="float: right">
                                <label for="course">Vagas</label>
                                <input required type="text" name="vacancy" id="vacancy" style="width: 150px"
                                       {literal}pattern="[0-9]{2}$"{/literal} />
                            </div>
                        </div>							
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Tem estágio?</label> 
                                <input type="radio" name="internship" value="Sim" id="internshipSim" 
                                       onclick="document.getElementById('status').options[3].text = 'Estágio'">
                                <label for="internshipSim">Sim</label> 
                                <input type="radio" name="internship" value="Não" id="internshipNao" checked 
                                       onclick="document.getElementById('status').options[3].text = 'Estágio (opção inválida)';
                                               document.getElementById('status').selectedIndex = 0;">
                                <label for="internshipNao">Não</label>
                            </div>
                            <div style="float: right">
                                <label for="status">Estado</label>
                                <select required name="status" id="status" style="width: 350px" 
                                        {literal} onChange="if (document.getElementById('internshipNao').checked && this.options[this.selectedIndex].value == 'Estágio') {
                                                    this.selectedIndex = 0;
                                                }"> {/literal}
                                            <option value="Aberto" selected>Aberto</option>
                                            <option value="A decorrer">A decorrer</option>
                                            <option value="Terminado">Terminado</option>
                                            <option value="Estágio">Estágio (opção inválida)</option>
                                            <option value="Fechado">Fechado</option>
                                        </select>
                                </div>								
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="observations">Observações</label>
                                    <textarea cols="5" rows="3" name="observations" id="observations" style="width: 630px"></textarea>
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