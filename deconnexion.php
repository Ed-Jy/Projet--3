<?php
session_start();
//permet de rediriger directement l'utilisateur connexion.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: connexion.php");
    exit;
}
//Supprime une variable
unset($_SESSION["user"]);

header("Location: index.php");

?>