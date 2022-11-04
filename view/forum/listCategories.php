<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste des catégories</h1>

<?php
foreach($categories as $category ){

    ?>
    <p><?=$category->getLabel()?></p>
    <?php
}
