<?php
session_start();

require('database.php');
require('checkUser.php');


//reçoit une action à exécuter ou une page à charger
if (isset($_GET['action'])) {
    switch ($variablePage['action'] = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING)) {
        case 'connexion'://connexion plus fréquente qu'inscription
            if (isset($_POST['email'], $_POST['pass'])) $variablePage['postConnexion'] = array('email' => $_POST['email'], 'pass' => $_POST['pass']);
        break;

        case 'inscription':
            if (isset($_POST['civil'], $_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['email'], $_POST['adresse'], $_POST['password1'], $_POST['password2'])) $variablePage['postInscription'] = array('civil' => $_POST['civil'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'tel' => $_POST['tel'], 'email' => $_POST['email'], 'adresse' => $_POST['adresse'], 'pass1' => $_POST['password1'], 'pass2' => $_POST['password2']);
        break;
    }
}
else {
    switch ($variablePage['page'] = (!empty($_GET['page'])) ? filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) : 'accueil') {
        case 'recherche':
            if (isset($_POST['search'])) $variablePage['postSearch']['search'] = $_POST['search'];
        break;

        case 'produit':
            if (isset($_GET['ref'])) $variablePage['postProduit']['ref'] = $_GET['ref'];
        break;

        case 'panier':
            if (isset($_POST['ref'], $_POST['article'], $_POST['prix'], $_POST['quant'], $_POST['dispo'])) {
                $variablePage['postPanier']['ref']        = filter_input(INPUT_POST, 'ref',       FILTER_VALIDATE_INT);
                $variablePage['postPanier']['article']    = filter_input(INPUT_POST, 'article',   FILTER_SANITIZE_STRING);
                $variablePage['postPanier']['prix']       = filter_input(INPUT_POST, 'prix',      FILTER_VALIDATE_FLOAT);
                $variablePage['postPanier']['quant']      = filter_input(INPUT_POST, 'quant',     FILTER_VALIDATE_INT);
                $variablePage['postPanier']['dispo']      = filter_input(INPUT_POST, 'dispo',     FILTER_VALIDATE_INT);

                if (in_array(false, $variablePage, true)) unset($variablePage['postPanier']); //tout ou rien (true de fin => comparaison du type. sinon, valeur)
            }
            else if (isset($_POST['supprimeArticle']))  $variablePage['postPanier']['supprimeArticle']  = filter_input(INPUT_POST, 'supprimeArticle',   FILTER_SANITIZE_STRING);
            else if (isset($_POST['supprimePanier']))   $variablePage['postPanier']['supprimePanier']   = filter_input(INPUT_POST, 'supprimePanier',    FILTER_VALIDATE_BOOLEAN);
        break;

        //exception : reçoit pas de données mais besoin des données utilisateur pour ces pages
        case 'profil':
            if (empty($_SESSION['client'])) {
                header('Location: index.php?action=connexion');
                exit();
            }
        break;

        case 'confirmation':
            if (empty($_SESSION['client'])) $variablePage['errMsg'] = true;
        break;
    }
}

//une action peut rediriger le flux, une action n'a pas de valeur par défaut : priorité
if (!empty($variablePage['action'])) {
    if (empty($_SESSION['client'])) {
        if      ($variablePage['action'] == 'connexion'     && !empty($variablePage['postConnexion'])   && !connexion($variablePage['postConnexion']))     $variablePage['errMsg'] = true;//sinon, redirigé par la fonction
        else if ($variablePage['action'] == 'inscription'   && !empty($variablePage['postInscription']) && !inscription($variablePage['postInscription'])) $variablePage['errMsg'] = true;//sinon, redirigé par la fonction
        $variablePage['page'] = $variablePage['action'];//si encore sur ce script : charge page
    }
    else if ($variablePage['action'] == 'deconnexion') deconnexion();
}
$variablePage['categories'] = getMenu();
if (!empty($variablePage['page']) && file_exists('action/' . $variablePage['page'] . '.php')) require('action/' . $variablePage['page'] . '.php');

//affichage de la page
?>
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
            <?php if (!empty($_SESSION['client'])) echo '<a href="index.php?page=profil">MON PROFIL</a>';
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

    <?php
        if (file_exists('view/' . $variablePage['page'] . '.php')) require('view/' . $variablePage['page'] . '.php');
        else require('view/erreur.php');
    ?>

    <footer>
        <br><hr><br>
        <span>© 2018 —  Dream Little dreamer  —  Crédits</span><br>
        <span>Contact : <em><a href="mailto:contact@dreamer.fr">contact@dreamer.fr</a></em></span><br>
        &nbsp;
    </footer>
</body>
</html>