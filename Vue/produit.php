<?php
$nomPage = 'produit';


ob_start(); ?>
	<section id="pageProduit">
		<form method="post" action="routeur.php?action=panier">
			<input type="hidden" name="ref" 	value="<?= htmlspecialchars($produit['id']) ?>">
			<input type="hidden" name="article" value="<?= htmlspecialchars($produit['nom']) ?>">
			<input type="hidden" name="prix" 	value="<?= htmlspecialchars($produit['prix']) ?>">
			<input type="hidden" name="dispo" 	value="<?= htmlspecialchars($produit['quantite_dispo']) ?>">
			
			<table>
				<thead>
					<tr>
						<th colspan="3">
							<b>Indiquez la quantité de <em>"<?= strtoupper(htmlspecialchars($produit['nom'])) ?>"</em> que vous souhaitez commander :</b>
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
						<td><img class="visuel" src="Vue/images/produit<?= htmlspecialchars($produit['id']) ?>.jpg" alt="Visuel article"></td>
						<td><?= htmlspecialchars($produit['prix']) ?> €</td>
						<td>
							<?php if ($produit['quantite_dispo'] == 0) echo 'Produit épuisé';
							else { ?>
								<input type="number" name="quant" min="1" max="<?= htmlspecialchars($produit['quantite_dispo']) ?>" step="1" value="1">
								<img src="Vue/images/panier.png" alt="Visuel panier" width="21" height="16"> 
							<?php } ?>
						</td>
					</tr>
				</tbody>
			</table>
		
			<aside>
				<a class="button1" href="routeur.php?action=boutique">Revenir à la boutique</a> 
				
				<?php if ($produit['quantite_dispo'] != 0)  { ?>
					<input type="submit" class="button1" value="Enregistrer dans mon panier">
				<?php } ?>
			</aside>
		</form>
	</section>
<?php $sessionPage = ob_get_clean();

require("template.php");
