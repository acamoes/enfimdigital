<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Files
 *
 * @author João Madeira
 */
class Files {
    private $name;
    private $content;

    function __construct() {

    }

    public function getInformations($id) {
        $query  = "SELECT ci.* FROM courses_informations ci INNER JOIN users_courses uc "
                . "ON ci.idCourses=uc.idCourses AND uc.idUsers=" . $_SESSION['users']->id . " AND ci.status='Ativo' AND ci.idInformations=" . $id . " LIMIT 1";
        $con    = new Database ();
        $result = $con->get($query);
        if (count($result) > 0) {
            $this->name    = $result[0]['document'];
            $this->content = $result[0]['documentBlob'];
        }
        else {
            $this->name    = "invalid.txt";
            $this->content = "Access denied!!!!";
        }
        $this->display();
    }

    public function getDocuments($id) {

    }

    public function getArchive($id, $filePos) {
        $query  = "SELECT cd.name, cd.type,cd.document3 as doc1,cd.document3Blob as blob1,cd.document4 as doc2,cd.document4Blob as blob2,cd.status "
                . "FROM courses_documents cd INNER JOIN users_courses uc "
                . "ON cd.idCourses=uc.idCourses AND cd.public='Sim' AND cd.status='Fechado' AND cd.idDocuments=" . $id . " AND type='Texto'  AND uc.idUsers=" . $_SESSION['users']->id . " "
                . "UNION "
                . "SELECT cd.name, cd.type,cd.document4 as doc1,cd.document4Blob as blob1, null as doc2,null as blob2,cd.status "
                . "FROM courses_documents cd INNER JOIN users_courses uc "
                . "ON cd.idCourses=uc.idCourses AND cd.public='Sim' AND cd.status='Fechado' AND cd.idDocuments=" . $id . " AND type='Apresentação'  AND uc.idUsers=" . $_SESSION['users']->id . " "
                . "UNION "
                . "SELECT cd.name, cd.type,cd.document1 as doc1,cd.document1Blob as blob1, null as doc2,null as blob2,cd.status "
                . "FROM courses_documents cd INNER JOIN users_courses uc "
                . "ON cd.idCourses=uc.idCourses AND cd.public='Sim' AND cd.status='Fechado' AND cd.idDocuments=" . $id . " AND type='Extra'  AND uc.idUsers=" . $_SESSION['users']->id . " ";
        $con    = new Database ();
        $result = $con->get($query);
        if (count($result) > 0) {
            $this->name    = $result[0]['doc' . $filePos];
            $this->content = $result[0]['blob' . $filePos];
        }
        else {
            $this->name    = "invalid.txt";
            $this->content = "Access denied!!!!";
        }
        $this->display();
    }

    public function getArchiveAll($id, $filePos) {
        if ($_SESSION['users']->permission == 'Equipa Executiva' ||
                $_SESSION['users']->permission == 'Formador') {
            if ($filePos != '5') {
                $query = "SELECT * FROM documents WHERE idDocuments=" . $id;
            }
            else {
                $query   = "SELECT * FROM courses_informations WHERE idInformations=" . $id;
                $filePos = '';
            }
            $con    = new Database ();
            $result = $con->get($query);
            if (count($result) > 0) {
                $this->name    = $result[0]['document' . $filePos];
                $this->content = $result[0]['document' . $filePos . 'Blob'];
            }
            else {
                $this->name    = "invalid.txt";
                $this->content = "Access denied!!!!";
            }
        }
        elseif ($_SESSION['users']->permission == 'Formando') {

        }
        else {
            $this->name    = "invalid.txt";
            $this->content = "Access denied!!!!";
        }
        $this->display();
    }

    private function display() {
        header('Content-type: text/html; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $this->name . '"');
        echo $this->content;
    }

    public function getFormacoesArchiveAll($id, $filePos) {
        if ($_SESSION['users']->permission == 'Equipa Executiva' ||
                $_SESSION['users']->permission == 'Formador') {
            $query  = "SELECT * FROM courses_documents WHERE idDocuments=" . $id;
            $con    = new Database ();
            $result = $con->get($query);
            if (count($result) > 0) {
                $this->name    = $result[0]['document' . $filePos];
                $this->content = $result[0]['document' . $filePos . 'Blob'];
            }
            else {
                $this->name    = "invalid.txt";
                $this->content = "Access denied!!!!";
            }
        }
        else {
            $this->name    = "invalid.txt";
            $this->content = "Access denied!!!!";
        }
        $this->display();
    }
}