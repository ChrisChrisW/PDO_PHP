<?php
require('view/Layout/header.php');
?>

    <h1>Pokédex</h1>

    <a href="?page=form">
        <button>
            Form
        </button>
    </a>
    <table>
        <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
            <td>Types</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($pokemons as $pokemon) : ?>
            <tr>
                <td>
                    <?php echo $pokemon->id; ?>
                </td>
                <td>
                    <a href="?page=pokemon&id=<?php echo $pokemon->id; ?>">
                        <?php echo $pokemon->name; ?>
                    </a>
                </td>
                <td>
                    <?php echo $pokemon->types; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php
require(__DIR__ . '/../../view/Layout/footer.php');
?>