<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="styleSheets/normalize.css" rel="stylesheet"/>
    <link href="styleSheets/global.css" rel="stylesheet"/>
    <link href="styleSheets/menu.css" rel="stylesheet"/>
    <link href="styleSheets/valid_confirm.css" rel="stylesheet"/>
	<title>Dream little dreamer - Confirmation</title>
</head>

<body>
    <?php
        require("commonPages/header.php");
        require("commonPages/menu.php");
    ?>

   <section>
       	<h2 class="title1">FÉLICITATIONS</h2>
		<h3 class="title2" >Votre commande a bien été prise en compte</h3>
        <article>
            <img src="images/confirm.jpg" alt="confimation">
            <a class="button1" href="accueil.php">Retour à l'accueil</a>
        </article>
	</section>

    <?php require("commonPages/footer.php"); ?>
</body>
</html>