<?php
$topics = $result["data"]['topics'];
$category = $result["data"]['category'];
?>

<h1>liste des topics dans la catégorie <?= $category ?> </h1>

<?php
foreach($topics as $topic){
    ?>
    <p>
        <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?=$topic->getId()?>">
            <?= $topic->getTitle()." (".$topic->getDateTopic().")" ?>
        </a>
    </p>
    <?php
}
?>

<!-- AJOUT D'UN FORMULAIRE -->

<h2>Ajout d'un topic</h2>

    <form action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="post">
        <label>
            Titre: <br>
            <input type="text" name="title" required>
        </label>
    <br>
        <label>
            Message: <br>
            <input type="text" name="content" required>
        </label>
    <br>
        <label>
            <input type="submit"  value="submit">
        </label>
    </form>
  
