<?php
session_start();
//permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}
//Supprime une variable
unset($_SESSION["user"]);

header("Location: index.php");

?>