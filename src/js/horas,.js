(function(){
    const horas = document.querySelector('#horas')
    let busqueda = {
        categoria_id : '',
        dia : ''
    }
    if(horas){


        const categoria = document.querySelector('[name="categoria_id"]')
        const dias = document.querySelectorAll('[name="dia"]')
        const inputHiddenDia = document.querySelector('[name="dia_id"]')
        const inputHiddenHora = document.querySelector('[name="hora_id"]')

        categoria.addEventListener('change', terminoBusqueda)
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda))

        function terminoBusqueda(e){
            inputHiddenDia.value = e.target.value
            busqueda[e.target.name]=e.target.value
    
            if(Object.values(busqueda).includes('')){
                return;
            }
    
            buscarEventos();
        }
    }



    async function buscarEventos(){
        const {dia, categoria_id} = busqueda
        const url = `/api/eventos-horario?categoria_id=${categoria_id}&dia_id=${dia}`
        const resultado = await fetch(url)
        const eventos = await resultado.json()

        obtenerHorasDisponibles();
    }

    function obtenerHorasDisponibles(){
        console.log('obtener')
        const horasDisponibles = document.querySelectorAll('#horas li')

        horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora))
    }

    function seleccionarHora(e){

        //Deshabilitar hora anterior
        const horaPrevia = document.querySelector('.horas__hora--seleccionada')

        if(horaPrevia){
            horaPrevia.classList.remove('horas__hora--seleccionada')
        }

        console.log('hora')
        e.target.classList.add('horas__hora--seleccionada')
        inputHiddenHora =  e.target.dataset.horaId
    }
})();