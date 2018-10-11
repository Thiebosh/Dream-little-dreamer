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
					<th>Apperçu</th>
					<th>Article</th>
					<th>Prix unitaire</th>
					<th>Quantité</th>
					<th>Total</th>
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
						</tr>
					<?php }
				} ?>
			</tbody>
			<!--
			<tfoot>
				<tr>
					<td colspan="5">recap commande (a finir pour vendredi)</td>
				</tr>
			</tfoot>
			-->
		</table>
		
		<span>
			<a class="button1" href="routeur.php?action=boutique">Continuer mes achats</a>
			<?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) { ?>
				<a class="button1" href="routeur.php?action=validation">Valider ma commande</a>
			<?php } ?>
		</span>
	</section>
<?php $sessionPage = ob_get_clean();

require("template.php");
