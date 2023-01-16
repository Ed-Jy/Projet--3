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
            <!-- <img class="logo_header" src="/ressources/logo.png" alt=""> -->
            <img class="logo_header" src="ressources/logo.png" alt="">
        </div>
        <div class="login_section" >
          <ul>
            <?php if(!isset($_SESSION["user"])):?>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            <?php else:?>
                <li class="userCompte" ><?= $_SESSION["user"]["pseudo"] ?></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>
            <?php endif; ?>
            
          
                
          </ul>  
        </div>
        
</nav>