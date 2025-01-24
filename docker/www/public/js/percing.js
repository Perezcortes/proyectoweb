document.getElementById("liveToastBtn").addEventListener("click", function () {
    // Obtener los valores del formulario
    var email = document.getElementById("Email").value;
    var nombre = document.getElementById("Nombre").value;
    var fecha = document.getElementById("datepicker").value;

    // Crear un objeto con los datos del formulario
    var formData = new FormData();
    formData.append("email", email);
    formData.append("nombre", nombre);
    formData.append("fecha", fecha);

    // Enviar datos a PHP usando AJAX
    fetch("../models/percing.php", {
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

document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        defaultDate: "today",
        locale: "es", // Configuración de idioma español
        disableMobile: true
    });
});




const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  toastTrigger.addEventListener('click', () => {
    toastBootstrap.show()
  })
}


