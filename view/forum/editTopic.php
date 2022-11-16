<?php
$topic = ($result["data"]['topic']);
?>

<h1>Modification du sujet</h1>

<form method="post">
    <p><br>
        <label>
            modifier le titre : <br>
            <input type="text" name="title" value="<?= $topic->getTitle()?>">
        </label>
    </p><br>
        <input type="submit" value="enregistrer">
</form>