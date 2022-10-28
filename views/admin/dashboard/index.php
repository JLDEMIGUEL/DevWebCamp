<h2 class="dashboard__heading"><?php echo $titulo?></h2 class="dashboard__heading">

<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos Registros</h3>

            <?php foreach($registros as $registro){?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido?>
                    </p>
                </div>
            <?php }?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Ingresos</h3>
            <p class="bloque__texto--cantidad"><?php echo $ingresos?> €</p>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Menos lugares disponibles</h3>

            <?php foreach($menos_lugares as $lugar){?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo $lugar->nombre . " - Disponibles " . $lugar->disponibles?>
                    </p>
                </div>
            <?php }?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Más lugares disponibles</h3>

            <?php foreach($mas_lugares as $lugar){?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo $lugar->nombre . " - Disponibles " . $lugar->disponibles?>
                    </p>
                </div>
            <?php }?>
        </div>
    </div>
</main>