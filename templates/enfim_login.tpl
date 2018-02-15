{* Smarty *}
<!DOCTYPE HTML>
<html>
    <head>
        <title>ENFIM DIGITAL</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    </head>
    <body>

        <!-- Page Wrapper -->
        <div id="page-wrapper">
            <!-- Banner -->
            <section id="banner">
                <div class="inner">
                    <div class="logo">
                        <span><img class="icon svg" src="images/logo_1.svg" /></span>
                    </div>
                    <h2>ENFIM DIGITAL</h2>
                    <p>Serve este site para gerir a documentação dos cursos, avaliações
                        e acompanhamento de estágio.</p>
                </div>
            </section>

            <!-- Wrapper -->
            <section id="wrapper">
                <section id="one" class="wrapper spotlight left style2">
                    <div class="inner">
                        <div class="content">
                            <h2 class="major">Login</h2><h3 class="alert">{$error}</h3>
                            <form method="post" action="{$SCRIPT_NAME}?action=submit">
                                <div class="field">
                                    <label for="username">Username</label> <input type="text"
                                                                                  name="username" id="username" value=""
                                                                                  style="width: 50%" />
                                </div>
                                <div class="field">
                                    <label for="password">Password</label> <input type="password"
                                                                                  name="password" id="password" value="" style="width: 50%" />
                                </div>
                                <ul class="actions">
                                    <li><input type="submit" name="submit" value="Submit" /></li>
                                </ul>
                                <div class="6u 12u(small)">
                                    <input type="checkbox" name="recoverPassword"
                                           id="recoverPassword"> <label for="recoverPassword">Recover
                                        password</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
            {include file="enfim_footer.tpl"}

