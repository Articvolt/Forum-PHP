<?php
    $topic = $result["data"]['topic'];  
    $idTopic = $topic->getId();
?>
    
<form action="index.php?ctrl=forum&action=&id=<?= $idTopic ?>" method="post">
    <p>
        <label>Nouveau titre : 
            <input type="text" name="titre" value=<?=$topic->getTitle()?>>
        </label>
    </p>
    <input type="submit" name="editTopic" value="Valider">
</form>
