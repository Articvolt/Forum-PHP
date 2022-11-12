<?php
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
?>

<h1>
    liste des messages dans le sujet <?= $topic ?> 
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
</h1>

<table class="listTable">
    <thead>
        <tr>
            <th>message</th>
            <th>auteur</th>
            <th>date</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($posts as $post){
    ?>
    <tr>
        <td><?= $post->getText() ?></td>
        <td></td>
        <td><?= $post->getDatePost() ?></td>
    </tr>      
<?php
    } 
?>
    </tbody>
</table>
<?php
// affiche le formulaire si le sujet est ouvert
    if($topic->getClosed() == 0) {
?>
        <h2>Ajout d'un post</h2>

        <form class="formAddList" action="index.php?ctrl=forum&action=ajoutPost&id=<?=$topic->getId()?>" method="post">
            <label>
                Message : <br>
                <textarea name="text" required></textarea>
            </label>
            <input type="submit" value="Poster">
        </form>
<?php
    } 



