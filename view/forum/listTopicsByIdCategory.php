<?php
$topics = (!$result["data"]['topics']) ? [] : $result["data"]['topics'];
$category = $result["data"]['category'];
?>

<h1>liste des sujets dans la catégorie <?= $category ?> </h1>

<table class="listTable">
    <thead>
        <tr>
            <th></th>
            <th>SUJET</th>
            <th>AUTEUR</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
<?php
if(!$topics) {
    echo "Pas de topics dans cette catégorie";
} else {
    foreach($topics as $topic) {
        ?>
        <tr>
            <td>
                <!-- affiche un icone "ouvert" ou "fermé" selon si le sujet est ouvert ou non -->
                <?php
                    if($topic->getClosed() == 1) {
                ?>
                    <i class="fa-solid fa-lock"></i>
                <?php
                    } else { 
                ?> 
                    <i class="fa-solid fa-unlock"></i>
                <?php
                    }  
                ?>
            </td>
            <td>
                <a href="index.php?ctrl=forum&action=listPostsByIdTopic&id=<?=$topic->getId()?>">
                    <?= $topic->getTitle() ?>
                </a>
            </td>
            <td>
            <?= $topic->getUser() ?>
            </td>
            <td>
            <?= $topic->getDateTopic() ?>
            </td>
        </tr>
        <?php
    }
}
?>
    </tbody>
</table>

<!-- AJOUT D'UN FORMULAIRE -->

<div class="formAddList">
    <h2>Ajout d'un topic</h2>
    
        <form  action="index.php?ctrl=forum&action=ajoutTopic&id=<?=$category->getId()?>" method="post">
            <label>
                Titre: <br>
                <input type="text" name="title" placeholder="Titre du topic" required>
            </label>
        <br>
            <label>
                Message: <br>
                <textarea name="text"  required></textarea>
            </label>
        <br>
            <label>
                <input type="submit"  value="enregistrer">
            </label>
        </form>
</div>
