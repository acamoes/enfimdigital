{include file="enfim_header_out.tpl"}
<section id="wrapper">
    <section id="one" class="wrapper spotlight left style2">
        <div class="inner">
            <div class="content">
                <h2 class="major">Login</h2><h3 class="alert">{$error}</h3>
                <form method="post" action="{$SCRIPT_NAME}?action=recover" id="recoverPassword">
                    <div class="field">
                        <label for="username">Username</label> <input type="text"
                                                                      name="username" id="username"
                                                                      style="width: 50%" />
                    </div>                                
                    <ul class="actions">
                        <li><button class="g-recaptcha" data-sitekey="{$botKey}" data-callback="onSubmit">Recuperar</button></li>
                    </ul>
                </form>
            </div>
        </div>
    </section>
</section>
{include file="enfim_footer.tpl"}

