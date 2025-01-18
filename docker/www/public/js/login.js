//Acciones de js para el login
// Animations
document.getElementById("register").addEventListener("click", () => document.getElementById("container").classList.add("right-panel-active"));
document.getElementById("login").addEventListener("click", () => document.getElementById("container").classList.remove("right-panel-active"));

// Función general de validación
function showValidation(input, message, isValid = false) {
    const formControl = input.parentElement;
    formControl.className = `form-control ${isValid ? 'success' : 'error'}`;
    formControl.querySelector('small').innerText = isValid ? '' : message;
}

// Validación de correo
function validateEmail(input, errorElement) {
    const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    const isValid = emailRegex.test(input.value);
    showValidation(input, isValid ? '' : '*Email no es valido', isValid);
    errorElement.textContent = isValid ? '' : '*Email no es valido';
    return isValid;
}

// Validación de longitud
function validateLength(input, minLength, maxLength) {
    const isValid = input.value.length >= minLength && input.value.length <= maxLength;
    showValidation(input, isValid ? '' : `*${input.id.charAt(0).toUpperCase() + input.id.slice(1)} debe tener entre ${minLength} y ${maxLength} caracteres`, isValid);
    return isValid;
}

// Verificar si los campos están vacíos con es requerido
function checkRequired(inputArr) {
    let isValid = true;
    inputArr.forEach(input => {
        const fieldName = input.placeholder || input.id.charAt(0).toUpperCase() + input.id.slice(1); // Obtener el nombre del campo (por ejemplo, 'Email')
        if (input.value.trim() === '') {
            showValidation(input, `*${fieldName} es requerido`); // Mensaje personalizado
            isValid = false;
        } else {
            showValidation(input, '', true); // Si el campo no está vacío, muestra el éxito
        }
    });
    return isValid;
}

// Manejo del formulario de registro
document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();
    if (checkRequired([document.getElementById('username'), document.getElementById('email'), document.getElementById('password')])) {
        validateLength(document.getElementById('username'), 4, 20);
        validateLength(document.getElementById('password'), 8, 20);
        validateEmail(document.getElementById('email'), document.querySelector("#email-error"));
    }
});

// Manejo del formulario de login
document.querySelector('.form-lg').addEventListener('submit', function (e) {
    e.preventDefault();
    const lgEmail = document.querySelector('.email-2');
    const lgPassword = document.querySelector('.password-2');
    if (checkRequired([lgEmail, lgPassword])) {
        validateEmail(lgEmail, document.querySelector(".email-error-2"));
        validateLength(lgPassword, 8, 20);
    }
});
