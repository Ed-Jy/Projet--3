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
    include_once("includes/header.php");
    // Includes "sectionpresentation"
    include_once("includes/sectionpresentation.php")
?>

<section>
<h2>Acteurs et Partenairs</h2>
    <p>Voici une liste de nos partenaires et acteurs avec lesquels nous travaillons étroitement pour fournir les meilleurs produits et services à nos clients. Nous sommes fiers de ces collaborations et remercions chacun d'entre eux pour leur contribution à notre réussite.
</p>
    <section class="sectionActeur">
        <?php foreach($acteurs as $acteur): ?> 
            <section class="bloc_partner">
                <div class=""><img class="logo_png" src="ressources/logo_Acteurs/<?php echo $acteur["logo"] ?>" alt=""/></div>
                <div class="acteurDesc">
                    <h3><?php echo $acteur["acteur"]?></h3>
                    <?php $acteurDesc = substr($acteur["description"],0 ,200); ?>
                    <p><?php echo "$acteurDesc...  "?></p>
                </div>
                    <a class="readMore" href="acteur.php?id_acteur=<?= $acteur["id_acteur"] ?>"><button>Lire la suite</button></a>
            </section>
            <?php endforeach; ?> 
    </section>
</section>

<?php //var_dump($acteurs)?>
<?php
    // Includes "footer"
    include("includes/footer.php");
?>
