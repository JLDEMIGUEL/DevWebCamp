<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo?></h2>
    <p class="devwebcamp__descripcion">Conoce la conferencia más importante de España</p>


    <div class="devwebcamp__grid">
        <div  <?php aos_animacion()?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg" alt="image/jpg">
            </picture>
        </div>

        <div  <?php aos_animacion()?> class="devwebcamp__contenido">
            <p class="devwebcamp__texto">
            Nulla at semper odio. Nam tincidunt ex vel egestas vehicula. Nunc id ornare augue, at vestibulum massa. Aliquam et fringilla metus. Integer nec leo fringilla, iaculis leo non, iaculis lorem. Donec leo nisi, sagittis ultrices molestie vitae, dictum facilisis erat. Mauris metus ante, mattis non dictum id
            </p>
            <p class="devwebcamp__texto">
            Nulla at semper odio. Nam tincidunt ex vel egestas vehicula. Nunc id ornare augue, at vestibulum massa. Aliquam et fringilla metus. Integer nec leo fringilla, iaculis leo non, iaculis lorem. Donec leo nisi, sagittis ultrices molestie vitae, dictum facilisis erat. Mauris metus ante, mattis non dictum id
            </p>
        </div>

    </div>
</main>