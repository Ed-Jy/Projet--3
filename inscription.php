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
        if(isset($_POST["nickname"], $_POST["nom"], $_POST["prenom"], $_POST["pass"], $_POST["reponse"])
        && !empty($_POST["nickname"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["pass"]) && !empty($_POST["reponse"])
        ){
            //le formulaire est complet
            //on récupère les données en les protégeant
            $pseudo = strip_tags($_POST["nickname"]);
            $nom = strip_tags($_POST["nom"]);
            $prenom = strip_tags($_POST["prenom"]);
            $reponse = strip_tags($_POST["reponse"]);

            //Je vais hacher le mdp
            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            //$pass = $_POST["pass"];
            //On enregistre en bdd
            require_once("includes/connect.php");
           
            //J'écris ma requête
            $sql = "INSERT INTO `account`(`nom`,`prenom`,`username`,`pass`,`reponse`) VALUES (:nom,:prenom ,:pseudo, :pass, :reponse)";

            //On prépare la requête
            $query = $db -> prepare($sql);

            //On inject les valeurs
            $query->bindValue(":nom", $nom,PDO::PARAM_STR);
            $query->bindValue(":prenom",$prenom, PDO::PARAM_STR);
            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->bindValue(":pass", $pass, PDO::PARAM_STR);
            $query->bindValue(":reponse",$reponse, PDO::PARAM_STR);

             
            //On execute la requête
            if(!$query->execute()){
                die("Une erreur est survenue");
            }
            //On récupère l'id de l'article
            $id = $db->lastInsertId();
            // Modifier pendant la session de mentorat
            $sql = "SELECT * FROM `account` WHERE `username` = :pseudo";

            $query = $db->prepare($sql);
    
            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
    
            $query->execute();
    
            $user = $query->fetch();
            // Je stock dans $_SESSION les inforamtions de l'utilisateur
            $_SESSION["user"] = [
                "id" => $user["id_user"],
                "pseudo" => $user["username"],
                "nom" => $user["nom"],
                "prenom" => $user["prenom"]
            ];
            //Je peux rediriger vers une page de profile
            header("Location: profil.php");

            //Je n'arrive pas à récupérer imédiatement les informations comme avec connexion
             
        }else{
            $c_msg = "<span style='color:red'>Erreur: ...Le formulaire est incomplet...*</span>";
        }
    }
    //var_dump($_POST); //verification avec un var_dump de l'envoi dans l'url
//Nom de la page
$titrepage = "Page d'inscription";

// Includes "header"
include("includes/header.php");
// Includes "sectionpresentation.php"
include_once("includes/sectionpresentation.php");

?>
<section>  
<h1>Inscription</h1>
    <form method="post">
            <div>
                <label for="pseudo">Pseudo:</label>
                <input type="text" name="nickname" id="pseudo">
            </div>
            <div>
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom">
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" id="prenom">
            </div>
            <div>
                <label for="pass">Mot de passe:</label>
                <input type="password" name="pass" id="pass">
            </div>

            <div>
                <br>
                <label for="question">Quel est votre film préféré ?</label>
                
                <input type="text" name="reponse" id="reponse">
            </div>
            </br>
            <?php if(isset($c_msg)){ echo $c_msg;} ?>
            <button type="submit">M'inscrire</button>
    </form>
</section>


        <?php

    // Includes "footer"
    include("includes/footer.php");
?>
