<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Register - Notes App</title>
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

        p a:hover {
            color: blue;
            text-decoration: underline;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .register-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .register-header p {
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

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .btn-register {
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

        .btn-register:hover {
            background: #0056d6;
        }

        .btn-register:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Create Account</h1>
        </div>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Enter your full name"
                    value="{{ old('name') }}"
                    required
                >
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required
                >
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter your password"
                    required
                >
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Admin Key (optional)</label>
                <input
                    type="text"
                    name="admin_key"
                    placeholder = "Enter admin key">
            </div>
            <button type="submit" class="btn-register">
                Register
            </button>
        </form>

        <p>
            <a href="{{ route('login') }}">
                Already have an account? Login
            </a>
        </p>
    </div>
</body>
</html>
