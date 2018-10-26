<?php 
session_start();

require('modele.php');


try {
    $variablePage['categories'] = getMenu();
    $variablePage['action'] = (!empty($_GET['action'])) ? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) : 'accueil'; //isset : vérifie l'existence ; empty : vérifie l'existece et que différent de false


    //gestion utilisateur
    if ($variablePage['action'] == 'connexion' || $variablePage['action'] == 'deconnexion' || $variablePage['action'] == 'inscription') {//du plus au moins fréquent
        if (empty($_SESSION['client'])) {
            if ($variablePage['action'] == 'connexion') {//connexion plus fréquente qu'inscription
                if (isset($_POST['email'], $_POST['pass'])) {
                    $variablePage['postConnexion'] = array('email' => $_POST['email'], 'pass' => $_POST['pass']);
                    $variablePage['postConnexion']['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $variablePage['postConnexion']['pass'] = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
                        
                    if (in_array(false, $variablePage, true)) unset($variablePage['postConnexion']);
                    
                    //traite
                    $postSecure = $variablePage['postConnexion'];
                    $donneesClient = getClient($postSecure['email']); //pour avoir infos du client par rapport à son email

                    //if (!password_verify($postSecure['pass'], $donneesClient['password'])) {//(hash premier mdp et le compare au second, déjà hashé) vérifie le résultat : ne stocke jamais mdp en clair en bdd
                    if ($postSecure['pass'] != $donneesClient['password']) $variablePage['errMsg'] = true; //message erreur
                    else {
                        $_SESSION['client'] = $donneesClient;
                        if (!empty($tmp = getCommandeAttente())) {//récupération du panier provisoire, s'il existe
                            $_SESSION['panier'] = $tmp['panier'];
                            $_SESSION['client']['refCommande'] = $tmp['refVide'];
                        }

                        header('Location: index.php?page=panier');//ou accueil ou profil ou boutique
                        exit();
                    }
                }
                
                require('Vue/connexion.php');
            }
            else if ($variablePage['action'] == 'inscription') {
                //sécurise : à faire vérifier var post, hasher mdp si toutes les var du post sont correctes
                if (isset($_POST['civil'], $_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['email'], $_POST['adresse'], $_POST['password1'], $_POST['password2'])) {
                    $variablePage['postInscription'] = array('civil' => $_POST['civil'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'tel' => $_POST['tel'], 'email' => $_POST['email'], 'adresse' => $_POST['adresse'], 'pass1' => $_POST['password1'], 'pass2' => $_POST['password2']);
                    $variablePage['postInscription']['nom'] = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
                    $variablePage['postInscription']['prenom'] = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
                    $variablePage['postInscription']['tel'] = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
                    $variablePage['postInscription']['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $variablePage['postInscription']['adresse'] = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);
                    $variablePage['postInscription']['password1'] = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
                    $variablePage['postInscription']['password2'] = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
                //password_hash($passwordToHash, PASSWORD_DEFAULT);//selectionne par défaut meilleure fonction de hashage

                //traite
                $postSecure = $variablePage['postInscription'];
                //si infos valide : inscrit client et redirige sur page de connexion
                //...
                }
                //sinon : affiche erreur appropriée
                $variablePage['errMsg'] = true;

                
                require('Vue/inscription.php');
            }
        }
        else if ($variablePage['action'] == 'deconnexion') {
            //if (!empty($_SESSION['panier'])) setCommande(true);//enregistrement du panier en provisoire, s'il existe
        
            session_destroy();//suppression des variables globales
            header('Location: index.php?page=accueil');//ou connexion
            exit(); 
        }
    }

    //gestion pages (ni inscription, connexion ou déconnexion)
    else {
        switch ($variablePage['action']) { //$action sécurisé par default
            case 'accueil':
                require('Vue/accueil.php');
            break;
            
            case 'recherche':
                //sécuriser variable search (type string)
                if (isset($_POST['search'])) {
                    $variablePage['postSearch']['search'] = filter_input(INPUT_POST, 'search',  FILTER_SANITIZE_STRING);
                    
                    if (in_array(false, $variablePage, true)) unset($variablePage['postSearch']);
                }

                $variablePage['postSearch']['search'] = $_POST['search'];//sécuriser variable search (type string)
                if (empty($variablePage['postSearch']['search'])) $variablePage['errMsg'] = true;
                else {
                    $variablePage['recherche'] = $variablePage['postSearch']['search'];
                    $variablePage['resultat'] = getRecherche($variablePage['recherche']);
                }

                require('Vue/recherche.php');
            break;

            case 'profil':
                if (empty($_SESSION['client'])) { //si pas de client connecté, on ne peut pas aller sur le profil = redirection vers connexion
                    header('Location: index.php?action=connexion');
                    exit();
                }
            
                require('Vue/profil.php');
            break;

            case 'boutique':
                $variablePage['boutique'] = getBoutique($variablePage['categories']);
            
                require('Vue/boutique.php');
            break;

            case 'produit':
                if (isset($_GET['ref'])) {
                    $options = array('options'=>array('default'=>1, 'min_range'=>1, 'max_range'=>getNbArticles()));
                    $variablePage['postProduit']['ref'] = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT, $options);
                    
                    if (in_array(false, $variablePage, true)) unset($variablePage['postProduit']);
                }
                if (empty($variablePage['postProduit']['ref'])) $variablePage['errMsg'] = true;
                else $variablePage['produit'] = getProduit($variablePage['postProduit']['ref']);

                require('Vue/produit.php');
            break;

            case 'panier':
                //sécurisation données
                if (isset($_POST['ref'], $_POST['article'], $_POST['prix'], $_POST['quant'], $_POST['dispo'])) {
                    $variablePage['postPanier']['ref']        = filter_input(INPUT_POST, 'ref',       FILTER_VALIDATE_INT);
                    $variablePage['postPanier']['article']    = filter_input(INPUT_POST, 'article',   FILTER_SANITIZE_STRING);
                    $variablePage['postPanier']['prix']       = filter_input(INPUT_POST, 'prix',      FILTER_VALIDATE_FLOAT);
                    $variablePage['postPanier']['quant']      = filter_input(INPUT_POST, 'quant',     FILTER_VALIDATE_INT);
                    $variablePage['postPanier']['dispo']      = filter_input(INPUT_POST, 'dispo',     FILTER_VALIDATE_INT);
                    
                    //on regarde s'il y a un false dans le tableau variablePage['postPanier] avec une comparaison stricte : comparaison du type (sinon 0 considéré comme false)
                    if (in_array(false, $variablePage['postPanier'], true)) unset($variablePage['postPanier']); //tout ou rien (true de fin => comparaison du type. sinon, valeur)
                }
                else if (isset($_POST['supprimeArticle']))  $variablePage['postPanier']['supprimeArticle']  = filter_input(INPUT_POST, 'supprimeArticle',   FILTER_SANITIZE_STRING);
                else if (isset($_POST['supprimePanier']))   $variablePage['postPanier']['supprimePanier']   = filter_input(INPUT_POST, 'supprimePanier',    FILTER_VALIDATE_BOOLEAN);

                //simplifie variable
                if (isset($variablePage['postPanier'])) $postSecure = $variablePage['postPanier'];

                //traite données
                if (!empty($postSecure['supprimePanier'])) {
                    $_SESSION['panier'] = array();//Vider le panier de commande
                    header('Location: index.php?page=boutique');//charge nouvelle page (=> nouveau script)
                    exit();//quitte script actuel ("ancienne" page)
                }
                else {
                    //si post contient infos d'un article, ajoute l'article
                    if (isset($postSecure['ref'], $postSecure['article'], $postSecure['prix'], $postSecure['quant'], $postSecure['dispo'])) {
                        
                        //si le panier n'est pas vide et que le panier contient une clé associative fille égale à postSecure['article"] (nom article) alors modifie la quantité
                        if (!empty($_SESSION['panier']) && array_key_exists($postSecure['article'], $_SESSION['panier'])) $_SESSION['panier'][$postSecure['article']]['quantite'] = $postSecure['quant'];

                        //sinon, crée nouvelle entrée du nom de l'article
                        else $_SESSION['panier'][$postSecure['article']] = array('id_produit'   => $postSecure['ref'],
                                                                                'produit'       => $postSecure['article'],
                                                                                'prix'          => $postSecure['prix'],
                                                                                'quantite'      => $postSecure['quant'],
                                                                                'quant_dispo'   => $postSecure['dispo']);
                        
                        $_SESSION['panier'][ $postSecure['article' ]]['total'] = $postSecure['prix'] * $_SESSION['panier'][$postSecure['article']]['quantite'];
                    }
                    //Supprimer un article du panier
                    else if (!empty($postSecure['supprimeArticle'])) unset($_SESSION['panier'][ $postSecure['supprimeArticle'] ]);//detruit table produit

                    //Calcul du prix total et de la quantité totale d'articles
                    if (!empty($_SESSION['panier'])) {
                        $variablePage['coutTotal']      = array_sum(array_column($_SESSION['panier'], 'total'));
                        $variablePage['quantiteTotale'] = array_sum(array_column($_SESSION['panier'], 'quantite'));
                    }
                }

                require('Vue/panier.php');
            break;

            case 'validation':
                require('Vue/validation.php');
            break;

            case 'confirmation':
                if (empty($_SESSION['client'])) $variablePage['errMsg'] = true;
                else {
                    setCommande(false);
                    $_SESSION['panier'] = array();
                }
                
                require('Vue/confirmation.php');
            break;

            

            default:
                throw new Exception('Erreur 404 : Page "' . $variablePage['action'] . '" introuvable');
            break;
        }
    }
}

catch(Exception $erreur) {
    $action = 'erreur';
    $erreurMessage = $erreur->getMessage();
    $erreurDetail = $erreur->getFile() . ', ligne ' . $erreur->getLine();
    
    require('Vue/erreur.php');
}