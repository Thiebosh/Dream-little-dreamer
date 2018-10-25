<?php
if (empty($variablePage['postProduit']['ref'])) $variablePage['errMsg'] = true;
else $variablePage['produit'] = getProduit($variablePage['postProduit']['ref']);
