<?php

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
            //Je vais hacher le mdp
            //$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            $pass = $_POST["pass"];
            //On enregistre en bdd
            require_once("includes/connect.php");
           
            //J'écris ma requête
            $sql = "INSERT INO `account`(`nom`,`prenom`,`username`,`pass`,`reponse`) VALUES (:nom,:prenom ,:pseudo, :pass, :reponse)";

            //On prépare la requête
            $query = $db -> prepare($sql);

            //On inject les valeurs
            $query->bindValue(":nom", 'nom',PDO::PARAM_STR);
            $query->bindValue(":prenom",'prenom', PDO::PARAM_STR);
            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->bindValue(":pass", $pass, PDO::PARAM_STR);
            $query->bindValue(":reponse",'reponse', PDO::PARAM_STR);

             
            //On execute la requête
            if(!$query->execute()){
                die("Une erreur est survenue");
            }
            //On récupère l'id de l'article
            //$id = $db->lastInsertId();

            //die("Votre compte à bien été crée sous l'id $id");
  
        }else{
            die("Le formulaire est incomplet");
        }
    }
    var_dump($_POST);

    //Nom de la page
    $titrepage = "Page d'inscription";

    // Includes "header"
    include("includes/header.php");
?>
<article>  
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
            </br>
            <div>
                <label for="question">Quel est le nom de jeune fille de votre mère ?</label>
                </br>
                <input type="text" name="reponse" id="reponse">
            </div>
            </br>
            <button type="submit">M'inscrire</button>
    </form>
</article>


        <?php

    // Includes "footer"
    include("includes/footer.php");
?>
