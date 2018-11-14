<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="view/styleSheets/normalize.css" rel="stylesheet"/>
    
    <link href="view/styleSheets/template.css" rel="stylesheet"/>
    <link href="view/styleSheets/section.css" rel="stylesheet"/>
    <title>Dream little dreamer - <?= htmlspecialchars(ucfirst($variablePage['page'])) ?></title>
</head>

<body>
    <header>
        <nav>
            <?php if (!empty($_SESSION['client'])) {
                echo '<a class="navElt buttonNav" href="index.php?action=deconnexion">Déconnexion</a>';
            }
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

            
            <form method="post" action="index.php?page=recherche">
                <input type="text" name="search" placeholder="Rechercher"/>
                <input type="submit" class="buttonNav" value="Rechercher"/>
            </form>

            <a class="navElt" href="index.php?page=panier"><img src="view/images/panier.png" alt="Visuel panier"/></a>
        </nav>
        
        <h1>
            <a href="index.php?page=accueil"><img src="view/images/logo.jpg" alt="Visuel logo"/></a>
        </h1>
    </header>

    <menu>
        <li><a href="index.php?page=accueil">ACCUEIL</a></li>
        <li>
            <a href="index.php?page=boutique">BOUTIQUE</a>
            <ul>
                <?php foreach ($variablePage['categories'] as $categorie) { ?>
                    <li><a href="index.php?page=boutique#<?= htmlspecialchars($categorie) ?>"><?= htmlspecialchars($categorie) ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <li><a href="index.php?page=panier">MON PANIER</a></li>
        <li>
            <?php if (!empty($_SESSION['client'])) { ?>
                MON COMPTE
                <ul>
                    <li><a href="index.php?page=profil">Mon profil</a></li>
                    <li><a href="index.php?page=commande">Mes commandes</a></li>
                </ul>
            <?php }
            else { ?>
                ACCÈS AU SITE
                <ul>
                    <li><a href="index.php?action=inscription">S'inscrire</a></li>
                    <li><a href="index.php?action=connexion">Se connecter</a></li>
                </ul>
            <?php } ?>
        </li>
        
        <hr><br>
    </menu>

    <?= $variablePage['contenuSection'] ?>

    <footer>
        <br><hr><br>
        <span>© 2018 —  Dream Little dreamer  —  Crédits</span><br>
        <span>Contact : <em><a href="mailto:contact@dreamer.fr">contact@dreamer.fr</a></em></span><br>
        &nbsp;
    </footer>
</body>
</html>
