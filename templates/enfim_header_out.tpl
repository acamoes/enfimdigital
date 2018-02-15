<!DOCTYPE HTML>
<html>
    <head>
        <title>ENFIM DIGITAL</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" type="text/css" href="assets/css/main.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/w3.css" />
        <!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="assets/css/ie8.css" /><![endif]-->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <script>
        function onSubmit(token) {
            if (confirm("Confirma que deseja recuperar a sua password?") == true) {
                document.getElementById("recoverPassword").submit();
            }
        }
    </script>
    <body>

        <!-- Page Wrapper -->
        <div id="loader"
             style="position: absolute; top: 30%; left: 40%; z-index: 50; cursor: auto;"></div>
        <div id="form"
             style="position: fixed; top: 0; left: 2%; z-index: 2147483647; cursor: auto;"></div>
        <div id="page-wrapper">
            <!-- Header -->
            <header id="header" style="height: 100px">
                <h1>
                    <img class="logo icon svg" src="images/logo_2.svg" height="80px" style="cursor:pointer;margin: 10px" onclick="javascript:location.href = '{$SCRIPT_NAME}?action=home'"/>
                </h1>
            </header>

