<?php
//on demarre la session php
session_start();

//permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}
    //Nom de la page
    $titrepage = "GBAF";
    

    // Includes "header"
    include("includes/header.php");
    //var_dump($_SESSION)
?>
<?php
    // Includes "footer"
    include("includes/footer.php");
?>