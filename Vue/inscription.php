<?php
$nomPage = 'inscription';


ob_start(); ?>
    <section id="pageInscriptionConnexion">
        <h2 class="title1">CRÉER VOTRE COMPTE</h2>
        <h3 class="title2">Déjà un compte ? <a href="routeur.php?action=connexion">Connectez-vous</a></h3>

        <form  method="post" action="routeur.php?action=profil"><!--profil ou connexion?-->
            <p> 
                <label><input type="radio" name="civi2" value="M" checked="checked"/> M</label>
                &nbsp;&nbsp;
                <label><input type="radio" name="civi2" value="Mme"/> MME</label>
                <br><br>
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
                <br><br>
                <!--numero de telephone-->
                <label  for="tel">NUMERO DE TÉLÉPHONE</label><br>
                <input  class="form_input" id="tel" type="tel"      name="tel"      placeholder="NUMERO DE TÉLÉPHONE">
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
            </p>
            <br><br>
            <input class="button2" type="submit" value="Sauvegarder">
        </form>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
