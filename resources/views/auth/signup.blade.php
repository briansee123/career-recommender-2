<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Career Path Recommender</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(120deg, #4a90e2 0%, #f76b1c 100%);
            padding: 40px 20px;
        }
        .container {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.15);
            max-width: 550px;
            width: 100%;
            padding: 60px 50px;
        }
        .title {
            text-align: center;
            margin-bottom: 40px;
        }
        .title h1 {
            font-size: 3rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        }
        .title .signup { color: #f76b1c; }
        .desc {
            color: #666;
            font-size: 1.2rem;
            margin: 0;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            font-size: 1.1rem;
        }
        .form-group input {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background: #fdfad6;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74,144,226,0.1);
        }
        .error-message {
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        .success-message {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        .terms {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 25px;
            text-align: center;
            line-height: 1.5;
        }
        .submit-btn {
            width: 100%;
            padding: 16px 0;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%);
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(74,144,226,0.3);
            transition: all 0.3s;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74,144,226,0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 30px;
        }
        .login-link p {
            color: #666;
            font-size: 1.1rem;
            margin: 0;
        }
        .login-link a {
            color: #4a90e2;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            .container {
                padding: 40px 30px;
            }
            .title h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Title -->
        <div class="title">
            <h1>SIGN <span class="signup">UP</span></h1>
            <p class="desc">A place to discover your future and make informed career choices</p>
        </div>

        <!-- Signup Form -->
        <form method="POST" action="{{ route('signup.post') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Enter your full name" 
                    value="{{ old('name') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email address" 
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Create a password" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Confirm your password" 
                    required
                >
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Success Message -->
            @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            @endif

            <!-- Terms -->
            <div class="terms">
                By signing up, you agree that you understand our terms of service and privacy policy.
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Create Account</button>
        </form>

        <!-- Login Link -->
        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</body>
</html>