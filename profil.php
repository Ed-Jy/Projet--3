<?php
//on demarre la session php
session_start();
//je veux afficher les acteurs/partenaires da ma bdd
//Je me connecte à la base de donnée
require_once "includes/connect.php";

//Je vais écrire la requête
$sql = "SELECT * FROM `acteur`";

//On exécute la requête
$requete = $db->query($sql);

//on récupère les données
$acteurs = $requete->fetchAll();

//permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}
    //Nom de la page
    $titrepage = "GBAF";
    

    // Includes "header"
    include("includes/header.php");
?>

<section>
    <h1>Groupement Banque Assurance Français</h1>    
    <p>Texte présentation du GBAF et du site</p>
</section>
<section>
<h2>Titre section acteurs et partenairs</h2>
    <p>Texte acterus et partenaires</p>
<?php foreach($acteurs as $acteur): ?>    


    <article class="bloc_partner">
        <img/>
        <h3><?php echo $acteur["acteur"]?></h3>
        <p><?php echo $acteur["description"]?></p>
        <a href="acteur.php?id=<?= $acteur["id_acteur"] ?>">Lire la suite</a>

        

    </article>
<?php endforeach; ?>    
</section>


<?php
    // Includes "footer"
    include("includes/footer.php");
?>
