<?php

function dbConnect() {
    $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dbName = 'dreamer';
    $dbUser = 'root';
    $dbPass = '';
    
    $dataBase = new PDO('mysql:host=localhost;dbname='.$dbName.';charset=utf8', $dbUser, $dbPass, $errMsg);
    if (!$dataBase) throw new Exception("Base De Données : Echec de connexion");

    return $dataBase;
}



function getInitMenu() {
    $bdd = dbConnect();

    //recupere liste des categories d article
    $query = 'SELECT DISTINCT type
                FROM produit
                ORDER BY type';
    $request = $bdd->prepare($query);
    if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

    foreach($request->fetchAll(PDO::FETCH_COLUMN) as $type) $donnees[] = $type;

    return $donnees;
}



function getInitProduit($id_produit) {
    $bdd = dbConnect();

    //recupere les infos d un article specifique
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



function getInitBoutique($typesProduit) {
    $bdd = dbConnect();

    //recupere les infos de chaque article dans chaque categorie
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
    //code de debugage : affichage du contenu d un tableau
    echo '<pre style="text-alig: left;">';
    print_r($donnees);
    echo '</pre>';
}



function getInitRecherche($recherche) {
	$bdd = dbConnect();
	
    $query = 'SELECT *
                FROM produit
                WHERE nom LIKE :search
                    OR type LIKE :search
                    OR description LIKE :search
                ORDER BY nom';
    $table = array('search' => '%'.$recherche.'%');
    $request = $bdd->prepare($query);
    if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");

    /*
    echo '<pre style="text-align: left;">';
    print_r($request);
    echo '</pre>';
    
    $select_recherche = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    
    echo '<pre style="text-align: left;">';
    print_r($select_recherche);
    echo '</pre>';
    */
    $select_recherche = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    /*
    echo '<pre style="text-align: left;">';
    print_r($select_recherche);
    echo '</pre>';
    */
    
    return $select_recherche;
}



function setCommande() {
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) throw new Exeption("Enregistrement de la commande : Panier vide");
    //if (!isset($_SESSION['client']) || empty($_SESSION['client'])) throw new Exeption("Enregistrement de la commande : Client déconnecté");
    $bdd = dbConnect();

    //determine numero commande
    $query = 'SELECT MAX(num_commande) as commande
                FROM commande';
    $request = $bdd->prepare($query);
    if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

    $commande = $request->fetch(PDO::FETCH_ASSOC)['commande'] + 1;
    $request->closeCursor();


    //recupere infos client
    //$client = $_SESSION['client'];//a terme
    $query = 'SELECT id, ad_livraison as adresse
                FROM client';
    $request = $bdd->prepare($query);
    if (!$request->execute()) throw new Exception("Base De Données : Echec d'exécution");

    $client = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();


    //pour chaque article dans le panier
    foreach ($_SESSION['panier'] as $article) {
        //enregistre la commande
        $query = 'INSERT INTO commande(num_commande, id_client, id_produit, qte_achetee, ad_livraison) 
                    VALUES(:commande, :client, :produit, :quantite, :adresse)';
        $table = array('commande' => $commande, 
                        'produit' => $article['id_produit'], 'quantite' => $article['quantite'], 
                        'client' => $client['id'], 'adresse' => $client['adresse']);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");


        //actualise nombre d article
        $query = 'UPDATE produit
                    SET quantite = :quantite
                    WHERE id = :id_produit';
        $table = array('quantite' => ($article['quant_dispo'] - $article['quantite']), 'id_produit' => $article['id_produit']);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) throw new Exception("Base De Données : Echec d'exécution");
    }
}