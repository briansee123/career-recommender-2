<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Career Path Recommender</title>
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
        .title .path { color: #f76b1c; }
        .title h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 15px 0;
            letter-spacing: 1px;
        }
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
        .forgot-link {
            text-align: right;
            margin-bottom: 25px;
        }
        .forgot-link a {
            color: #4a90e2;
            font-size: 1.05rem;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link a:hover { text-decoration: underline; }
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
        .signup-link {
            text-align: center;
            margin-top: 30px;
        }
        .signup-link p {
            color: #666;
            font-size: 1.1rem;
            margin: 0;
        }
        .signup-link a {
            color: #4a90e2;
            font-weight: 600;
            text-decoration: none;
        }
        .signup-link a:hover { text-decoration: underline; }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
            line-height: 1;
        }
        .modal-close:hover { color: #333; }
        .modal-body {
            text-align: center;
        }
        .modal-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .modal-title {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
        }
        .modal-text {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 25px;
        }
        .modal-email-box {
            background: #f0f9ff;
            border: 2px solid #4a90e2;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .modal-email-box p {
            color: #333;
            font-size: 1rem;
            margin: 0 0 10px 0;
            font-weight: 600;
        }
        .modal-email-box a {
            color: #4a90e2;
            font-size: 1.2rem;
            font-weight: 700;
            text-decoration: none;
        }
        .modal-btn {
            padding: 12px 40px;
            background: linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
        }
        .modal-btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Title -->
        <div class="title">
            <h1>CAREER <span class="path">PATH</span></h1>
            <h2>RECOMMENDER</h2>
            <p class="desc">A place to discover your future and make informed career choices</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Username or Email</label>
                <input type="text" id="email" name="email" placeholder="Enter username or email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
            @endif

            <!-- Forgot Password -->
            <div class="forgot-link">
                <a href="#" onclick="showModal(event)">Forgot password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Login</button>
        </form>

        <!-- Sign Up Link -->
        <div class="signup-link">
            <p>Don't have an account? <a href="{{ route('signup') }}">Sign up here</a></p>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">×</button>
            <div class="modal-body">
                <div class="modal-icon">🔒</div>
                <h2 class="modal-title">Forgot Your Password?</h2>
                <p class="modal-text">Please contact the administrator for password reset assistance.</p>
                <div class="modal-email-box">
                    <p>Admin Email:</p>
                    <a href="mailto:admin@test.com">admin@test.com</a>
                </div>
                <button class="modal-btn" onclick="closeModal()">Got it!</button>
            </div>
        </div>
    </div>

    <script>
        function showModal(e) {
            e.preventDefault();
            document.getElementById('forgotModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('forgotModal').style.display = 'none';
        }
        document.getElementById('forgotModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>