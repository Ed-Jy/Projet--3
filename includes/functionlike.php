<?php


    // Fonction pour ajouter un like/dislike à la base de données
    function addLike($pdo, $item_id, $user_id, $type) {
        $query = $pdo->prepare("INSERT INTO likes (item_id, user_id, type) VALUES (?, ?, ?)");
        $query->execute([$item_id, $user_id, $type]);
    }

    // Fonction pour récupérer le nombre de likes et dislikes d'un élément
    function getLikes($pdo, $item_id) {
        $likes = $pdo->prepare("SELECT COUNT(*) FROM likes WHERE item_id = ? AND type = 'like'");
        $likes->execute([$item_id]);
        $like_count = $likes->fetchColumn();

        $dislikes = $pdo->prepare("SELECT COUNT(*) FROM likes WHERE item_id = ? AND type = 'dislike'");
        $dislikes->execute([$item_id]);
        $dislike_count = $dislikes->fetchColumn();

        return [
            'like_count' => $like_count,
            'dislike_count' => $dislike_count
        ];
    }

?>
