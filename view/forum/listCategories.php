<?php
$categories = $result["data"]['categories']; 
?>
<h1>liste des catégories</h1>

<?php

foreach($categories as $category ){
    ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByIdCategory&id=<?=$category->getId()?>"><?=$category->getLabel()?></a></p>
    <?php
}
?>

<form action="index.php?ctrl=forum&action=ajoutCategory" method="post">
    <label >
        Label <br>
        <input type="text" name="label" placeholder="Entrez un label" required>
    </label>
    <input type="submit" value="enregistrer">
</form>