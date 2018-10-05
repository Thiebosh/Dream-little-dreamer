<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="styleSheets/normalize.css" rel="stylesheet"/>
		<link href="styleSheets/boutique.css" rel="stylesheet"/>
		<link href="styleSheets/header.css" rel="stylesheet"/><!--remodifie juste le style du header-->
		<link href="styleSheets/footer.css" rel="stylesheet"/>
		<title>Dream little dreamer</title>
	</head>
	
<body>
	<?php require("header.php"); ?>

	<section>
		<h2> Boutique </h2>
						
		<article id="lampe">
			<h3>Lampes</h3>
			<aside class="produit">
				<img class="images-produits" src="images/lampe1.jpg">
				<span class="desc_prod">
					<h4>Lampe de chevet enfant</h4>
					Toute mignonne , cette lampe à poser éclairera doucement la chambre de votre enfant tout en la décorant délicatement.
					<br><b>20,00 euros</b>
					<br>
					<button class="boutons"><a href="produit.php">Acheter</a></button>
				</span>
			</aside>
			<aside class="produit">
				<img class="images-produits" src="images/lampe2.jpg">
				<span class="desc_prod">
					<h4>Plaffonier Mapple</h4>
					Cette lampe fait apparaitre une véritable forêt de feuilles et assure incontestablement un éclairage chalheureux.
					<br><b>40,00 euros</b> 
					<br>
					<button class="boutons"><a href="produit.php">Acheter</a></button>
				</span>
			</aside>
		</article>

		<article id="bougie">
			<h3>Bougies</h3>
			<aside class="produit">
				<img class="images-produits" src="images/bougie1.jpg">
				<span class="desc_prod">
					<h4>Bougie ananas rose</h4>
					Bougie de cire contenue dans une boîte en porcelaine en forme d'ananas avec couvercle.
					<br><b>5,00 euros</b>
					<br>
					<button class="boutons"><a  href="produit.php">Acheter</a></button>
				</span>
			</aside>
			<aside class="produit">
				<img class="images-produits" src="images/bougie2.jpg">
				<span class="desc_prod">
					<h4>Lot de 3 bougies led horizon doré</h4>
					Pratiques, la flamme ne brûle pas et elles ne s'éteignent pas au moindre courant d'air.
					<br><b>20,00 euros</b> 
					<br>
					<button class="boutons"><a  href="produit.php">Acheter</a></button>
				</span>
			</aside>
		</article>
	</section>
	<?php require("footer.php"); ?>
</body>
</html>
