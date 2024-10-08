// Variable para rastrear si se ha elegido una opción del selector
var opcionElegida = false;

// Función para mostrar la alerta al intentar salir del sitio
function confirmarSalida(e) {
    // Desactivar la alerta del navegador
    e.preventDefault();

    // Mostrar la alerta solo si no se ha elegido una opción del selector
    if (!opcionElegida) {
        Swal.fire({
            title: 'Advertencia',
            text: 'Para continuar, por favor, elija una opción de pago.',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // No se hace nada si el usuario hace clic en "Cancelar"
            }
        });
    }
}

// Agregar el evento 'beforeunload' para confirmar la salida si no se ha elegido una opción del selector
window.addEventListener('beforeunload', confirmarSalida);

// Manejar cambio en el selector de pago
document.getElementById('pago').addEventListener('change', function () {
    // Actualizar la variable cuando se elige una opción del selector
    opcionElegida = true;
});
