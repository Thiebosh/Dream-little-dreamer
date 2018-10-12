<?php 
//index.php : fichier combinant routeur.php et controleur.php

session_start();
//session_destroy();//pour forcer reinitialisation variables globales

//require('controleur.php');//pas necessaire d avoir fichier controleur car peu de traitement donc fonctions tres concises => MVC incomplet
require('modele.php');


try {
    $typeProduits = getInitMenu();

    switch ((isset($_GET['action'])) ? $_GET['action'] : 'accueil') {
        case 'accueil':
            require('Vue/accueil.php');
        break;
        case 'boutique':
            $boutique = getInitBoutique($typeProduits);
        
            require('Vue/boutique.php');
        break;
        case 'confirmation':
            setCommande();
            $_SESSION['panier'] = array();

            require('Vue/confirmation.php');
        break;
        case 'connexion':
        //variables page...

            require('Vue/connexion.php');
        break;
        case 'inscription':
        //variables page...

            require('Vue/inscription.php');
        break;
        case 'panier':
            //si post contient infos d'un article, ajoute l'article
            if (isset($_POST['ref']) && isset($_POST['article']) && isset($_POST['prix']) && isset($_POST['quant']) && isset($_POST['dispo'])) {
                $ajout = false;

                //Si panier déjà initialisé, modifie quantité
                if (isset($_SESSION['panier'])) {
                    $indice = 0;
                    while (isset($_SESSION['panier'][$indice])) {
                        //Si on a déjà commandé le produit
                        if ($_SESSION['panier'][$indice]['id_produit'] == $_POST['ref']) {
                            $_SESSION['panier'][$indice]['quantite'] += $_POST['quant'];
                            $ajout = true;
                        }
                        $indice++;
                    }
                }

                //Ajout d'un nouvel article (si pas déjà présent dans le panier)
                if (!$ajout) {
                    $newArticle['id_produit']   = $_POST['ref'];
                    $newArticle['nom']          = $_POST['article'];
                    $newArticle['prix']         = $_POST['prix'];
                    $newArticle['quantite']     = $_POST['quant'];
                    $newArticle['quant_dispo']  = $_POST['dispo'];

                    $_SESSION['panier'][] = $newArticle;
                }
            }

            //Supprimer un article du panier
            else if (isset($_POST['supprimerArticle'])) array_splice($_SESSION['panier'], $_POST['posSupprime'], 1);

            //Vider le panier de commande
            else if (isset($_POST['viderTable'])) {
                $_SESSION['panier'] = array();
                header('Location: routeur.php?action=boutique');//charge nouvelle page (=> nouveau script)
                exit();//quitte script actuel ("ancienne" page)
            }
            
            //Calcul du prix total et de la quantité totale d'articles
            if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
                $cout = array();
                $quantite_total = 0;
                foreach ($_SESSION['panier'] as $article) {
                    $cout[] = $article['prix'] * $article['quantite']; //equivaut a total += $article['prix'] * $article['quantite'] mais permet d'utilser fonction array_sum()
                    $quantite_total += $article['quantite'];
                }
                $total = array_sum($cout);
            }

            require('Vue/panier.php');
        break;
        case 'produit':
            if (!isset($_GET['ref']) || empty($_GET['ref'])) throw new Exception('Référence produit invalide');
            $produit = getInitProduit($_GET['ref']);

            require('Vue/produit.php');
        break;
        case 'profil':
        //variables page...
        
            require('Vue/profil.php');
        break;
        case 'recherche':
            if (!isset($_POST['search']) || empty($_POST['search'])) throw new Exception('Vous devez entrer votre requête dans la barre de recherche');
            $recherche = $_POST['search'];
            $tab_recherche = getInitRecherche(strtolower($recherche));
        
            require('Vue/recherche.php');
        break;
        case 'validation':
            require('Vue/validation.php');
        break;
        default: 
            throw new Exception('Erreur 404 : Page introuvable');
        break;
    }
}

catch(Exception $erreur) {
    $erreurMessage = $erreur->getMessage();
    $erreurDetail = $erreur->getFile() . ', ligne ' . $erreur->getLine();
    
    require('Vue/erreur.php');
}