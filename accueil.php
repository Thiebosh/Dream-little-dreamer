<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="styleSheets/normalize.css" rel="stylesheet"/>
    <link href="styleSheets/accueil.css" rel="stylesheet"/>
    <link href="styleSheets/header.css" rel="stylesheet"/><!--remodifie juste le style du header-->
    <link href="styleSheets/footer.css" rel="stylesheet"/>
    <title>Dream little dreamer</title>
</head>

<body>
    <?php require("header.php"); ?>

    <section>
        <h2> Votre nouvelle boutique Dream Little dreamer vient d'ouvrir !</h2><!--h1 réservé aux titres de site par convention-->
        <p> Sur ce site vous pourrez trouver tous les objets de décoration qui vous permettront de créer votre propre univers.</p>
        
        <article class="slider-holder">
            <span id="slider-image-1"></span>
            <span id="slider-image-2"></span>
            <span id="slider-image-3"></span>
            <div class="image-holder">
                <img src="images/deco.jpg" class="slider-image" />
                <img src="images/lit.jpg" class="slider-image" />
                <img src="images/room.jpg" class="slider-image" />
            </div>
            <div class="button-holder">
                <a href="#slider-image-1" class="slider-change"></a>
                <a href="#slider-image-2" class="slider-change"></a>
                <a href="#slider-image-3" class="slider-change"></a>
            </div>
        </article>
    </section>

    <?php require("footer.php"); ?>
</body>
</html>