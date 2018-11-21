<?php
/*$$$$$$ appel systématique (pour toutes les pages) $$$$$$*/
function dbConnect() {
    //Connexion à la base de données
    $errMsg = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $dbName = 'dreamer';
    $dbUser = 'root';
    $dbPass = '';
    
    $dataBase = new PDO('mysql:host=localhost;dbname='.$dbName.';charset=utf8', $dbUser, $dbPass, $errMsg);
    
    //En cas d'échec de connexion
    if (!$dataBase) {
        throw new Exception("Base De Données : Echec de connexion");
    }

    return $dataBase;
}


function getMenu() {
    $bdd = dbConnect();

    //Récupérer la liste des catégories d articles
    $query = 'SELECT DISTINCT type
                FROM produit
                ORDER BY type';
    $request = $bdd->prepare($query);//Préparation de la requête
    if (!$request->execute()) {
        throw new Exception("Base De Données : Echec d'exécution");
    }

    foreach ($request->fetchAll(PDO::FETCH_COLUMN) as $type) {
        $donnees[] = $type;
    }

    return $donnees;
}


/*$$$$$$ gérer clients $$$$$$*/
function getAllClients() {
    $bdd = dbConnect();

    //Récupérer la liste des catégories d articles
    $query = 'SELECT email FROM client';
    $request = $bdd->prepare($query);//Préparation de la requête
    if (!$request->execute()) {
        throw new Exception("Base De Données : Echec d'exécution");
    }

    $mailClients = $request->fetchAll(PDO::FETCH_ASSOC);
    $request->closeCursor();
    $emails = array();
    foreach ($mailClients as $mail) {
        array_push($emails, $mail['email']);
    }

    return $emails;
}


function getClient($email) {
    $bdd = dbConnect();

    $query = 'SELECT *
                FROM client 
                WHERE email = :mail';
    $table = array('mail' => $email);

    $request = $bdd->prepare($query);
    if (!$request->execute($table)) {
        throw new Exception("Base De Données : Echec d'exécution");
    }
    $donneesClient = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();

    return $donneesClient;
}


function createNewClient($data) {
    $bdd = dbConnect();

    $query = 'INSERT INTO client(nom, prenom, ad_livraison, tel, email, genre, password) 
                    VALUES(:nom, :prenom, :adresse, :tel, :email, :civil, :password)';
    
    $table = array('nom' => $data['nom'],
                    'prenom' => $data['prenom'], 
                    'adresse'=> $data['adresse'],
                    'tel' => $data['tel'],
                    'email' => $data['email'],
                    'civil' => $data['civil'],
                    'password' => $data['hash_password']);

    $request = $bdd->prepare($query);
    if (!$request->execute($table)) {
        throw new Exception("Base De Données : Echec d'exécution");
    }
}


/*$$$$$$ gérer commandes $$$$$$*/
function getCommandes($refClient) {
    $bdd = dbConnect();

    //récupère infos de toutes les commandes regroupées par commandes
    $query = 'SELECT num_commande as refCommande, ad_livraison, SUM(qte_achetee) as qteTotale
            FROM commande
            WHERE id_client = :client AND est_provisoire = 0
            GROUP BY num_commande ORDER BY num_commande';
    $request = $bdd->prepare($query);

    if (!$request->execute(array('client' => $refClient))) {
        throw new Exception("Base De Données : Echec d'exécution");
    }

    foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $dataCommande) {
        $commande['refCommande'] = $ref = $dataCommande['refCommande'];
        $commande['livraison'] = $dataCommande['ad_livraison'];
        $commande['qteTotale'] = $dataCommande['qteTotale'];


        $query = 'SELECT p.id as refProduit, p.nom, p.prix, c.qte_achetee, c.qte_achetee * p.prix as cout
            FROM commande c INNER JOIN produit p ON c.id_produit = p.id
            WHERE c.num_commande = :ref';
        $request = $bdd->prepare($query);

        if (!$request->execute(array('ref' => $ref))) {
            throw new Exception("Base De Données : Echec d'exécution");
        }
        $commande['contenu'] = $request->fetchAll(PDO::FETCH_ASSOC);


        $commande['coutTotal'] = array_sum(array_column($commande['contenu'], 'cout'));
        $listCommandes[$ref] = $commande;
    }

    return isset($listCommandes)? $listCommandes : false;
}


function getCommandeAttente($refClient) {
    $bdd = dbConnect();

    //récupère référence de commande en attente et nombre de produits associés
    $query = 'SELECT COUNT(id_produit) AS nbr, num_commande
            FROM commande 
            WHERE id_client = :client AND est_provisoire = 1
            GROUP BY num_commande';
    $request = $bdd->prepare($query);

    if (!$request->execute(array('client' => $refClient))) {
        throw new Exception("Base De Données : Echec d'exécution");
    }
    $data = $request->fetchAll(PDO::FETCH_ASSOC)[0];
    $nbArticles = $data['nbr'];
    $refCommande = $data['num_commande'];


    //s'il n'y a aucun article enregistré : fini. sinon implicite
    if ($nbArticles === 0) {
        return false;
    }
    

    //récupère liste des articles et quantité associée
    $query = 'SELECT id_produit, qte_achetee 
            FROM commande 
            WHERE num_commande = :refCommande';
    $request = $bdd->prepare($query);

    if (!$request->execute(array('refCommande' => $refCommande))) {
        throw new Exception("Base De Données : Echec d'exécution");
    }
    $data = $request->fetchAll(PDO::FETCH_ASSOC);


    //récupère l'ensemble des données de chaque article de la liste et reforme l'arborescence du panier
    foreach ($data as $article) {
        $dataArticle = getProduit($article['id_produit']);
        $oldPanier[$dataArticle['nom']] = array('id_produit'    => $article['id_produit'],
                                                'produit'       => $dataArticle['nom'],
                                                'prix'          => $dataArticle['prix'],
                                                'quantite'      => $article['qte_achetee'],
                                                'quant_dispo'   => $dataArticle['quantite_dispo'],
                                                'total'   => $dataArticle['prix'] * $article['qte_achetee']);
    }


    //libère la référence de commande récupérée
    $query = 'DELETE FROM commande
            WHERE num_commande = :refCommande';
    $request = $bdd->prepare($query);
    if (!$request->execute(array('refCommande' => $refCommande))) {
        throw new Exception("Base De Données : Echec d'exécution");
    }

    
    //retourne le nouveau panier et la référence libérée
    return array('refVide' => $refCommande, 'panier' => $oldPanier);
}


function setCommande($estProvisoire) {
    if (empty($_SESSION['panier'])) {
        throw new Exeption("Enregistrement de la commande : Panier vide");
    }
    if (empty($_SESSION['client'])) {
        throw new Exeption("Enregistrement de la commande : Client déconnecté");
    }
    $bdd = dbConnect();


    //determine numero commande
    if (!empty($_SESSION['client']['refCommandeFree'])) {
        $refCommande = $_SESSION['client']['refCommandeFree'];
    }
    else {
        $query = 'SELECT MAX(num_commande) as nbCommandes
                    FROM commande';
        $request = $bdd->prepare($query);
        if (!$request->execute()) {
            throw new Exception("Base De Données : Echec d'exécution");
        }

        $refCommande = $request->fetch(PDO::FETCH_ASSOC)['nbCommandes'] + 1;
        $request->closeCursor();
    }


    //pour chaque article dans le panier
    foreach ($_SESSION['panier'] as $article) {
        //enregistre la commande
        $query = 'INSERT INTO commande(num_commande, id_client, id_produit, qte_achetee, ad_livraison, est_provisoire) 
                    VALUES(:commande, :client, :produit, :quantite, :adresse, :provisoire)';
        $table = array('commande' => $refCommande, 'provisoire' => ($estProvisoire === TRUE)? 1 : 0,
                        'produit' => $article['id_produit'], 'quantite' => $article['quantite'], 
                        'client' => $_SESSION['client']['id'], 'adresse' => $_SESSION['client']['ad_livraison']);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) {
            throw new Exception("Base De Données : Echec d'exécution");
        }

        //actualise nombre d'articles dans la base de données
        $query = 'UPDATE produit
                    SET quantite = :quantite
                    WHERE id = :id_produit';
        $table = array('quantite' => ($article['quant_dispo'] - $article['quantite']), 
                        'id_produit' => $article['id_produit']);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) {
            throw new Exception("Base De Données : Echec d'exécution");
        }
    }
}


/*$$$$$$ gérer articles $$$$$$*/
function getNbArticles() {
    $bdd = dbConnect();

    //Récupérer la liste des catégories d articles
    $query = 'SELECT COUNT(*)
                FROM produit';
    $request = $bdd->prepare($query);//Préparation de la requête
    if (!$request->execute()) {
        throw new Exception("Base De Données : Echec d'exécution");
    }

    $nombreArticles = $request->fetch(PDO::FETCH_NUM)[0];//équivaut à $nombreArticles[0];
    $request->closeCursor();

    return $nombreArticles;
}


function getProduit($id_produit) {
    $bdd = dbConnect();

    //Récupérer les infos d'un article specifique
    $query = 'SELECT nom, prix, quantite as quantite_dispo
                FROM produit
                WHERE id = :id_produit';
    $table = array('id_produit' => $id_produit);
    $request = $bdd->prepare($query);

    if (!$request->execute($table)) {
        throw new Exception("Base De Données : Echec d'exécution");
    }
    $table = $request->fetch(PDO::FETCH_ASSOC);
    $request->closeCursor();
    $table['id'] = $id_produit;
    
    return $table;
}


function getBoutique($typesProduit) {
    $bdd = dbConnect();

    //Récupérer les infos de chaque article dans chaque categorie
    foreach ($typesProduit as $type) {
        $query = 'SELECT *
                    FROM produit
                    WHERE type = :type
                    ORDER BY nom';
        $table = array('type' => $type);
        $request = $bdd->prepare($query);
        if (!$request->execute($table)) {
            throw new Exception("Base De Données : Echec d'exécution");
        }

        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $dataProduit) {
            $donnees[$type][] = $dataProduit;
        }
    }
    
    return $donnees;

    /*//code de debugage : affichage du contenu d un tableau
    echo '<pre style="text-alig: left;">';
    print_r($donnees);
    echo '</pre>';*/
}


/*$$$$$$ autre - recherche $$$$$$*/
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
    if (!$request->execute($table)) {
        throw new Exception("Base De Données : Echec d'exécution");
    }
    $select_recherche = $request->fetchAll(PDO::FETCH_ASSOC);
    
    return $select_recherche;
}
