<?php
$nomPage = 'panier';


ob_start(); ?>
	<section id="pagePanier">
		<h2 id="title1">VOTRE PANIER</h2>
		Ajoutez des articles à votre panier en cliquant <a href="routeur.php?action=boutique">ici</a>.
		<br>
		<br>
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
				<?php if (isset($_SESSION['panier'])) {
					foreach($_SESSION['panier'] as $produitCommande) { ?>
						<tr>
							<td><img class="visuel" src="Vue/images/produit<?= htmlspecialchars($produitCommande['id_produit']) ?>.jpg" alt="Visuel article"></td>
							<td><?= htmlspecialchars($produitCommande['nom']) ?></td>
							<td><?= htmlspecialchars($produitCommande['prix']) ?> €</td>
							<td><?= htmlspecialchars($produitCommande['quantite']) ?><!--bouton modifier?--></td>
							<td><?= htmlspecialchars($produitCommande['prix'] * $produitCommande['quantite']) ?> €</td>
							<td>
								<form method="post" action="routeur.php?action=panier">
									<input type="hidden" name="supprimerArticle" 	value="True">
									<input type="hidden" name="idArticle" 			value="<?= htmlspecialchars($produitCommande['id_produit']) ?>">
									<input id="supprimerArticle" type="image" src="Vue/images/annule.jpg" width="20" >
								</form>
							</td>
						</tr>
					<?php }
				} ?>
			</tbody>
			<?php if ($total !=0) {?>
				<tfoot>
					<tr>
						<td colspan="3"></td>
						<td>Quantité totale<br><?= htmlspecialchars($quantite_total) ?></td>
						<td>Prix total<br><?= htmlspecialchars($total) ?> €</td>
						<td></td>
					</tr>
				</tfoot>
			<?php } ?>
		</table>
		
		<span>
			<a class="button1" href="routeur.php?action=boutique">Continuer mes achats</a>
			<?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) { ?>
				<form method="post" action="routeur.php?action=panier">
					<input type="hidden" name="viderTable" 	value="True">
					<input class="button1" type="submit" value="Vider mon panier"/>
				</form>
				<a class="button1" href="routeur.php?action=validation">Valider ma commande</a>
			<?php } ?>
		</span>
	</section>
<?php $sessionPage = ob_get_clean();

require("template.php");
