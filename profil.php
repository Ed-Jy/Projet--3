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
<section>
    <h1>Groupement Banque Assurance Français</h1>    
    <p>Texte présentation du GBAF et du site</p>
</section>
<section>
    <h2>Titre section acteurs et partenairs</h2>
    <p>Texte acterus et partenaires</p>
    <div class="bloc_partner">
        

    </div>
</section>


<?php
    // Includes "footer"
    include("includes/footer.php");
?>
