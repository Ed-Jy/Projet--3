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
        $user = $query->fetch();
        if(!$user){
            $c_msg = "<span style='color:red'>L'utilisateur et/ou la réponse secrète est incorrect.</span>";
        }
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
        //Je peux rediriger vers une page de profile
        header("Location: modifmdp.php");
        
        }
        $c_msg = "<span style='color:red'>Veuillez remplir tout les champs.</span>";
        
            
    }
    //Nom de la page
    $titrepage = "Mot de passe oublié";

    // Includes "header"
    include("includes/header.php");
?>
<section> 
<h1>Connexion</h1>
    <form method="post">
            <div>
                <label for="pseudo">Pseudo:</label>
                <input type="text" name="nickname" id="pseudo">
            </div>         
            <div>
                <label>Quel est votre film préféré ?</label>
                <input type="text" name="reponse" id="reponse">
            </div>
            <br>
            <?php if(isset($c_msg)){ echo $c_msg; } ?>
            <button type="submit">Changer le mot de passe</button>
    </form>
</section>


        <?php
    // Includes "footer"
    include("includes/footer.php");
?>