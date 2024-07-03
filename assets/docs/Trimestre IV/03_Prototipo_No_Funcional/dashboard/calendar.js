const calendar = document.getElementById('calendar');
const reminderPopup = document.getElementById('reminderPopup');
const overlay = document.getElementById('overlay');
const selectedDateElement = document.getElementById('selectedDate');
const reminderText = document.getElementById('reminderText');
const monthYear = document.getElementById('monthYear');

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
const reminders = JSON.parse(localStorage.getItem('reminders') || '{}');

function generateCalendar(month, year) {
    calendar.innerHTML = '';
    monthYear.innerText = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // Add empty divs for days of the week before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyDiv = document.createElement('div');
        calendar.appendChild(emptyDiv);
    }

    // Add divs for each day of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.innerText = day;
        const dateKey = `${day}-${month + 1}-${year}`;
        if (reminders[dateKey]) {
            dayDiv.classList.add('has-reminder');
        }
        dayDiv.addEventListener('click', () => openReminderPopup(day, month, year));
        calendar.appendChild(dayDiv);
    }
}

function openReminderPopup(day, month, year) {
    const dateKey = `${day}-${month + 1}-${year}`;
    selectedDateElement.innerText = `Fecha seleccionada: ${day}-${month + 1}-${year}`;
    reminderText.value = reminders[dateKey] || '';
    reminderPopup.style.display = 'block';
    overlay.style.display = 'block';
}

function closeReminderPopup() {
    reminderPopup.style.display = 'none';
    overlay.style.display = 'none';
}

function saveReminder() {
    const dateKey = selectedDateElement.innerText.split(': ')[1];
    reminders[dateKey] = reminderText.value;
    localStorage.setItem('reminders', JSON.stringify(reminders));
    alert('Recordatorio guardado.');
    closeReminderPopup();
    generateCalendar(currentMonth, currentYear);
}

function changeMonth(offset) {
    currentMonth += offset;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
}

generateCalendar(currentMonth, currentYear);