<?php ob_start(); ?>
	<section id="pageBoutiqueSearch">
		<h2 class="title1">BOUTIQUE</h2>
		
		<br><hr><br>

		<?php $displaySeparateurCat = false;
			$panierInit = !empty($_SESSION['panier']);
			foreach ($variablePage['boutique'] as $categorie) { 
				if ($displaySeparateurCat === true) {
					echo '<br><hr><br>';
				} ?>

				<article id="<?= htmlspecialchars($categorie[0]['type']) ?>">
					<h3><?= htmlspecialchars(strtoupper($categorie[0]['type'])) ?></h3>
					<br>
					<?php $displaySeparateurProd = false;
						foreach ($categorie as $article) {
							if ($displaySeparateurProd === true) {
								echo'<br><hr><br>';
							} ?>
							<aside>
								<img src="view/images/produit<?= htmlspecialchars($article['id']) ?>.jpg" alt="Visuel article">
								<div>
									<h4><?= htmlspecialchars($article['nom']) ?></h4>
									<?= htmlspecialchars($article['description']) ?><br>
									<b><?= htmlspecialchars($article['prix']) ?> euros</b><br>
									<br><br>
									<a class="button1" href="index.php?page=produit&ref=<?= htmlspecialchars($article['id']) ?>">
										<!-- si panier existe et contient nom article en cours d'affichage... -->
										<?= ($panierInit && array_key_exists($article['nom'], $_SESSION['panier']))? 'Modifier le' : 'Ajouter au' ?> panier
									</a>
								</div>
							</aside>
							<?php $displaySeparateurProd = true;
						}
					?>
				</article>
				<?php $displaySeparateurCat = true;
			}
		?>
	</section>
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");

