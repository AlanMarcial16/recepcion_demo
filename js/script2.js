document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fecha');
    const habitacionesDisponiblesElement = document.getElementById('habitacionesDisponibles');

    fechaInput.addEventListener('blur', function() {
        fetch('obtenerHabitaciones.php', {
            method: 'POST',
            body: new URLSearchParams({
                fecha: fechaInput.value
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => response.json())
        .then(habitacionesDisponibles => {
            console.log('Habitaciones Disponibles:', habitacionesDisponibles);

            // Actualiza la interfaz de usuario
            mostrarHabitacionesDisponibles(habitacionesDisponibles);
        })
        .catch(error => console.error('Error al obtener las habitaciones disponibles:', error));
    });

    function mostrarHabitacionesDisponibles(habitacionesDisponibles) {
        // Muestra las habitaciones disponibles agrupadas por categoría
        habitacionesDisponiblesElement.innerHTML = '';

        for (const [categoria, habitacionesCategoria] of Object.entries(habitacionesDisponibles)) {
            const habitacionesHTML = habitacionesCategoria.length > 0
                ? habitacionesCategoria.join(', ')
                : 'Ninguna disponible en esta categoría';

            const categoriaHTML = `<p><b>${categoria}:</b> ${habitacionesHTML}</p>`;
            habitacionesDisponiblesElement.innerHTML += categoriaHTML;
        }
    }
});
