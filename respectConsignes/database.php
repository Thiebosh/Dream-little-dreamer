<?php

function dbConnect() {
    //Connexion à la base de données
    $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dbName = 'dreamer';
    $dbUser = 'root';
    $dbPass = '';
    
    $dataBase = new PDO('mysql:host=localhost;dbname='.$dbName.';charset=utf8', $dbUser, $dbPass, $errMsg);
    
    //En cas d'échec de connexion
    if (!$dataBase) throw new Exception("Base De Données : Echec de connexion");

    return $dataBase;
}


function getMenu() {
    $bdd = dbConnect();

    //Récupérer la liste des catégories d articles
    $query = 'SELECT DISTINCT type
                FROM produit
                ORDER BY type';
    $request = $bdd->prepare($query);//Préparation de la requête
    if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

    foreach($request->fetchAll(PDO::FETCH_COLUMN) as $type) $donnees[] = $type;

    return $donnees;
}


function getClient($email) {
    $bdd = dbConnect();

    $query = 'SELECT *
                FROM client 
                WHERE email = :mail';
    $table = array('mail' => $email);

    $request = $bdd->prepare($query);
    if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    $donneesClient = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();

    return $donneesClient;
}


function getProduit($id_produit) {
    $bdd = dbConnect();

    //Récupérer les infos d'un article specifique
    $query = 'SELECT nom, prix, quantite as quantite_dispo
                FROM produit
                WHERE id = :id_produit';
    $table = array('id_produit' => $id_produit);
    $request = $bdd->prepare($query);

    if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    $table = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    $table['id'] = $id_produit;
    
    return $table;
}


function getBoutique($typesProduit) {
    $bdd = dbConnect();

    //Récupérer les infos de chaque article dans chaque categorie
    foreach($typesProduit as $type) {
        $query = 'SELECT *
                    FROM produit
                    WHERE type = :type
                    ORDER BY nom';
        $table = array('type' => $type);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        foreach($request->fetchAll(PDO::FETCH_ASSOC) as $dataProduit) $donnees[$type][] = $dataProduit;
    }
    
    return $donnees;

    /*//code de debugage : affichage du contenu d un tableau
    echo '<pre style="text-alig: left;">';
    print_r($donnees);
    echo '</pre>';*/
}


function getRecherche($recherche) {
	$bdd = dbConnect();
    
    $query = 'SELECT *
                FROM produit
                WHERE LOWER(nom) LIKE :search
                    OR LOWER(type) LIKE :search
                    OR LOWER(description) LIKE :search
                ORDER BY nom';
    $table = array('search' => '%' . strtolower($recherche) . '%');
    $request = $bdd->prepare($query);
    if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    $select_recherche = $request->fetchAll(PDO::FETCH_ASSOC);
    
    return $select_recherche;
}



function setCommande($estProvisoire) {
    if (empty($_SESSION['panier'])) throw new Exeption("Enregistrement de la commande : Panier vide");
    if (empty($_SESSION['client'])) throw new Exeption("Enregistrement de la commande : Client déconnecté");
    $bdd = dbConnect();


    //determine numero commande
    $query = 'SELECT MAX(num_commande) as nbCommandes
                FROM commande';
    $request = $bdd->prepare($query);
    if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

    $refCommande = $request->fetch(PDO::FETCH_ASSOC)['nbCommandes'] + 1;
    $request->closeCursor();


    //pour chaque article dans le panier
    foreach ($_SESSION['panier'] as $article) {
        //enregistre la commande
        $query = 'INSERT INTO commande(num_commande, id_client, id_produit, qte_achetee, ad_livraison/*, etat*/) 
                    VALUES(:commande, :client, :produit, :quantite, :adresse/*, :etat*/)';
        $table = array('commande' => $refCommande, /*'etat' => ($estProvisoire === TRUE)? 'en attente' : 'confirmé',*/
                        'produit' => $article['id_produit'], 'quantite' => $article['quantite'], 
                        'client' => $_SESSION['client']['id'], 'adresse' => $_SESSION['client']['ad_livraison']);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

        //actualise nombre d'articles dans la base de données
        $query = 'UPDATE produit
                    SET quantite = :quantite
                    WHERE id = :id_produit';
        $table = array('quantite' => ($article['quant_dispo'] - $article['quantite']), 'id_produit' => $article['id_produit']);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    }
}

function getCommandeAttente() {
    //récupère données commande du client si elle existe puis la supprime de la table
    //renvoie commande remise en forme et référence commande si elle existe
    return;
}



function getNbArticles() {
    $bdd = dbConnect();

    //Récupérer la liste des catégories d articles
    $query = 'SELECT COUNT(*)
                FROM produit';
    $request = $bdd->prepare($query);//Préparation de la requête
    if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

    $nombreArticles = $request->fetch(PDO::FETCH_NUM)[0];//équivaut à $nombreArticles[0];
    $request->closeCursor();

    return $nombreArticles;
}