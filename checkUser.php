<?php

function inscription($postSecure) {
    if (in_array($postSecure['email'], getAllClients())) {
        $variablePage['errMsgs'][] = $errMsg['construction']['inscription']['mail'];
    }
    if ($postSecure['password1'] != $postSecure['password2']) {
        $variablePage['errMsgs'][] = $errMsg['construction']['inscription']['password'];
    }
    
    if (empty($variablePage['errMsgs'])) {
        $postSecure['hash_password'] = sha1($postSecure['password1']);
        createNewClient($postSecure);
    }
}


function connexion($postSecure) {
    $donneesClient = getClient($postSecure['email']); //pour avoir infos du client par rapport à son email

    //if (!password_verify($variablePage['post']['pass'], $donneesClient['password'])) {//(hash premier mdp et le compare au second, déjà hashé) vérifie le résultat : ne stocke jamais mdp en clair en bdd
    if (sha1($postSecure['pass']) == $donneesClient['password']) {
        $_SESSION['client'] = $donneesClient;
        $tmp = getCommandeAttente($_SESSION['client']['id']);
        if (!empty($tmp)) {//récupération du panier provisoire, s'il existe
            $_SESSION['panier'] = $tmp['panier'];
            $_SESSION['client']['refCommandeFree'] = $tmp['refVide'];
        }

        header('Location: index.php?page=panier');//ou accueil ou profil ou boutique
        exit();
    }
}


function deconnexion() {
    if (!empty($_SESSION['panier'])) {//enregistrement du panier en provisoire, s'il existe
        setCommande(true);
    }

    session_destroy();//suppression des variables globales
    header('Location: index.php?page=accueil');//ou connexion
    exit();
}

