<?php
header('Content-type: text/html; charset=UTF-8');
define('PROD', false);
// define our application directory
define('ENFIM_DIR', "");
// define smarty lib directory
define('SMARTY_DIR', "vendor/smarty/smarty/libs/");
// include the setup script
include(ENFIM_DIR . "libs/enfim_setup.php");

session_start();

if (!isset($_SESSION['users'])) {
    header('Location: index.php');
}
if ($_SESSION['users']->permission == '') {
    header('Location: index.php');
}
$type = 'normal';
$data = array();
$data = $_REQUEST;
if (!array_key_exists('action', $data)) {
    header('Location: index.php');
}
else {
    if ($data['action'] == "equipaExecutiva" && $_SESSION['users']->permission != 'Equipa Executiva') {
        header('Location: index.php');
    }
    if ($data['action'] == "formadores" && (!$_SESSION['users']->isFormador($data['idCourses']) || !$_SESSION['users']->isDiretor($data['idCourses']))) {
        header('Location: index.php');
    }
}

$errors['success'] = true;
$errors['message'] = "";
if (isset($_FILES['ficheiro'])) {

    $file_name = $_FILES['ficheiro']['name'];
    $file_size = $_FILES['ficheiro']['size'];
    $file_tmp  = $_FILES['ficheiro']['tmp_name'];
    $file_type = $_FILES['ficheiro']['type'];
    $file_ext  = explode('.', $file_name);
    $file_ext  = strtolower($file_ext[count($file_ext) - 1]);

    $expensions = array("exe", "com", "php", "js", "asp", "aspx", "cx", "bat", "bsh");

    if (in_array($file_ext, $expensions) === true) {
        $errors['success'] = false;
        $errors['message'] = "Extensão inválida.";
    }

    if ($file_size > 104857600) {
        $errors['success'] = false;
        $errors['message'] = 'Até 100 megas';
    }

    if ($errors['success']) {
        $fp              = fopen($file_tmp, 'r');
        $content         = fread($fp, filesize($file_tmp));
        $content         = addslashes($content);
        fclose($fp);
        $data['file']    = $file_name;
        $data['content'] = $content;

        // $_SESSION['ficheiros'][$data['type']]['idDocuments']
        $set = true;
        if (!array_key_exists('ficheiros', $_SESSION)) {
            $set = false;
        }
        else {
            if (!array_key_exists('idDocuments', $_SESSION['ficheiros'])) {
                $set = false;
            }
        }

        if ($set) {
            $data['idDocuments'] = $_SESSION['ficheiros']['idDocuments'];
            if ($data['tab'] != 'formacoes') {
                $errors = $_SESSION['equipaExecutiva']->atualizarDocumentosFicheiro
                        ($data);
            }
            else {
                $errors = $_SESSION['equipaExecutiva']->atualizarFormacoesFicheiro
                        ($data);
            }
        }
        else {
            if ($data['tab'] != 'formacoes') {
                $errors = $_SESSION['equipaExecutiva']->inserirDocumentoFicheiro
                        ($data);
            }
            else {
                $errors = $_SESSION['equipaExecutiva']->inserirFormacoesFicheiro
                        ($data);
            }
        }
    }
}
?>
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
    </head>
    <body style="background-color:#45558d;background-image:url();">
        <form action = "upload.php" method = "POST" enctype = "multipart/form-data" style="margin:0">
            <?php
            if ($errors['message'] != '') {
                ?>
                <div class="row uniform" id="texto"><div style="background-color:#45558d;float: left">
                        <label for="texto"><br><?= $errors['message'] ?></label></div></div>
                <?php
            }
            else {
                ?>
                <?php if (key_exists('action', $data)) { ?>
                    <input type = "hidden" name="action" id="action" value="<?= $data['action'] ?>">
                <?php } ?>
                <?php if (key_exists('tab', $data)) { ?>
                    <input type = "hidden" name="tab" id="tab" value="<?= $data['tab'] ?>">
                <?php } ?>
                <?php if (key_exists('subTab', $data)) { ?>
                    <input type = "hidden" name="subTab" id="subTab" value="<?= $data['subTab'] ?>">
                <?php } ?>
                <?php if (key_exists('idCourses', $data)) { ?>
                    <input type = "hidden" name="idCourses" id="idCourses" value="<?= $data['idCourses'] ?>">
                <?php } ?>
                <?php if (key_exists('filePos', $data)) { ?>
                    <input type = "hidden" name="filePos" id="type" value="<?= $data['filePos'] ?>">
                <?php } ?>
                <?php if (key_exists('type', $data)) { ?>
                    <input type = "hidden" name="type" id="type" value="<?= $data['type'] ?>">
                <?php } ?>
                <input type = "file" name="ficheiro" id="ficheiro" style="background-color:#45558d; width: 250px;line-height: 0;padding:0;" onChange="this.form.submit()">
            <?php }
            ?>
        </form>
    </body>
</html>