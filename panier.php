<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link href="styleSheets/normalize.css" rel="stylesheet"/>
	<link href="styleSheets/global.css" rel="stylesheet"/>
	<link href="styleSheets/menu.css" rel="stylesheet"/>
	<link href="styleSheets/panier.css" rel="stylesheet"/>
	<title>Dream little dreamer - Panier</title>
</head>

<body>
    <?php
        require("commonPages/header.php");
        require("commonPages/menu.php");
    ?>
	
	<section>
		<h2 id="title1">VOTRE PANIER</h2>
		Ajoutez des articles à votre panier en cliquant <a href="boutique.php">ici</a>.
		<br>
		<br>
		<table>
			<thead>
				<tr>
					<th>Produit </th>
					<th>Prix unitaire </th>
					<th>Quantité </th>
					<th>Total </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		
		<span>
			<a class="button1" href="boutique.php">Continuer mes achats</a>
			<a class="button1" href="validation.php">Valider ma commande</a>
		</span>
	</section>
	
	<?php require("commonPages/footer.php"); ?>
</body>
</html>