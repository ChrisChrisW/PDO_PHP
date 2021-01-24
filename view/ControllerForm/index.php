<?php
require('view/Layout/header.php');
?>
    <h1>Formulaire</h1>

    <form method="post">
        <label for="name">Name <input type="text" name="name" value="" required></label>
        <label for="type">Type</label>
        <select name="type" id="type">
            <?php foreach($types as $type) : ?>
                <option value="<?php echo $type->id; ?>"><?php echo $type->label; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="submit">
    </form>

<?php
require(__DIR__.'/../../view/Layout/footer.php');
?>