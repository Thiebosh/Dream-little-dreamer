<?php
$nomPage = 'recherche';

//remettre form de produit si ajout direct
ob_start(); ?>
    <section id="pageBoutiqueSearch">
        <h2 class="title1">Résultats obtenus pour "<em><?= htmlspecialchars($recherche) ?></em>"</h2>
        
	    <br><hr><br>
        
        <article>
            <?php $displaySeparateur = false;
                foreach ($tab_recherche as $article) {
                    if ($displaySeparateur === true) echo'<br><hr><br>'?>
                    <aside>
                        <img class="images-produits" src="Vue/images/produit<?= htmlspecialchars($article['id']) ?>.jpg" alt="Visuel article">
                        <div>
                            <h4><?= htmlspecialchars($article['nom']) ?></h4>
                            <?= htmlspecialchars($article['description']) ?><br>
                            <b><?= htmlspecialchars($article['prix']) ?> €</b><br>
                            <br><br>
			                <a class="button1" href="routeur.php?action=produit&ref=<?= htmlspecialchars($article['id']) ?>">Ajouter au panier</a>
                        </div>
                    </aside>
                <?php $displaySeparateur = true;
            } ?>
        </article>
        <br><br><br>
        <a class="button1" href="routeur.php?action=boutique">Retour à la boutique</a>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
