<?php
if (isset($variablePage['postPanier'])) $postSecure = $variablePage['postPanier'];

//Vider le panier de commande
if (!empty($postSecure['supprimePanier'])) {
    $_SESSION['panier'] = array();
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
        
        $_SESSION['panier'][$postSecure['article']]['total'] = $postSecure['prix'] * $_SESSION['panier'][$postSecure['article']]['quantite'];
    }

    //Supprimer un article du panier
    else if (!empty($postSecure['supprimeArticle'])) unset($_SESSION['panier'][$postSecure['supprimeArticle']]);

    //Calcul du prix total et de la quantité totale d'articles
    if (!empty($_SESSION['panier'])) {
        $variablePage['coutTotal']      = array_sum(array_column($_SESSION['panier'], 'total'));
        $variablePage['quantiteTotale'] = array_sum(array_column($_SESSION['panier'], 'quantite'));
    }
}
