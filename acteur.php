<?php
//Je démarre la session
session_start();
//Je verifie si j'ai un id    "||"
if(!isset($_GET["id_acteur"])){
    //Je n'ai pas d'id
    die("Je n'ai pas d'id");
}
//permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}
//je recup l'id et l'id_acteur

$iduser = $_SESSION["user"]["id"];
$id = $_GET["id_acteur"];
$date_creation = date('Y-m-d H:i:s');
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

// var_dump($iduser);
// var_dump($id);

    if(isset($_POST["submit_commentaire"])){
        if(isset($_POST["post"]) AND !empty($_POST["post"])){
            $commentaire = htmlspecialchars($_POST["post"]);
            //je prépare ma bd pour envoyer mon commentaire 
            $ins = $db->prepare('INSERT INTO `post`(`id_user`, `id_acteur`, `date_add`, `post`) VALUES (? , ?, ?, ?)');
            $ins->execute(array($iduser, $id, $date_creation, $_POST["post"] ));
            $c_msg = " <span style='color:green'>Votre commentaire a bien été posté</span>";
        }else{
            $c_msg = "<span style='color:red'>Erreur: Vous devez écrire un commentaire pour le poster</span>";
        }
    }
//requête des commentaires / 'ORDER BY `id_post` desc' pour faire remonter le commentaire le plus rescend
$commentaires = $db->prepare('SELECT * FROM `post`, `account` WHERE post.id_user = account.id_user AND `id_acteur` = ? ORDER BY `id_post`desc');
$commentaires-> execute(array($id));
var_dump($commentaires);
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
            <div class="acteur_Like">
                <a href="">J'aime</a> (15)
                </br>
                <a href="">Je n'aime pas</a>
            </div>
        </article>
        <article class="bloc_Commentaires">
        <h3>Commentaires:</h3>
            <form class="form_coms" method="post">
                <?php if(isset($c_msg)){ echo $c_msg; } ?>
                <br>
                <textarea name="post" id="" placeholder="Votre commentaire..." cols="40" rows="5"></textarea>
                <br>
                <input type="submit" value="Poster mon commentaire" name="submit_commentaire">
            </form>
            
            <?php while($c = $commentaires->fetch()){?>
              
                <div class="commentaire">
                  
                <b class="b_commentaire" >Pseudo:<?= $c['username']?></b>
                <p class="p_commentaire_date">Posté le: <?= $c['date_add']?></p>
                <p class="p_commentaire_post" ><?= $c['post']?></p> 
                </div>  
            <?php } ?>        
        </article>
        <a class="" href="profil.php"><button>Revenir aux Acteurs et Partenairs</button></a>
        
</section>


<?php
    // Includes "footer"
    include("includes/footer.php");
?>
