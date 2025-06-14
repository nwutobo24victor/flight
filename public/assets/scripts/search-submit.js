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

            console.log(data.flight[0].itineraries[0]);
            console.log(data.flight[0].itineraries[0].segments[0].carrierCode);


            submitButton.disabled = false;
            submitButton.style.backgroundColor = '#05203C';

            const statusContainer = document.getElementById('status');
            const responseContainer = document.getElementById('response');

            statusContainer.innerHTML = `<p style="color: green;">${data.message}</p>`;

            // Check if the response has flights
            if (data.status === true && data.flight.length > 0) {
                let html = `<p hidden style="color: green;">${data.message}</p><ul>`;

                data.flight.forEach(flight => {
                    const segment = flight.itineraries[0].segments[0];
                    const itinerary = flight.itineraries[0];

                    html += `
                       <form method="POST" action="./config/book-flight.php">
                            <li style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #ccc; border-radius: 8px;">
                                <input type="hidden" name="carrierCode" value="${flight.itineraries[0].segments[0].carrierCode}">
                                <input type="hidden" name="flightNumber" value="${flight.itineraries[0].segments[0].number}">
                                <input type="hidden" name="departureAirport" value="${flight.itineraries[0].segments[0].departure.iataCode}">
                                <input type="hidden" name="departureTime" value="${flight.itineraries[0].segments[0].departure.at}">
                                <input type="hidden" name="arrivalAirport" value="${flight.itineraries[0].segments[0].arrival.iataCode}">
                                <input type="hidden" name="arrivalTime" value="${flight.itineraries[0].segments[0].arrival.at}">
                                <input type="hidden" name="price" value="${flight.price.total}">
                                <input type="hidden" name="currency" value="${flight.price.currency}">

                                <div class="flex justify-end mb-6">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-lg px-4 py-0.5 cursor-pointer">Book</button>
                                </div>

                                <strong>Carrier:</strong> ${flight.itineraries[0].segments[0].carrierCode ?? 'N/A'}<br>
                                <strong>Flight Number:</strong> ${flight.itineraries[0].segments[0].number ?? 'N/A'}<br>
                                <strong>Departure:</strong> ${flight.itineraries[0].segments[0].departure.iataCode ?? 'N/A'} at ${flight.itineraries[0].segments[0].departure.at ?? 'N/A'}<br>
                                <strong>Arrival:</strong> ${flight.itineraries[0].segments[0].arrival.iataCode ?? 'N/A'} at ${flight.itineraries[0].segments[0].arrival.at ?? 'N/A'}<br>
                                <strong>Price:</strong> ${flight.price.currency ?? 'N/A'} ${flight.price.total ?? 'N/A'}
                            </li>
                        </form>
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