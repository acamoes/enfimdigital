<section id="wrapper" style="width: 700px;">
    <section id="one" class="wrapper spotlight left style2"
             style="border-radius: 5px; width: 100%;">
        <div class="inner">
            <div class="content">
                <section>   
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
                            <label for="sigla">Sigla</label><input required type="text"
                                                                   name="sigla" id="sigla" style="width: 150px" maxlength="10"
                                                                   value="{$curso['sigla']}"
                                                                   readonly="readonly"/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="name">Curso</label><input required type="text"
                                                                  name="name" id="name" style="width: 350px"
                                                                  value="{$curso['name']}"
                                                                  readonly="readonly"/>
                        </div>
                        <div style="float: right">
                            <label for="level">Nível</label><input required type="text"
                                                                   name="level" id="level" style="width: 200px"
                                                                   value="{$curso['level']}"
                                                                   readonly="readonly"/>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div style="float: left">
                            <label for="internship">Tem estágio?</label><input required type="text"
                                                                               name="internship" id="internship" style="width: 200px"
                                                                               value="{$curso['internship']}"
                                                                               readonly="readonly"/>
                        </div>
                        <div style="float: right">
                            <label for="status">Estado</label><input required type="text"
                                                                     name="status" id="status" style="width: 200px"
                                                                     value="{$curso['status']}"
                                                                     readonly="readonly"/>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>