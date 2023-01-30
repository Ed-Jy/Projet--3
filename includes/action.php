<?php
session_start();

    function vote($iduser, $id, $vote){
        if($vote == 1){
            echo "like";
            // Si ça n'existe pas  => l'association id_user et id_acteur pas dans la table VOTE

            // INSERT INTO `vote`(`id_user`, `id_acteur`, `vote`) VALUES ( 1,1, $vote)
            // Si ça existe déja 
            //UPDATE
        }
        else if($vote == -1){
            echo "J'aime pas";
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<article class="bloc_Acteur">
            <div class=""><img class="logo_png" src="" alt=""/></div>
            <div class="">
                <h3>ACTEUR</h3>
                <p>descruption de l'acteur</p>
            </div>
            <div class="acteur_Like">
                <a href="./action.php?vote=1">J'aime</a> (15)
                </br>
                <a href="./action.php?vote=-1">Je n'aime pas</a>
            </div>

            <div class="">
                <h3>ACTEUR 2</h3>
                <p>descruption de l'acteur</p>
            </div>
            <div class="acteur_Like">
                <a href="./action.php?vote=1">J'aime</a> (15)
                </br>
                <a href="./action.php?vote=-1">Je n'aime pas</a>
                <a href="./action.php?vote=0">J'enleve mon j'aime</a>
            </div>
        </article>
        <?php 
            if (isset($_GET['vote']))
                vote(1,1, $_GET['vote']);
          
        ?>
</body>
</html>

