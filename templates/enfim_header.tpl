<!DOCTYPE HTML>
<html>
    <head>
        <title>ENFIM DIGITAL</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/w3.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" language="javascript">
            function openTab(tab, index)
            {
                for (i = 0; i < document.getElementsByClassName("subTabs").length; i++)
                {
                    document.getElementsByClassName("tabs")[i].style.borderBottom = "6px solid #ccc";
                    document.getElementsByClassName("tabs")[i].style.color = "#ccc";
                    document.getElementsByClassName("subTabs")[i].style.display = "none";
                }
                document.getElementById(tab).style.borderBottom = "6px solid #77f";
                document.getElementById(tab).style.color = "#77f";
                document.getElementById(index + tab).style.display = "block";
            }

            function request(query = 'action=&', target = 'form')
            {
                $.ajax({
                    url: '{$SCRIPT_NAME}',
                    data: query,
                    success: function (data) {
                        $('#' + target).html(data);
                    }
                });
            }

            function showFiles(val)
            {
                if (document.getElementById('idCourse').options[document.getElementById('idCourse').selectedIndex].value != "")
                {
                    if (val.name == 'idModules')
                    {
                        if (document.getElementById('idModules').options[document.getElementById('idModules').selectedIndex].value != "")
                        {
                            document.getElementById('file1').style.display = 'block';
                            document.getElementById('file2').style.display = 'block';
                            document.getElementById('file3').style.display = 'block';
                            document.getElementById('file4').style.display = 'block';
                            return;
                        }
                    }
                }
                document.getElementById('file1').style.display = 'none';
                document.getElementById('file2').style.display = 'none';
                document.getElementById('file3').style.display = 'none';
                document.getElementById('file4').style.display = 'none';
            }
        </script>
    </head>
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
                <nav>
                    <a href="#menu">Menu</a>
                </nav>
            </header>

            <!-- Menu -->
            <nav id="menu">
                <div class="inner">
                    <h2>Menu</br>{$users->username}</h2>
                    <ul class="links">
                        {if $users->permission eq "Equipa Executiva"}<li><a href='{$SCRIPT_NAME}?action=equipaExecutiva&task=dashboard'>Equipa Executiva</a></li>{/if}
                        {if $users->permission eq "Serviços Centrais"}<li><a href='{$SCRIPT_NAME}?action=servicosCentrais&task=dashboard'>Serviços Centrais</a></li>{/if}
                        <li><a href="{$SCRIPT_NAME}?action=exit">Sair</a></li>
                    </ul>
                    <a href="#" class="close">Close</a>
                </div>
            </nav>

