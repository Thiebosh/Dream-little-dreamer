<header>
	<nav>
		<a href="inscription.php"><button>S'inscrire</button></a>

		<form method="post" action="profil.php">
			<input type="email" 	name="email" 	placeholder="EMAIL@EXEMPLE.COM"	required>
			<input type="password" 	name="pass"		placeholder="MOT DE PASSE" 		required>
			<input type="submit" class="button" value="Se connecter"/>
		</form>
		
		<form method="get" action="recherche.php">
			<input type="text" 		name="search"	placeholder="Rechercher" />
			<input type="submit" class="button" value="Rechercher" />
		</form>

		<a href="panier.php"><img src="images/panier.png" alt="Panier"/></a>
	</nav>
	
	<h1>
		<a href="accueil.php"><img src="images/logo.jpg" alt="Logo"/></a>
	</h1>

	<menu>
		<li><a href="accueil.php">ACCUEIL</a></li>
		<li>
			<a href="boutique.php">BOUTIQUE</a>
			<ul>
				<li><a href="boutique.php#lampe">Lampe </a></li>
				<li><a href="boutique.php#bougie">Bougie </a></li>
			</ul>
		</li>
		<li><a href="panier.php">MON PANIER</a></li>
		<li>
			CONNEXION
			<ul>
				<li><a href="connexion.php">Se connecter </a></li>
				<li><a href="inscription.php">S'inscrire </a></li>
			</ul>
		</li>
	</menu>

	<hr>
</header>