<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>    
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
                            <input required type="text" name="course" id="course" style="width: 350px" 
                                   value="{$calendario['completeName']}" readonly="readonly" />                                
                        </div>
                        <div style="float: right">
                            <label for="course">Sigla</label>
                            <input required type="text" name="course" id="course" style="width: 200px"  value="{$calendario['course']}" readonly="readonly"
                                   {literal} pattern="[A-Z]{2,3}\s([A-Z]{3}\s|[0-9]{2}\/)*[0-9]{4}$" {/literal} />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="startDate">Data de Início</label>
                            <input required type="text"  value="{$calendario['startDate']}"  readonly="readonly"
                                   name="startDate" id="startDate" maxlength="10"
                                   style="width: 150px; display: inline-block;"                             
                                       {literal}  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"{/literal} />
                        </div>
                        <div style="float: right">
                            <label for="endDate">Data de Fim</label>
                            <input required type="text"  value="{$calendario['endDate']}"  readonly="readonly"
                                   name="endDate" id="endDate" maxlength="10"
                                   style="width: 150px; display: inline-block;"                             
                                       {literal}  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}$"{/literal} />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="course">Local</label>
                            <input required type="text" name="local" id="local"   value="{$calendario['local']}" style="width: 300px"  readonly="readonly"/>
                        </div>
                        <div style="float: right">
                            <label for="course">Vagas</label>
                            <input required type="text" name="vacancy" id="vacancy" style="width: 150px"  readonly="readonly"  value="{$calendario['vacancy']}"
                                   {literal}pattern="[0-9]{2}$"{/literal} />
                        </div>
                    </div>							
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="status">Tem estágio?</label>
                            <input required type="text" name="internship" id="internship" style="width: 150px"  
                                   readonly="readonly"  value="{$calendario['internship']}"/>
                        </div>
                        <div style="float: right">
                            <label for="status">Estado</label>
                            <input required type="text" name="status" id="status" style="width: 150px"  readonly="readonly"  
                                   value="{$calendario['status']}"/>
                        </div>								
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="observations">Observações</label>
                            <textarea cols="5" rows="3" name="observations" id="observations" readonly="readonly" style="width: 630px">{$calendario['observations']|urldecode}</textarea>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>