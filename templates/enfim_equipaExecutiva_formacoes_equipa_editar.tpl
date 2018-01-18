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
                                                            datastring.push({ldelim}name: 'idUsers', value: '{$utilizador['idUsers']}'});
                                                                    datastring.push({ldelim}name: 'idCourses', value: '{$equipaExecutivaFormacoesIdCourses}'});
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
                                       onclick="$('#form').html('');">X
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
                                                                             value="{$utilizador['username']}"
                                                                             {literal}pattern="[a-z0-9._%+-]{6,}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="email">Email</label><input required type="text"
                                                                       name="email" id="email" style="width: 350px"
                                                                       value="{$utilizador['email']}"
                                                                       {literal}pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="sigla">Sigla</label><input type="text" name="sigla"
                                                                       id="sigla" maxlength="3" style="width: 100px"
                                                                       value="{$utilizador['sigla']}"
                                                                       {literal}pattern="[A-Z]{2,3}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="name">Nome</label><input required type="text"
                                                                     name="name" id="name" style="width: 400px"
                                                                     value="{$utilizador['name']}"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="permission">Nível</label> <select name="permission"
                                                                              id="permission" style="width: 200px">
                                    <option value="Equipa Executiva" {if $utilizador['permission'] eq "Equipa Executiva"}selected{/if}>Equipa Executiva</option>
                                    <option value="Serviços Centrais" {if $utilizador['permission'] eq "Serviços Centrais"}selected{/if}>Serviços Centrais</option>
                                    <option value="Formador" {if $utilizador['permission'] eq "Formador"}selected{/if}>Formador</option>
                                    <option value="Formando" {if $utilizador['permission'] eq "Formando"}selected{/if}>Formando</option>
                                </select>
                            </div>
                            <div style="float: right">
                                <label for="status">Estado</label> <input type="radio"
                                                                          id="ativo" name="status" value="Ativo" {if $utilizador['status'] eq "Ativo"}checked="checked"{/if}><label
                                                                          for="ativo">Ativo</label> <input type="radio" id="inativo"
                                                                          name="status" value="Inativo"{if $utilizador['status'] eq "Inativo"}checked="checked"{/if}><label for="inativo">Inativo</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="birthDate">Nascimento</label><input type="text"
                                                                                name="birthDate" id="birthDate" maxlength="10"
                                                                                style="width: 150px" 
                                                                                value="{$utilizador['birthDate']}"
                                                                                {literal}pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="aepId">NrAssoc</label><input required type="text"
                                                                         name="aepId" id="aepId" maxlength="6" style="width: 150px"
                                                                         value="{$utilizador['aepId']}"
                                                                         {literal}pattern="[0-9]{5,}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="address">Morada</label><input type="text"
                                                                          name="address" id="address" style="width: 400px"
                                                                          value="{$utilizador['address']}"/>
                            </div>
                            <div style="float: right">
                                <label for="mobile">Telemóvel</label><input type="text"
                                                                            name="mobile" id="mobile" maxlength="9" style="width: 150px"
                                                                            value="{$utilizador['mobile']}"
                                                                            {literal}pattern="[0-9]{9}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="zipCode">Código Postal</label> <input required
                                                                                  type="text" name="zipCode" id="zipCode" style="width: 300px"
                                                                                  value="{$utilizador['zipCode']} {$utilizador['local']}" 
                                                                                  {literal}pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="telephone">Telefone</label><input type="text"
                                                                              name="telephone" id="telephone" maxlength="9"
                                                                              style="width: 150px"
                                                                              value="{$utilizador['telephone']}"
                                                                              {literal}pattern="[0-9]{9}$" />{/literal}
                            </div>
                        </div>
                        {if $currentSubTab eq 'inscritos'}    
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="unitType">Nível</label> 
                                    <select name="unitType"
                                            id="unitType" style="width: 200px"
                                            onChange="changeField1(this.options[this.selectedIndex].value, '{$utilizador['unitType']}', 'unitDiv'); changeField2(this.options[this.selectedIndex].value, '{$utilizador['unit']}', 'rankDiv');">
                                        <option selected></option>
                                        <option value="Nacional"
                                                {if $utilizador['unitType'] eq "Nacional"}selected='selected'{/if}>Nacional</option>
                                        <option value="Regional"
                                                {if $utilizador['unitType'] eq "Regional"}selected='selected'{/if}>Regional</option>
                                        <option value="Local"
                                                {if $utilizador['unitType'] eq "Local"}selected='selected'{/if}>Local</option>
                                    </select>
                                </div>
                                <div style="float: right" id="unitDiv">
                                    <label for="unit">Unidade</label> <input
                                        value="{$utilizador['unit']}" type="text" name="unit" id="unit"
                                        style="width: 200px" />
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left" id="rankDiv">
                                    <label for="rank">Cargo/Função</label> <input
                                        value="{$utilizador['rank']}" type="text" name="rank" id="rank"
                                        style="width: 200px" />
                                </div>
                                <div style="float: right">
                                    <label for="boRank">BO Cargo/Função</label> <input
                                        value="{$utilizador['boRank']}" type="text" name="boRank"
                                        id="boRank" style="width: 200px"
                                        {literal}pattern="^BO\s[0-9]{1,2}\/[0-9]{4}$" />{/literal}
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <input type="checkbox" name="qa" id="qa" {if $utilizador['qa'] eq 'on'}checked='checked'{/if} />
                                    <label for="qa">Quota paga</label> 
                                    <input type="checkbox" name="payment" id="payment" {if $utilizador['payment'] eq 'on'}checked='checked'{/if} />
                                    <label for="payment">Pago</label>
                                </div>
                                <div style="float: right">
                                    <label for="value">Valor</label> <input
                                        value="{$utilizador['value']}" type="text" name="value" id="value"
                                        style="width: 150px" 
                                        {literal}pattern="^[0-9]{2,3}$" />{/literal}
                                </div>
                            </div>
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="value">Recibo</label> <input
                                        value="{$utilizador['receipt']}" type="text" name="receipt"
                                        id="receipt" style="width: 200px" />
                                </div>
                                <div style="float: right">
                                    <label for="value">BO do curso</label> <input
                                        value="{$utilizador['boCourse']}" type="text" name="boCourse"
                                        id="boCourse" style="width: 150px"
                                        {literal}pattern="^BO\s[0-9]{1,2}\/[0-9]{4}$" />{/literal}
                                </div>
                            </div>                        
                            <div class="row uniform">
                                <div style="float: left">
                                    <label for="status">Terminou com aproveitamento:</label> 
                                    <input type="checkbox" name="attended" id="attended" {if $utilizador['attended'] eq 'on'}checked='checked'{/if} />
                                    <label for="attended">Participou?</label> 
                                    <input type="checkbox" name="passedCourse" id="passedCourse" {if $utilizador['passedCourse'] eq 'on'}checked='checked'{/if} />
                                    <label for="passedCourse">Curso</label> 
                                    <input type="checkbox" name="passedInternship" id="passedInternship" {if $utilizador['passedInternship'] eq 'on'}checked='checked'{/if}/>
                                    <label for="passedInternship">Estágio</label> 
                                    <input type="checkbox" name="passed" id="passed" {if $utilizador['passed'] eq 'on'}checked='checked'{/if} />
                                    <label for="passed">Etapa</label>
                                </div>
                            </div>
                        {else}
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
                        {/if}
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