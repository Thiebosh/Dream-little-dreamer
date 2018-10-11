<?php
$nomPage = 'recherche';


ob_start(); ?>
	
	<section id="pageBoutiqueSearch">
    <h2 class="title1">Résultats obtenus pour <em><?= htmlspecialchars($recherche) ?></em></h2>
		
	<br><hr><br>

	<?php $compteur_article = 0;
		foreach ($tab_recherche as $article) {
			if($compteur_article != 0) echo'<br><hr><br>'?>
			<aside>
			<img src="Vue/images/produit<?= htmlspecialchars($article['id']) ?>.jpg" alt="Lampe1">
			<div>
			<h4><?= htmlspecialchars($article['nom']) ?></h4>
			<?= htmlspecialchars($article['description']) ?><br>
			<b><?= htmlspecialchars($article['prix']) ?> euros</b><br>
			<br><br>
			<a class="button1" href="routeur.php?action=produit&ref=<?= htmlspecialchars($article['id']) ?>">Ajouter au panier</a>
			</div>
			</aside>
			<?php $compteur_article++;
		} ?>
		</article>
	</section>
	
<?php $sessionPage = ob_get_clean();

require("template.php");
