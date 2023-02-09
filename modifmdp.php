<?php
//on demarre la session php
session_start();

//Nom de la page
$titrepage = "Mot de passe oublié";
//Je vérifi si le formulaire à été envoyé
if(!empty($_POST)){
        //je vérif que tout les champs sont remplis
        if(isset($_POST["pass"]) && !empty($_POST["pass"])){
            //Je vais hacher le mdp
            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            //je me connect à la bd
            require('./includes/connect.php');
            //je trouve une solution pour faire un update du mot de passe de l'utilisateur.
        }else{
            $c_msg = "<span style='color:red'>Veuillez indiquer votre nouveau mot de passe.</span>";
        }
}
 // Includes "header"
 include_once("includes/header.php");
 ?>
 <section>  
 <h1>Modification du mot de passe</h1>
     <form method="post">
        <? if(isset($c_msg)){echo $c_msg;} ?>
             <div>
                 <label for="pseudo">Choisissez un nouveau mot de passe</label>
                 <input type="password" name="pass" id="pass" placeholder="Nouveau mot de passe">
             </div>            
             </br>
             <button type="submit">Changer le mot de passe</button>
             </br>
     </form>
 </section>
