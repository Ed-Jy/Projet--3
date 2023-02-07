<?php
    function sqlGetNBVotes($db, $id){
        $result = 0;
        $reqSQL = "SELECT count(vote) as 'nbvote' FROM vote WHERE id_acteur=$id and vote=1";
        $resultNBVotes = $db->prepare($reqSQL);
        $resultNBVotes->execute();
        if($row = $resultNBVotes->fetch()){
            $result = $row["nbvote"];
        }
        return $result;
    }


?>