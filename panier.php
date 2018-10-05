<!DOCTYPE html>
<html>
	<head>
		<title>Commande</title>
		<link href="styleSheets/normalize.css" rel="stylesheet"/>
		<link href="styleSheets/panier.css" rel="stylesheet"/>
		<link href="styleSheets/header.css" rel="stylesheet"/><!--remodifie juste le style du header-->
		<link href="styleSheets/footer.css" rel="stylesheet"/>
	</head>
<body>
	<?php include 'header.php';?>
	
	
	<!-- A modifier plus tard pour que cela ne s'affiche que lorsque le panier est vide-->
	<section>
		<h2 id="title1">VOTRE PANIER</h2>
		<p class = "panier_vide">
			Ajoutez des articles à votre panier en cliquant <a href="boutique.php">ici</a>.
		</p>
		<table class="table_produit">
			<thead>
				<tr>
					<th> Produit </td>
					<th> Prix unitaire </td>
					<th> Quantité </td>
					<th> Total </td>
				</tr>
			</thead>
			</tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		
		<div id="sorties_panier">
			<button class="bouton"><a href="boutique.php">Continuer mes achats</a></button>
			<button class="bouton"><a href="wip.php">Valider ma commande</a></button>
		</div>
	</section>

	
	<?php require("footer.php"); ?>
</body>