<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Path Recommender - Login</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      font-family: 'Montserrat', Arial, sans-serif;
      background: linear-gradient(120deg, #4a90e2 0%, #f76b1c 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .container {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.08);
      max-width: 800px;
      width: 100%;
      padding: 40px 0 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .title {
      font-size: 2.3rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 8px;
      letter-spacing: 1px;
    }
    .title .path {
      color: #f76b1c;
    }
    .desc {
      color: #555;
      font-size: 1.1rem;
      margin-bottom: 32px;
      text-align: center;
    }
    .login-box {
      display: flex;
      width: 90%;
      max-width: 700px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.03);
      overflow: hidden;
      margin-bottom: 18px;
    }
    .login-social, .login-form {
      flex: 1;
      padding: 32px 28px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .login-social {
      border-right: 1px solid #eee;
      align-items: center;
    }
    .login-social button {
      width: 100%;
      margin-bottom: 18px;
      padding: 10px 0;
      border: 1px solid #4a90e2;
      border-radius: 6px;
      background: #fff;
      color: #333;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: box-shadow 0.2s;
      box-shadow: 0 2px 4px rgba(74,144,226,0.07);
    }
    .login-social button img {
      height: 22px;
      margin-right: 10px;
    }
    .login-social .signup-link {
      margin-top: 10px;
      font-size: 0.98rem;
      color: #4a90e2;
      text-decoration: none;
      text-align: center;
    }
    .login-form label {
      font-weight: 600;
      margin-bottom: 6px;
      margin-top: 10px;
      color: #222;
    }
    .login-form input {
      width: 100%;
      padding: 8px 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background: #fdfad6;
      font-size: 1rem;
    }
    .login-form .forgot {
      color: #4a90e2;
      font-size: 0.97rem;
      text-decoration: none;
      margin-bottom: 18px;
      display: inline-block;
    }
    .login-form button {
      width: 100%;
      padding: 10px 0;
      border: none;
      border-radius: 6px;
      background: linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%);
      color: #fff;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 8px;
      box-shadow: 0 2px 6px rgba(74,144,226,0.09);
      transition: background 0.2s;
    }
    .error-message {
      color: #dc3545;
      font-size: 0.9rem;
      text-align: center;
      margin-top: -10px;
      margin-bottom: 10px;
      display: none; /* Initially hidden */
    }
    .footer {
      margin-top: 18px;
      text-align: center;
      color: #666;
      font-size: 0.98rem;
    }
    .footer a {
      color: #4a90e2;
      text-decoration: none;
      margin: 0 8px;
      font-size: 0.98rem;
    }
    @media (max-width: 700px) {
      .container {
        padding: 18px 0 10px 0;
      }
      .login-box {
        flex-direction: column;
        min-width: 0;
      }
      .login-social, .login-form {
        border-right: none;
        border-bottom: 1px solid #eee;
        padding: 22px 12px;
      }
      .login-form {
        border-bottom: none;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">
      CAREER <span class="path">PATH</span><br>RECOMMENDER
    </div>
    <div class="desc">
      A place to discover your future and make informed career choices
    </div>
    <div class="login-box">
      <div class="login-social">
        <button><img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google icon">Continue with Google</button>
        <button><img src="https://img.icons8.com/color/24/000000/facebook-new.png" alt="Facebook icon">Continue with Facebook</button>
        <a class="signup-link" href="{{ route('signup') }}">Sign up with email</a>
      </div>
      <div class="login-form">
        <form id="login-form" method="POST" action="{{ route('login.post') }}">
  @csrf
  <label for="username">Username or Email</label>
  <input type="text" id="username" name="username" placeholder="Enter username or email" required value="{{ old('username') }}">
  
  <label for="password">Password</label>
  <input type="password" id="password" name="password" placeholder="Your password" required>
  
  @if ($errors->any())
    <div class="error-message" style="display: block;">
      {{ $errors->first() }}
    </div>
  @endif
  
  <a class="forgot" href="#">Forgot password?</a>
  <button type="submit">Login</button>
</form>
      </div>
    </div>
    <div class="footer">
      <a href="#">About</a> ·
      <a href="#">Careers</a> ·
      <a href="#">Privacy</a> ·
      <a href="#">Terms</a> ·
      <a href="#">Contact</a>
      <br>
      © Career Path Recommender, 2023
    </div>
  </div>

</body>
</html>