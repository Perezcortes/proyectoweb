document.getElementById("liveToastBtn").addEventListener("click", function () {
    // Obtener los valores del formulario
    var email = document.getElementById("Email").value;
    var nombre = document.getElementById("Nombre").value;
    var fecha = document.getElementById("datepicker").value;
    var horaSeleccionada = document.getElementById('Hora').value;

    // Verificar que se haya seleccionado una hora
    if (!horaSeleccionada) {
        alert("Por favor, selecciona una hora para tu cita.");
        return;
    }

    var hora = horaSeleccionada.value;

    // Crear un objeto con los datos del formulario
    var formData = new FormData();
    formData.append("email", email);
    formData.append("nombre", nombre);
    formData.append("fecha", fecha);
    formData.append("hora", hora);

    // Enviar datos a PHP usando AJAX
    fetch("../controllers/PercingController.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("¡Cita registrada exitosamente!");
            document.querySelector("form").reset(); // Limpiar el formulario
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));

});
flatpickr("#datepicker", {
    dateFormat: "Y-m-d",
    defaultDate: "today",
    locale: "es", // Configuración de idioma español
    disableMobile: true
});

const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  toastTrigger.addEventListener('click', () => {
    toastBootstrap.show()
  })
}


document.querySelector("form").addEventListener("submit", function (e) {
    let hora = document.getElementById("hora-cita").value;
    
    if (!hora) {
        alert("Por favor, selecciona una hora para tu cita.");
        e.preventDefault(); // Evita que el formulario se envíe
    } else {
        console.log("Hora seleccionada: " + hora);
    }
});