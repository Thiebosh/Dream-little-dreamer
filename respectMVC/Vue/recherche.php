<?php
ob_start(); ?>
    <section id="pageBoutiqueSearch">
        <h2 class="title1">Résultats obtenus pour "<em><?= htmlspecialchars($variablePage['recherche']) ?></em>"</h2>
        
	    <br><hr><br>
        
        <article>
            <?php $displaySeparateur = false;
                $variablePage['recherche'] = strtolower($variablePage['recherche']);
                foreach ($variablePage['resultat'] as $article) {
                    if ($displaySeparateur === true) echo'<br><hr><br>'?>
                    <aside>
                        <img class="images-produits" src="vue/images/produit<?= htmlspecialchars($article['id']) ?>.jpg" alt="Visuel article">
                        <div>
                            <h4>
                            <?= htmlspecialchars( str_replace(ucfirst($variablePage['recherche']), strtoupper($variablePage['recherche']), 
                                        str_replace($variablePage['recherche'], strtoupper($variablePage['recherche']), $article['nom'])) ) ?>
                            </h4>
                            <?= htmlspecialchars( str_replace(ucfirst($variablePage['recherche']), strtoupper($variablePage['recherche']), 
                                        str_replace($variablePage['recherche'], strtoupper($variablePage['recherche']), $article['description'])) ) ?>
                            <br><br>
                            <b><?= htmlspecialchars($article['prix']) ?> €</b><br>
                            <br><br>
                            <a class="button1" href="index.php?action=produit&ref=<?= htmlspecialchars($article['id']) ?>">Ajouter au panier</a>
                        </div>
                    </aside>
                <?php $displaySeparateur = true;
            } ?>
        </article>
        <br><br><br>
        <a class="button1" href="index.php?action=boutique">Retour à la boutique</a>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
