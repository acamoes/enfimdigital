<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 700px;">
        <div class="inner">
            <div class="content">

                <section>

                    <div class="row uniform" style="padding-top: 1.75em">
                        <div style="float: right">
                            <label style="float: right; cursor: pointer"
                                   onclick="closeModal();
                                           request('action={$action}&task=search&tab={$currentTab}&subTab={$currentSubTab}&search=' + document.getElementById('{$currentTab}{$currentSubTab}search').value + '&{$action}{$currentTab|ucfirst}IdCourses=' + document.getElementById('{$action}{$currentTab}IdCourse').options[document.getElementById('{$action}{$currentTab}IdCourse').selectedIndex].value, 'SST{$currentTab}{$currentSubTab}');">X
                                Close</label>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="username">Username</label><input required
                                                                         type="text" name="username" id="username" style="width: 200px"
                                                                         value="{$utilizador['username']}" readonly
                                                                         {literal}pattern="[a-z0-9._@%+-]{6,}$" />{/literal}
                        </div>
                        <div style="float: right">
                            <label for="email">Email</label><input required type="text"
                                                                   name="email" id="email" style="width: 350px"
                                                                   value="{$utilizador['email']}" readonly
                                                                   {literal}pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />{/literal}
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="sigla">Sigla</label><input type="text" name="sigla"
                                                                   id="sigla" maxlength="3" style="width: 100px"
                                                                   value="{$utilizador['sigla']}" readonly
                                                                   {literal}pattern="[A-Z]{2,3}$" />{/literal}
                        </div>
                        <div style="float: right">
                            <label for="name">Nome</label><input required type="text"
                                                                 name="name" id="name" style="width: 400px"
                                                                 value="{$utilizador['name']}" readonly/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="permission">Nível</label>
                            <input required type="text"
                                   name="permission" id="permission" style="width: 200px"
                                   value="{$utilizador['permission']}" readonly/>
                        </div>
                        <div style="float: right">
                            <label for="status">Estado</label> 
                            <input required type="text"
                                   name="status" id="status" style="width: 200px"
                                   value="{$utilizador['status']}" readonly/>                         
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="birthDate">Nascimento</label>
                            <input type="text"
                                   name="birthDate" id="birthDate" maxlength="10"
                                   value="{$utilizador['birthDate']}" readonly
                                   style="width: 150px; display: inline-block;"                             
                                   {literal}  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"{/literal} />
                            </div>
                            <div style="float: right">
                                <label for="aepId">NrAssoc</label><input required type="text"
                                                                         name="aepId" id="aepId" maxlength="6" style="width: 150px"
                                                                         value="{$utilizador['aepId']}" readonly
                                                                         {literal}pattern="[0-9]{5,}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="address">Morada</label><input type="text"
                                                                          name="address" id="address" style="width: 400px"
                                                                          value="{$utilizador['address']}" readonly/>
                            </div>
                            <div style="float: right">
                                <label for="mobile">Telemóvel</label><input type="text"
                                                                            name="mobile" id="mobile" maxlength="9" style="width: 150px"
                                                                            value="{$utilizador['mobile']}" readonly
                                                                            {literal}pattern="[0-9]{9}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="zipCode">Código Postal</label> <input required
                                                                                  type="text" name="zipCode" id="zipCode" style="width: 300px"
                                                                                  value="{$utilizador['zipCode']} {$utilizador['local']}" readonly
                                                                                  {literal}pattern="[0-9]{4}-[0-9]{3}\s[\w]+.+$" />{/literal}
                            </div>
                            <div style="float: right">
                                <label for="telephone">Telefone</label><input type="text"
                                                                              name="telephone" id="telephone" maxlength="9"
                                                                              style="width: 150px"
                                                                              value="{$utilizador['telephone']}" readonly
                                                                              {literal}pattern="[0-9]{9}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="unitType">Nível</label> 
                                <input type="text"
                                       name="unitType" id="unitType" maxlength="9"
                                       style="width: 150px"
                                       value="{$utilizador['unitType']}" readonly/>
                            </div>
                            <div style="float: right" id="unitDiv">
                                <label for="unit">Unidade</label> <input
                                    value="{$utilizador['unit']}" type="text" name="unit" id="unit"
                                    style="width: 200px" readonly/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left" id="rankDiv">
                                <label for="rank">Cargo/Função</label> <input
                                    value="{$utilizador['rank']}" readonly type="text" name="rank" id="rank"
                                    style="width: 200px" />
                            </div>
                            <div style="float: right">
                                <label for="boRank">BO Cargo/Função</label> <input
                                    value="{$utilizador['boRank']}" readonly type="text" name="boRank"
                                    id="boRank" style="width: 200px"
                                    {literal}pattern="^BO\s[0-9]{1,2}\/[0-9]{4}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <input type="checkbox" name="qa" id="qa"  disabled='true' {if $utilizador['qa'] eq 'on'}checked='checked'{/if} />
                                <label for="qa">Quota paga</label> 
                                <input type="checkbox" name="payment"  disabled='true' id="payment" {if $utilizador['payment'] eq 'on'}checked='checked'{/if} />
                                <label for="payment">Pago</label>
                            </div>
                            <div style="float: right">
                                <label for="value">Data de pagamento</label> <input
                                    value="{$utilizador['paymentDate']}" readonly type="text" name="paymentDate" id="paymentDate"
                                    style="width: 150px" 
                                    {literal}pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="value">Recibo</label> <input
                                    value="{$utilizador['receipt']}" readonly type="text" name="receipt"
                                    id="receipt" style="width: 200px" />
                            </div>
                            <div style="float: right">
                                <label for="value">Valor</label> <input
                                    value="{$utilizador['value']}" readonly type="text" name="value" id="value"
                                    style="width: 150px" 
                                    {literal}pattern="^[0-9]{2,3}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="value">Selecionado</label> <input
                                    value="{$utilizador['selected']}" readonly type="text" name="selected" id="selected"
                                    style="width: 200px" />
                            </div>
                            <div style="float: right">
                                <label for="value">BO do curso</label> <input
                                    value="{$utilizador['boCourse']}" readonly type="text" name="boCourse"
                                    id="boCourse" style="width: 150px"
                                    {literal}pattern="^BO\s[0-9]{1,2}\/[0-9]{4}$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="iban">IBAN</label>
                                <input value="{$utilizador['iban']}" readonly
                                       type="text" name="iban" id="iban" maxlength="25"
                                       style="width: 630px" 
                                       {literal}pattern="([0-9]{21}|[A-Z]{2}[0-9]{23})+$" />{/literal}
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Terminou com aproveitamento:</label> 
                                <input type="checkbox" name="attended" id="attended" {if $utilizador['attended'] eq 'on'}checked='checked'{/if} disabled='true'/>
                                <label for="attended">Participou?</label> 
                                <input type="checkbox" name="passedCourse" id="passedCourse" {if $utilizador['passedCourse'] eq 'on'}checked='checked'{/if} disabled='true'/>
                                <label for="passedCourse">Curso</label> 
                                <input type="checkbox" name="passedInternship" id="passedInternship" {if $utilizador['passedInternship'] eq 'on'}checked='checked'{/if} disabled='true'/>
                                <label for="passedInternship">Estágio</label> 
                                <input type="checkbox" name="passed" id="passed" {if $utilizador['passed'] eq 'on'}checked='checked'{/if} disabled='true'/>
                                <label for="passed">Etapa</label>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="observations">Observações</label>
                                <textarea cols="5" rows="3" name="observations" readonly
                                          id="observations" style="width: 630px">{$utilizador['observations']|urldecode}</textarea>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>