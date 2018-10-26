<?php
session_start();

require('database.php');
require('checkUser.php');


//reçoit une action à exécuter ou une page à charger
//filtrage variables
if (isset($_GET['action'])) {
    switch ($variablePage['action'] = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING)) {
        case 'connexion'://connexion plus fréquente qu'inscription
            if (isset($_POST['email'], $_POST['pass'])) {
                $variablePage['postConnexion']['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $variablePage['postConnexion']['pass'] = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
                    
                if (in_array(false, $variablePage, true)) unset($variablePage['postConnexion']);
            }
        break;

        case 'inscription':
            if (isset($_POST['civil'], $_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['email'], $_POST['adresse'], $_POST['password1'], $_POST['password2'])) {
                $variablePage['postInscription'] = array('civil' => $_POST['civil'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'tel' => $_POST['tel'], 'email' => $_POST['email'], 'adresse' => $_POST['adresse'], 'pass1' => $_POST['password1'], 'pass2' => $_POST['password2']);
                $variablePage['postInscription']['nom'] = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
                $variablePage['postInscription']['prenom'] = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
                //$variablePage['postInscription']['tel'] = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
                $variablePage['postInscription']['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $variablePage['postInscription']['adresse'] = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);
                $variablePage['postInscription']['password1'] = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
                $variablePage['postInscription']['password2'] = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

                if (in_array(false, $variablePage, true)) unset($variablePage['postInscription']);
            }
        break;
    }
}
else {
    switch ($variablePage['page'] = (!empty($_GET['page'])) ? filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) : 'accueil') {//isset : vérifie l'existence ; empty : vérifie l'existece et que différent de false
        case 'recherche':
            if (isset($_POST['search'])) {
                $variablePage['postSearch']['search'] = filter_input(INPUT_POST, 'search',  FILTER_SANITIZE_STRING);
                
                if (in_array(false, $variablePage, true)) unset($variablePage['postSearch']);
            }
        break;

        case 'produit':
            if (isset($_GET['ref'])) {
                $variablePage['postProduit']['ref'] = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT);
                
                if (in_array(false, $variablePage, true)) unset($variablePage['postProduit']);
            }
        break;

        case 'panier':
            if (isset($_POST['ref'], $_POST['article'], $_POST['prix'], $_POST['quant'], $_POST['dispo'])) {
                $variablePage['postPanier']['ref']        = filter_input(INPUT_POST, 'ref',       FILTER_VALIDATE_INT);
                $variablePage['postPanier']['article']    = filter_input(INPUT_POST, 'article',   FILTER_SANITIZE_STRING);
                $variablePage['postPanier']['prix']       = filter_input(INPUT_POST, 'prix',      FILTER_VALIDATE_FLOAT);
                $variablePage['postPanier']['quant']      = filter_input(INPUT_POST, 'quant',     FILTER_VALIDATE_INT);
                $variablePage['postPanier']['dispo']      = filter_input(INPUT_POST, 'dispo',     FILTER_VALIDATE_INT);

                //on regarde s'il y a un false dans le tableau variablePage['postPanier] avec une comparaison stricte : comparaison du type (sinon 0 considéré comme false)
                if (in_array(false, $variablePage, true)) unset($variablePage['postPanier']); //tout ou rien (true de fin => comparaison du type. sinon, valeur)
            }
            else if (isset($_POST['supprimeArticle']))  $variablePage['postPanier']['supprimeArticle']  = filter_input(INPUT_POST, 'supprimeArticle',   FILTER_SANITIZE_STRING);
            else if (isset($_POST['supprimePanier']))   $variablePage['postPanier']['supprimePanier']   = filter_input(INPUT_POST, 'supprimePanier',    FILTER_VALIDATE_BOOLEAN);
        break;

        //exception : reçoit pas de données mais besoin des données utilisateur pour ces pages
        case 'profil':
            if (empty($_SESSION['client'])) {
                header('Location: index.php?action=connexion'); //si pas de client connecté, on ne peut pas aller sur le profil = redirection vers connexion
                exit();
            }
        break;

        case 'confirmation':
            if (empty($_SESSION['client'])) $variablePage['errMsg'] = true;
        break;
    }
}

//construction des pages
try {//appels bdd peut jeter des erreurs
    //une action peut rediriger le flux et une action n'a pas de valeur par défaut donc priorité
    if (!empty($variablePage['action'])) {
        if (empty($_SESSION['client'])) {
            if      ($variablePage['action'] == 'connexion'     && !empty($variablePage['postConnexion'])   && !connexion($variablePage['postConnexion']))     $variablePage['errMsg'] = true;//sinon, redirigé par la fonction
            else if ($variablePage['action'] == 'inscription'   && !empty($variablePage['postInscription']) && !inscription($variablePage['postInscription'])) $variablePage['errMsg'] = true;//sinon, redirigé par la fonction
            $variablePage['page'] = $variablePage['action'];//si encore sur ce script : charge page
        }
        else if ($variablePage['action'] == 'deconnexion') deconnexion();
    }

    //une page a forcément besoin du menu
    $variablePage['categories'] = getMenu();
    if (!empty($variablePage['page']) && file_exists('action/' . $variablePage['page'] . '.php')) require('action/' . $variablePage['page'] . '.php');
}
catch(Exception $erreur) {
    $variablePage['page'] = 'erreur';
    $variablePage['erreur']['message'] = $erreur->getMessage();
    $variablePage['erreur']['detail'] = 'Fichier ' . $erreur->getFile() . ', ligne ' . $erreur->getLine();
}

//affichage de la page
if (file_exists('view/' . $variablePage['page'] . '.php')) require('view/' . $variablePage['page'] . '.php');
else require('view/erreur.php');
