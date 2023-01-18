<?php
//on demarre la session php
session_start();
//Je verifie mon id
//if(!isset($_GET["id_acteur"]) || empty($_GET["id_acteur"])){
    //je n'ai pas d'id
//    header("Location: profil.php");
//    exit;
//}
//Je récup l'id
$id = $_GET["id_acteur"];

//Je me connecte à la base de donnée
require_once "includes/connect.php";

//Je veias chercher l'acteur dans la base de donée
//j'écris la requête
$sql = "SELECT * FROM `acteur` WHERE `id_acteur`=:id";

//Je prépare la requête
$requete = $db->prepare($sql);

//j'inject les paramètres
$requete->bindValue(":id", $id, PDO::PARAM_INT);

//j'execute la requête
$requete->execute();

$acteur = $requete->fetch();


//permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}
    //Nom de la page
    $titrepage = $acteur["acteur"];
    

    // Includes "header"
    include("includes/header.php");

    // Includes "sectionpresentation"
    include_once("includes/sectionpresentation.php")

?>
<h2><?php echo $acteur["acteur"]?></h2>
    <article class="bloc_partner">
        <img/>
        <h3><?php echo $acteur["acteur"]?></h3>
        <p><?php echo $acteur["description"]?></p>
    </article>
</section>


<?php
    // Includes "footer"
    include("includes/footer.php");
?>