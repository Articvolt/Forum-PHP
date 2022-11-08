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
}


