<?php
if (empty($variablePage['postSearch']['search'])) {
    $variablePage['errMsg'] = true;
}
else {
    $variablePage['recherche'] = $variablePage['postSearch']['search'];
    $variablePage['resultat'] = getRecherche($variablePage['recherche']);
}