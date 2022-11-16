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
        <a href="index.php?ctrl=forum&action=unlockTopic&id=<?=$topic->getId()?>"><i class="fa-solid fa-lock"></i></a> 
    <?php
        } else { 
    ?> 
        <a href="index.php?ctrl=forum&action=lockTopic&id=<?=$topic->getId()?>"><i class="fa-solid fa-unlock"></i></a> 
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
            <!-- si l'utilisateur est le propriétaire  -->
            <th>MODIFICATIONS</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($posts as $post){
    ?>
    <tr>
        <td><?= $post->getText() ?></td>
        <td> <?= $post->getUser() ?> </td>
        <td><?= $post->getDatePost() ?></td>
        <!-- si l'utilisateur est le propriétaire  -->
        <td>
            <!-- modifie le post -->
            <a href="index.php?ctrl=forum&action=editPost&id=<?=$post->getId()?>">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <!-- supprime le post -->
            <a href="index.php?ctrl=forum&action=deletePost&id=<?=$post->getId()?>">
                <i class="fa-solid fa-trash"></i>
            </a>
        </td>
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
    <div class="formAddList">
        <h2>Ajout d'un post</h2>

        <form  action="index.php?ctrl=forum&action=ajoutPost&id=<?=$topic->getId()?>" method="post">
            <label>
                Message : <br>
                <textarea name="text" required></textarea>
            </label>
            <input type="submit" value="Poster">
        </form>
    </div>
<?php
    } 



