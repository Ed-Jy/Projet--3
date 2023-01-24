<?php
session_start();
//Je me connecte à la base de donnée
require_once("connect.php");


if(isset($_GET['t'], $_GET['id_acteur']) AND !empty($_GET['t']) AND !empty($_GET['id_acteur'])) {
    //Je creer la variable $getid
    $getid = (int) $_GET['id_acteur'];
    

    $check = $db->prepare('SELECT `id_acteur` FROM `acteur` WHERE `id_acteur`= ?');
    $check->execute(array($getid));
}
var_dump($getid);
var_dump($_GET['id_acteur']);
?>