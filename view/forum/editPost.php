<?php
$post = $result["data"]['post'];
?>

<h1>Modification du message</h1>

<form method="post">
    <label>
        modifier le texte :<br>
        <textarea name="text"><?= $post->getText()?></textarea>
    </label>
    <br>
    <input type="submit" value="enregistrer">
</form>