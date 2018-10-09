<?php 
session_start();

require("controleur.php");
require("modele.php");

try {
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'accueil';

    
    
    
    switch ($action) {
        /*case "accueil":
            //fonction constructeur accueil
            require("Vue/action.php");
        break;*/
        case "boutique":
            //fonction constructeur boutique
            initBoutique();
        break;
        /*case "confirmation":*
            //fonction constructeur ...
            require("Vue/accueil.php");
        break;
        case "connexion":
            //fonction constructeur accueil
            require("Vue/accueil.php");
        break;
        case "inscription":
            //fonction constructeur accueil
            require("Vue/accueil.php");
        break;*/
        case "panier":
        $boutique = getDataMenu();
            if (isset($_POST['ref']) && isset($_POST['article']) && 
                isset($_POST['prix']) && isset($_POST['quant'])) {
                $newArticle['id_produit']   = $_POST['ref'];
                $newArticle['nom']          = $_POST['article'];
                $newArticle['prix']         = $_POST['prix'];
                $newArticle['quantite']        = $_POST['quant'];

                $_SESSION['panier'][] = $newArticle;
            }
            
            require("Vue/panier.php");
        break;
        case "produit"://*
            initProduit((isset($_GET['ref'])) ? $_GET['ref'] : 1);
        break;/*
        case "profil":
            //fonction constructeur accueil
            require("Vue/accueil.php");
        break;
        case "recherche":*
            //fonction constructeur accueil
            require("Vue/accueil.php");
        break;
        case "validation":*
            //fonction constructeur accueil
            require("Vue/accueil.php");
        break;*/
        default: 
            require("Vue/".$action.".php");//non securise as fuck
        break;
    }
    

}

catch(Exception $erreur) {
    $erreurMessage = $erreur->getMessage();
    $erreurDetail = $erreur->getFile() . ', ligne ' . $erreur->getLine();
    
    require('Vue/erreur.php');
}