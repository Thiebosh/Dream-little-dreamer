<?php ob_start(); ?>
    <section id="pageBoutiqueSearch">
        <?php if (isset($variablePage['errMsg'])) {
            echo '<aside class="errMsg">Vous devez entrer votre requête dans la barre de recherche</aside>';
        }
        else { ?>
            <h2 class="title1">Résultats obtenus pour "<em><?= htmlspecialchars($variablePage['recherche']) ?></em>"</h2>
            
            <br><hr><br>
            
            <article>
                <?php $displaySeparateur = false;
                    $variablePage['Recherche'] = ucfirst(strtolower($variablePage['recherche']));
                    $variablePage['RECHERCHE'] = strtoupper($variablePage['recherche']);

                    foreach ($variablePage['resultat'] as $article) {
                        if ($displaySeparateur === true) {
                            echo'<br><hr><br>';
                        } ?>
                        <aside>
                            <img class="images-produits" src="view/images/produit<?= htmlspecialchars($article['id']) ?>.jpg" alt="Visuel article">
                            <div>
                                <h4>
                                <!-- remplace toutes les occurences du premier string par le contenu du second dans le troisième. Deux fois : une pour la minuscule, l'autre pour la majuscule -->
                                <?php
                                    $article['nom'] = str_replace($variablePage['Recherche'], $variablePage['RECHERCHE'], $article['nom']);
                                    $article['nom'] = str_replace($variablePage['recherche'], $variablePage['RECHERCHE'], $article['nom']);
                                    echo htmlspecialchars( $article['nom'] );
                                ?>
                                </h4>
                                <?= htmlspecialchars( str_replace($variablePage['Recherche'], $variablePage['RECHERCHE'], 
                                                        str_replace($variablePage['recherche'], $variablePage['RECHERCHE'], $article['description'])) ) ?>
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
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");

