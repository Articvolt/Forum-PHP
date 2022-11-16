<?php
$topic = ($result["data"]['topic']);
?>

<h1>Modification du sujet</h1>

<form method="post">
    <p>Sujet fermé / ouvert :</p>
    <br>
    <input type="radio" name="isClosed" id="closed" value="closed">
    <label><i class="fa-solid fa-lock"></i> fermé</label>
    <br>
    <input type="radio" name="isClosed" id="open" value="open">
    <label><i class="fa-solid fa-unlock"></i> ouvert</label>

    <p><br>
        <label>
            modifier le titre : <br>
            <input type="text" name="title" value="<?= $topic->getTitle()?>">
        </label>
    </p><br>
        <input type="submit" value="enregistrer">
</form>