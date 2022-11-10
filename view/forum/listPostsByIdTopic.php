<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
?>

<h1>liste des topics dans la catégorie <?= $topic ?> </h1>

<?php
foreach($posts as $post){
    ?>
    <p>      
        <?= $post->getText()." (".$post->getDatePost().")" ?>
    </p>
    <?php
} ?>

<h2>Ajout d'un post</h2>

<form action="index.php?ctrl=forum&action=ajoutPost&id=<?=$topic->getId()?>" method="post">
    <label>
        Message : <br>
        <textarea name="text" required></textarea>
    </label>
    <input type="submit" value="Poster">
</form>


