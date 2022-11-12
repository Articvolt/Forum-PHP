<?php
$categories = $result["data"]['categories']; 
?>
<h1>liste des catégories</h1>

<table class="listTable">
    <thead>
        <tr>
            <th>TITRE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($categories as $category ){
            ?>
                <tr>
                    <td>
                    <a href="index.php?ctrl=forum&action=listTopicsByIdCategory&id=<?=$category->getId()?>"><?=$category->getLabel()?></a>
                    </td>
                </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<!-- FORMULAIRE ADD CATEGORY -->
<div class="formAddList">
    <h2>Ajout d'une catégorie</h2>
    <form action="index.php?ctrl=forum&action=ajoutCategory" method="post">
        <label >
            Label <br>
            <input type="text" name="label" placeholder="Entrez un label" required>
        </label>
        <input type="submit" value="enregistrer">
    </form>
</div>