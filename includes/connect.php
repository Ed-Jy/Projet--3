<?php
    // Je crée mes constantes d'environnement
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    define("DBNAME", "oc_gbaf");

    //PDO utilise un DSN de connexion (data source name)
    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

    //Je me connect à la base
    try {
        //Je fais une instance de PDO
        $db = new PDO($dsn, DBUSER, DBPASS);

        // Je m'assure d'envoyer les donnée en UTF8 (gère les accents et tout)
        $db->exec("SET NAMES utf8");
        //Je définis le mode de "fetch" par defaut
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur".$e->getMessage());
    }

    //Je suis connecté à la base
    //Je peux récupérer la liste des utilisateurs, (account)
    $sql = "SELECT * FROM `account`";
    //J'éxecute la requète
    $requete = $db->query($sql);

    //Je récupère les données (fetch ou fetchAll)
    $user = $requete->fetchAll(); 
?>
