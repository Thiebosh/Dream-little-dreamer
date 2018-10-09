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
					<th>Article</th>
					<th>Prix unitaire</th>
					<th>Quantité </th>
					<th>Total </th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($_SESSION['panier'])) {
					foreach($_SESSION['panier'] as $produitCommande) { ?>
						<tr>
							<td><?= htmlspecialchars($produitCommande['nom']) ?></td>
							<td><?= htmlspecialchars($produitCommande['prix']) ?></td>
							<td><?= htmlspecialchars($produitCommande['quantite']) ?></td>
							<td><?= htmlspecialchars($produitCommande['prix'] * $produitCommande['quantite']) ?> €</td>
						</tr>
					<?php }
				} ?>
			</tbody>
		</table>
		
		<span>
			<a class="button1" href="routeur.php?action=boutique">Continuer mes achats</a>
			<a class="button1" href="routeur.php?action=validation">Valider ma commande</a>
		</span>
	</section>
<?php $sessionPage = ob_get_clean();

require("template.php");
