<?php
if (empty($variablePage['postProduit']['ref']) || 
    !empty($variablePage['postProduit']['ref']) && ($variablePage['postProduit']['ref'] < 1 || $variablePage['postProduit']['ref'] > getNbArticles())) {
    $variablePage['errMsg'] = true;
}
else $variablePage['produit'] = getProduit($variablePage['postProduit']['ref']);
