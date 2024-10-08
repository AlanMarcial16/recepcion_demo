// Variable para indicar si el formulario ha sido completado
var formularioCompletado = false;

// Función que se ejecuta al cargar la página
window.addEventListener('load', function() {
    // Agregar un listener al botón "Continuar"
    var btnContinuar = document.getElementById('btnfin');
    if (btnContinuar) {
        btnContinuar.addEventListener('click', function() {
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
        var confirmationMessage = 'Para salir, por favor, complete el formulario y pulse el botón "Continuar".';
        (e || window.event).returnValue = confirmationMessage; // Standard
        return confirmationMessage; // Legacy support for Internet Explorer 9 and earlier
    }
}
