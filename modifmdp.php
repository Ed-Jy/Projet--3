<?php
//on demarre la session php
session_start();
//Nom de la page
$titrepage = "Mot de passe oublié";

if(!empty($_POST)){
         //je vérif que tout les champs sont remplis
        if(isset($_POST["pass"], $_POST["passconfirm"])
        && !empty($_POST["pass"]) && !empty($_POST["pass"])
        ){
            if($_POST['pass'] == $_POST['passconfirm']){
                require('./includes/connect.php');
                
                 //Je vais hacher le mdp
                $newpass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $pseudoNow = $_SESSION["user"]['pseudo'];
                $query = $db->prepare("UPDATE `account` SET `pass`='$newpass' WHERE `username`= '$pseudoNow'");
                $query->execute();

                //je deconnect la session
                unset($_SESSION["user"]);

                header("Location: valid_account.php");

            }else{
                $c_msg = "<span style='color:red'>Veuillez indiquer le même mot de passe.</span>";
            }
          
         }else{
             $c_msg = "<span style='color:red'>Veuillez indiquer votre nouveau mot de passe.</span>";
         }
 }


 // Includes "header"
 include_once("includes/header.php");
 ?>
 <section>
    <h1>Modification du mot de passe</h1>
    <form class=chatform method="post">
            <label>Votre nouveau mot de passe :</label>
            <input type="password" name="pass" id="mdp" required/>
        <br/>
            <label>Confirmez votre nouveau mot de passe :</label>
            <input type="password" name="passconfirm" id="mdpConfirm" required/>
        <br/>
        <br/>
            <?php if(isset($c_msg)){ echo $c_msg; } ?>
            <button type="submit" value="Changer mon mot de passe">Changer mon mot de passe</button>
        <br/>
        </form>
     </section>
     <?php

    // Includes "footer"
    include("includes/footer.php");
?>