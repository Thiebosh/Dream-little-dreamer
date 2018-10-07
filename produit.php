<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link href="styleSheets/normalize.css" rel="stylesheet"/>
	<link href="styleSheets/global.css" rel="stylesheet"/>
	<link href="styleSheets/menu.css" rel="stylesheet"/>
	<link href="styleSheets/produits.css" rel="stylesheet"/>
	<title>Dream little dreamer - Produit</title>
</head>

<body>
    <?php
        require("commonPages/header.php");
        require("commonPages/menu.php");
    ?>

	<section>
		<form method="post" action="panier.php">
			<table>
				<thead>
					<tr>
						<th colspan="4">
							<b><em>nom_produit</em><br> Indiquez la quantité que vous souhaitez commander :</b>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><b>Réf.</b></td>
						<td><b>Article</b></td>
						<td><b>Prix </b></td>
						<td><b>Quantité</b></td>
					</tr>

					<tr>
						<td><em>réf_produit</em><input type="hidden" name="ref" value="bouti8"></td>
						<td><em>nom_produit</em><input type="hidden" name="article" value="Attache papier "></td>
						<td><em>prix_produit</em> euros<input type="hidden" name="prix" value="564"></td>
						<td><input type="number" name="quant" min="1" max="10" step="1" placeholder="1"><img src="images/panier.png" alt="panier" width="21" height="16"> </td>
					</tr>
					
					<tr>
						<td colspan="2"></td>
						<td colspan="2"><br>
					</tr>
				</tbody>
			</table>
		
			<aside>
				<a class="button1" href="boutique.php">Revenir à la boutique</a> 
				<input type="submit" class="button1" value="Enregistrer dans mon panier">
			</aside>
		</form>
	</section>

	<?php require("commonPages/footer.php"); ?>
</body>
</html>
