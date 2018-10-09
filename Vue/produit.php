<?php
$nomPage = 'produit';


ob_start(); ?>
	<section id="pageProduit">
		<form method="post" action="routeur.php?action=panier">
			<input type="hidden" name="ref" 	value="<?= htmlspecialchars($produit['id']) ?>">
			<input type="hidden" name="article" value="<?= htmlspecialchars($produit['nom']) ?>">
			<input type="hidden" name="prix" 	value="<?= htmlspecialchars($produit['prix']) ?>">
			
			<table>
				<thead>
					<tr>
						<th colspan="4">
							<b><em><?= strtoupper(htmlspecialchars($produit['nom'])) ?></em><br> Indiquez la quantité que vous souhaitez commander :</b>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td><b>Article</b></td>
						<td><b>Prix unitaire</b></td>
						<td><b>Quantité</b></td>
					</tr>

					<tr>
						<td><img src="Vue/images/produit<?= htmlspecialchars($produit['id']) ?>.jpg" alt="image_produit" width="150"></td>
						<td><?= htmlspecialchars($produit['nom']) ?></td>
						<td><?= htmlspecialchars($produit['prix']) ?> euros</td>
						<td>
							<input type="number" name="quant" min="1" max="10" step="1" value="1">
							<img src="Vue/images/panier.png" alt="panier" width="21" height="16"> 
						</td>
					</tr>
				</tbody>
			</table>
		
			<aside>
				<a class="button1" href="routeur.php?action=boutique">Revenir à la boutique</a> 
				<input type="submit" class="button1" value="Enregistrer dans mon panier">
			</aside>
		</form>
	</section>
<?php $sessionPage = ob_get_clean();

require("template.php");
