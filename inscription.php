<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="normalize.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
    <title>Inscription</title>
</head>
<body>
    <h1>CRÉER VOTRE COMPTE</h1>
    <h2>Déjà un compte ? <a href="connexion.php">Connectez-vous</a></h2>
    <fieldset>
        <form  method="post" action="connexion.php">
            <p> 
                <input class="genre" type="radio" name="civi2" value="M" checked="checked"/> M
                <input class="genre" type="radio" name="civi2" value="Mme"/> MME
                <br>
                <table>
                    <tr>
                        <th>
                            <label for="nom">NOM</label>
                        </th>
                        <th>
                            <label for="prenom">PRÉNOM</label>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="nom" id="nom" placeholder="NOM" required />
                        </td>
                        <td>
                            <input type="text" name="prenom" id="prenom" placeholder="PRÉNOM" required/>
                        </td>
                    </tr>
                </table>
                <br>
                <!--date de naissance-->
                <label for="date">DATE DE NAISSANCE</label><br>
                <input type="date" name="date" id="date">
                <br><br>
                <!--e-mail-->
                <label for="email">E-MAIL</label><br>
                <input type="email" name="email" id="email" placeholder="EMAIL@EXEMPLE.COM" required>
                <br><br>
                <!--mot de passe-->
                <label for="password1">MOT DE PASSE</label><br>
                <input type="password" name="password1" id="password1" placeholder="MOT DE PASSE" required />
                <br><br>
                <!--vérification du mot de passe-->
                <label for="password2">CONFIRMER VOTRE MOT DE PASSE</label><br>
                <input type="password" name="password2" id="password2" placeholder="MOT DE PASSE" required /> 
            </p>
            <br><input class="bouton" type="submit" value="Sauvegarder">
        </form>
    </fieldset>    
</body>

</html>