function setupAirportAutocomplete(inputId, suggestionsBoxId) {
    const input = document.getElementById(inputId);
    const box = document.getElementById(suggestionsBoxId);
    let timer = null;

    input.addEventListener('keyup', function () {
        clearTimeout(timer);
        const query = this.value.trim();

        if (query.length < 2) {
            box.innerHTML = '';
            return;
        }

        timer = setTimeout(() => {
            fetch('./config/airport-autocomplete.php?q=' + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    box.innerHTML = '';

                    if (data && data.length > 0) {
                        data.forEach(airport => {
                            const item = document.createElement('div');
                            item.className = 'suggestion-item';
                            item.textContent = `${airport.iataCode} - ${airport.name}, ${airport.cityName}`;
                            item.addEventListener('click', () => {
                                input.value = airport.iataCode;
                                box.innerHTML = '';
                            });
                            box.appendChild(item);
                        });
                    }
                });
        }, 300);
    });

    // Hide suggestions if clicked outside
    document.addEventListener('click', (e) => {
        if (!box.contains(e.target) && e.target !== input) {
            box.innerHTML = '';
        }
    });
}

// Setup for both inputs
setupAirportAutocomplete('origin', 'origin-suggestions');
setupAirportAutocomplete('destination', 'destination-suggestions');