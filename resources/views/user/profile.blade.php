<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Partner - User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            color: #333;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating elements */
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

        /* Navigation */
        .navbar {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
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
            position: relative;
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

        .dropdown a:first-child {
            border-radius: 10px 10px 0 0;
        }

        .dropdown a:last-child {
            border-radius: 0 0 10px 10px;
        }

        .dropdown a:hover {
            background: #f5f5f5;
        }

        /* Main Container */
        .container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-title {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Success Message */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        /* User Avatar Section */
        .avatar-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .avatar-container {
            position: relative;
            display: inline-block;
        }

        .user-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
            margin: 0 auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .change-avatar-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f093fb;
            border: 3px solid white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .change-avatar-btn:hover {
            transform: scale(1.1);
        }

        .avatar-options {
            display: none;
            margin-top: 20px;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .avatar-options.active {
            display: flex;
        }

        .avatar-option {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            cursor: pointer;
            transition: all 0.3s;
            border: 3px solid transparent;
        }

        .avatar-option:hover {
            transform: scale(1.1);
            border-color: #667eea;
        }

        /* User Info Section */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 15px;
        }

        .info-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
        }

        .edit-icon {
            cursor: pointer;
            font-size: 1rem;
            color: #667eea;
            float: right;
        }

        /* Resume Section */
        .resume-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.8rem;
            color: #667eea;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .resume-upload-area {
            border: 2px dashed #667eea;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: #f8f9ff;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .resume-upload-area:hover {
            background: #f0f2ff;
        }

        /* Test Results Section */
        .test-results {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .test-item {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .test-date {
            color: #666;
            font-size: 0.9rem;
        }

        .test-result {
            font-weight: 600;
            color: #667eea;
            font-size: 1.1rem;
        }

        .mbti-badge {
            background: #f093fb;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Job Apply List Section */
        .job-apply-list {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .apply-item {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .apply-info {
            flex: 1;
        }

        .apply-job-name {
            font-weight: 600;
            color: #667eea;
            font-size: 1.1rem;
        }

        .apply-company {
            color: #666;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .apply-date {
            color: #888;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-reviewed {
            background: #cfe2ff;
            color: #084298;
        }

        .status-accepted {
            background: #d1e7dd;
            color: #0a3622;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .erase-btn {
            padding: 8px 16px;
            background: #e53935;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .erase-btn:hover {
            background: #d32f2f;
        }

        .no-applications {
            text-align: center;
            color: #666;
            font-style: italic;
        }

        /* Back Button */
        .back-button {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 60px;
        }

        .back-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 20px 80px;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px 10px;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-links a {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-circles">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
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
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">User Profile</h1>

        @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Avatar Section -->
            <div class="avatar-section">
                <div class="avatar-container">
                    <div class="user-avatar" id="userAvatar">{{ auth()->user()->avatar ?? '😊' }}</div>
                    <div class="change-avatar-btn" onclick="toggleAvatarOptions()">✏️</div>
                </div>
                <div class="avatar-options" id="avatarOptions">
                    <div class="avatar-option" onclick="changeAvatar('😊')">😊</div>
                    <div class="avatar-option" onclick="changeAvatar('😎')">😎</div>
                    <div class="avatar-option" onclick="changeAvatar('🤓')">🤓</div>
                    <div class="avatar-option" onclick="changeAvatar('🌟')">🌟</div>
                    <div class="avatar-option" onclick="changeAvatar('🚀')">🚀</div>
                    <div class="avatar-option" onclick="changeAvatar('💼')">💼</div>
                    <div class="avatar-option" onclick="changeAvatar('🎯')">🎯</div>
                    <div class="avatar-option" onclick="changeAvatar('🌈')">🌈</div>
                </div>
            </div>

            <!-- User Info Form -->
            <form action="{{ route('profile.update') }}" method="POST" id="profile-form">
                @csrf
                <input type="hidden" name="avatar" id="avatar-input" value="{{ auth()->user()->avatar ?? '😊' }}">
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Name</div>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" 
                               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 1.2rem; font-weight: 600;">
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" 
                               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 1.2rem; font-weight: 600;">
                    </div>
                    <div class="info-item">
                        <div class="info-label">Age</div>
                        <input type="text" name="age" value="{{ auth()->user()->age }}" placeholder="e.g. 25 years old"
                               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 1.2rem; font-weight: 600;">
                    </div>
                    <div class="info-item">
                        <div class="info-label">Nationality</div>
                        <input type="text" name="nationality" value="{{ auth()->user()->nationality }}" placeholder="e.g. Malaysian"
                               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 1.2rem; font-weight: 600;">
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone</div>
                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" placeholder="+60 12-345 6789"
                               style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 1.2rem; font-weight: 600;">
                    </div>
                </div>
                
                <button type="submit" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 12px 40px; border-radius: 25px; font-weight: 600; cursor: pointer; font-size: 1rem;">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>

        <!-- Resume Section -->
<div class="resume-section">
    <h2 class="section-title">📄 Resume</h2>
    
    @if(auth()->user()->resume)
        <div style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 25px; border-radius: 15px; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <div>
                    <h3 style="color: #667eea; font-size: 1.3rem; margin-bottom: 5px;">
                        {{ auth()->user()->resume->job_title }}
                    </h3>
                    <p style="color: #666; font-size: 0.95rem;">
                        Last updated: {{ auth()->user()->resume->updated_at->format('M d, Y') }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('buildresume') }}" style="background: #667eea; color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-block; margin-right: 10px;">
                        ✏️ Edit Resume
                    </a>
                    <button onclick="alert('Download feature coming soon!')" style="background: #10b981; color: white; padding: 10px 20px; border-radius: 10px; border: none; font-weight: 600; cursor: pointer;">
                        📥 Download PDF
                    </button>
                </div>
            </div>
            
            <!-- Resume Preview -->
            <div style="background: white; padding: 20px; border-radius: 12px;">
                <div style="border-bottom: 2px solid #667eea; padding-bottom: 10px; margin-bottom: 15px;">
                    <h4 style="color: #333; font-size: 1.1rem;">Personal Information</h4>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; font-size: 0.9rem;">
                    <div>
                        <strong>Name:</strong> {{ auth()->user()->resume->first_name }} {{ auth()->user()->resume->last_name }}
                    </div>
                    <div>
                        <strong>Email:</strong> {{ auth()->user()->resume->email }}
                    </div>
                    <div>
                        <strong>Phone:</strong> {{ auth()->user()->resume->phone ?? 'Not provided' }}
                    </div>
                    <div>
                        <strong>Location:</strong> {{ auth()->user()->resume->city ?? 'Not provided' }}, {{ auth()->user()->resume->country ?? 'Malaysia' }}
                    </div>
                </div>
                
                @if(auth()->user()->resume->summary)
                <div style="margin-top: 20px;">
                    <div style="border-bottom: 2px solid #667eea; padding-bottom: 10px; margin-bottom: 15px;">
                        <h4 style="color: #333; font-size: 1.1rem;">Professional Summary</h4>
                    </div>
                    <p style="color: #555; line-height: 1.6;">{{ auth()->user()->resume->summary }}</p>
                </div>
                @endif
                
                @if(auth()->user()->resume->experience_company)
                <div style="margin-top: 20px;">
                    <div style="border-bottom: 2px solid #667eea; padding-bottom: 10px; margin-bottom: 15px;">
                        <h4 style="color: #333; font-size: 1.1rem;">Work Experience</h4>
                    </div>
                    <div>
                        <strong style="color: #667eea;">{{ auth()->user()->resume->experience_title }}</strong>
                        <div style="color: #666; font-size: 0.9rem; margin: 5px 0;">
                            {{ auth()->user()->resume->experience_company }} | {{ auth()->user()->resume->experience_duration }}
                        </div>
                        <p style="color: #555; margin-top: 8px;">{{ auth()->user()->resume->experience_description }}</p>
                    </div>
                </div>
                @endif
                
                @if(auth()->user()->resume->education_institution)
                <div style="margin-top: 20px;">
                    <div style="border-bottom: 2px solid #667eea; padding-bottom: 10px; margin-bottom: 15px;">
                        <h4 style="color: #333; font-size: 1.1rem;">Education</h4>
                    </div>
                    <div>
                        <strong style="color: #667eea;">{{ auth()->user()->resume->education_degree }}</strong>
                        <div style="color: #666; font-size: 0.9rem; margin: 5px 0;">
                            {{ auth()->user()->resume->education_institution }} | {{ auth()->user()->resume->education_year }}
                        </div>
                    </div>
                </div>
                @endif
                
                @if(auth()->user()->resume->skills)
                <div style="margin-top: 20px;">
                    <div style="border-bottom: 2px solid #667eea; padding-bottom: 10px; margin-bottom: 15px;">
                        <h4 style="color: #333; font-size: 1.1rem;">Skills</h4>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        @foreach(explode(',', auth()->user()->resume->skills) as $skill)
                            <span style="background: #667eea; color: white; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    @else
        <div class="resume-options">
            <p style="text-align: center; color: #666; margin-bottom: 20px; font-size: 1.1rem;">
                You haven't created a resume yet. Build one now to apply for jobs!
            </p>
            <a href="{{ route('buildresume') }}" style="display: block; text-align: center; background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 15px 30px; border-radius: 15px; text-decoration: none; font-weight: 600; font-size: 1.1rem;">
                🛠️ Build Your Resume Now
            </a>
        </div>
    @endif
</div>

        <!-- Test Results Section -->
        <div class="test-results">
            <h2 class="section-title">🎯 Personality Test Results (Latest 3)</h2>
            
            @forelse($testHistory as $test)
            <div class="test-item">
                <div>
                    <div class="test-date">{{ $test->created_at->format('F d, Y - g:i A') }}</div>
                    <div class="test-result">{{ Str::limit($test->ai_recommendations, 100) }}</div>
                </div>
                <span class="mbti-badge">{{ $test->mbti_type }}</span>
            </div>
            @empty
            <p style="text-align: center; color: #666; font-style: italic;">No test results yet. <a href="{{ route('test') }}" style="color: #667eea;">Take the test now!</a></p>
            @endforelse
        </div>

        <!-- Job Apply List Section -->
        <div class="job-apply-list">
            <h2 class="section-title">📋 Job Application History</h2>
            
            @forelse($applications as $application)
            <div class="apply-item">
                <div class="apply-info">
                    <div class="apply-job-name">{{ $application->jobListing->title }}</div>
                    <div class="apply-company">at {{ $application->jobListing->company }}</div>
                    <div class="apply-date">Applied on {{ $application->created_at->format('F d, Y') }}</div>
                </div>
                <div>
                    <span class="status-badge status-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
                    <form action="{{ route('profile.deleteApplication', $application->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="erase-btn" onclick="return confirm('Are you sure you want to delete this application?')">Erase</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="no-applications">
                No job applications yet. 
                <a href="{{ route('jobs') }}" style="color: #667eea; font-weight: 600;">Browse jobs!</a>
            </p>
            @endforelse
        </div>

        <!-- Back Button -->
        <div class="back-button">
            <a href="{{ route('homepage') }}" class="back-btn">🏠 Back to Homepage</a>
        </div>
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

        // Avatar functions
        function toggleAvatarOptions() {
            const options = document.getElementById('avatarOptions');
            options.classList.toggle('active');
        }

        function changeAvatar(emoji) {
            document.getElementById('userAvatar').textContent = emoji;
            document.getElementById('avatar-input').value = emoji;
            document.getElementById('avatarOptions').classList.remove('active');
            document.getElementById('profile-form').submit();
        }
    </script>
</body>
</html>