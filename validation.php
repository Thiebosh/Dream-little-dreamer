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
	<title>Dream little dreamer - Validation</title>
</head>

<body>
    <?php
        require("commonPages/header.php");
        require("commonPages/menu.php");
    ?>

   <section>
       	<h2 class="title1" >VOUS Y ÊTES PRESQUE !</h2>
		<h3 class="title2" >Souhaitez-vous confirmer la commande ?</h3>
        <article>
            <img src="images/valid.jpg" alt="validation">
            <form method="post" action="confirmation.php"> 
                <a class="button1" href="panier.php">Retour</a>
                <input class="button1" type="submit" value="Confirmer"/>
            </form>
        </article>
    </section>
    
    <?php require("commonPages/footer.php"); ?>
</body>
</html>