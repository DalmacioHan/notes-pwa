<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<title>Login - Notes App</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
        font-family: Poppins, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: #dbe2ef;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        }

        /* NEW: wrapper that stacks weather ABOVE login */
        .page-stack {
        width: 100%;
        max-width: 420px;            /* controls both cards width */
        display: flex;
        flex-direction: column;      /* makes items vertical */
        gap: 16px;                   /* spacing between weather + login */
        align-items: stretch;
        }

        p a {
        color: #333;
        font-size: 15px;
        margin-bottom: 8px;
        display: flex;
        justify-content: center;
        text-decoration: none;
        margin-top: 5px;
        }

        .login-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        width: 100%;
        padding: 40px;
        }

        /* Weather card container is now a separate card area */
        /* Card Container */
        .weather-container {
            background: white; /* Semi-transparent glass effect */
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            width: 100%;
            max-width: 420px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* Text Elements */
        .weather-city {
            font-weight: 700;
            color: #333;
            font-size: 1.1rem;
        }

        .weather-temp {
            font-size: 2.2rem;
            font-weight: 700;
            color: #222;
            margin: 5px 0;
        }

        .weather-desc {
            text-transform: capitalize;
            color: #555;
            font-size: 0.9rem;
        }

        .login-header {
        text-align: center;
        margin-bottom: 40px;
        }

        .login-header h1 {
        color: #333;
        font-size: 28px;
        margin-bottom: 8px;
        }

        .form-group { margin-bottom: 24px; }

        .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 14px;
        }

        .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        outline: none;
        }

        .form-group input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
        width: 100%;
        padding: 14px;
        background: blue;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        font-family: Poppins;
        }

        .btn-login:active { transform: translateY(0); }

        /* Weather card look */
        .glass-card {
        width: 100%;
        background: rgba(255,255,255,0.75);
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .glass-card.small {
        max-width: 320px; /* optional: set how wide the weather card is */
        }

        .card-body { padding: 8px; text-align: center; }
    </style>
    </head>

    <body>

    <!-- NEW: wrapper around weather + login -->
    <div class="page-stack">

        <!-- Weather card (separate container) -->
        <div class="weather-container" id="weather-mini">
            @if(isset($weather))
                <div class="weather-city">{{ $weather['city'] }}</div>
                <div class="weather-temp">{{ $weather['temp'] }}°C</div>
                <div class="weather-desc">{{ $weather['description'] }}</div>
            @else
                <div class="weather-city">Loading...</div>
            @endif
        </div>

        <!-- Login card -->
        <div class="login-container">
        <div class="login-header">
            <h1>Log In</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" onsubmit="return loginUser(event)">
            @csrf

            <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" placeholder="Enter your email"
                    value="{{ old('email') }}" autocomplete="email" required>
            </div>

            <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter your password"
                    autocomplete="current-password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <p>
            <a href="{{ route('register') }}" class="text-gray-600">Create an account</a>
        </p>
        </div>

    </div>

    <script>
        function loginUser(event) {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!email || !password) {
            event.preventDefault();
            alert('Please enter both email and password.');
            return false;
        }
        return true;
        }
    </script>

    <script>
        async function loadWeather() {
        try {
            const res = await fetch('/weather');
            const data = await res.json();
            const weatherCard = document.getElementById('weather-mini');

            if (weatherCard) {
            weatherCard.innerHTML = `
                <div style="font-weight:600;">${data.name}</div>
                <div style="font-size:1.2rem;">${data.main.temp}°C</div>
                <div style="text-transform:capitalize;font-size:0.9rem;">
                ${data.weather[0].description}
                </div>
            `;
            }
        } catch (error) {
            console.error("Weather load failed", error);
        }
        }

        loadWeather();
        setInterval(loadWeather, 60000);
    </script>

    </body>
    </html>

