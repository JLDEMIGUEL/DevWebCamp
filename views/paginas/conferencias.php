<main class="agenda">
    <h2 class="agenda__heading">Workshops & Conferencias</h2>
    <p class="agenda__descripcion">Talleres y Conferencias por expertos en el Desarrollo Web</p>

    <div class="eventos">
        <h3 class="eventos__heading">&lt;Conferencias/></h3>

        <p class="eventos__fecha">Viernes 5 de Octubre</p>
        <div class="eventos__listado">
            <?php foreach ($eventos['conferencias_v'] as $evento) { ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora ?></p>
                    <div class="evento__informacion">
                        <h4 class="evento__nombre"><?php echo $evento->nombre ?></h4>
                        <p class="evento__introduccion"><?php echo $evento->descripcion ?></p>
                        <div class="evento__autor-info">
                            <picture>
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.webp" type="image/webp">
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" type="image/png">
                                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" alt="Imagen Ponente">
                            </picture>
                            <p class="evento__autor-nombre">
                                <?php echo $evento->ponente->nombre . " " . $evento->ponente->apellido; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <p class="eventos__fecha">Sabado 6 de Octubre</p>
        <div class="eventos__listado">
            <?php foreach ($eventos['conferencias_s'] as $evento) { ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora ?></p>
                    <div class="evento__informacion">
                        <h4 class="evento__nombre"><?php echo $evento->nombre ?></h4>
                        <p class="evento__introduccion"><?php echo $evento->descripcion ?></p>
                        <div class="evento__autor-info">
                            <picture>
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.webp" type="image/webp">
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" type="image/png">
                                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" alt="Imagen Ponente">
                            </picture>
                            <p class="evento__autor-nombre">
                                <?php echo $evento->ponente->nombre . " " . $evento->ponente->apellido; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">&lt;Workshops/></h3>

        <p class="eventos__fecha">Viernes 5 de Octubre</p>
        <div class="eventos__listado">
            <?php foreach ($eventos['workshops_v'] as $evento) { ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora ?></p>
                    <div class="evento__informacion">
                        <h4 class="evento__nombre"><?php echo $evento->nombre ?></h4>
                        <p class="evento__introduccion"><?php echo $evento->descripcion ?></p>
                        <div class="evento__autor-info">
                            <picture>
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.webp" type="image/webp">
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" type="image/png">
                                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" alt="Imagen Ponente">
                            </picture>
                            <p class="evento__autor-nombre">
                                <?php echo $evento->ponente->nombre . " " . $evento->ponente->apellido; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <p class="eventos__fecha">Sabado 6 de Octubre</p>
        <div class="eventos__listado">
            <?php foreach ($eventos['workshops_s'] as $evento) { ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora ?></p>
                    <div class="evento__informacion">
                        <h4 class="evento__nombre"><?php echo $evento->nombre ?></h4>
                        <p class="evento__introduccion"><?php echo $evento->descripcion ?></p>
                        <div class="evento__autor-info">
                            <picture>
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.webp" type="image/webp">
                                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" type="image/png">
                                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="/img/speakers/<?php echo $evento->ponente->imagen; ?>.png" alt="Imagen Ponente">
                            </picture>
                            <p class="evento__autor-nombre">
                                <?php echo $evento->ponente->nombre . " " . $evento->ponente->apellido; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</main>