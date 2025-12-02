<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Partner - User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #667eea;
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
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

        .info-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .edit-form {
            display: flex;
            gap: 10px;
        }

        .edit-form input {
            flex: 1;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .edit-form button {
            padding: 5px 10px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

        .resume-options {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .resume-btn {
            flex: 1;
            padding: 15px;
            border: 2px solid #667eea;
            background: white;
            color: #667eea;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .resume-btn:hover {
            background: #667eea;
            color: white;
        }

        .resume-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .resume-upload-area {
            display: none;
            border: 2px dashed #667eea;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: #f8f9ff;
            cursor: pointer;
            transition: all 0.3s;
        }

        .resume-upload-area:hover {
            background: #f0f2ff;
        }

        .resume-upload-area.active {
            display: block;
        }

        .resume-builder {
            display: none;
        }

        .resume-builder.active {
            display: block;
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

        /* AI Assistant */
        .ai-assistant {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .ai-button {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            box-shadow: 0 5px 20px rgba(245, 87, 108, 0.4);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            transition: all 0.3s;
            animation: pulse 2s infinite;
        }

        .ai-button:hover {
            transform: scale(1.1);
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 5px 20px rgba(245, 87, 108, 0.4); }
            50% { box-shadow: 0 5px 30px rgba(245, 87, 108, 0.6); }
        }

        .ai-chat {
            position: absolute;
            bottom: 90px;
            right: 0;
            width: 350px;
            height: 450px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
        }

        .ai-chat.active {
            display: flex;
        }

        .ai-chat-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 20px 20px 0 0;
            font-weight: 600;
        }

        .ai-chat-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .ai-message {
            background: #f5f7fa;
            padding: 12px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            max-width: 80%;
        }

        .ai-message.user {
            background: #667eea;
            color: white;
            margin-left: auto;
        }

        .ai-chat-input {
            display: flex;
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .ai-chat-input input {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 10px 15px;
            outline: none;
        }

        .ai-chat-input button {
            margin-left: 10px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
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

            .resume-options {
                flex-direction: column;
            }

            .ai-chat {
                width: 300px;
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
                <a href="homepage.html">Home</a>
                <a href="jobs.html">More Jobs</a>
                <a href="test.html">Test Now</a>
                <div class="user-menu">
                    <div class="user-icon-nav" onclick="toggleDropdown()">👤</div>
                    <div class="dropdown" id="userDropdown">
                        <a href="profile.html">Go Profile</a>
                        <a href="login.html">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">User Profile</h1>

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Avatar Section -->
            <div class="avatar-section">
                <div class="avatar-container">
                    <div class="user-avatar" id="userAvatar">😊</div>
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

            <!-- User Info -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-header">
                        <div class="info-label">Name</div>
                        <span class="edit-icon" onclick="editField('name')">✏️</span>
                    </div>
                    <div class="info-value" id="name-value">Sarah Johnson</div>
                    <div class="edit-form" id="name-edit" style="display: none;">
                        <input type="text" id="name-input" value="Sarah Johnson">
                        <button onclick="saveField('name')">Save</button>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-header">
                        <div class="info-label">Age</div>
                        <span class="edit-icon" onclick="editField('age')">✏️</span>
                    </div>
                    <div class="info-value" id="age-value">28 years old</div>
                    <div class="edit-form" id="age-edit" style="display: none;">
                        <input type="text" id="age-input" value="28 years old">
                        <button onclick="saveField('age')">Save</button>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-header">
                        <div class="info-label">Nationality</div>
                        <span class="edit-icon" onclick="editField('nationality')">✏️</span>
                    </div>
                    <div class="info-value" id="nationality-value">🇺🇸 United States</div>
                    <div class="edit-form" id="nationality-edit" style="display: none;">
                        <input type="text" id="nationality-input" value="🇺🇸 United States">
                        <button onclick="saveField('nationality')">Save</button>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-header">
                        <div class="info-label">Contact Info</div>
                        <span class="edit-icon" onclick="editField('contact')">✏️</span>
                    </div>
                    <div class="info-value" id="contact-value">sarah.j@email.com</div>
                    <div class="edit-form" id="contact-edit" style="display: none;">
                        <input type="text" id="contact-input" value="sarah.j@email.com">
                        <button onclick="saveField('contact')">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resume Section -->
        <div class="resume-section">
            <h2 class="section-title">📄 Resume</h2>
            <div class="resume-options">
                <button class="resume-btn" id="uploadBtn" onclick="showUpload()">Upload Resume</button>
                <button class="resume-btn" id="buildBtn" onclick="showBuilder()">Build Resume</button>
            </div>

            <!-- Upload Option -->
            <div class="resume-upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()">
                <div style="font-size: 3rem; margin-bottom: 10px;">📁</div>
                <div style="font-size: 1.2rem; font-weight: 600; margin-bottom: 10px;">Click to upload your resume</div>
                <div style="color: #666;">Supported formats: PDF, DOC, DOCX (Max 5MB)</div>
                <input type="file" id="fileInput" style="display: none;" accept=".pdf,.doc,.docx" onchange="handleFileUpload(event)">
                <div id="uploadStatus" style="margin-top: 15px; color: #667eea; font-weight: 600;"></div>
            </div>

            <!-- Builder Option -->
            <div class="resume-builder" id="builderArea">
                <div style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 30px; border-radius: 15px; text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 15px;">🛠️</div>
                    <div style="font-size: 1.2rem; font-weight: 600; margin-bottom: 10px;">Resume Builder</div>
                    <div style="color: #666; margin-bottom: 20px;">Create a professional resume in minutes with our guided builder</div>
                    <button style="padding: 12px 30px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 25px; font-weight: 600; cursor: pointer; font-size: 1rem;" onclick="alert('Resume builder coming soon! This will guide you through creating a professional resume step by step.')">Start Building</button>
                </div>
            </div>
        </div>

        <!-- Test Results Section -->
        <div class="test-results">
            <h2 class="section-title">🎯 Personality Test Results</h2>
            
            <div class="test-item">
                <div>
                    <div class="test-date">November 10, 2024 - 2:30 PM</div>
                    <div class="test-result">Recommended Career: Software Engineer</div>
                </div>
                <span class="mbti-badge">INTJ</span>
            </div>

            <div class="test-item">
                <div>
                    <div class="test-date">November 8, 2024 - 10:15 AM</div>
                    <div class="test-result">Recommended Career: Data Analyst</div>
                </div>
                <span class="mbti-badge">INTJ</span>
            </div>

            <div class="test-item">
                <div>
                    <div class="test-date">November 5, 2024 - 4:45 PM</div>
                    <div class="test-result">Recommended Career: UX Designer</div>
                </div>
                <span class="mbti-badge">INFJ</span>
            </div>

            <div class="test-item">
                <div>
                    <div class="test-date">November 1, 2024 - 11:20 AM</div>
                    <div class="test-result">Recommended Career: Product Manager</div>
                </div>
                <span class="mbti-badge">ENTJ</span>
            </div>
        </div>

        <!-- Job Apply List Section -->
        <div class="job-apply-list">
            <h2 class="section-title">📋 Job Application History</h2>
            <div id="applyList"></div>
        </div>

        <!-- Back Button -->
        <div class="back-button">
            <a href="homepage.html" class="back-btn">🏠 Back to Homepage</a>
        </div>
    </div>

    <!-- AI Assistant -->
    <div class="ai-assistant">
        <button class="ai-button" onclick="toggleAIChat()">🤖</button>
        <div class="ai-chat" id="aiChat">
            <div class="ai-chat-header">
                AI Resume Assistant 💼
            </div>
            <div class="ai-chat-body" id="chatBody">
                <div class="ai-message">
                    Hi Sarah! 👋 I'm your AI Resume Assistant. I can help you:
                    <br><br>
                    ✨ Improve your resume<br>
                    📝 Suggest better wording<br>
                    🎯 Tailor it for specific jobs<br>
                    💡 Highlight your strengths<br>
                    <br>
                    How can I help you today?
                </div>
            </div>
            <div class="ai-chat-input">
                <input type="text" id="userInput" placeholder="Ask me anything..." onkeypress="handleKeyPress(event)">
                <button onclick="sendMessage()">Send</button>
            </div>
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
            document.getElementById('avatarOptions').classList.remove('active');
        }

        // Edit functions
        function editField(field) {
            document.getElementById(field + '-value').style.display = 'none';
            document.getElementById(field + '-edit').style.display = 'flex';
        }

        function saveField(field) {
            const input = document.getElementById(field + '-input').value;
            document.getElementById(field + '-value').textContent = input;
            document.getElementById(field + '-value').style.display = 'block';
            document.getElementById(field + '-edit').style.display = 'none';
        }

        // Resume functions
        function showUpload() {
            document.getElementById('uploadArea').classList.add('active');
            document.getElementById('builderArea').classList.remove('active');
            document.getElementById('uploadBtn').classList.add('active');
            document.getElementById('buildBtn').classList.remove('active');
        }

        function showBuilder() {
            document.getElementById('builderArea').classList.add('active');
            document.getElementById('uploadArea').classList.remove('active');
            document.getElementById('buildBtn').classList.add('active');
            document.getElementById('uploadBtn').classList.remove('active');
        }

        function handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('uploadStatus').textContent = `✅ Uploaded: ${file.name}`;
            }
        }

        // AI Assistant functions
        function toggleAIChat() {
            const chat = document.getElementById('aiChat');
            chat.classList.toggle('active');
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function sendMessage() {
            const input = document.getElementById('userInput');
            const message = input.value.trim();
            
            if (message) {
                const chatBody = document.getElementById('chatBody');
                
                // Add user message
                const userMsg = document.createElement('div');
                userMsg.className = 'ai-message user';
                userMsg.textContent = message;
                chatBody.appendChild(userMsg);
                
                input.value = '';
                
                // Simulate AI response
                setTimeout(() => {
                    const aiMsg = document.createElement('div');
                    aiMsg.className = 'ai-message';
                    
                    const responses = [
                        "That's a great question! For your resume, I'd recommend highlighting your technical skills and project experience more prominently. 💼",
                        "Based on your INTJ personality type, you excel at strategic thinking. Make sure your resume showcases your problem-solving abilities! 🎯",
                        "Your resume looks good! Consider adding more quantifiable achievements. For example, 'Increased efficiency by 30%' instead of 'Improved efficiency'. 📈",
                        "I notice you have strong experience in your field. Have you thought about adding a professional summary at the top? It really helps! ✨",
                        "Great! For the Software Engineer role, emphasize your coding projects and technologies you've worked with. Employers love concrete examples! 🚀"
                    ];
                    
                    aiMsg.textContent = responses[Math.floor(Math.random() * responses.length)];
                    chatBody.appendChild(aiMsg);
                    chatBody.scrollTop = chatBody.scrollHeight;
                }, 1000);
                
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        }

        // Job Apply List
        const applyListKey = 'appliedJobs';
        
        function renderApplyList() {
            const list = document.getElementById('applyList');
            list.innerHTML = '';
            
            const applications = JSON.parse(localStorage.getItem(applyListKey)) || [];
            
            if (applications.length === 0) {
                list.innerHTML = '<p class="no-applications">No job applications yet</p>';
                return;
            }
            
            applications.forEach((app, index) => {
                const item = document.createElement('div');
                item.className = 'apply-item';
                item.innerHTML = `
                    <div class="apply-info">
                        <div class="apply-job-name">${app.jobName}</div>
                        <div class="apply-company">at ${app.company}</div>
                        <div class="apply-date">Applied on ${app.date}</div>
                    </div>
                    <button class="erase-btn" onclick="eraseApplication(${index})">Erase</button>
                `;
                list.appendChild(item);
            });
        }

        function eraseApplication(index) {
            if (confirm('Are you sure you want to erase this application?')) {
                let applications = JSON.parse(localStorage.getItem(applyListKey)) || [];
                applications.splice(index, 1);
                localStorage.setItem(applyListKey, JSON.stringify(applications));
                renderApplyList();
            }
        }

        // Initialize with sample data if none exists
        if (!localStorage.getItem(applyListKey)) {
            const sampleApps = [
                { jobName: 'Senior Frontend Developer', company: 'TechGrow Solutions', date: 'November 14, 2025' },
                { jobName: 'Marketing Manager', company: 'Green Innovations', date: 'November 12, 2025' },
                { jobName: 'UX Designer', company: 'Design Corp', date: 'November 10, 2025' }
            ];
            localStorage.setItem(applyListKey, JSON.stringify(sampleApps));
        }

        // Render on load
        window.onload = renderApplyList;
    </script>
</body>
</html>