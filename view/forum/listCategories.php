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
