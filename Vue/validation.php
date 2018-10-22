<?php
ob_start(); ?>
    <section id="pageValidConfirm">
        <h2 class="title1" >VOUS Y ÊTES PRESQUE !</h2>
        <h3 class="title2" >Souhaitez-vous confirmer la commande ?</h3>
        <article>
            <img src="Vue/images/valid.jpg" alt="Visuel validation">
            <span>
                <a class="button1" href="index.php?action=panier">Retour</a>
                <?php if (!empty($_SESSION['client'])) echo '<a class="button1" href="index.php?action=confirmation">Confirmer</a>';
                else echo '<a class="button1" href="index.php?action=connexion">Se connecter</a>' ?>
            </span>
        </article>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
