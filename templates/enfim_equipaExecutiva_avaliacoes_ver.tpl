<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section> 
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
                                <label for="curso">Curso</label> 
                                <input required type="text" name="curso" id="name" style="width: 300px" maxlength="100"
                                       value="{$avaliacao['curso']}" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="name">Nome</label>
                                <input required type="text" name="name" id="name" style="width: 300px" maxlength="100"
                                       value="{$avaliacao['name']}" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Alvo</label> 
                                <input required type="text" name="target" id="status" style="width: 300px" maxlength="100"
                                       value="{$avaliacao['target']}" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="status">Estado</label>
                                <input required type="text" name="status" id="status" style="width: 300px" maxlength="100"
                                       value="{$avaliacao['status']}" readonly="readonly"/>
                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left">
                                <label for="template">Observações</label>
                                <textarea cols="10" rows="5" name="template" id="template" style="width: 630px" readonly="readonly">{$avaliacao['template']}</textarea>
                                <a href="#" class="small button" onclick="document.getElementById('templateFormat').innerHTML = JSON.stringify(JSON.parse(document.getElementById('template').value), undefined, 4)">Format</a>

                            </div>
                        </div>
                        <div class="row uniform">
                            <div style="float: left;">
                                <pre><code id="templateFormat"></code></pre>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </section>
</section>