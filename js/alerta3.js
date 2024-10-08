// Variable para rastrear si se ha hecho clic en "Proceder al pago"
var procederAlPagoClic = false;

// Función para mostrar la alerta al intentar salir de la página
function confirmarSalida(e) {
    // Desactivar la alerta del navegador
    e.preventDefault();

    // Mostrar la alerta solo si no se ha hecho clic en "Proceder al pago"
    if (!procederAlPagoClic) {
        Swal.fire({
            title: 'Advertencia',
            text: 'Para continuar, por favor, utilice el botón "Proceder al pago".',
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

// Agregar el evento 'beforeunload' para confirmar la salida si no se ha hecho clic en "Proceder al pago"
window.addEventListener('beforeunload', confirmarSalida);

// Manejar clic en el botón "Proceder al pago"
document.getElementById('btnPagar').addEventListener('click', function () {
    procederAlPagoClic = true;
});
