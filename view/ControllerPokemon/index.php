<?php
require(__DIR__.'/../../view/Layout/header.php');
?>

    <h1><?php echo $pokemon->name ?></h1>

    <span>Numéro : <?php echo $pokemon->id ?></span>

    <p>Une description</p>

    <a href="./index.php">Retour à la liste</a>

    <br>
    <br>

<?php
require(__DIR__.'/../../view/Layout/footer.php');
?>