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
        $pseudo = $_POST["nickname"];
        $rep = $_POST["reponse"];    
        //je connect la BD
        require('./includes/connect.php');
        $sql = "SELECT * FROM `account` WHERE username=:pseudo AND reponse=:reponse";
        $query = $db->prepare($sql);
        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":reponse", $rep, PDO::PARAM_STR);
        $query->execute();
        $user_rep = $query->fetch();
        if(!$user_rep){
            die("L'utilisateur et/ou le mot de passe est incorrect.");
        }else{
            header("Location: modifmdp.php");
            exit; 
        }
        }else{
            echo "c'est pas ça";
        }
            
    }
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
            <button type="submit">Changer le mot de passe</button>
    </form>
</article>


        <?php
    // Includes "footer"
    include("includes/footer.php");
?>