<?php
//on demarre la session php
session_start();

//Permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}

//valeur simplifié
$pseudoNow = $_SESSION["user"]['pseudo'];
//verif si formulaire envoyé
if(!empty($_POST)){ 
                //Le formulaire à été envoyé
                //Je verif que le champ pseudo est remplis
            if(isset($_POST["pseudomodif"]) && !empty($_POST["pseudomodif"])){
                //je protège les donées
                $pseudo = strip_tags($_POST["pseudomodif"]);
                //je me connect à la DB
                require_once "includes/connect.php";
                //Update
                $query = $db->prepare("UPDATE `account` SET `username`='$pseudo' WHERE `username`= '$pseudoNow'");
                $query->execute();
                //message
                $c_msg = " <span style='color:green'>Votre pseudo à bien été modifé</span>";
                //deconnexion pour utiliser la nouvelle session
                //Supprime une variable
                unset($_SESSION["user"]);

                header("Location: valid_account.php");
            }else{
                $c_msg = "<span style='color:red'>Erreur: Vous devez indiquer un nouveau pseudo</span>";
            }
}
//Nom de la page
$titrepage = "Paramêtre";
// Includes "header"
include("includes/header.php");
// Includes "sectionpresentation"
include_once("includes/sectionpresentation.php");
?>
<section id="profil_param">
<h1 >Modifier mes imformations</h1>
    <form class="profil_param" method="post">
        <div>
            <label for="pseudo">Pseudo:</label>
            <?php if(isset($c_msg)){ echo $c_msg;} ?>
            <input type="text" name="pseudomodif" id="pseudo"  placeholder="<?php echo $pseudoNow ?>">
            <button type="submit" name="form1" value="modifier">Modifier</button>
        </div>
    </form>
    <br>
    <a href="profil.php">Revenir aux Acteurs et Partenairs</a>   
</section>

<!-- <p><?php echo "Nom de famille: ". $_SESSION["user"]["nom"] ?></p>
<p><?php echo "Prénom: ". $_SESSION["user"]["prenom"] ?></p> -->

<?php
    // Includes "footer"
    include("includes/footer.php");
?>
