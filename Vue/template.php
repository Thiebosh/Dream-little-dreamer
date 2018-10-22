<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="Vue/styleSheets/normalize.css" rel="stylesheet"/>
    
    <link href="Vue/styleSheets/template.css" rel="stylesheet"/>
    <link href="Vue/styleSheets/section.css" rel="stylesheet"/>
    <title>Dream little dreamer - <?= htmlspecialchars(ucfirst($action)) ?></title>
</head>

<body>
    <header>
        <nav>
            <?php if (!empty($_SESSION['client'])) echo '<a class="navElt buttonNav" href="index.php?action=deconnexion">Déconnexion</a>';
            else { ?>
                <a class="navElt buttonNav" href="index.php?action=inscription">S'inscrire</a>

                <form class="navElt" method="post" action="index.php?action=connexion">
                    <span>
                        <input type="email" 	name="email" 	placeholder="EMAIL@EXEMPLE.COM"	required>
                        <input type="password" 	name="pass"		placeholder="MOT DE PASSE" 		required>
                    </span>
                    <input type="submit" class="buttonNav" value="Se connecter"/>
                </form>
            <?php } ?>

            
            <form method="post" action="index.php?action=recherche">
                <input type="text" name="search" placeholder="Rechercher"/>
                <input type="submit" class="buttonNav" value="Rechercher"/>
            </form>

            <a class="navElt" href="index.php?action=panier"><img src="Vue/images/panier.png" alt="Visuel panier"/></a>
        </nav>
        
        <h1>
            <a href="index.php?action=accueil"><img src="Vue/images/logo.jpg" alt="Visuel logo"/></a>
        </h1>
    </header>

    <menu>
        <li><a href="index.php?action=accueil">ACCUEIL</a></li>
        <li>
            <a href="index.php?action=boutique">BOUTIQUE</a>
            <ul>
                <?php foreach ($typeProduits as $type) { ?>
                    <li><a href="index.php?action=boutique#<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <li><a href="index.php?action=panier">MON PANIER</a></li>
        <li>
            <?php if (!empty($_SESSION['client'])) echo '<a href="index.php?action=profil">MON PROFIL</a>';
            else { ?>
                CONNEXION
                <ul>
                    <li><a href="index.php?action=inscription">S'inscrire</a></li>
                    <li><a href="index.php?action=connexion">Se connecter</a></li>
                </ul>
            <?php }  ?>
        </li>
        
        <hr><br>
    </menu>

    <?= $sessionPage ?><!--insere code de la page (dans section)-->

    <footer>
        <br><hr><br>
        <span>© 2018 —  Dream Little dreamer  —  Crédits</span><br>
        <span>Contact : <em><a href="mailto:contact@dreamer.fr">contact@dreamer.fr</a></em></span><br>
        &nbsp;
    </footer>
</body>
</html>
