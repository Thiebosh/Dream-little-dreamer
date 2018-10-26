<?php ob_start(); ?>
	<section id="pageProduit">
		<?php if (isset($variablePage['errMsg'])) echo '<aside class="errMsg">Référence produit invalide</aside>';
		else {
			$intoPanier = !empty($_SESSION['panier']) && array_key_exists($variablePage['produit']['nom'], $_SESSION['panier']); ?>
			<form method="post" action="index.php?page=panier">
				<input type="hidden" name="ref" 	value="<?= htmlspecialchars($variablePage['produit']['id']) ?>">
				<input type="hidden" name="article" value="<?= htmlspecialchars($variablePage['produit']['nom']) ?>">
				<input type="hidden" name="prix" 	value="<?= htmlspecialchars($variablePage['produit']['prix']) ?>">
				<input type="hidden" name="dispo" 	value="<?= htmlspecialchars($variablePage['produit']['quantite_dispo']) ?>">
				
				<table>
					<thead>
						<tr>
							<th colspan="3">
								<b>Indiquez la quantité de <em>"<?= htmlspecialchars(strtoupper($variablePage['produit']['nom'])) ?>"</em> que vous souhaitez commander :</b>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Aperçu</th>
							<th>Prix unitaire</th>
							<th>Quantité</th>
						</tr>

						<tr>
							<td><img class="visuel" src="view/images/produit<?= htmlspecialchars($variablePage['produit']['id']) ?>.jpg" alt="Visuel article"></td>
							<td><?= htmlspecialchars($variablePage['produit']['prix']) ?> €</td>
							<td>
								<?php if ($variablePage['produit']['quantite_dispo'] == 0) echo 'Produit épuisé';
								else { ?>
									<input type="number" name="quant" step="1" min="1" max="<?= htmlspecialchars($variablePage['produit']['quantite_dispo']) ?>"
										title="Entre 1 et <?= htmlspecialchars($variablePage['produit']['quantite_dispo']) ?>" 
										value="<?= ($intoPanier)? htmlspecialchars($_SESSION['panier'][$variablePage['produit']['nom']]['quantite']) : 1 ?>">
									<img src="view/images/panier.png" alt="Visuel panier" width="21" height="16"> 
								<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
			
				<aside>
					<a class="button1" href="index.php?page=boutique">Revenir à la boutique</a> 
					<?php if ($variablePage['produit']['quantite_dispo'] != 0) { ?>
						<input type="submit" class="button1" value="<?= ($intoPanier)? 'Modifier le' : 'Ajouter au' ?> panier">
					<?php } ?>
				</aside>
			</form>
		<?php } ?>
	</section>
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");
