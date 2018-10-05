<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="styleSheets/normalize.css" rel="stylesheet"/>
    <link href="styleSheets/global.css" rel="stylesheet"/>
    <link href="styleSheets/menu.css" rel="stylesheet"/>
    <link href="styleSheets/inscription_connexion.css" rel="stylesheet"/>
	<title>Dream little dreamer</title>
</head>

<body>
    <?php require("header.php"); ?>

    <section>
        <h2 class="title1">CRÉER VOTRE COMPTE</h2>
        <h3 class="title2">Déjà un compte ? <a href="connexion.php">Connectez-vous</a></h3>

        <article>
            <form  method="post" action="profil.php">
                <div class="contenu"> 
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
                                <input  class="form_input" id="nom" type="text" name="nom"       placeholder="NOM" required />
                            </td>
                            <td>
                                <input  class="form_input" id="prenom" type="text" name="prenom"    placeholder="PRÉNOM" required />
                            </td>
                        </tr>
                    </table>
                    <br>
                    <!--date de naissance-->
                    <label  for="date">DATE DE NAISSANCE</label><br>
                    <input  class="form_input" id="date" type="date"      name="date">
                    <br><br>
                    <!--e-mail-->
                    <label  for="email">E-MAIL</label><br>
                    <input  class="form_input" id="email" type="email"     name="email"        placeholder="EMAIL@EXEMPLE.COM" required />
                    <br><br>
                    <!--adresse-->
                    <label  for="adresse">ADRESSE</label><br>
                    <input  class="form_input" id="adresse" type="text"     name="adresse"        placeholder="ADRESSE" required />
                    <br><br>
                    <!--mot de passe-->
                    <label for="password1">MOT DE PASSE</label><br>
                    <input  class="form_input"  id="password1" type="password"  name="password1"    placeholder="MOT DE PASSE" required />
                    <br><br>
                    <!--vérification du mot de passe-->
                    <label for="password2">CONFIRMEZ VOTRE MOT DE PASSE</label><br>
                    <input  class="form_input" id="password2" type="password"  name="password2"    placeholder="MOT DE PASSE" required /> 
                </div>
                <br><input class="bouton" type="submit" value="Sauvegarder">
            </form>
        </article>    
    </section>

<?php require("footer.php"); ?>
</body>
</html>