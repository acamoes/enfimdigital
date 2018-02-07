<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>                     
                    <div class="row uniform" style="padding-top: 1.75em">
                        <div style="float: right">
                            <label style="float: right; cursor: pointer"
                                   onclick="$('#form').html('');
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
                            <input required type="text"
                                   name="idCourse" id="idCourse" 
                                   value="{$modulo['curso']}"
                                   readonly="readonly"
                                   style="width: 400px" />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="name">Módulo</label>
                            <input required type="text"
                                   name="name" id="name" 
                                   value="{$modulo['modulo']}"
                                   readonly="readonly"
                                   style="width: 400px" />
                        </div>
                        <div style="float: right">
                            <label for="order">Ordem</label>
                            <input required type="text"
                                   name="order" id="order" 
                                   style="width: 100px" pattern="[0-9]+$"
                                   value="{$modulo['order']}"
                                   readonly="readonly"
                                   />
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="type">Tipo</label>
                            <input required type="text"
                                   name="type" id="type" 
                                   style="width: 100px"
                                   value="{$modulo['type']}"
                                   readonly="readonly"
                                   />
                        </div>
                        <div style="float: right">
                            <label for="duration">Duração (m)</label>
                            <input required
                                   type="text" name="duration" id="duration" style="width: 100px"
                                   value="{$modulo['duration']}"
                                   readonly="readonly"/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="status">Estado</label>
                            <input required
                                   type="text" name="status" id="status" style="width: 200px"
                                   value="{$modulo['status']}"
                                   readonly="readonly"/>				
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>