// Función que se ejecuta cuando el usuario intenta salir de la página o cambiar de pestaña
window.addEventListener('beforeunload', function(e) {
    // Verifica si el formulario está llenado parcialmente
    var form = document.getElementById('Reservas');
    if (form.elements['fecha'].value !== '' ||form.elements['salida'].value !== '' ||form.elements['cliente'].value !== '' || form.elements['anticipo'].value !== '') {
        // Muestra un aviso personalizado
        var confirmationMessage = '¿Estás seguro de abandonar la página? Tu formulario no está completo.';
        (e || window.event).returnValue = confirmationMessage; // Standard
        return confirmationMessage; // Legacy support for Internet Explorer 9 and earlier
    }
    });