<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/output.css" rel="stylesheet">
    <title>Flight Search</title>

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

<body class="bg-[#05203C]">

    <div class="block relative h-screen w-full bg-cover bg-center" style="background-image: url(./assets/images/Summer-2025-Explore.webp);">
        <div class="h-screen w-full flex items-center justify-center bg-[#05203C]/50 backdrop-blur-lg p-2">
            <div class="block lg:w-2/3 bg-white rounded-lg shadow-lg lg:p-8 p-3">
                <p class="text-3xl mb-6">Millions of cheap flights. One simple search.</p>

                <p class="block mb-3 space-x-2 text-sm font-bold">
                    <span class="rounded-xl bg-[#05203C] text-white py-2 px-6">Flight</span>
                    <span class="rounded-xl border border-[#05203C] text-[#05203C] py-2 px-6">Hotels</span>
                    <span class="rounded-xl border border-[#05203C] text-[#05203C] py-2 px-6">Cars</span>
                </p>

                <form method="GET" class="py-6 block mb-3">
                    <div class="flex flex-col lg:flex-row gap-4 mb-3">
                        <div class="block w-full flex-1 p-2 border border-gray-300 rounded-lg">
                            <label for="origin" class="font-semibold text-sm">From</label>
                            <input type="text" name="origin" id="origin" placeholder="From" class="w-full py-2 focus:outline-none focus:ring-0" required>
                            <div id="origin-suggestions" class="suggestions-box"></div>
                        </div>

                        <div class="block w-full flex-1 p-2 border border-gray-300 rounded-lg">
                            <label for="destination" class="font-semibold text-sm">Destination</label>
                            <input type="text" name="destination" id="destination" placeholder="Destination" class="w-full py-2 focus:outline-none focus:ring-0" required>
                            <div id="destination-suggestions" class="suggestions-box"></div>
                        </div>

                        <div class="block w-full flex-1 p-2 border border-gray-300 rounded-lg">
                            <label for="departure_date" class="font-semibold text-sm">Departure Date</label>
                            <input type="date" name="departure_date" id="departure_date" class="w-full py-2 focus:outline-none focus:ring-0" required>
                        </div>
                    </div>

                    <div class="block">
                        <button type="submit"
                            class="flex items-center lg:justify-start justify-center gap-2 transition duration-200 rounded-xl bg-[#05203C] hover:bg-[#024daf] py-6 px-6 text-white lg:w-36 w-full">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m18,10c0-4.41-3.59-8-8-8S2,5.59,2,10s3.59,8,8,8c1.85,0,3.54-.63,4.9-1.69l5.1,5.1,1.41-1.41-5.1-5.1c1.05-1.36,1.69-3.05,1.69-4.9Zm-14,0c0-3.31,2.69-6,6-6s6,2.69,6,6-2.69,6-6,6-6-2.69-6-6Z"></path>
                                </svg>
                            </span>
                            <span>Search</span>
                        </button>
                    </div>
                </form>

                <div class="block mb-3">
                    <div class="block lg:flex items-center justify-between w-full space-y-3 ">
                        <div class="rounded-xl bg-[#05203C] hover:bg-[#024daf] text-white flex items-center gap-2 p-4 w-full max-w-sm">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m19,2H5c-1.1,0-2,.9-2,2v16c0,1.1.9,2,2,2h14c1.1,0,2-.9,2-2V4c0-1.1-.9-2-2-2Zm-14,2h14v7s-14,0-14,0v-7Zm0,16v-7h14v7s-14,0-14,0Z"></path>
                                    <path d="M14 7 10 7 10 6 8 6 8 9 16 9 16 6 14 6 14 7z"></path>
                                    <path d="M14 15 14 16 10 16 10 15 8 15 8 18 16 18 16 15 14 15z"></path>
                                </svg>
                            </span>
                            <span>Learn More </span>
                        </div>

                        <div class="rounded-xl bg-[#05203C] hover:bg-[#024daf] text-white flex items-center gap-2 p-4 w-full max-w-sm">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.77 9.16 19.4 5.05A2.99 2.99 0 0 0 16.55 3H7.44a3 3 0 0 0-2.85 2.05L3.22 9.16c-.72.3-1.23 1.02-1.23 1.84v5c0 .75.42 1.4 1.04 1.74-.01.07-.04.13-.04.2V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-2h12v2c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-2.06c0-.07-.03-.13-.04-.2.62-.34 1.04-.99 1.04-1.74v-5c0-.83-.51-1.54-1.23-1.84ZM4 16v-5h16v5zM7.44 5h9.12a1 1 0 0 1 .95.68L18.62 9H5.39L6.5 5.68A1 1 0 0 1 7.45 5Z"></path>
                                    <path d="M6.5 12a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M17.5 12a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3"></path>
                                </svg>
                            </span>
                            <span>Car Rental </span>
                        </div>

                        <div class="rounded-xl bg-[#05203C] hover:bg-[#024daf] text-white flex items-center gap-2 p-4 w-full max-w-sm">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21.21 3.88a2.93 2.93 0 0 0-2.57-.98c-.8.09-1.63.48-2.47 1.13-1.24-.65-2.62-1-4.06-1.02-2.44 0-4.69.88-6.4 2.55A8.95 8.95 0 0 0 3 11.9a9 9 0 0 0 .58 3.31c-1.07 1.2-2.07 3.68-.83 5.08.52.58 1.26.84 2.15.84.99 0 2.17-.33 3.44-.89 1.1.49 2.31.76 3.55.77h.12c2.37 0 4.59-.9 6.28-2.55 1.72-1.67 2.68-3.92 2.71-6.34.01-.98-.14-1.92-.42-2.83 1.28-2.21 1.7-4.2.63-5.41M7.11 6.99A6.94 6.94 0 0 1 12 5.01h.09c1.88.02 3.63.77 4.93 2.1.57.59 1.02 1.26 1.35 1.99-.97 1.46-2.45 3.2-4.54 5.06-2.04 1.81-3.9 3.05-5.43 3.85-.51-.31-.98-.67-1.41-1.11a6.92 6.92 0 0 1-1.98-4.98c.02-1.88.77-3.63 2.11-4.93ZM4.25 18.95c-.22-.25 0-1.08.39-1.78.28.39.58.77.92 1.12.21.22.44.43.67.62-1.05.31-1.75.3-1.98.03Zm14.76-6.86a6.92 6.92 0 0 1-2.11 4.93c-1.33 1.3-3.08 1.98-4.98 1.98-.37 0-.73-.05-1.09-.11a32 32 0 0 0 4.33-3.24 32 32 0 0 0 3.83-4.03c0 .16.02.31.02.47m-.55-6.38c-.17-.17-.34-.33-.52-.48.39-.22.7-.32.92-.35.36-.04.63.06.86.32.22.25.17.9-.21 1.82-.31-.46-.66-.91-1.06-1.31Z"></path>
                                </svg>
                            </span>
                            <span>Explore everywhere </span>
                        </div>
                    </div>
                </div>

                <div class="block mb-3">
                    <div class="flex items-center justify-between w-full">
                        <p class="text-gray-600 text-sm">Search for flights, hotels, and cars</p>
                        <a href="#" class="text-blue-500 hover:underline text-sm">Advanced Search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./assets/scripts/search-suggestion.js"></script>
</body>

</html>