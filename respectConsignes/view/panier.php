<section id="pagePanier">
	<h2 id="title1">VOTRE PANIER</h2>
	
	<?php if (!empty($_SESSION['panier'])) { ?>
		<table>
			<thead>
				<tr>
					<th>Aperçu</th>
					<th>Article</th>
					<th>Prix unitaire</th>
					<th>Quantité</th>
					<th>Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION['panier'] as $produitCommande) { ?>
					<tr>
						<td><img class="visuel" src="view/images/produit<?= htmlspecialchars($produitCommande['id_produit']) ?>.jpg" alt="Visuel article"></td>
						<td><?= htmlspecialchars($produitCommande['produit']) ?></td>
						<td><?= htmlspecialchars($produitCommande['prix']) ?> €</td>
						<td>
							<a href="index.php?page=produit&ref=<?= htmlspecialchars($produitCommande['id_produit']) ?>">
								<?= htmlspecialchars($produitCommande['quantite']) ?>
							</a>
						</td>
						<td><?= htmlspecialchars($produitCommande['total']) ?> €</td>
						<td>
							<form method="post" action="index.php?page=panier">
								<input type="hidden" name="supprimeArticle" value="<?= htmlspecialchars($produitCommande['produit']) ?>">
								<input class="supprimerArticle" type="image" src="view/images/annule.jpg" width="20">
							</form>	
						</td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3"></th>
					<th>Quantité totale<br><?= htmlspecialchars($variablePage['quantiteTotale']) ?></th>
					<th>Prix total<br><?= htmlspecialchars($variablePage['coutTotal']) ?> €</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	<?php } ?>
	
	<span>
		<?php if (!empty($_SESSION['panier'])) { ?>
			<form method="post" action="index.php?page=panier">
				<input type="hidden" name="supprimePanier" value="true">
				<input class="button1" type="submit" value="Vider mon panier"/>
			</form>
		<?php } ?>
		<a class="button1" href="index.php?page=boutique"><?= (empty($_SESSION['panier']))? 'Commencer' : 'Continuer' ?> mes achats</a>
		<?php if (!empty($_SESSION['panier'])) { ?>
			<a class="button1" href="index.php?page=validation">Valider ma commande</a>
		<?php } ?>
	</span>
</section>
