<?php
$category = ($result["data"]['category']);
?>

<h1>Modification de la catégorie</h1>

<form method="post">
    <p>
        <label>
            modifier le nom de la catégorie : <br>
            <input type="text" name="label" value="<?= $category->getLabel()?>">
        </label>
    </p><br>
        <input type="submit" value="enregistrer">
</form>