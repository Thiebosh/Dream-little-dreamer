<?php
$nomPage = 'recherche';


ob_start(); ?>
    <section id="pageBoutiqueSearch">
        <h2 class="title1">Résultats obtenus pour <em><? htmlspecialchars($recherche) ?></em></h2>
        <article>
            <aside>
                <img class="images-produits" src="Vue/images/lampe1.jpg" alt="lampe1">
                <div>
                    <h4><?= htmlspecialchars($produit['nom']) ?></h4>
                    <?= htmlspecialchars($produit['description']) ?><br>
                    <b><?= htmlspecialchars($produit['prix']) ?> euros</b><br>
                    <br>
                    <a class="button1" href="routeur.php?action=produit">Ajouter au panier</a>
                </div>
            </aside>
        </article>
        <br><br><br>
        <a class="button1" href="routeur.php?action=boutique">Retour à la boutique</a>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
