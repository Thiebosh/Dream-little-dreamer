<?php ob_start(); ?>
    <section id="pageProfil">
        <h2 class="title1">VOTRE COMPTE</h2>
        <h3 class="title2">Vos informations personnelles</h3><br>
        <article>
            <img src="view/images/avatar.jpg" alt="Avatar"/>
            <div>
                <span>NOM :             <?= $_SESSION['client']['nom'] ?></span>
                <span>PRÉNOM :          <?= $_SESSION['client']['prenom'] ?></span>
            </div>
            <div>SEXE :                 <?= ($_SESSION['client']['genre'])? 'Féminin' : 'Masculin' ?></div>
            <div>NUMÉRO DE TÉLÉPHONE :  <?= $_SESSION['client']['tel'] ?></div>
            <div>E-MAIL :               <?= $_SESSION['client']['email'] ?></div>
        </article>
        <br><br>
        <a class="button1" href="index.php?action=deconnexion">Déconnexion</a>
    </section>
<?php $variablePage['contenuSection'] = ob_get_clean();

require("template.php");

