<section id="pageBoutiqueSearch">
    <?php if (isset($variablePage['errMsg'])) echo '<aside class="errMsg">Vous devez entrer votre requête dans la barre de recherche</aside>';
	else { ?>
        <h2 class="title1">Résultats obtenus pour "<em><?= htmlspecialchars($variablePage['recherche']) ?></em>"</h2>
        
        <br><hr><br>
        
        <article>
            <?php $displaySeparateur = false;
                $variablePage['recherche'] = strtolower($variablePage['recherche']);
                foreach ($variablePage['resultat'] as $article) {
                    if ($displaySeparateur === true) echo'<br><hr><br>'?>
                    <aside>
                        <img class="images-produits" src="view/images/produit<?= htmlspecialchars($article['id']) ?>.jpg" alt="Visuel article">
                        <div>
                            <h4>
							<!-- détail arrive... -->
                            <?= htmlspecialchars( str_replace(ucfirst($variablePage['recherche']), strtoupper($variablePage['recherche']), 
                                        str_replace($variablePage['recherche'], strtoupper($variablePage['recherche']), $article['nom'])) ) ?>
                            </h4>
                            <?= htmlspecialchars( str_replace(ucfirst($variablePage['recherche']), strtoupper($variablePage['recherche']), 
                                        str_replace($variablePage['recherche'], strtoupper($variablePage['recherche']), $article['description'])) ) ?>
                            <br><br>
                            <b><?= htmlspecialchars($article['prix']) ?> €</b><br>
                            <br><br>
                            <a class="button1" href="index.php?page=produit&ref=<?= htmlspecialchars($article['id']) ?>">Ajouter au panier</a>
                        </div>
                    </aside>
                <?php $displaySeparateur = true;
            } ?>
        </article>
	<?php } ?>
    <br><br><br>
    <a class="button1" href="index.php?page=boutique">Retour à la boutique</a>
</section>
