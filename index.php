<?php 
session_start();

require('modele.php');


try {
    $typeProduits = getInitMenu();

    switch ($action = (!empty($_GET['action'])) ? $_GET['action'] : 'accueil') { //$action sécurisé par default
        case 'accueil':
            require('Vue/accueil.php');
        break;
        
        case 'recherche':
            if (empty($_POST['search'])) throw new Exception('Vous devez entrer votre requête dans la barre de recherche');
            $recherche = $_POST['search'];
            $tab_recherche = getInitRecherche(strtolower($recherche));
        
            require('Vue/recherche.php');
        break;



        case 'inscription':
        //variables page...
        //utiliser FILTER_VALIDATE_EMAIL. ou FILTER_SANITIZE_STRING mais @ peut coincer. Et puis ca permet de montrer l'étendue de votre maitrise...

            require('Vue/inscription.php');
        break;

        case 'connexion':
        //utiliser FILTER_VALIDATE_EMAIL. ou FILTER_SANITIZE_STRING mais @ peut coincer. Et puis ca permet de montrer l'étendue de votre maitrise...

        //petit filtre détaillé : vérifie que la variable du post appartient aux valeurs du tableau. Peut être pas besoin, mais au moins vous saurez faire
        //$postSecure['etat'] = filter_input(INPUT_POST, 'etat', FILTER_CALLBACK, 
        //    ['options' => function ($data) {return in_array($data, ['en attente', 'confirmer']) ? $data : false;}]);
            if (!empty($_POST['email']) && !empty($_POST['pass'])) {
                $donneesClient = getInitClient($_POST['email']);

                //if (!password_verify($_POST['pass'], $donneesClient['password'])) {//vérifie le résultat : ne stocke jamais mdp en clair en bdd
                if ($_POST['pass'] != $donneesClient['password']) $messageErreur = TRUE;
                else {
                    $_SESSION['client'] = $donneesClient;
                    if (!empty($tmp = getCommandeAttente())) {//récupération du panier provisoire, s'il existe
                        foreach ($tmp['contenu'] as $produit) $_SESSION['panier'][] = $produit;//vérifier validité
                        $_SESSION['client']['refCommande'] = $tmp['refVide'];
                    }
            
                    header('Location: index.php?action=panier');//ou accueil ou profil ou boutique
                    exit();
                }
            }

            require('Vue/connexion.php');
        break;

        case 'deconnexion':
            //if (!empty($_SESSION['panier'])) setCommande(TRUE);//enregistrement du panier en provisoire, s'il existe

            session_destroy();//suppression des variables globales
            header('Location: index.php?action=accueil');
            exit();
        break;
        
        case 'profil':
        //variables page...
        
            require('Vue/profil.php');
        break;



        case 'boutique':
            $boutique = getInitBoutique($typeProduits);
        
            require('Vue/boutique.php');
        break;

        case 'produit':
            if (empty($_GET['ref'])) throw new Exception('Référence produit invalide');
            $produit = getInitProduit($_GET['ref']);

            require('Vue/produit.php');
        break;

        case 'panier':
            //si post contient infos d'un article, ajoute l'article
            if (isset($_POST['ref'], $_POST['article'], $_POST['prix'], $_POST['quant'], $_POST['dispo'])) {
                //sécurisation données
                $postSecure['ref']        = filter_input(INPUT_POST, 'ref',       FILTER_VALIDATE_INT);
                $postSecure['article']    = filter_input(INPUT_POST, 'article',   FILTER_SANITIZE_STRING);
                $postSecure['prix']       = filter_input(INPUT_POST, 'prix',      FILTER_VALIDATE_FLOAT);
                $postSecure['quant']      = filter_input(INPUT_POST, 'quant',     FILTER_VALIDATE_INT);
                $postSecure['dispo']      = filter_input(INPUT_POST, 'dispo',     FILTER_VALIDATE_INT);

                if (!in_array(false, $postSecure, true)) {//si tout est valide (true de fin pour comparaison du type plutot que de la valeur)
                    $ajout = false;

                    //Si panier déjà initialisé, modifie quantité
                    if (isset($_SESSION['panier'])) {
                        $indice = 0;
                        while (isset($_SESSION['panier'][$indice])) {
                            //Si on a déjà commandé le produit
                            if ($_SESSION['panier'][$indice]['id_produit'] == $postSecure['ref']) {
                                $_SESSION['panier'][$indice]['quantite'] += $postSecure['quant'];
                                $ajout = true;
                            }
                            $indice++;
                        }
                    }

                    //Ajout d'un nouvel article (si pas déjà présent dans le panier)
                    if (!$ajout) $_SESSION['panier'][] = array('id_produit' => $postSecure['ref'],
                                                            'nom'           => $postSecure['article'],
                                                            'prix'          => $postSecure['prix'],
                                                            'quantite'      => $postSecure['quant'],
                                                            'quant_dispo'   => $postSecure['dispo']);
                }
            }

            //Supprimer un article du panier
            else if (isset($_POST['supprimerArticle']) && ($position = filter_input(INPUT_POST, 'posSupprime', FILTER_VALIDATE_INT)) !== false) {
                array_splice($_SESSION['panier'], $position, 1);
            }

            //Vider le panier de commande
            else if (isset($_POST['viderTable'])) {
                $_SESSION['panier'] = array();
                header('Location: index.php?action=boutique');//charge nouvelle page (=> nouveau script)
                exit();//quitte script actuel ("ancienne" page)
            }
            
            //Calcul du prix total et de la quantité totale d'articles
            if (!empty($_SESSION['panier'])) {
                $total = $quantite_total = 0;
                foreach ($_SESSION['panier'] as $article) {
                    $total += $article['prix'] * $article['quantite'];
                    $quantite_total += $article['quantite'];
                }
            }

            require('Vue/panier.php');
        break;

        case 'validation':
            require('Vue/validation.php');
        break;

        case 'confirmation':
            setCommande(FALSE);
            $_SESSION['panier'] = array();

            require('Vue/confirmation.php');
        break;

        

        default:
            throw new Exception('Erreur 404 : Page "' . $action . '" introuvable');
        break;
    }
}

catch(Exception $erreur) {
    $action = 'erreur';
    $erreurMessage = $erreur->getMessage();
    $erreurDetail = $erreur->getFile() . ', ligne ' . $erreur->getLine();
    
    require('Vue/erreur.php');
}