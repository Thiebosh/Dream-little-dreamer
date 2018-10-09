<?php
$nomPage = 'profil';


ob_start(); ?>
    <section id="pageProfil">
        <h2 class="title1">VOTRE COMPTE</h2>
        <h3 class="title2">Vos informations personnelles</h3><br>
        <article>
            <img src="Vue/images/avatar.jpg" alt ="votre avatar"/>
            <div>
                <span>NOM : <em>nom_client</em></span>
                <span>PRÉNOM : <em>prénom_client</em></span>
            </div>
            <div>SEXE : <em>sexe_client</em></div>
            <div>NUMÉRO DE TÉLÉPHONE : <em>tel_client</em></div>
            <div>E-MAIL : <em>mail_client</em></div>
        </article>
        <br><br>
        <a class="button1" href="routeur.php?action=connexion">Déconnexion</a>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
