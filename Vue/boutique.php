<?php
$nomPage = 'boutique';


ob_start(); ?>
	<section id="pageBoutiqueSearch">
		<h2 class="title1">BOUTIQUE</h2>
		
		<br><hr><br>

		<?php $compteur_categorie = 0;
			foreach ($boutique as $categorie) { 
				if ($compteur_categorie != 0) echo '<br><hr><br>'; ?>

				<article id="<?= htmlspecialchars($categorie['type']) ?>">
					<h3><?= htmlspecialchars(strtoupper($categorie['type'])) ?></h3>
					<br>
					<?php $compteur_article = 0;
						foreach ($categorie['contenu'] as $article) {
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
			<?php $compteur_categorie++;
		} ?>
	</section>
	
<?php $sessionPage = ob_get_clean();

require("template.php");
