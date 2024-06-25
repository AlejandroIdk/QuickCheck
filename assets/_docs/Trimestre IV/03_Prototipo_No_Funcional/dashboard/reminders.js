const reminders = JSON.parse(localStorage.getItem('reminders') || '{}');
const remindersList = document.getElementById('remindersList');

function loadReminders() {
    remindersList.innerHTML = '<h2>Recordatorios</h2>';
    for (let dateKey in reminders) {
        const reminderItem = document.createElement('div');
        reminderItem.className = 'reminder-item';
        reminderItem.innerHTML = `
            <span>${dateKey}: ${reminders[dateKey]}</span>
            <button class="delete-btn" onclick="deleteReminder('${dateKey}')">Eliminar</button>
        `;
        remindersList.appendChild(reminderItem);
    }
    if (Object.keys(reminders).length === 0) {
        remindersList.innerHTML += '<p>No hay recordatorios.</p>';
    }
}

function deleteReminder(dateKey) {
    delete reminders[dateKey];
    localStorage.setItem('reminders', JSON.stringify(reminders));
    loadReminders();
}

loadReminders();