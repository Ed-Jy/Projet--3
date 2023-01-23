<?php
//Je démarre la session
session_start();

//Je verifie si j'ai un id    "||"
if(!isset($_GET["id_acteur"])){
    //Je n'ai pas d'id
    die("Je n'ai pas d'id");
}

//je recup l'id
$id = $_GET["id_acteur"];

//Je me connecte à la base de donnée
require_once "includes/connect.php";

//Je vais chercher l'article dans ma bd
//J'écris la request
$sql = "SELECT * FROM `acteur` WHERE `id_acteur` = :id";

//On prépare la request
$request = $db -> prepare($sql);

//J'injecte les paramêtre

$request -> bindValue(":id", $id, PDO::PARAM_INT);

//j'éxecute la request
$request -> execute();

//Je récupère l'article
$acteur = $request->fetch();

    //Nom de la page
    $titrepage = "$acteur[acteur]";
    

    // Includes "header"
    include_once("includes/header.php");
?>

<section class="sectionActeur">
        <article class="bloc_Acteur">
            <div class=""><img class="logo_png" src="ressources/logo_Acteurs/<?php echo $acteur["logo"] ?>" alt=""/></div>
            <div class="acteurDesc">
                <h3><?php echo $acteur["acteur"]?></h3>
                <p><?php echo $acteur["description"]?></p>
            </div>
        </article>
        <a class="" href="profil.php"><button>Revenir aux Acteurs et Partenairs</button></a>
        
</section>


<?php
    // Includes "footer"
    include("includes/footer.php");
?>
