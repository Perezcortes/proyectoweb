// Animaciones
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
    showValidation(input, isValid ? '' : '*Email no es válido', isValid);
    errorElement.textContent = isValid ? '' : '*Email no es válido';
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
        const fieldName = input.placeholder || input.id.charAt(0).toUpperCase() + input.id.slice(1);
        if (input.value.trim() === '') {
            showValidation(input, `*${fieldName} es requerido`);
            isValid = false;
        } else {
            showValidation(input, '', true);
        }
    });
    return isValid;
}

// Manejo del formulario de login
document.querySelector('.form-lg').addEventListener('submit', function(e) {
    e.preventDefault();
    const lgEmail = document.querySelector('.email-2');
    const lgPassword = document.querySelector('.password-2');
    const isValid = checkRequired([lgEmail, lgPassword]);
    if (isValid) {
        const validEmail = validateEmail(lgEmail, document.querySelector(".email-error-2"));
        const validPassword = validateLength(lgPassword, 8, 20);
        if (validEmail && validPassword) {
            this.submit();
        }
    }
});