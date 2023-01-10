<?php
require_once "includes/functionlike.php";

require_once "includes/connect.php";
?>
<div class="like-dislike-container">
    <button class="like-button" data-item-id="<?php echo $item_id; ?>">Like</button>
    <span class="like-count"><?php echo getLikes($pdo, $item_id)['like_count']; ?></span>
    <button class="dislike-button" data-item-id="<?php echo $item_id; ?>">Dislike</button>
    <span class="dislike-count"><?php echo getLikes($pdo, $item_id)['dislike_count']; ?></span>
</div>
