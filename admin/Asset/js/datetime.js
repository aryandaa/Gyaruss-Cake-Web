function updateDateTime() {
    const dateTimeElements = document.querySelectorAll('.dateTime');

    const now = new Date();
    const options = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
    const tanggal = now.toLocaleDateString('id-ID', options);
    const jam = now.toLocaleTimeString('id-ID');

    const output = `${tanggal} — ${jam}`;

    dateTimeElements.forEach(el => {
        el.textContent = output;
    });
}

setInterval(updateDateTime, 1000);
updateDateTime();
