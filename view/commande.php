<?php ob_start(); ?>
	<section id="pagePanier">
		<h2 id="title1">VOS COMMANDES</h2>
		
		<?php if (empty($variablePage['commandes'])) { /*pas besoin d'afficher le tableau si vide*/ ?>
			Vous n'avez encore rien commandé !<br><br><br>
			<a class="button1" href="index.php?page=boutique" style="text-decoration: none"><?= (empty($_SESSION['panier']))? 'Commencer' : 'Continuer' ?> mes achats</a>
		<?php }
		else {
			$separateur = false;
			foreach ($variablePage['commandes'] as $commande) {
				if ($separateur) {
					echo '<br><br><br><br>';
				} ?>
				<table>
					<thead>
						<tr>
							<th colspan="2">Référence commande : <?= htmlspecialchars($commande['refCommande']) ?></th>
							<th colspan="3">
								<br>
								Coût total : <?= htmlspecialchars($commande['coutTotal']) ?> € - 
								<?php echo htmlspecialchars($commande['qteTotale']);
								echo $commande['qteTotale'] > 1? ' articles commandés' : ' article commandé'; ?><br>
								Livré au <?= htmlspecialchars($commande['livraison']) ?>
							</th>
						</tr>
						<tr><th colspan="5"><hr>Détail de la commande</th></tr>
						<tr>
							<th></th>
							<th>Article</th>
							<th>Prix unitaire</th>
							<th>Quantité</th>
							<th>Coût total</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($commande['contenu'] as $produit) { ?>
							<tr>
								<td><img class="visuel" src="view/images/produit<?= htmlspecialchars($produit['refProduit']) ?>.jpg" alt="Visuel article"></td>
								<td><?= htmlspecialchars($produit['nom']) ?></td>
								<td><?= htmlspecialchars($produit['prix']) ?> €</td>
								<td><?= htmlspecialchars($produit['qte_achetee']) ?></td>
								<td><?= htmlspecialchars($produit['cout']) ?> €</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php $separateur = true;
			}
		} ?>
	</section>
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");
