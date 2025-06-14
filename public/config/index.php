<?php require 'search-flights.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Search</title>
</head>

<body>
    <h1>Search Flights</h1>
    <form method="POST">
        <input name="origin" placeholder="From (e.g. LAX)" required>
        <input name="destination" placeholder="To (e.g. JFK)" required>
        <input type="date" name="departure_date" required>
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($flights['data'])): ?>
        <h2>Results</h2>
        <ul>
            <?php foreach ($flights['data'] as $flight): ?>
                <li>
                    <?= $flight['itineraries'][0]['segments'][0]['departure']['iataCode'] ?>
                    to
                    <?= $flight['itineraries'][0]['segments'][0]['arrival']['iataCode'] ?> -
                    €<?= $flight['price']['total'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No flights found.</p>
    <?php endif; ?>
</body>

</html>