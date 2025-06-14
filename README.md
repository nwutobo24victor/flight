# ✈️ Flight Booking System (PHP + Amadeus API)

A modern flight booking system built with **PHP** and powered by the **Amadeus Self-Service API**. This project allows users to search for flights, view available offers, and book flights in real-time.

## 🚀 Features

- Flight Search (by origin, destination, date)
- Real-time flight offers using Amadeus API
- Traveler details and booking flow
- Responsive user interface
- Error handling and validation
- Easy integration and setup

## 🛠 Tech Stack

- **Backend**: PHP (Vanilla)
- **API**: Amadeus for Developers (Self-Service)
- **HTTP Requests**: cURL / Guzzle (choose one)
- **Frontend**: HTML, CSS, Bootstrap (or Tailwind)
- **Storage**: MySQL (optional, if storing user/session/booking data)

## 🧰 Prerequisites

- PHP >= 7.4
- Web server (Apache/Nginx)
- Composer (if using Guzzle or autoloaders)
- Amadeus Developer Account  
  👉 https://developers.amadeus.com

## 🔐 Amadeus API Setup

1. Create an account on [Amadeus for Developers](https://developers.amadeus.com)
2. Create an application to get your:
   - **API Key**
   - **API Secret**
3. Use the API key/secret to generate an access token (OAuth 2.0)

## 🔧 Installation

1. **Clone the repo**
   ```bash
   git clone https://github.com/nwutobo24victor/flight.git
   cd flight