<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="Vue/styleSheets/normalize.css" rel="stylesheet"/>
    
    <link href="Vue/styleSheets/template.css" rel="stylesheet"/>
    <link href="Vue/styleSheets/section.css" rel="stylesheet"/>
    <title>Dream little dreamer - <?= htmlspecialchars(ucfirst($nomPage)) ?></title>
</head>

<body>
    <header>
        <nav>
            <?php /*if (isset($SESSION_['client'])) {
                echo '<a class="buttonNav" href="routeur.php?action=deconnexion">Déconnexion</a>';
            }
            else {*/ ?>
                <a class="buttonNav" href="routeur.php?action=inscription">S'inscrire</a>

                <form method="post" action="routeur.php?action=profil">
                    <span>
                        <input type="email" 	name="email" 	placeholder="EMAIL@EXEMPLE.COM"	required>
                        <input type="password" 	name="pass"		placeholder="MOT DE PASSE" 		required>
                    </span>
                    <input type="submit" class="buttonNav" value="Se connecter"/>
                </form>
            <?php /*}*/ ?>

            
            <form method="get" action="routeur.php?action=recherche">
                <span><input type="text" 		name="search"	placeholder="Rechercher"/></span>
                <input type="submit" class="buttonNav" value="Rechercher"/>
            </form>

            <a href="routeur.php?action=panier"><img src="Vue/images/panier.png" alt="Panier"/></a>
        </nav>
        
        <h1>
            <a href="routeur.php?action=accueil"><img src="Vue/images/logo.jpg" alt="Logo"/></a>
        </h1>
    </header>

    <menu>
        <li><a href="routeur.php?action=accueil">ACCUEIL</a></li>
        <li>
            <a href="routeur.php?action=boutique">BOUTIQUE</a>
            <ul>
                <?php foreach ($boutique as $categorie) { ?>
                    <li><a href="routeur.php?action=boutique#<?= htmlspecialchars($categorie['type']) ?>"><?= htmlspecialchars($categorie['type']) ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <li><a href="routeur.php?action=panier">MON PANIER</a></li>
        <li>
            CONNEXION
            <ul>
                <li><a href="routeur.php?action=connexion">Se connecter </a></li>
                <li><a href="routeur.php?action=inscription">S'inscrire </a></li>
            </ul>
        </li>
        
        <hr><br>
    </menu>

    <?= $sessionPage ?>

    <footer>
        <br><hr><br>
        <span>© 2018 —  Dream Little dreamer  —  Crédits</span><br>
        <span>Contact : <em>contact@dreamer.fr</em></span>
    </footer>
</body>
</html>
