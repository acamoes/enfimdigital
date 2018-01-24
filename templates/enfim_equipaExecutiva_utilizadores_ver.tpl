<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>   
                    <div class="row uniform" style="padding-top: 1.75em">
                        <div style="float: right">
                            <label style="float: right; cursor: pointer"
                                   onclick="getElementById('form').innerHTML = '';request('action={$action}&task=search&tab={$currentTab}&search=' + document.getElementById('{$currentTab}search').value, 'ST{$currentTab}');">X
                                Close</label>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div id="formMsg"></div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="username">Username</label><input type="text" 
                                                                         name="username" 
                                                                         id="username" 
                                                                         value="{$utilizador['username']}" 
                                                                         readonly="readonly"
                                                                         style="width: 200px"  />
                        </div>
                        <div style="float: right">
                            <label for="email">Email</label><input  type="text"
                                                                    name="email" id="email"
                                                                    value="{$utilizador['email']}" 
                                                                    readonly="readonly"
                                                                    style="width: 350px" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="sigla">Sigla</label><input type="text" name="sigla"                                                                   
                                                                   id="sigla" 
                                                                   value="{$utilizador['sigla']}" 
                                                                   readonly="readonly"
                                                                   maxlength="3" style="width: 100px" />
                        </div>
                        <div style="float: right">
                            <label for="name">Nome</label><input  type="text"
                                                                  name="name" 
                                                                  id="name" 
                                                                  value="{$utilizador['name']}" 
                                                                  readonly="readonly"
                                                                  style="width: 400px" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="permission">Nível</label><input  type="text"
                                                                         name="permission" 
                                                                         id="permission" 
                                                                         value="{$utilizador['permission']}" 
                                                                         readonly="readonly"
                                                                         style="width: 200px" /> 
                        </div>
                        <div style="float: right">
                            <label for="status">Estado</label><input  type="text"
                                                                      name="status" 
                                                                      id="status" 
                                                                      value="{$utilizador['status']}" 
                                                                      readonly="readonly"
                                                                      style="width: 200px" /> 
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="birthDate">Nascimento</label><input type="text"
                                                                            name="birthDate" 
                                                                            id="birthDate" 
                                                                            value="{$utilizador['birthDate']}" 
                                                                            readonly="readonly"
                                                                            maxlength="10" />
                        </div>
                        <div style="float: right">
                            <label for="aepId">NrAssoc</label><input  type="text"
                                                                      name="aepId" 
                                                                      id="aepId" 
                                                                      value="{$utilizador['aepId']}" 
                                                                      readonly="readonly"
                                                                      maxlength="6" style="width: 150px" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="address">Morada</label><input type="text"
                                                                      name="address" 
                                                                      id="address" 
                                                                      value="{$utilizador['address']}" 
                                                                      readonly="readonly"
                                                                      style="width: 400px" />
                        </div>
                        <div style="float: right">
                            <label for="mobile">Telemóvel</label><input type="text"
                                                                        name="mobile" 
                                                                        id="mobile"
                                                                        value="{$utilizador['mobile']}" 
                                                                        readonly="readonly"
                                                                        maxlength="9" style="width: 150px" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="zipCode">Código Postal</label> <input type="text" 
                                                                              name="zipCode" 
                                                                              id="zipCode" 
                                                                              value="{$utilizador['zipCode']} {$utilizador['local']}" 
                                                                              readonly="readonly"
                                                                              style="width: 300px" />
                        </div>
                        <div style="float: right">
                            <label for="telephone">Telefone</label><input type="text"
                                                                          name="telephone" 
                                                                          id="telephone" 
                                                                          value="{$utilizador['telephone']}" 
                                                                          readonly="readonly"
                                                                          maxlength="9" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="iban">IBAN</label><input type="text" 
                                                                 name="iban"
                                                                 id="iban"
                                                                 value="{$utilizador['iban']}" 
                                                                 readonly="readonly"
                                                                 maxlength="25" style="width: 630px" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="observations">Observações</label>
                            <textarea cols="5" rows="3" name="observations" readonly="readonly"
                                      id="observations" style="width: 630px">{$utilizador['observations']}</textarea>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>