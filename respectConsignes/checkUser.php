<?php
function inscription() {
    
    //si infos valide : inscrit client et redirige sur page de connexion 
        // /!\ hasher mdp si toutes les var du post sont correctes
        //password_hash($passwordToHash, PASSWORD_DEFAULT);//selectionne par défaut meilleure fonction de hashage
    //sinon : affiche erreur appropriée
}

function connexion($postSecure) {
    $donneesClient = getClient($postSecure['email']); //pour avoir infos du client par rapport à son email

    //if (!password_verify($variablePage['post']['pass'], $donneesClient['password'])) {//(hash premier mdp et le compare au second, déjà hashé) vérifie le résultat : ne stocke jamais mdp en clair en bdd
    if ($postSecure['pass'] != $donneesClient['password']) return false; //message erreur
    else {
        $_SESSION['client'] = $donneesClient;
        if (!empty($tmp = getCommandeAttente())) {//récupération du panier provisoire, s'il existe
            $_SESSION['panier'] = $tmp['panier'];
            $_SESSION['client']['refCommande'] = $tmp['refVide'];
        }

        header('Location: index.php?page=panier');//ou accueil ou profil ou boutique
        exit();
    }
}

function deconnexion() {
    //if (!empty($_SESSION['panier'])) setCommande(true);//enregistrement du panier en provisoire, s'il existe

    session_destroy();//suppression des variables globales
    header('Location: index.php?page=accueil');//ou connexion
    exit();
}