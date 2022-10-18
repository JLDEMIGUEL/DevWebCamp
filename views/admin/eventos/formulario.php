<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Eventos</legend>
    

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Evento</label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Evento" value="<?php echo $evento->nombre ?? '';?>">
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripcion Evento</label>
        <textarea  rows="8" class="formulario__input formulario__input--textarea" id="descripcion" name="descripcion" placeholder="Descripcion Evento" value="<?php echo $evento->descripcion ?? '';?>"></textarea>
    </div>

    <div class="formulario__campo">
        <label for="categorias" class="formulario__label">Categorias</label>
        <select class="formulario__select" id="categoria" name="categoria_id">
            <option value="" disabled selected>-- Seleccionar --</option>
            <?php foreach($categoria as $categoria){?>
                <option <?php echo ($evento->categoria_id === $categoria->id) ? 'selected' : '';?> value="<?php echo $categoria->id?>"><?php echo $categoria->nombre?></option>
            <?php }?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="dias" class="formulario__label">Seleccione el día</label>

        <div class="formulario__radio">
            <?php foreach($dias as $dia){?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre)?>"><?php echo $dia->nombre;?></label>
                    <input type="radio" id="<?php echo strtolower($dia->nombre)?>" name="dia" value="<?php echo $dia->id;?>">

                </div>
            <?php }?>   
            
        </div>
        <input type="hidden" name="dia_id" value="">
    </div>


    <div id="horas" class="formulario__campo">
        <label class="formulario__label">Seleccionar Hora</label>

        <ul id="horas" class="horas">
            <?php foreach($horas as $hora){?>
                <li data-hora-id="<?php echo $hora->id?>" class="horas__hora horas__hora--deshabilitada"><?php echo $hora->hora?></li>
            <?php }?>
        </ul>
        <input type="hidden" name="hora_id" value="">
    </div>

</fieldset>


<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información extra</legend>

    <div class="formulario__campo">
        <label for="ponentes" class="formulario__label">Ponentes</label>
        <input type="text" class="formulario__input" id="ponentes" placeholder="Buscar ponentes">
        <ul id="listado-ponentes" class="listado-ponentes"></ul>
        <input type="hidden" name="ponente_id" value="">
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Lugares disponibles</label>
        <input type="number" class="formulario__input" value="<?php echo $evento->disponibles;?>" min="1" id="disponibles" name="disponibles" placeholder="Ejemplo: 20">
    </div>
</fieldset>