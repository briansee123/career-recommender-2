<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job - Career Path Recommender</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating Circles Animation */
        .floating-circles {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }
        .circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 5s;
        }
        .circle:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-30px) translateX(20px); }
            50% { transform: translateY(-60px) translateX(-20px); }
            75% { transform: translateY(-30px) translateX(20px); }
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #667eea;
        }
        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #667eea;
        }
        .user-menu {
            position: relative;
        }
        .user-icon-nav {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
            font-size: 1.2rem;
        }
        .user-icon-nav:hover {
            transform: scale(1.1);
        }
        .dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            min-width: 160px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 10000;
        }
        .dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown a {
            display: block;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            transition: background 0.3s;
        }
        .dropdown a:hover {
            background: #f5f5f5;
        }

        /* Main Container */
        .apply-container {
            position: relative;
            z-index: 1;
            max-width: 700px;
            width: 100%;
            margin: 60px auto;
            padding: 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 20px;
            transition: 0.3s;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
        }
        .back-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-5px);
        }

        .apply-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 50px 40px;
            position: relative;
            overflow: hidden;
        }

        .apply-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        }

        .apply-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
            text-align: center;
        }

        .job-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #764ba2;
            margin-bottom: 15px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .slogan {
            color: #999;
            font-size: 1.1rem;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            background: #f8f9ff;
            border: 2px solid #e0e7ff;
            border-radius: 15px;
            color: #333;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Quicksand', sans-serif;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        /* Resume Section */
        .resume-section {
            background: linear-gradient(135deg, #f8f9ff 0%, #e0e7ff 100%);
            border: 2px dashed #667eea;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        .resume-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .resume-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 10px;
        }

        .resume-subtext {
            color: #999;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .choose-file-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 12px 35px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            border: none;
            font-size: 1rem;
        }

        .choose-file-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .file-name {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #667eea;
            font-weight: 600;
        }

        .build-resume-link {
            margin-top: 15px;
            display: block;
            color: #f093fb;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .build-resume-link:hover {
            color: #764ba2;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            flex: 1;
            padding: 18px 0;
            border: none;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .back-btn {
            background: #f5f5f5;
            color: #666;
        }

        .back-btn:hover {
            background: #e0e0e0;
            transform: translateY(-3px);
        }

        /* Success Message */
        .success-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px 30px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: none;
            align-items: center;
            gap: 12px;
            z-index: 10000;
            animation: slideIn 0.4s ease;
        }

        .success-toast.show {
            display: flex;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .apply-card {
                padding: 40px 25px;
            }
            .btn-group {
                flex-direction: column;
            }
            .nav-links {
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background -->
    <div class="floating-circles">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <!-- Header -->
    <header>
        <div class="nav-container">
            <div class="logo">JOB PARTNER</div>
            <div class="nav-links">
                <a href="{{ route('homepage') }}">Home</a>
                <a href="{{ route('jobs') }}">More Jobs</a>
                <a href="{{ route('test') }}">Test Now</a>
                <div class="user-menu">
                    <div class="user-icon-nav" onclick="toggleDropdown()">
                        {{ auth()->user()->avatar ?? '👤' }}
                    </div>
                    <div class="dropdown" id="userDropdown">
                        <a href="{{ route('profile') }}">Go Profile</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="apply-container">
        <a href="{{ route('jobs') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Jobs
        </a>

        <div class="apply-card">
            <h1 class="apply-title">Apply for Position</h1>
            <div class="job-name">
                <i class="fas fa-briefcase"></i>
                {{ $job->title }}
            </div>
            <p class="slogan">✨ We'll help you take the next step in your career journey ✨</p>

            <form action="{{ route('apply.submit') }}" method="POST" enctype="multipart/form-data" id="apply-form">
                @csrf
                <input type="hidden" name="job_listing_id" value="{{ $job->id }}">

                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" id="name" name="full_name" value="{{ auth()->user()->name }}" required placeholder="e.g. Alex Tan">
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required placeholder="alex@example.com">
                </div>

                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}" required placeholder="+60 12-345 6789">
                </div>

                <!-- Resume Section -->
                <div class="resume-section">
                    <div class="resume-icon"><i class="fas fa-file-upload"></i></div>
                    <div class="resume-text">Upload Your Resume</div>
                    <div class="resume-subtext">PDF, DOC, DOCX (Max 5MB)</div>
                    
                    <div class="file-input-wrapper">
                        <label for="resume-file" class="choose-file-btn">
                            <i class="fas fa-cloud-upload-alt"></i> Choose File
                        </label>
                        <input type="file" id="resume-file" name="resume" accept=".pdf,.doc,.docx" onchange="showFileName()">
                    </div>
                    
                    <div class="file-name" id="file-name"></div>
                    
                    <a href="{{ route('buildresume') }}" class="build-resume-link">
                        <i class="fas fa-magic"></i> Or build one with our AI Resume Builder
                    </a>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn submit-btn">
                        <i class="fas fa-paper-plane"></i> Submit Application
                    </button>
                    <button type="button" class="btn back-btn" onclick="history.back()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Toast -->
    <div class="success-toast" id="toast">
        <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>
        <span>Application submitted successfully!</span>
    </div>

    <script>
        // Dropdown toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.user-icon-nav')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown.classList.contains('active')) {
                    dropdown.classList.remove('active');
                }
            }
        }

        // Show file name
        function showFileName() {
            const input = document.getElementById('resume-file');
            const fileNameDiv = document.getElementById('file-name');
            if (input.files.length > 0) {
                fileNameDiv.textContent = '✓ ' + input.files[0].name;
            }
        }

        // Show success message if redirected with success
        @if(session('success'))
        document.getElementById('toast').classList.add('show');
        setTimeout(() => {
            document.getElementById('toast').classList.remove('show');
        }, 3000);
        @endif
    </script>
</body>
</html>