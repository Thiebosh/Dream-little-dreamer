<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="styleSheets/normalize.css" rel="stylesheet"/>
    <link href="styleSheets/inscription_connexion.css" rel="stylesheet"/>
    <link href="styleSheets/header.css" rel="stylesheet"/>
    <link href="styleSheets/footer.css" rel="stylesheet"/>
    <title>Connexion</title>
</head>

<body>
    <?php require("header.php"); ?>

    <section>
        <h2 class="title1">CONNECTEZ-VOUS À VOTRE COMPTE</h2>
        <h3 class="title2">Pas de compte ? <a href="inscription.php">Créez-en un</a></h3>
        <article>
            <!--mise en forme du nom et mot de passe-->
            <form method="post" action="profil.php">
                <p class="contenu"> 
                    <label  for="email">E-MAIL</label><br>
                    <input class="form_input" id="email" type="email"      name="email"    placeholder="EMAIL@EXEMPLE.COM" required>
                    <br><br><!--saut de ligne-->
                    <label  for="pass">MOT DE PASSE</label><br>
                    <input  class="form_input" id ="pass" type="password"  name="pass"     placeholder="MOT DE PASSE" required>
                </p>
                <input class ="bouton" type="submit" value="Se connecter"/>
            </form>
        </article>
    </section>
    
    <?php require("footer.php"); ?>
</body>
</html>