<?php
$nomPage = 'accueil';


ob_start(); ?>
    <section id="pageAccueil">
        <h2> Notre nouvelle boutique <em>Dream Little dreamer</em> vient d'ouvrir !</h2>
        <p> Sur ce site, vous pourrez trouver tous les objets de décoration qui vous permettront de créer votre propre univers...</p>
        
        <article class="slider-holder">
            <span id="slider-image-1"></span>
            <span id="slider-image-2"></span>
            <span id="slider-image-3"></span>
            <div class="image-holder">
                <img class="slider-image" src="Vue/images/deco.jpg" alt="deco1"/>
                <img class="slider-image" src="Vue/images/lit.jpg"  alt="deco2"/>
                <img class="slider-image" src="Vue/images/room.jpg" alt="deco3"/>
            </div>
            <div class="button-holder">
                <a href="#slider-image-1" class="slider-change"></a>
                <a href="#slider-image-2" class="slider-change"></a>
                <a href="#slider-image-3" class="slider-change"></a>
            </div>
        </article>
    </section>
<?php $sessionPage = ob_get_clean();

require("template.php");
