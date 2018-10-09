<?php

function dbConnect() {
    $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dbName = 'dreamer';
    $dbUser = 'root';
    $dbPass = '';
    
    $dataBase = new PDO('mysql:host=localhost;dbname='.$dbName.';charset=utf8', $dbUser, $dbPass);
    if (!$dataBase) throw new Exception("Base De Données : Echec de connexion");

    return $dataBase;
}

function getDataMenu() {
    $bdd = dbConnect();

    $query = 'SELECT DISTINCT type
            FROM produit';
    
    $request = $bdd->prepare($query);
    $retour = $request->execute();
    if (!$retour) throw new Exception("Base De Données : Echec d'exécution");

    foreach($request->fetchAll(PDO::FETCH_COLUMN) as $type) {
        $donnees[$type]['type'] = $type;
    }

    return $donnees;
}

function getInitProduit($id_produit) {
    $bdd = dbConnect();

    $query = 'SELECT nom, prix
            FROM produit
            WHERE id = :id_produit';
    
    $table = array('id_produit' => $id_produit);

    $request = $bdd->prepare($query);
    $retour = $request->execute($table);
    if (!$retour) throw new Exception("Base De Données : Echec d'exécution");

    $table = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();

    $table['id'] = $id_produit;
    
    return $table;
}

function getInitBoutique() {
    $bdd = dbConnect();

    $query = 'SELECT DISTINCT type
            FROM produit';
    
    $request = $bdd->prepare($query);
    $retour = $request->execute();
    if (!$retour) throw new Exception("Base De Données : Echec d'exécution");

    foreach($request->fetchAll(PDO::FETCH_COLUMN) as $type) {
        $query = 'SELECT *
                FROM produit
                WHERE type = :type';

        $table = array('type' => $type);
        $request = $bdd->prepare($query);
        $retour = $request->execute($table);
        if (!$retour) throw new Exception("Base De Données : Echec d'exécution");

        $table = $request->fetchAll();
        foreach($table as $produit) {
            $donnees[$type]['contenu'][] = array_unique($produit);
            $donnees[$type]['type'] = $type;
        }
    }
    /*
    echo '<pre>';
    print_r($donnees);
    echo '</pre>';
    */

    return $donnees;
}
