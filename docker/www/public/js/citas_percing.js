document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        defaultDate: "today",
        locale: "es",
        disableMobile: true,
        onChange: function (selectedDates, dateStr) {
            if (dateStr) {
                fetchOcupiedHours(dateStr);
            }
        }
    });
});

function fetchOcupiedHours(fecha) {
    fetch(`../models/citas_percing.php?fecha=${encodeURIComponent(fecha)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                generateHourButtons(data.ocupadas);
            } else {
                console.error("Error al obtener horas ocupadas:", data.message);
            }
        })
        .catch(error => console.error("Error en la petición:", error));
}

function generateHourButtons(ocupadas = []) {
    const container = document.getElementById("hourButtons");
    container.innerHTML = "";

    const ocupadasNormalizadas = ocupadas.map(hora => hora.split(".")[0]);

    const hours = [10, 11, 12, 13, 14, 15, 16, 18, 19, 20];
    const intervals = [":00", ":20", ":40"];

    let row = document.createElement("div");
    row.classList.add("d-flex", "flex-wrap", "gap-2");
    let count = 0;

    hours.forEach(hour => {
        if (hour === 17) return;
        intervals.forEach(interval => {
            let amPm = hour < 12 ? "am" : "pm";
            let displayHour = hour <= 12 ? hour : hour - 12;
            let formattedHour = `${hour.toString().padStart(2, "0")}${interval}:00`;

            let button = document.createElement("button");
            button.type = "button";
            button.className = "btn m-1";
            button.innerText = `${displayHour}${interval} ${amPm}`;

            button.style.backgroundColor = "#1a1a1a";
            button.style.color = "#ff4da6";
            button.style.border = "2px solid #ff4da6";
            button.style.padding = "8px 15px";
            button.style.borderRadius = "8px";

            if (ocupadasNormalizadas.includes(formattedHour)) {
                button.disabled = true;
                button.style.backgroundColor = "#ff4da6";
                button.style.color = "#1a1a1a";
            } else {
                button.onclick = () => selectHour(`${displayHour}${interval} ${amPm}`);
            }

            row.appendChild(button);
            count++;

            if (count % 3 === 0) {
                container.appendChild(row);
                row = document.createElement("div");
                row.classList.add("d-flex", "flex-wrap", "gap-2");
            }
        });
    });

    container.appendChild(row);
}

function selectHour(hour) {
    const formattedHour = convertTo24HourFormat(hour);
    document.getElementById("selectHour").innerText = `Hora seleccionada: ${hour}`;
    document.getElementById("hourButtons").classList.add("d-none");
    document.getElementById("hiddenHour").value = formattedHour;
}

function convertTo24HourFormat(hourStr) {
    const [time, period] = hourStr.split(" ");
    let [hours, minutes] = time.split(":");
    hours = parseInt(hours);

    if (period === "pm" && hours !== 12) hours += 12;
    if (period === "am" && hours === 12) hours = 0;

    return `${hours.toString().padStart(2, '0')}:${minutes}:00`;
}

// 🚀 Envío de datos con SweetAlert2
document.getElementById("liveToastBtn").addEventListener("click", function () {
    const email = document.getElementById("Email").value.trim();
    const nombre = document.getElementById("Nombre").value.trim();
    const fecha = document.getElementById("datepicker").value.trim();
    const hora = document.getElementById("hiddenHour").value;

    if (!email || !nombre || !fecha || !hora || hora === "Seleccionar hora") {
        Swal.fire({
            icon: "warning",
            title: "Campos incompletos",
            text: "Por favor, completa todos los campos antes de enviar.",
        });
        return;
    }

    fetch("../models/citas_percing.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `email=${encodeURIComponent(email)}&nombre=${encodeURIComponent(nombre)}&fecha=${encodeURIComponent(fecha)}&hora=${encodeURIComponent(hora)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: "success",
                title: "Cita registrada",
                text: "Tu cita se ha registrado exitosamente.",
            });
        } else if (data.message.includes("ya existe")) {
            Swal.fire({
                icon: "error",
                title: "Cita duplicada",
                text: "Ya existe una cita con estos datos. Intenta con otra fecha u hora.",
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: data.message || "Ocurrió un problema al registrar la cita.",
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({
            icon: "error",
            title: "Error del servidor",
            text: "Ocurrió un error inesperado al procesar la solicitud.",
        });
    });
});

function toggleHours() {
    const container = document.getElementById("hourButtons");

    if (container.classList.contains("d-none")) {
        const fecha = document.getElementById("datepicker").value;
        if (!fecha) {
            Swal.fire({
                icon: "warning",
                title: "Fecha requerida",
                text: "Por favor, selecciona una fecha primero.",
            });
            return;
        }

        if (!container.hasChildNodes()) {
            fetchOcupiedHours(fecha);
        }

        container.classList.remove("d-none");
    } else {
        container.classList.add("d-none");
    }
}
