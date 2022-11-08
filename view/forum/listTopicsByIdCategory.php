<?php
$topics = $result["data"]['topics'];
$category = $result["data"]['category'];
?>

<h1>liste des topics dans la catégorie <?= $category ?> </h1>

<?php
foreach($topics as $topic){

    ?>
    <p>
        <a href="#">
            <?php $topic->getTitle()." (".$topic->getDateTopic().")" ?>
        </a>
    </p>
    <?php
}



  
