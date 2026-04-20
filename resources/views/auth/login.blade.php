<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Login - Notes App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Poppins, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #dbe2ef;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
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
            max-width: 420px;
            padding: 40px;
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

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
        }

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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
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
        }
        .btn-login:active {
            transform: translateY(0);
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Log In</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" onsubmit="return loginUser(event)">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>
        <p>
            <a href="{{ route('register') }}" class="text-gray-600">
                Create an account
            </a>
        </p>
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

        return true; // allow Laravel POST to /login
    }
</script>
</body>
</html>
