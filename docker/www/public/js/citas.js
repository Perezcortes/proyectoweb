function updateForm(value) {
    const seccionTatuaje = document.getElementById('seccion_tatuaje');
    const seccionPerforacion = document.getElementById('seccion_perforacion');
    const seccionOtro = document.getElementById('seccion_otro');
    const seccionCotizacion = document.getElementById('seccion_cotizacion');
    const tituloFormulario = document.querySelector('h2');

    // Ocultar todas las secciones
    [seccionTatuaje, seccionPerforacion, seccionOtro, seccionCotizacion].forEach(seccion => {
        seccion.style.display = 'none';
    });

    if (value === 'Tatuaje') {
        seccionTatuaje.style.display = 'block';
        tituloFormulario.innerHTML = 'Agenda tu tatuaje';
    } else if (value === 'Perforacion') {
        seccionPerforacion.style.display = 'block';
        tituloFormulario.innerHTML = 'Agenda tu perforación';
    } else if (value === 'Cotizar') {
        seccionCotizacion.style.display = 'block';
        tituloFormulario.innerHTML = 'Solicitar cotización';
    } else if (value === 'Otro') {
        seccionOtro.style.display = 'block';
        tituloFormulario.innerHTML = 'Solicitar información';
    } else {
        tituloFormulario.innerHTML = '¡Agenda hoy!';
    }
}

// Función para mostrar campo "Otro servicio"
function toggleOtherService(value) {
    const contenedorOtroServicio = document.getElementById('contenedor_otro_servicio');
    contenedorOtroServicio.style.display = value === 'Otro' ? 'block' : 'none';
}