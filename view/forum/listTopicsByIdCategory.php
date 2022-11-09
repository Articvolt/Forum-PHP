<?php
$topics = (!$result["data"]['topics']) ? [] : $result["data"]['topics'];
$category = $result["data"]['category'];
?>

<h1>liste des topics dans la catégorie <?= $category ?> </h1>

<?php

if(!$topics) {
    echo "Pas de topics dans cette catégorie";
} else {
    foreach($topics as $topic) {
        ?>
        <p>
            <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?=$topic->getId()?>">
                <?= $topic->getTitle() ?>
            </a>
            <?= $topic->getDateTopic()." ".$topic->getUser() ?>
        </p>
        <?php
    }
}
?>

<!-- AJOUT D'UN FORMULAIRE -->

<h2>Ajout d'un topic</h2>

    <form action="index.php?ctrl=forum&action=ajoutTopic&id=<?=$category->getId()?>" method="post">
        <label>
            Titre: <br>
            <input type="text" name="title" placeholder="Titre du topic" required>
        </label>
    <br>
        <label>
            Message: <br>
            <textarea name="text"  required></textarea>
        </label>
    <br>
        <label>
            <input type="submit"  value="enregistrer">
        </label>
    </form>
  
