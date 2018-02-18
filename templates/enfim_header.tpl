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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link type="text/css" rel="stylesheet" href="assets/css/dhtmlgoodies_calendar.css" media="screen"></LINK>
	<SCRIPT type="text/javascript" src="assets/js/dhtmlgoodies_calendar.js"></script>
        <script type="text/javascript" language="javascript">

            $(document).on('keyup keypress', function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    if (e.currentTarget.activeElement.localName == 'textarea')
                    {
                    } else if ($('button:visible').length > 0)
                    {
                        $('button:visible')[0].click();
                    } else if ($('a.fa-search:visible').length > 0)
                    {
                        $('a.fa-search:visible')[0].click();
                    } else
                    {
                        return false;
                    }
                    return true;
                }
            });

            function openTab(tab, index)
            {
                for (i = 0; i < document.getElementsByClassName("tabsBox").length; i++)
                {
                    document.getElementsByClassName("tabs")[i].style.borderBottom = "6px solid #ccc";
                    document.getElementsByClassName("tabs")[i].style.color = "#ccc";
                    document.getElementsByClassName("tabsBox")[i].style.display = "none";
                }
                document.getElementById(tab).style.borderBottom = "6px solid #77f";
                document.getElementById(tab).style.color = "#77f";
                document.getElementById(index + tab).style.display = "block";
            }

            function closeModal()
            {
                $('#form').html('');
                $('#calendarDiv').hide();
                if ($('a.fa-search:visible').length > 0)
                    {
                        $('a.fa-search:visible')[0].click();
                    }
            }

            function openSubTab(tab, index)
            {
                for (i = 0; i < document.getElementsByClassName("subTabsBox").length; i++)
                {
                    document.getElementsByClassName("subTabs")[i].style.borderBottom = "6px solid #ccc";
                    document.getElementsByClassName("subTabs")[i].style.color = "#ccc";
                    document.getElementsByClassName("subTabsBox")[i].style.display = "none";
                }
                document.getElementById(tab).style.borderBottom = "6px solid #77f";
                document.getElementById(tab).style.color = "#77f";
                document.getElementById(index + tab).style.display = "block";
            }

            function request(query = 'action=&', target = 'form')
            {
                if (target == 'form') {
                    $('#form').css('position', 'fixed');
                    $('#form').css('top', 100);
                }
                $('#loader').html('<img id="ajaxLoader" src="images/loader.gif" style="width:100px;heigth:100px" />');
                $.ajax({
                    url: '{$SCRIPT_NAME}',
                    data: query,
                    success: function (data) {
                        $('#loader').html('');
                        $('#' + target).html(data);
                        if (target == 'form') {
                            topPos = $('#form').offset().top;
                            $('#form').css('position', 'absolute');
                            $('#form').css('top', topPos);
                        }
                    }
                });
            }

            function requestAPI(query = 'action=&', target = 'form')
            {
                $('#loader').html('<img id="ajaxLoader" src="images/loader.gif" style="width:100px;heigth:100px" />');
                $.ajax({
                    url: '{$SCRIPT_NAME}',
                    data: query,
                    success: function (data) {
                        obj = JSON.parse(data);
                        $('#loader').html('');
                        if (typeof obj.success !== 'undefined') {
                            $('#' + target).html("<div id='errorForThreeSecond'><h3 class='alert'>" + obj.message + "</h3></div>");
                        } else {
                            $('#username').val([obj.username]);
                            $('#name').val(obj.name);
                            $('#email').val(obj.email);
                            $('#birthDate').val(obj.birthDate);
                            $('#address').val(obj.address);
                            $('#zipCode').val(obj.zipCode);
                            $('#mobile').val(obj.mobile);
                            $('#telephone').val(obj.telephone);
                            $('#observations').val(obj.observations);
                            $('[name="status"]').val([obj.status]);
                            $('#' + target).html("<div id='errorForThreeSecond'><h3 class='success'>" + obj.message + "</h3></div>");
                            $('#unitType').val(obj.unitType);
                            $('#rank').val(obj.rank);
                            $('#boRank').val(obj.boRank);
                            $('#unit').val(obj.unit);

                        }
                        //$('#' + target).html(data);
                    }
                });
            }

            function isPositiveInteger(n) {
                return 0 === n % (!isNaN(parseFloat(n)) && 0 <= ~~n);
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

            function changeField1(tipo, value, id)
            {
                var html = '';
                if (tipo == 'Nacional')
                {
                    html = '<label for="unit">Unidade</label>';
                    html += '<select  required name="unit" id="unit" style="width: 200px">';
                    html += '<option value="Chefia Nacional" ' + (value == 'Chefia Nacional' ? 'selected' : '') + '>Chefia Nacional</option>';
                    html += '<option value="Mesa da Conferência" ' + (value == 'Mesa da Conferência' ? 'selected' : '') + '>Mesa da Conferência</option>';
                    html += '<option value="Conselho Jurisdicional" ' + (value == 'Conselho Jurisdicional' ? 'selected' : '') + '>Conselho Jurisdicional</option>';
                    html += '<option value="Conselho Fiscal" ' + (value == 'Conselho Fiscal' ? 'selected' : '') + '>Conselho Fiscal</option>';
                    html += '<option value="ENFIM" ' + (value == 'ENFIM' ? 'selected' : '') + '>ENFIM</option></select>';
                } else if (tipo == 'Regional')
                {
                    html = '<label for="unit">Unidade</label>';
                    html += '<select  required name="unit" id="unit" style="width: 200px">';
                    html += '<option value="Chefia Regional Norte" ' + (value == 'Chefia Regional Norte' ? 'selected' : '') + '>Chefia Regional Norte</option>';
                    html += '<option value="Chefia Regional Centro" ' + (value == 'Chefia Regional Centro' ? 'selected' : '') + '>Chefia Regional Centro</option>';
                    html += '<option value="Chefia Regional Lisboa e Vale do Tejo" ' + (value == 'Chefia Regional Lisboa e Vale do Tejo' ? 'selected' : '') + '>Chefia Regional Lisboa e Vale do Tejo</option>';
                    html += '<option value="Chefia Regional Além do Tejo" ' + (value == 'Chefia Regional Além do Tejo' ? 'selected' : '') + '>Chefia Regional Além do Tejo</option>';
                    html += '<option value="Chefia Regional Sul" ' + (value == 'Chefia Regional Sul' ? 'selected' : '') + '>Chefia Regional Sul</option>';
                    html += '<option value="Chefia Regional Madeira" ' + (value == 'Chefia Regional Madeira' ? 'selected' : '') + '>Chefia Regional Madeira</option>';
                    html += '<option value="Chefia Regional Açores Central e Ocidental" ' + (value == 'Chefia Regional Açores Central e Ocidental' ? 'selected' : '') + '>Chefia Regional Açores Central e Ocidental</option>';
                    html += '<option value="Chefia Regional Açores Oriental" ' + (value == 'Chefia Regional Açores Oriental' ? 'selected' : '') + '>Chefia Regional Açores Oriental</option>';
                    html += '<option value="Mesa do Conselho Regional Norte" ' + (value == 'Mesa do Conselho Regional Norte' ? 'selected' : '') + '>Mesa do Conselho Regional Norte</option>';
                    html += '<option value="Mesa do Conselho Regional Centro" ' + (value == 'Mesa do Conselho Regional Centro' ? 'selected' : '') + '>Mesa do Conselho do Conselho Regional Centro</option>';
                    html += '<option value="Mesa do Conselho Regional Lisboa e Vale do Tejo" ' + (value == 'Mesa do Conselho Regional Lisboa e Vale do Tejo' ? 'selected' : '') + '>Mesa do Conselho Regional Lisboa e Vale do Tejo</option>';
                    html += '<option value="Mesa do Conselho Regional Além do Tejo" ' + (value == 'Mesa do Conselho Regional Além do Tejo' ? 'selected' : '') + '>Mesa do Conselho Regional Além do Tejo</option>';
                    html += '<option value="Mesa do Conselho Regional Sul" ' + (value == 'Mesa do Conselho Regional Sul' ? 'selected' : '') + '>Mesa do Conselho Regional Sul</option>';
                    html += '<option value="Mesa do Conselho Regional Madeira" ' + (value == 'Mesa do Conselho Regional Madeira' ? 'selected' : '') + '>Mesa do Conselho Regional Madeira</option>';
                    html += '<option value="Mesa do Conselho Regional Açores Central e Ocidental" ' + (value == 'Mesa do Conselho Regional Açores Central e Ocidental' ? 'selected' : '') + '>Mesa do Conselho Regional Açores Central e Ocidental</option>';
                    html += '<option value="Mesa do Conselho Regional Açores Oriental" ' + (value == 'Mesa do Conselho Regional Açores Oriental' ? 'selected' : '') + '>Mesa do Conselho Regional Açores Oriental</option></select>';
                } else if (tipo == 'Local')
                {
                    html = '<label for="unit">Unidade</label>';
                    html += '<input type="text" required name="unit" id="unit" value="' + value + '" style="width: 200px" pattern="^[0-9]{ldelim}1,3}$"/>';
                }
                document.getElementById(id).innerHTML = html;
            }

            function changeField2(tipo, value, id)
            {
                var html = '';
                if (tipo == 'Nacional')
                {
                    html = '<label for="rank">Cargo/Função</label>';
                    html += '<select required name="rank" id="rank" style="width: 200px">';
                    html += '<option value="Escoteiro Chefe Nacional" ' + (value == 'Escoteiro Chefe Nacional' ? 'selected' : '') + '>Escoteiro Chefe Nacional</option>';
                    html += '<option value="Escoteiro Chefe Nacional Adjunto" ' + (value == 'Escoteiro Chefe Nacional Adjunto' ? 'selected' : '') + '>Escoteiro Chefe Nacional Adjunto</option>';
                    html += '<option value="Escoteiro Chefe Adjunto da Chefia Nacional" ' + (value == 'Escoteiro Chefe Adjunto da Chefia Nacional' ? 'selected' : '') + '>Escoteiro Chefe Adjunto da Chefia Nacional</option>';
                    html += '<option value="Colaborador da Chefia Nacional" ' + (value == 'Colaborador da Chefia Nacional' ? 'selected' : '') + '>Colaborador da Chefia Nacional</option>';
                    html += '<option value="Presidente da Mesa da Conferência" ' + (value == 'Presidente da Mesa da Conferência' ? 'selected' : '') + '>Presidente da Mesa da Conferência</option>';
                    html += '<option value="Secretário da Mesa da Conferência" ' + (value == 'Secretário da Mesa da Conferência' ? 'selected' : '') + '>Secretário da Mesa da Conferência</option>';
                    html += '<option value="Segundo Secretário da Mesa da Conferência" ' + (value == 'Segundo Secretário da Mesa da Conferência' ? 'selected' : '') + '>Segundo Secretário da Mesa da Conferência</option>';
                    html += '<option value="Membro do Conselho Jurisdicional" ' + (value == 'Membro do Conselho Jurisdicional' ? 'selected' : '') + '>Membro do Conselho Jurisdicional</option>';
                    html += '<option value="Membro do Conselho Fiscal" ' + (value == 'Membro do Conselho Fiscal' ? 'selected' : '') + '>Membro do Conselho Fiscal</option>';
                    html += '<option value="Coordenador da Equipa Executiva" ' + (value == 'Coordenador da Equipa Executiva' ? 'selected' : '') + '>Coordenador da Equipa Executiva</option>';
                    html += '<option value="Membro da Equipa Executiva" ' + (value == 'Membro da Equipa Executiva' ? 'selected' : '') + '>Membro da Equipa Executiva</option>';
                    html += '<option value="Formador" ' + (value == 'Formador' ? 'selected' : '') + '>Formador</option>';
                    html += '<option value="Estagiário de Formador" ' + (value == 'Estagiário de Formador' ? 'selected' : '') + '>Estagiário de Formador</option></select>';
                } else if (tipo == 'Regional')
                {
                    html = '<label for="rank">Cargo/Função</label>';
                    html += '<select required name="rank" id="rank" style="width: 200px">';
                    html += '<option value="Escoteiro Chefe Regional" ' + (value == 'Escoteiro Chefe Regional' ? 'selected' : '') + '>Escoteiro Chefe Regional</option>';
                    html += '<option value="Escoteiro Chefe Regional Adjunto" ' + (value == 'Escoteiro Chefe Regional Adjunto' ? 'selected' : '') + '>Escoteiro Chefe Regional Adjunto</option>';
                    html += '<option value="Escoteiro Chefe Adjunto da Chefia Regional" ' + (value == 'Escoteiro Chefe Adjunto da Chefia Regional' ? 'selected' : '') + '>Escoteiro Chefe Adjunto da Chefia Regional</option>';
                    html += '<option value="Colaborador da Chefia Regional" ' + (value == 'Colaborador da Chefia Regional' ? 'selected' : '') + '>Colaborador da Chefia Regional</option>';
                    html += '<option value="Presidente da Mesa do Conselho Regional" ' + (value == 'Presidente da Mesa do Conselho Regional' ? 'selected' : '') + '>Presidente da Mesa do Conselho Regional</option>';
                    html += '<option value="Secretário da Mesa do Conselho Regional" ' + (value == 'Secretário da Mesa do Conselho Regional' ? 'selected' : '') + '>Secretário da Mesa do Conselho Regional</option></select>';
                } else if (tipo == 'Local')
                {
                    html = '<label for="rank">Cargo/Função</label>';
                    html += '<select required name="rank" id="rank" style="width: 200px">';
                    html += '<option value="Escoteiro Chefe de Grupo" ' + (value == 'Escoteiro Chefe de Grupo' ? 'selected' : '') + '>Escoteiro Chefe de Grupo</option>';
                    html += '<option value="Escoteiro SubChefe de Grupo" ' + (value == 'Escoteiro SubChefe de Grupo' ? 'selected' : '') + '>Escoteiro SubChefe de Grupo</option>';
                    html += '<option value="Escoteiro Chefe Adjunto da Chefia de Grupo" ' + (value == 'Escoteiro Chefe Adjunto da Chefia de Grupo' ? 'selected' : '') + '>Escoteiro Chefe Adjunto da Chefia de Grupo</option>';
                    html += '<option value="Colaborador de Grupo" ' + (value == 'Colaborador de Grupo' ? 'selected' : '') + '>Colaborador de Grupo</option>';
                    html += '<option value="Escoteiro Chefe dos Serviços Administrativos" ' + (value == 'Escoteiro Chefe dos Serviços Administrativos' ? 'selected' : '') + '>Escoteiro Chefe dos Serviços Administrativos</option>';
                    html += '<option value="Escoteiro Chefe de Clã" ' + (value == 'Escoteiro Chefe de Clã' ? 'selected' : '') + '>Escoteiro Chefe de Clã</option>';
                    html += '<option value="Escoteiro SubChefe de Clã" ' + (value == 'Escoteiro SubChefe de Clã' ? 'selected' : '') + '>Escoteiro SubChefe de Clã</option>';
                    html += '<option value="Escoteiro Chefe da Tribo de Exploradores" ' + (value == 'Escoteiro Chefe da Tribo de Exploradores' ? 'selected' : '') + '>Escoteiro Chefe da Tribo de Exploradores</option>';
                    html += '<option value="Escoteiro SubChefe da Tribo de Exploradores" ' + (value == 'Escoteiro SubChefe da Tribo de Exploradores' ? 'selected' : '') + '>Escoteiro SubChefe da Tribo de Exploradores</option>';
                    html += '<option value="Escoteiro Chefe da Tribo de Escoteiros" ' + (value == 'Escoteiro Chefe da Tribo de Escoteiros' ? 'selected' : '') + '>Escoteiro Chefe da Tribo de Escoteiros</option>';
                    html += '<option value="Escoteiro SubChefe da Tribo de Escoteiros" ' + (value == 'Escoteiro SubChefe da Tribo de Escoteiros' ? 'selected' : '') + '>Escoteiro SubChefe da Tribo de Escoteiros</option>';
                    html += '<option value="Escoteiro Chefe de Alcateia" ' + (value == 'Escoteiro Chefe de Alcateia' ? 'selected' : '') + '>Escoteiro Chefe de Alcateia</option>';
                    html += '<option value="Escoteiro SubChede de Alcateia" ' + (value == 'Escoteiro SubChede de Alcateia' ? 'selected' : '') + '>Escoteiro SubChede de Alcateia</option>';
                    html += '<option value="Aspirante a Escoteiro Chefe" ' + (value == 'Aspirante a Escoteiro Chefe' ? 'selected' : '') + '>Aspirante a Escoteiro Chefe</option>';
                    html += '<option value="Caminheiro" ' + (value == 'Caminheiro' ? 'selected' : '') + '>Caminheiro</option>';
                    html += '<option value="Candidato" ' + (value == 'Candidato' ? 'selected' : '') + '>Candidato</option></select>';
                }
                document.getElementById(id).innerHTML = html;
            }
        </script>
    </head>
    <body>

        <!-- Page Wrapper -->
        <div id="loader"
             style="position: fixed; top: 50%; left: 50%; z-index: 20000; cursor: auto;"></div>
        <div id="form"
             style="position: fixed; top: 100px; left: 2%; z-index: 9000; cursor: auto;"></div>
        <div id="smallForm"
             style="position: fixed; top: 0; left: 2%; z-index: 9000; cursor: auto;"></div>
        <div id="page-wrapper">
            <!-- Header -->
            <header id="header" style="height: 100px">
                <h1 style="height:100px">
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

