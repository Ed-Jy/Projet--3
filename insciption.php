<?php
    // Includes function.php
    include_once("includes/functions.php");

    // Includes "header"
    include("includes/header.php");
?>
<article>  
    <form method="post">
        <h1>Inscription</h1>
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
</article>


        <?php

    // Includes "footer"
    include("includes/footer.php");
?>
