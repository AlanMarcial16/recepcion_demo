// Obtener el elemento del calendario
const calendar = document.getElementById('calendar');

// Obtener el mes y año actual
const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

// Obtener las reservaciones y renderizar el calendario
getReservaciones();

// Función para obtener las reservaciones mediante una solicitud AJAX
function getReservaciones() {
  // Limpiar el contenido del calendario existente
  calendar.innerHTML = '';

  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'obtener_reservaciones.php', true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const reservaciones = JSON.parse(xhr.responseText);

      // Renderizar el calendario y resaltar las fechas ocupadas
      renderCalendar(currentMonth, currentYear, reservaciones);
      updateMonthAvailability(currentMonth, currentYear, reservaciones);
    }
  };

  xhr.send();
}

// Función para renderizar el calendario de un mes y año específicos
function renderCalendar(month, year, reservaciones) {
  // Obtener los días de la semana abreviados
  const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

  // Obtener el primer día del mes
  const firstDay = new Date(year, month, 1);

  // Obtener el número de días en el mes
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Crear el encabezado del calendario con el mes y año actual
  const monthHeader = document.createElement('div');
  monthHeader.classList.add('month');
  monthHeader.innerHTML = `<button onclick="previousMonth()">&#8249;</button><h2>${getMonthName(month)} ${year}</h2><button onclick="nextMonth()">&#8250;</button>`;
  calendar.appendChild(monthHeader);

  // Crear la fila de los días de la semana
  const daysOfWeekRow = document.createElement('div');
  daysOfWeekRow.classList.add('calendar-grid');

  // Crear las celdas de los días de la semana
  daysOfWeek.forEach(dayOfWeek => {
    const dayOfWeekCell = document.createElement('div');
    dayOfWeekCell.classList.add('calendar-day');
    dayOfWeekCell.innerText = dayOfWeek;

    daysOfWeekRow.appendChild(dayOfWeekCell);
  });
  calendar.appendChild(daysOfWeekRow);

  // Crear los días del mes
  const calendarGrid = document.createElement('div');
  calendarGrid.classList.add('calendar-grid');

  // Calcular el número de celdas vacías antes del primer día del mes
  const emptyCells = firstDay.getDay();

  // Rellenar las celdas vacías
  for (let i = 0; i < emptyCells; i++) {
    const emptyCell = document.createElement('div');
    emptyCell.classList.add('calendar-day');
    calendarGrid.appendChild(emptyCell);
  }

  // Crear un objeto para almacenar el número de reservaciones por día
  const reservationsCount = {};

  // Contar el número de reservaciones por día
  reservaciones.forEach(reservacion => {
    const fechaEntrada = new Date(reservacion.fecha);
    const fechaSalida = new Date(reservacion.salida);

    // Iterar sobre cada día entre la fecha de entrada y salida
    for (let date = fechaEntrada; date <= fechaSalida; date.setDate(date.getDate() + 1)) {
      const key = date.toISOString().split('T')[0]; // Utilizar la fecha como clave

      if (reservationsCount[key]) {
        reservationsCount[key]++;
      } else {
        reservationsCount[key] = 1;
      }
    }
  });

  // Crear las celdas de los días del mes
  for (let day = 1; day <= daysInMonth; day++) {
    const calendarDay = document.createElement('div');
    calendarDay.classList.add('calendar-day');
    calendarDay.innerText = day;

    // Verificar si la fecha actual está ocupada en alguna reservación
    const currentDate = new Date(year, month, day);
    const key = currentDate.toISOString().split('T')[0];
    // Verificar si la fecha actual está ocupada en alguna reservación
    const isDateOccupied = key in reservationsCount;
    // Obtener el número de reservaciones para la fecha actual
    const reservationCount = reservationsCount[key] || 0;

    // Aplicar una clase adicional a las celdas de los días ocupados
    if (isDateOccupied) {
      calendarDay.classList.add('day-occupied');
    }

    // Aplicar una clase adicional a las celdas de los días con más reservaciones
    if (reservationCount > 0) {
      calendarDay.classList.add('day-reservations');
    }

    calendarGrid.appendChild(calendarDay);
  }

  calendar.appendChild(calendarGrid);
}

// Función para obtener el nombre del mes
function getMonthName(month) {
  const months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ];
  return months[month];
}

// Función para avanzar al siguiente mes
function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  getReservaciones();
}

// Función para retroceder al mes anterior
function previousMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  getReservaciones();
}

