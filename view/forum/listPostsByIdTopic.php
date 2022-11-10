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

<?php
foreach($posts as $post){
    ?>
    <p>      
        <?= $post->getText()." (".$post->getDatePost().")" ?>
    </p>
<?php
    } 

// affiche le formulaire si le sujet est ouvert
    if($topic->getClosed() == 0) {
?>
        <h2>Ajout d'un post</h2>

        <form action="index.php?ctrl=forum&action=ajoutPost&id=<?=$topic->getId()?>" method="post">
            <label>
                Message : <br>
                <textarea name="text" required></textarea>
            </label>
            <input type="submit" value="Poster">
        </form>
<?php
    } 



