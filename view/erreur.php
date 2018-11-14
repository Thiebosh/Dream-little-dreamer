<?php ob_start(); ?>
    <section>
        <?php if (empty($variablePage['erreur'])) {
            echo 'Erreur 404 : Page "' . htmlspecialchars($variablePage['page']) . '" introuvable<br>';
        }
        else {//ligne de débug
            echo htmlspecialchars($variablePage['erreur']['message']) . '<br><br>' . htmlspecialchars($variablePage['erreur']['detail']);
        } ?>
    </section>
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");

