<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title><?= $titrepage ?? "Accueil" ?></title>
</head>
<body class="container">
<nav>
        <div>
            <a href="http://localhost/Projet%20%233/profil.php"><img class="logo_header" src="ressources/logo.png" alt=""></a>
        </div>
        <div class="login_section" >
          <ul>
            <?php if(!isset($_SESSION["user"])):?>
                <li class="userCompte"><a href="index.php">Connexion</a></li>
                <li class="userCompte"><a href="inscription.php">Inscription</a></li>
            <?php else:?>
                <li class="userCompte" ><img class="logo_login" src="ressources/login.png"><?= $_SESSION["user"]["nom"]." ".$_SESSION["user"]["prenom"]?></li>
                <li class="userCompte"><a href="profilparam.php">Paramêtres du compte</a></li>
                <li class="userCompte"><a href="deconnexion.php">Deconnexion</a></li>    
            <?php endif; ?>   
          </ul>  
        </div>
        
</nav>