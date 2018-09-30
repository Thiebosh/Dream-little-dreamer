<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
    <title>Connexion</title>
</head>

<body>
    <h1>CONNECTEZ-VOUS À VOTRE COMPTE</h1>
    <h2>Pas de compte ? <a href="inscription.php">Créez-en un</a></h2>
    <fieldset>
		<!--mise en forme du nom et mot de passe-->
		<form method="post" action="action.php">
            <p> 
                <label for="email">E-MAIL</label><br>
                <input type="email" name="email" id="email" placeholder="EMAIL@EXEMPLE.COM" required>
                <br><br><!--saut de ligne-->
                <label for="pass">MOT DE PASSE</label><br>
                <input type="password" name="pass" id="pass" placeholder="MOT DE PASSE" required>
            </p>
            <input class ="bouton" type="submit" value="Se connecter"/>
        </form>
    </fieldset>
</body>
</html>