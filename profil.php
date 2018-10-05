<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="styleSheets/normalize.css" rel="stylesheet"/>
	<link href="styleSheets/global.css" rel="stylesheet"/>
	<link href="styleSheets/menu.css" rel="stylesheet"/>
    <link href="styleSheets/profil.css" rel="stylesheet"/>
	<title>Dream little dreamer</title>
</head>

<body>
    <?php require("header.php"); ?>

    <section>
        <h2 class="title1">VOTRE COMPTE</h2>
        <h3 class="title2">Vos informations personnelles</h3><br>
        <article>
            <img src="images/avatar.jpg" alt ="votre avatar"/>
            <div>
                <span>NOM : <em>nom_client</em></span>
                <span>PRÉNOM : <em>prénom_client</em></span>
            </div>
            <div>SEXE : <em>sexe_client</em></div>
            <div>DATE DE NAISSANCE : <em>date_client</em></div>
            <div>E-MAIL : <em>mail_client</em></div>
        </article>
        <br><br>
        <a class="button" href="connexion.php">Déconnexion</a>
    </section>

<?php require("footer.php"); ?>
</body>
</html>