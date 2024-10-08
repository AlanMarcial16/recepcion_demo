// Variable para indicar si el formulario ha sido completado
var formularioCompletado = false;

// Función que se ejecuta al cargar la página
window.addEventListener('load', function() {
    // Agregar un listener al botón "Sí"
    var btnSi = document.querySelector('.btn-danger');
    if (btnSi) {
        btnSi.addEventListener('click', function() {
            formularioCompletado = true;
        });
    }

    // Agregar un listener al botón "No"
    var btnNo = document.querySelector('.btn-success');
    if (btnNo) {
        btnNo.addEventListener('click', function() {
            formularioCompletado = true;
        });
    }

    // Agregar el evento 'beforeunload' para mostrar la alerta
    window.addEventListener('beforeunload', confirmarSalida);
});

// Función para mostrar la alerta al intentar salir de la página
function confirmarSalida(e) {
    // Verificar si el formulario ha sido completado
    if (!formularioCompletado) {
        // Mostrar la alerta personalizada
        var confirmationMessage = 'Para salir, por favor, seleccione una opción ("Sí" o "No").';
        (e || window.event).returnValue = confirmationMessage; // Standard
        return confirmationMessage; // Legacy support for Internet Explorer 9 and earlier
    }
}
