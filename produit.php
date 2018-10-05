<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="styleSheets/normalize.css" rel="stylesheet"/>
		<link href="styleSheets/produits.css" rel="stylesheet"/>
		<link href="styleSheets/header.css" rel="stylesheet"/>
		<link href="styleSheets/footer.css" rel="stylesheet"/>
		<title>Dream little dreamer</title>
	</head>
	
<body>
	<?php require("header.php"); ?>

	<section>
		<form method="post" action="panier.php">
			<table class="fiche-produits">
				<thead>
					<tr>
						<th colspan="4">
							<b> Lampe de chevet enfant <br> Indiquez la quantité que vous souhaitez commander.</b>
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
						<td>lampe1<input type="hidden" name="ref" value="bouti8"></td>
						<td>Lampe de chevet enfant <input type="hidden" name="article" value="Attache papier "></td>
						<td>21,00 Euros<input type="hidden" name="prix" value="564"></td>
						<td><input type="text" name="quant" value="1"><img src="images/panier.png" width="21" height="16"> </td>
					</tr>
					
					<tr>
						<td align="center" valign="middle" colspan="2"></td>
						<td align="center" valign="middle" colspan="2"><br>
					</tr>
				</tbody>
			</table>
		
			<aside>
				<a href="boutique.php" class="boutons">Revenir à la boutique</a> 
				<input type="submit" value="Enregistrer dans mon panier" class="boutons">
			</aside>
		</form>
	</section>
	<?php require("footer.php"); ?>
</body>

</html>
