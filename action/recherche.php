<?php
if (!empty($variablePage['postSearch']['search'])) {
    $variablePage['recherche'] = $variablePage['postSearch']['search'];
    $variablePage['resultat'] = getRecherche($variablePage['recherche']);
}