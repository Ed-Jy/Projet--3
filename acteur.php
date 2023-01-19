<?php
//Je verifie si j'ai un id    "||"
// if(!isset($_GET["id_acteur"]) || !empty($_GET["id_acteur"])){
//     //Je n'ai pas d'id
//     die("Je n'ai pas d'id");
// }

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

var_dump($acteur);

    //Nom de la page
    $titrepage = "$acteur[acteur]";
    

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
            <article class="bloc_partner">
                <div class="logo_png"><?php //echo $acteur["logo"] ?></div>
                <div class="acteurDesc">
                    <h3><?php echo $acteur["acteur"]?></h3>
                    <?php $acteurDesc = substr($acteur["description"],0 ,200); ?>
                    <p><?php echo "$acteurDesc...  "?></p>
                </div>
                    <a class="readMore" href="acteur.php?id=<?= $acteur["id_acteur"] ?>"><button>Lire la suite</button></a>
            </article>
    </section>
</section>

<?php
    // Includes "footer"
    include("includes/footer.php");
?>
