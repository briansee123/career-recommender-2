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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            color: #333;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating elements */
        .floating-circles { position: fixed; width: 100%; height: 100%; overflow: hidden; z-index: 0; pointer-events: none; }
        .circle { position: absolute; border-radius: 50%; background: rgba(255, 255, 255, 0.1); animation: float 20s infinite ease-in-out; }
        .circle:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .circle:nth-child(2) { width: 120px; height: 120px; top: 60%; right: 10%; animation-delay: 5s; }
        .circle:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 10s; }
        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-30px) translateX(20px); }
            50% { transform: translateY(-60px) translateX(-20px); }
            75% { transform: translateY(-30px) translateX(20px); }
        }

        /* Navigation */
        .navbar { position: sticky; top: 0; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 15px 0; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1); z-index: 1000; }
        .nav-container { max-width: 1400px; margin: 0 auto; padding: 0 30px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.8rem; font-weight: 700; color: #667eea; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: #667eea; }
        .user-menu { position: relative; }
        .user-icon-nav { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; cursor: pointer; transition: transform 0.3s; font-size: 1.2rem; }
        .user-icon-nav:hover { transform: scale(1.1); }
        .dropdown { position: absolute; top: 50px; right: 0; background: white; border-radius: 10px; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15); min-width: 160px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s; z-index: 10000; }
        .dropdown.active { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown a { display: block; padding: 12px 20px; color: #555; text-decoration: none; transition: background 0.3s; }
        .dropdown a:hover { background: #f5f5f5; }

        /* Main Container */
        .container { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        .page-title { text-align: center; color: white; font-size: 2.5rem; margin-bottom: 40px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); }

        /* Success Message */
        .success-message { background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb; display: flex; align-items: center; gap: 10px; }
        .error-message { background: #f8d7da; color: #721c24; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; }

        /* Profile Card */
        .profile-card { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }
        .avatar-section { text-align: center; margin-bottom: 40px; }
        .avatar-container { position: relative; display: inline-block; }
        .user-avatar { width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white; margin: 0 auto; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15); }
        .change-avatar-btn { position: absolute; bottom: 5px; right: 5px; width: 40px; height: 40px; border-radius: 50%; background: #f093fb; border: 3px solid white; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: transform 0.3s; }
        .change-avatar-btn:hover { transform: scale(1.1); }
        .avatar-options { display: none; margin-top: 20px; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .avatar-options.active { display: flex; }
        .avatar-option { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #f5f7fa, #c3cfe2); display: flex; align-items: center; justify-content: center; font-size: 2rem; cursor: pointer; transition: all 0.3s; border: 3px solid transparent; }
        .avatar-option:hover { transform: scale(1.1); border-color: #667eea; }

        /* Info Grid */
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .info-item { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 20px; border-radius: 15px; }
        .info-label { font-size: 0.9rem; color: #666; margin-bottom: 5px; }

        /* Resume Section */
        .resume-section { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }
        .section-title { font-size: 1.8rem; color: #667eea; margin-bottom: 20px; font-weight: 600; }

        /* AI Card Styles */
        .ai-encouragement-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); border-radius: 20px; padding: 30px; margin: 20px 0; text-align: center; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3); color: white; display: none; }
        .encouragement-icon { font-size: 3rem; margin-bottom: 15px; animation: pulse 2s infinite; }
        .encouragement-text { font-size: 1.3rem; font-weight: 600; margin-bottom: 20px; line-height: 1.6; }
        .completion-bar { background: rgba(255, 255, 255, 0.3); height: 12px; border-radius: 20px; overflow: hidden; margin-bottom: 10px; }
        .completion-fill { background: linear-gradient(90deg, #ffd700, #ff8c00); height: 100%; border-radius: 20px; transition: width 1s ease; }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }

        /* Test & Apply Lists */
        .test-results, .job-apply-list { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); margin-bottom: 30px; }
        .test-item, .apply-item { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 20px; border-radius: 15px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; }
        .mbti-badge { background: #f093fb; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem; font-weight: 600; }
        
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-left: 10px; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-reviewed { background: #cfe2ff; color: #084298; }
        .status-accepted { background: #d1e7dd; color: #0a3622; }
        .status-rejected { background: #f8d7da; color: #721c24; }
        
        .erase-btn { padding: 8px 16px; background: #e53935; color: white; border: none; border-radius: 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .erase-btn:hover { background: #d32f2f; }

        .back-btn { background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 20px 80px; font-size: 1.3rem; font-weight: 600; border-radius: 50px; cursor: pointer; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3); text-decoration: none; display: inline-block; }
        
        @media (max-width: 768px) { .container { padding: 20px 10px; } .info-grid { grid-template-columns: 1fr; } }
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

        <!-- AI Encouragement Section -->
        <div class="ai-encouragement-card" id="aiEncouragementCard">
            <div class="encouragement-icon">💜</div>
            <div class="encouragement-text" id="encouragementText">Loading your personalized message...</div>
            <div class="completion-bar">
                <div class="completion-fill" id="completionFill" style="width: 0%"></div>
            </div>
            <div class="completion-label" id="completionLabel">0% Complete</div>
        </div>

        @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="error-message">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <!-- 1. Profile Card (Avatar & Info) -->
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
                
                <div style="text-align: center;">
                    <button type="submit" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 12px 40px; border-radius: 25px; font-weight: 600; cursor: pointer; font-size: 1rem;">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. Resume Section (Updated) -->
        <div class="resume-section">
            <h2 class="section-title">📄 Resume Management</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
                
                <!-- A. Uploaded File Resume -->
                <div style="background: #f8f9ff; padding: 25px; border-radius: 15px; border: 2px dashed #667eea;">
                    <h3 style="color: #4a5568; font-size: 1.2rem; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-file-upload"></i> Uploaded Resume File
                    </h3>

                    @if(auth()->user()->resume_path)
                        <!-- File Exists State -->
                        <div style="text-align: center; padding: 20px 0;">
                            <div style="font-size: 3rem; color: #e53e3e; margin-bottom: 10px;">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <p style="color: #667eea; font-weight: 600; margin-bottom: 5px;">Resume Uploaded</p>
                            <p style="color: #718096; font-size: 0.85rem; margin-bottom: 20px;">
                                Uploaded on {{ auth()->user()->updated_at->format('M d, Y') }}
                            </p>
                            
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <a href="{{ Storage::url(auth()->user()->resume_path) }}" target="_blank" style="background: #667eea; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600;">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                
                                <button onclick="document.getElementById('update-resume-form').style.display='block'; this.style.display='none';" style="background: #ecc94b; color: #744210; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600;">
                                    <i class="fas fa-sync-alt"></i> Update
                                </button>

                                <form action="{{ route('profile.deleteResumeFile') }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete your resume file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #fc8181; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 600;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Hidden Update Form -->
                            <div id="update-resume-form" style="display: none; margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 15px;">
                                <form action="{{ route('profile.uploadResume') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="resume" accept=".pdf,.doc,.docx" required style="font-size: 0.9rem; margin-bottom: 10px; width: 100%;">
                                    <button type="submit" style="background: #48bb78; color: white; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;">Upload New File</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- No File State -->
                        <div style="text-align: center; padding: 20px 0;">
                            <p style="color: #718096; margin-bottom: 15px;">Upload your existing resume (PDF/DOCX)</p>
                            <form action="{{ route('profile.uploadResume') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="margin-bottom: 15px;">
                                    <input type="file" name="resume" accept=".pdf,.doc,.docx" required style="font-size: 0.9rem; margin-left: 20px;">
                                </div>
                                <button type="submit" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 10px 25px; border-radius: 25px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">
                                    <i class="fas fa-cloud-upload-alt"></i> Upload Resume
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- B. Digital Resume Builder -->
                <div style="background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%); padding: 25px; border-radius: 15px; border: 1px solid #cbd5e0;">
                    <h3 style="color: #2d3748; font-size: 1.2rem; margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-magic"></i> Digital Resume Profile
                    </h3>

                    @if(auth()->user()->resume)
                        <!-- Digital Resume Exists -->
                        <div>
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                                <div style="width: 60px; height: 60px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                    @if(auth()->user()->resume->photo)
                                        <img src="{{ Storage::url(auth()->user()->resume->photo) }}" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                                    @else
                                        💼
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: #2d3748; font-size: 1.1rem;">{{ auth()->user()->resume->job_title }}</div>
                                    <div style="font-size: 0.85rem; color: #718096;">Updated: {{ auth()->user()->resume->updated_at->diffForHumans() }}</div>
                                </div>
                            </div>

                            <div style="background: white; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; color: #4a5568; max-height: 100px; overflow: hidden; position: relative;">
                                <strong>Summary:</strong> {{ auth()->user()->resume->summary ?? 'No summary added yet.' }}
                                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 30px; background: linear-gradient(to bottom, transparent, white);"></div>
                            </div>

                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('buildresume') }}" style="flex: 1; text-align: center; background: #4299e1; color: white; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                                <form action="{{ route('profile.deleteResumeRecord') }}" method="POST" onsubmit="return confirm('Delete your digital resume profile? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: white; color: #e53e3e; border: 1px solid #e53e3e; padding: 10px 15px; border-radius: 8px; cursor: pointer; font-size: 0.9rem;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- No Digital Resume -->
                        <div style="text-align: center; padding: 30px 0;">
                            <div style="font-size: 2.5rem; margin-bottom: 15px;">🚀</div>
                            <p style="color: #4a5568; margin-bottom: 20px; font-size: 0.95rem;">
                                Don't have a resume file? <br>Build a professional digital profile in minutes!
                            </p>
                            <a href="{{ route('buildresume') }}" style="display: inline-block; background: linear-gradient(135deg, #4299e1 0%, #667eea 100%); color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none; font-weight: 700; box-shadow: 0 4px 10px rgba(66, 153, 225, 0.4); transition: transform 0.2s;">
                                ✨ Build Resume Now
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- 3. Test Results Section -->
        <div class="test-results">
            <h2 class="section-title">🎯 Personality Test Results</h2>
            
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

        <!-- 4. Job Applications Section -->
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
            <p style="text-align: center; color: #666; font-style: italic;">
                No job applications yet. 
                <a href="{{ route('jobs') }}" style="color: #667eea; font-weight: 600;">Browse jobs!</a>
            </p>
            @endforelse
        </div>

        <!-- Back Button -->
        <div style="text-align: center; margin-top: 40px; margin-bottom: 60px;">
            <a href="{{ route('homepage') }}" class="back-btn">🏠 Back to Homepage</a>
        </div>
    </div>

    <script>
        // Dropdown toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

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

        // AI Encouragement
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/ai/profile-encouragement', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('encouragementText').textContent = data.message;
                    document.getElementById('completionFill').style.width = data.completion + '%';
                    document.getElementById('completionLabel').textContent = data.completion + '% Complete';
                    document.getElementById('aiEncouragementCard').style.display = 'block';
                }
            })
            .catch(error => {
                console.log('AI encouragement not loaded:', error);
            });
        });
    </script>
</body>
</html>