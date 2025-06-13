<?php require './search-flights.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Search</title>

    <style>
        .w-05 {
            width: 50%;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .flex {
            display: flex;
        }

        .row {
            flex-direction: row;
        }

        .column {
            flex-direction: column;
        }

        .block {
            display: block;
        }

        .inline {
            display: inline;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .justify-between {
            justify-content: space-between;
        }
    </style>

    <style>
        .suggestions-box {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            width: 250px;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }

        .suggestion-item {
            padding: 8px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background: #f0f0f0;
        }
    </style>

</head>

<body>
    <h1>Search Flights</h1>
    <form method="POST">
        <div class="flex row items-center justify-between w-05" style="background-color: #000;">
            <div class="block">
                <input type="text" id="origin" name="origin" placeholder="Enter origin airport..." autocomplete="off">
                <div id="origin-suggestions" class="suggestions-box"></div>
            </div>

            <div class="block">
                <input type="text" id="destination" name="destination" placeholder="Enter destination airport..." autocomplete="off">
                <div id="destination-suggestions" class="suggestions-box"></div>
            </div>

            <div class="block">
                <input type="date" name="departure_date" required>
            </div>
        </div>
        <!-- <input name="origin" placeholder="From (e.g. LAX)" required>
        <input name="destination" placeholder="To (e.g. JFK)" required>
        <input type="date" name="departure_date" required>
        <button type="submit">Search</button> -->
    </form>


    <script>
        function setupAirportAutocomplete(inputId, suggestionsBoxId) {
            const input = document.getElementById(inputId);
            const box = document.getElementById(suggestionsBoxId);
            let timer = null;

            input.addEventListener('keyup', function() {
                clearTimeout(timer);
                const query = this.value.trim();

                if (query.length < 2) {
                    box.innerHTML = '';
                    return;
                }

                timer = setTimeout(() => {
                    fetch('./airport-autocomplete.php?q=' + encodeURIComponent(query))
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
    </script>


</body>

</html>