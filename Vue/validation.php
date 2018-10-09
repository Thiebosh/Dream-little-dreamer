<?php
$nomPage = 'validation';


ob_start(); ?>
    <section id="pageValidConfirm">
        <h2 class="title1" >VOUS Y ÊTES PRESQUE !</h2>
        <h3 class="title2" >Souhaitez-vous confirmer la commande ?</h3>
        <article>
            <img src="Vue/images/valid.jpg" alt="validation">
            <form method="post" action="routeur.php?action=confirmation"> 
                <a class="button1" href="routeur.php?action=panier">Retour</a>
                <input class="button1" type="submit" value="Confirmer"/>
            </form>
        </article>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
