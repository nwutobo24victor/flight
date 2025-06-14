const submitButton = document.querySelector('button[type="submit"]');

const modal = document.getElementById('flightModal');
const closeBtn = document.getElementById('closeModal');

document.getElementById('searchForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    submitButton.disabled = true;
    submitButton.style.backgroundColor = '#024daf';

    const form = e.target;
    const formData = new FormData(form);

    fetch('./config/search-flights.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {

            console.log(data.flight[0].itineraries[0].duration);
            console.log(data.flight[0].itineraries[0].segments[0].carrierCode);


            submitButton.disabled = false;
            submitButton.style.backgroundColor = '#05203C';

            const responseContainer = document.getElementById('response');

            // Check if the response has flights
            if (data.status === true && data.flight.length > 0) {
                let html = `<p style="color: green;">${data.message}</p><ul>`;

                data.flight.forEach(flight => {
                    html += `
                    <li style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #ccc; border-radius: 8px;">
                        <strong>Carrier:</strong> ${data.flight[0].itineraries[0].segments[0].carrierCode ?? 'N/A'} <strong>Duration:</strong> ${data.flight[0].itineraries[0].duration ?? 'N/A'}<br>
                        <strong>Flight Number:</strong> ${data.flight[0].itineraries[0].segments[0].aircraft.code ?? 'N/A'}<br>
                        <strong>Departure:</strong> ${data.flight[0].itineraries[0].segments[0].departure.iataCode ?? 'N/A'} at ${data.flight[0].itineraries[0].segments[0].departure.at ?? 'N/A'}<br>
                        <strong>Arrival:</strong> ${data.flight[0].itineraries[0].segments[0].arrival.iataCode ?? 'N/A'} at ${data.flight[0].itineraries[0].segments[0].arrival.at ?? 'N/A'}<br>
                        <strong>Price:</strong> ${flight.price.currency ?? 'N/A'} ${flight.price.total ?? 'N/A'}
                    </li>
                `;
                });

                html += `</ul>`;
                responseContainer.innerHTML = html;

            } else {
                responseContainer.innerHTML = `<p style="color: red;">No flights found or something went wrong.</p>`;
            }

            // Show the modal with the response
            modal.classList.toggle('hidden');
        })
        .catch(error => {

            submitButton.disabled = false;
            submitButton.style.backgroundColor = '#05203C';


            document.getElementById('response').innerHTML = `<p style="color: red;">Error: ${error}</p>`;

            modal.classList.toggle('hidden');
        });
});



closeBtn.addEventListener('click', () => {
    modal.classList.toggle('hidden');
});