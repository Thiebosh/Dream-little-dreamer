<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link href="styleSheets/normalize.css" rel="stylesheet"/>
	<link href="styleSheets/global.css" rel="stylesheet"/>
	<link href="styleSheets/menu.css" rel="stylesheet"/>
	<link href="styleSheets/boutique_search.css" rel="stylesheet"/>
	<title>Dream little dreamer - Boutique</title>
</head>
	
<body>
    <?php
        require("commonPages/header.php");
        require("commonPages/menu.php");
    ?>

	<section>
		<h2 class="title1">BOUTIQUE</h2>
		
		<br><hr><br>

		<article id="lampe">
			<h3>LAMPES</h3>
			<br>
			<aside>
				<img src="images/lampe1.jpg" alt="Lampe1">
				<div>
					<h4>Lampe de chevet enfant</h4>
					Toute mignonne, cette lampe à poser éclairera doucement la chambre de votre enfant tout en la décorant délicatement.<br>
					<b>20,00 euros</b><br>
					<br><br>
					<a class="button1" href="produit.php">Ajouter au panier</a>
				</div>
			</aside>
			<br><hr><br>
			<aside>
				<img src="images/lampe2.jpg" alt="Lampe2">
				<div>
					<h4>Plafonier Mapple</h4>
					Cette lampe fait apparaitre une véritable forêt de feuilles et assure incontestablement un éclairage chalheureux.<br>
					<b>40,00 euros</b><br>
					<br><br>
					<a class="button1" href="produit.php">Ajouter au panier</a>
				</div>
			</aside>
		</article>

		<br><hr><br>

		<article id="bougie">
			<h3>BOUGIES</h3>
			<br>
			<aside>
				<img src="images/bougie1.jpg" alt="Bougie1">
				<div>
					<h4>Bougie ananas rose</h4>
					Bougie de cire contenue dans une boîte en porcelaine en forme d'ananas avec couvercle.<br>
					<b>5,00 euros</b><br>
					<br><br>
					<a class="button1" href="produit.php">Ajouter au panier</a>
				</div>
			</aside>
			<br><hr><br>
			<aside>
				<img src="images/bougie2.jpg" alt="Bougie2">
				<div>
					<h4>Lot de 3 bougies led horizon doré</h4>
					Pratiques, la flamme ne brûle pas et elles ne s'éteignent pas au moindre courant d'air.<br>
					<b>20,00 euros</b><br>
					<br><br>
					<a class="button1" href="produit.php">Ajouter au panier</a>
				</div>
			</aside>
		</article>
	</section>

	<?php require("commonPages/footer.php"); ?>
</body>
</html>
