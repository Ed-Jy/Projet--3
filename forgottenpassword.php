<?php
//on demarre la session php
session_start();
//permet de rediriger directement l'utilisateur quand il est sur profil quand il est dejà connecté
if(isset($_SESSION["user"])){
    header("Location: profil.php");
    exit;
}

    //on verifie si le formulaire à été envoyé
if(!empty($_POST)){
        //Le formulaire à été envoyé
        //Je verif que tous les champs OBLI* sont remplis
    if(isset($_POST["nickname"], $_POST["reponse"])
    && !empty($_POST["nickname"]) && !empty($_POST["reponse"])
        ){
        //on récupère les données en les protégeant
        $pseudo = strip_tags($_POST["nickname"]);  
        //Je me connect à la base de donnée
        require_once "includes/connect.php";

        $sql = "SELECT * FROM `account` WHERE `username` = :pseudo";

        $query = $db->prepare($sql);

        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();

        if(!$user){
            die("L'utilisateur et/ou la réponse secrète est incorrect.");
        }
        //Ici le user existe, on peut verifier son mdp
        if(!password_verify($_POST["reponse"], $user["reponse"])){
            die("L'utilisateur et/ou la réponse secrète est incorrect.");
        }
        //L'utilisateur et le mdp sont corrects.
        //On va pouvoir connecter l'utilisateur, ouvrir la session.
        //on demarre la session php
        session_start();

        // Je stock dans $_SESSION les inforamtions de l'utilisateur
        $_SESSION["user"] = [
            "id" => $user["id_user"],
            "pseudo" => $user["username"],
            "nom" => $user["nom"],
            "prenom" => $user["prenom"]
        ];
        var_dump($_SESSION);
        //Je peux rediriger vers une page de profile
        header("Location: profil.php");
        
    }    
}
    //var_dump($_POST); //verification avec un var_dump de l'envoi dans l'url

    //Nom de la page
    $titrepage = "Mot de passe oublié";

    // Includes "header"
    include("includes/header.php");

    // Includes "sectionpresentation"
    include_once("includes/sectionpresentation.php")
?>
<article>  
<h1>Connexion</h1>
    <form method="post">
            <div>
                <label for="pseudo">Pseudo:</label>
                <input type="text" name="nickname" id="pseudo">
            </div>         
            <div>
                <label for="question">Quel est votre film préféré ?</label>
                <input type="text" name="reponse" id="reponse">
            </div>
            </br>
            <button type="submit">Me connecter</button>
    </form>
</article>


        <?php

    // Includes "footer"
    include("includes/footer.php");
?>