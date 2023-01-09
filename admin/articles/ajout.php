<?php
    // On traite le formulaire
    if (!empty($_POST)){
        //POST n'est pas vide, on verifie que toutes les donnée sont présentes
        if (
            isset($_POST["titre"], $_POST["contenu"])
            && !empty($_POST["titre"]) && !empty($_POST["contenu"])
        ){
            //Le formulaire est complet
            //On récupère les données en les protégeant (failles XSS)
            //On retire toute balise du titre
            $titre = strip_tags($_POST["titre"]);

            //On neutralisre toute balises du contenu
            $contenu = htmlspecialchars($_POST["contenu"]);

            //On peut enregistrer les données
            //On se connect à la base
            require_once "../../includes/connect.php";

            //J'écris ma requête
            $sql = "INSERT INTO `articles`(`title`,`content`) VALUES (:title, :content)";

            //On prépare la requête
            $query = $db -> prepare($sql);

            //On inject les valeurs
            $query->bindValue(":title", $titre, PDO::PARAM_STR);
            $query->bindValue(":content", $contenu, PDO::PARAM_STR);

            //On execute la requête
            if(!$query->execute()){
                die("Une erreur est survenue");
            }
            //On récupère l'id de l'article
            $id = $db->lastInsertId();

            die("Article ajouté sous le numéro $id");           
        }else{
            die("Le formulaire est incomplet");
        }
    }
        
    $titrepage = "Ajouter un article";
    // Includes "header"
    include_once("../../includes/header.php");
?>

<h1>ajouter un article</h1>

<form method="post" action="">
    <div>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div>
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu"></textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>

<?php
// ajouter mon footer
include_once ("../../includes/footer.php");
?>