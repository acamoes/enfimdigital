<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>
                    <script>
                        function submeter() {                          
                        var datastring = $("#utilizadoresNovo").serializeArray();
                        datastring.push({ name:'action', value:'{$modulo}' });
                        datastring.push({ name:'task', value:'inserir' });
                        datastring.push({ name:'tab', value:'utilizadores' });
                        $.ajax({
                                url: '{$SCRIPT_NAME}',
                                data: datastring,
                                success: function (result) {
                                        $('#form').html('');
                                        $('#STutilizadores').html(result);
                                }
                        });
                        }

                    </script>
                    <form id="utilizadoresNovo" name="utilizadoresNovo"
                          onSubmit="submeter();return false;">    
                        <div class="row uniform" style="padding-top: 1.75em">
                            <div style="float: right">
                                <label style="float: right; cursor: pointer"
                                       onclick="$('#form').innerHTML = '';">X
                                    Close</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div id="formMsg"></div>
                        </div>
                        {literal}
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="username">Username</label><input required
                                                                                 type="text" name="username" id="username" style="width: 200px"
                                                                                 pattern="[a-z0-9._%+-]{6,}$" />
                                </div>
                                <div style="float: right">
                                    <label for="email">Email</label><input required type="text"
                                                                           name="email" id="email" style="width: 350px"
                                                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="sigla">Sigla</label><input type="text" name="sigla"
                                                                           id="sigla" maxlength="3" style="width: 100px"
                                                                           pattern="[A-Z]{2,3}$" />
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
                                                                              id="ativo" name="status" value="Ativo" checked=""><label
                                                                              for="ativo">Ativo</label> <input type="radio" id="inativo"
                                                                              name="status" value="Inativo"><label for="inativo">Inativo</label>
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="birthDate">Nascimento</label><input type="text"
                                                                                    name="birthDate" id="birthDate" maxlength="10"
                                                                                    style="width: 150px" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />
                                </div>
                                <div style="float: right">
                                    <label for="aepId">NrAssoc</label><input required type="text"
                                                                             name="aepId" id="aepId" maxlength="6" style="width: 150px"
                                                                             pattern="[0-9]{5,}$" />
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
                                                                                pattern="[0-9]{9}$" />
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="zipCode">Código Postal</label> <input required
                                                                                      type="text" name="zipCode" id="zipCode" style="width: 300px"
                                                                                      pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />
                                </div>
                                <div style="float: right">
                                    <label for="telephone">Telefone</label><input type="text"
                                                                                  name="telephone" id="telephone" maxlength="9"
                                                                                  style="width: 150px" pattern="[0-9]{9}$" />
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="iban">IBAN</label><input type="text" name="iban"
                                                                         id="iban" maxlength="25" style="width: 630px"
                                                                         pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />
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
                        {/literal}
                    </form>
                </section>
            </div>
        </div>
    </section>
</section>