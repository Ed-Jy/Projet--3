<?php 


//Verification d'envoi du formulaire
if(!empty($_POST)){
    //Le fomulaire à bien été envoyé verif "var_dump($_POST);"
    //On Vérifie que tout les champs requis sont remplis " "
    if(isset($_POST["username"], $_POST["nom"], $_POST["prenom"], $_POST["password"], $_POST["reponse"])
        && !empty($_POST["username"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["password"]) && !empty($_POST["reponse"])
    ){
        // Le formulaire est complet
        // On récupère les données en les protègeant
        $pseudo = strip_tags($_POST["username"]);

        // On va hasher le mot de passe
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Engistrement dans la bdd
        $db = new PDO('mysql:host=localhost;dbname=oc_gbaf;charset=utf8', 'root', 'root'); 
        $sql = "INSERT INTO account(username) VALUE (?,?)";  
        
        $query = $db->prepare($sql);
        
        $query->execute();

    }else{
        die("Le formulaire n'est pas complet");
    }

}


?>
<!-- Commentaire HTML Commentaire PhP /* */ -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="container">


    <header>
        <div>
            <img class="logo_header" src="ressources/logo.png" alt="">
        </div>
            <div class="login_section" >
                <a href="test.php" target="_blank">
                    <img class="logo_login" src="ressources/login.png" alt="">
                </a>    
                <p>
         

                </p>
            </div>
        
    </header>
        <h1>Inscription en faite j'en veux pas</h1>
        <form method="post">
            <div>
                <label for="pseudo">Pseudo:</label>
                <input type="text" name="username" id="pseudo">
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
                <input type="password" name="password" id="pass">
            </div>
            </br>
            <div>
                <label for="question">Quel est le nom de jeune fille de votre mère ?</label>
                </br>
                <input type="text" name="reponse" id="question">
            </div>
            </br>
            <button type="submit">M'inscrire</button>
        </form>


    
    <footer>
        <div>
        <p>© Copyright 2023 Edjy-Design</p>
        </div>
    </footer>
    
</body>
</html>
