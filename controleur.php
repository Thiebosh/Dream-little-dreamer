<?php

function initProduit($id_produit) {
    $produit = getInitProduit($id_produit);
    $boutique = getDataMenu();
    require('Vue/produit.php');
}

function initBoutique() {
    $boutique = getInitBoutique();
    require('Vue/boutique.php');
}

function initRecherche($recherche) {
	$tab_recherche = getInitRecherche($recherche);
	require('Vue/recherche.php');
}