<?php
//on demarre la session php
session_start();

    //Nom de la page
    $titrepage = "Profil";

    // Includes "header"
    include("includes/header.php");
    //var_dump($_SESSION)
?>
<article>  
<h1>Profil de <?php echo $_SESSION["user"]["pseudo"]; ?></h1>
<p>Nom: <?php echo $_SESSION["user"]["nom"]; ?></p>
<p>Prénom: <?php echo $_SESSION["user"]["prenom"]; ?></p>

</article>


<?php
    // Includes "footer"
    include("includes/footer.php");
?>
