<?php
$nomPage = 'confirmation';


ob_start(); ?>
    <section id="pageValidConfirm">
        <h2 class="title1">FÉLICITATIONS</h2>
        <h3 class="title2" >Votre commande a bien été prise en compte</h3>
        <article>
            <img src="Vue/images/confirm.jpg" alt="Visuel confirmation">
            <a class="button1" href="routeur.php?action=accueil">Retour à l'accueil</a>
        </article>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
