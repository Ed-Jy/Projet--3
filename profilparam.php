<?php
//on demarre la session php
session_start();

//permet de rediriger directement l'utilisateur index.php quand il est déconnecté
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}

    //verif si formulaire envoyé
if(!empty($_POST)){ 
    //Le formulaire à été envoyé
    //Je verif que le champ pseudo est remplis
if(isset($_POST["nickname"]) && !empty($_POST["nickname"])){
    //je protège les donées
    $pseudo = ($_POST["nickname"]);
    //je me connect à la DB
    require_once "includes/connect.php";

    $sql = "UPDATE `account`
            SET `nickname` = ?";

    $query = $db->prepare($sql);

    $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);

    $query->execute();

}else{
    die("champ vide");
}


}
    //Nom de la page
    $titrepage = "Paramêtre";
    
var_dump($_POST);
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
            <input type="text" name="nickname" id="pseudo"  placeholder="<?php echo $_SESSION["user"]["pseudo"] ?>">
            <button type="submit" name="form1" value="modifier">Modifier</button>
        </div>
    </form>
    <br>
    <form class="profil_param" method="post">
        <div>
            <label for="pass">Mot de passe:</label>
            <input type="password" name="oldpsd" placeholder="Mot de passe actuel" id="pass">
            <input type="password" name="psd" placeholder="Nouveau mot de passe" id="pass">
            <input type="password" name="confpsd" placeholder="Confirmation du mot de passe" id="pass">
            <button type="submit" name="form2" value="modifier">Modifier</button>
        </div>
    </form>
    
</section>

<p><?php echo "Nom de famille: ". $_SESSION["user"]["nom"] ?></p>
<p><?php echo "Prénom: ". $_SESSION["user"]["prenom"] ?></p>

<?php
    // Includes "footer"
    include("includes/footer.php");
?>
