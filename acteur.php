<?php
//Je démarre la session
session_start();
//Je verifie si j'ai un id    "||"
if(!isset($_GET["id_acteur"])){
    //Je n'ai pas d'id
    die("Je n'ai pas d'id");
}
//je recup l'id et l'id_acteur

$iduser = $_SESSION["user"]["id"];
$id = $_GET["id_acteur"];
$post_Com = $_POST["post"];
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

if(isset($_POST["submit_commentaire"])){
    if(isset($_POST["post"]) AND !empty($_POST["post"])){
        $commentaire = htmlspecialchars($_POST["post"]);
        //je prépare ma bd pour envoyer mon commentaire 
        $ins = $db->prepare('INSERT INTO `post`(`id_user`, `id_acteur`, `date_add`, `post`) VALUES (? , ?, ?, ?)');
        $ins->execute(array($iduser, $id, $date_creation, $post_Com ));
        $c_msg = " <span style='color:green'>Votre commentaire a bien été posté</span>";
    }else{
        $c_msg = 'Erreur: Tous les champs doivent être complétés';
    }
}

var_dump($id,);
var_dump($iduser);
var_dump($date_creation);
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
        <article class="bloc_Acteur">
            <h3>Commentaires:</h3>
            <form method="post">
                <label for=""><?php echo $_SESSION["user"]["pseudo"];  ?></label>
                <?php if(isset($c_msg)){ echo $c_msg; } ?>
                <br>
                <textarea name="post" id="" placeholder="Votre commentaire..." cols="30" rows="10"></textarea>
                <br>
                <input type="submit" value="Poster mon commentaire" name="submit_commentaire">
            </form>
            <br>
        </article>
            <article>
            </article>  
        <a class="" href="profil.php"><button>Revenir aux Acteurs et Partenairs</button></a>
        
</section>


<?php
    // Includes "footer"
    include("includes/footer.php");
    // var_dump($_POST);
    // var_dump($_SESSION);
    
?>
