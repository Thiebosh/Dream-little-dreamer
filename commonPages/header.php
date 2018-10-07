<header>
	<nav>
		<a class="buttonNav" href="inscription.php">S'inscrire</a>

		<form method="post" action="profil.php">
			<span>
				<input type="email" 	name="email" 	placeholder="EMAIL@EXEMPLE.COM"	required>
				<input type="password" 	name="pass"		placeholder="MOT DE PASSE" 		required>
			</span>
			<input type="submit" class="buttonNav" value="Se connecter"/>
		</form>
		
		<form method="get" action="recherche.php">
			<span><input type="text" 		name="search"	placeholder="Rechercher"/></span>
			<input type="submit" class="buttonNav" value="Rechercher"/>
		</form>

		<a href="panier.php"><img src="images/panier.png" alt="Panier"/></a>
	</nav>
	
	<h1>
		<a href="accueil.php"><img src="images/logo.jpg" alt="Logo"/></a>
	</h1>
</header>