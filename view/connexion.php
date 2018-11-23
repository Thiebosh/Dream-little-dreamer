<?php ob_start(); ?>
    <section id="pageInscriptionConnexion">
        <h2 class="title1">CONNECTEZ-VOUS À VOTRE COMPTE</h2>
        <h3 class="title2">Pas de compte ? <a href="index.php?page=inscription">Créez-en un</a></h3>

        
        <?php if (isset($variablePage['errMsgs'])) {
            echo '<aside class="errMsg">';
            foreach ($variablePage['errMsgs'] as $msg) {
                echo $msg . '<br>';
            }
            echo '</aside>';
        } ?>
        <form method="post" action="index.php?action=connexion">
            <p> 
                <label  for="email">E-MAIL</label><br>
                <input class="form_input" id="email" type="email"      name="email"    placeholder="EMAIL@EXEMPLE.COM"  required>
                <br><br>
                <label  for="pass">MOT DE PASSE</label><br>
                <input  class="form_input" id ="pass" type="password"  name="pass"     placeholder="MOT DE PASSE"       required>
            </p>
            <br><br>
            <input class ="button2" type="submit" value="Se connecter"/>
        </form>
    </section>
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");

