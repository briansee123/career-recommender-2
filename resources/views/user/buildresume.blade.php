<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your Resume - Career Path Recommender</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(-45deg, #fdf2f8, #dbefff, #fdfad6, #e6f7ff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #2d3436;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ====================== HEADER ====================== */
        header {
            background: #0f172a;
            padding: 14px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.4rem;
            color: #fff;
        }
        .logo img { height: 36px; border-radius: 8px; }
        .logo .title {
            background: linear-gradient(90deg, #fd79a8, #a29bfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .search-bar {
            flex: 1;
            max-width: 500px;
            display: flex;
            background: #1e293b;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .search-bar input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            background: transparent;
            color: #fff;
            font-size: 1rem;
        }
        .search-bar input::placeholder { color: #94a3b8; }
        .search-bar button {
            background: #10b981;
            color: white;
            border: none;
            padding: 0 18px;
            cursor: pointer;
            transition: 0.2s;
        }
        .search-bar button:hover { background: #059669; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .nav-links a {
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            color: #94a3b8;
            transition: all 0.2s;
        }
        .nav-links a:hover {
            background: #1e293b;
            color: #e2e8f0;
        }
        .nav-links a.active {
            background: #3b82f6;
            color: white;
        }

        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-icon {
            width: 40px;
            height: 40px;
            background: #fd79a8;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .user-icon:hover { background: #f43f5e; }
        .dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: #1e293b;
            border-radius: 12px;
            min-width: 180px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown a {
            display: block;
            padding: 12px 16px;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.95rem;
            transition: 0.2s;
        }
        .dropdown a:hover { background: #334155; }
        .dropdown a.logout { color: #f87171; border-top: 1px solid #334155; }

        /* ====================== MAIN CONTENT ====================== */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            max-width: 1200px;
            width: 100%;
            background: rgba(255, 255, 255, 0.92);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Left Panel */
        .form-panel { padding: 40px; display: flex; flex-direction: column; justify-content: space-between; }
        .progress-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .score { font-size: 0.95rem; font-weight: 600; color: #e11d48; display: flex; align-items: center; gap: 6px; }
        .score-bar { width: 80px; height: 6px; background: #fee2e2; border-radius: 3px; overflow: hidden; }
        .score-fill { height: 100%; background: #ef4444; width: 10%; border-radius: 3px; transition: width 0.5s ease; }
        .add-job { font-size: 0.9rem; color: #16a34a; font-weight: 600; display: flex; align-items: center; gap: 6px; }

        .customize-btn {
            background: #3b82f6; color: white; border: none; padding: 8px 16px; border-radius: 12px;
            font-weight: 600; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; gap: 6px;
            transition: 0.2s;
        }
        .customize-btn:hover { background: #2563eb; transform: translateY(-1px); }

        .section-title { font-size: 1.4rem; font-weight: 700; margin: 24px 0 16px; color: #1e293b; }
        .section-desc { font-size: 0.9rem; color: #64748b; margin-bottom: 20px; }

        .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        .input-group { margin-bottom: 16px; }
        .input-group label { display: block; font-weight: 600; color: #475569; margin-bottom: 6px; font-size: 0.95rem; }
        .input-group input, .input-group textarea {
            width: 100%; padding: 12px 14px; border: 1.5px solid #e2e8f0; border-radius: 12px;
            background: #f8fafc; font-size: 1rem; transition: all 0.3s ease;
        }
        .input-group input:focus, .input-group textarea:focus {
            outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        textarea { resize: vertical; min-height: 80px; }

        .photo-upload { display: flex; align-items: center; gap: 16px; margin: 16px 0; }
        .photo-preview {
            width: 80px; height: 80px; border-radius: 50%; background: #e2e8f0;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
            border: 3px dashed #94a3b8;
        }
        .photo-preview img { width: 100%; height: 100%; object-fit: cover; }
        .upload-link { color: #3b82f6; font-weight: 600; cursor: pointer; }

        .btn-group { display: flex; gap: 12px; margin-top: 32px; }
        .btn { flex: 1; padding: 14px 0; border: none; border-radius: 14px; font-weight: 600; font-size: 1.05rem; cursor: pointer; transition: all 0.3s ease; }
        .next-btn { background: #3b82f6; color: white; }
        .next-btn:hover { background: #2563eb; transform: translateY(-2px); }
        .save-btn { background: #e2e8f0; color: #475569; }
        .save-btn:hover { background: #cbd5e1; }

        .terms {
            font-size: 0.8rem; color: #94a3b8; text-align: center; margin-top: 20px;
        }
        .terms a { color: #3b82f6; text-decoration: none; }

        /* Right Panel - Preview */
        .preview-panel { background: #f8fafc; padding: 40px; border-left: 1px solid #e2e8f0; display: flex; flex-direction: column; }
        .resume-preview { background: white; padding: 32px; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .preview-header { text-align: center; margin-bottom: 24px; }
        .preview-name { font-size: 1.8rem; font-weight: 700; color: #1e293b; }
        .preview-title { font-size: 1.1rem; color: #64748b; margin-top: 4px; }
        .preview-contact { display: flex; justify-content: center; gap: 16px; margin-top: 12px; font-size: 0.9rem; color: #475569; }
        .preview-section { margin-top: 24px; }
        .preview-section h3 { font-size: 1.2rem; font-weight: 700; color: #1e293b; border-bottom: 2px solid #3b82f6; padding-bottom: 6px; margin-bottom: 12px; }
        .preview-item { margin-bottom: 16px; }
        .preview-item h4 { font-weight: 600; color: #1e293b; }
        .preview-item p { font-size: 0.9rem; color: #64748b; margin-top: 2px; }

        /* ====================== FOOTER ====================== */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 30px 20px;
            font-size: 0.9rem;
            text-align: center;
        }
        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }
        .footer-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: 0.2s;
        }
        .footer-links a:hover { color: #e2e8f0; }
        .copyright {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .container { grid-template-columns: 1fr; }
            .preview-panel { order: -1; padding: 24px; }
        }
        @media (max-width: 768px) {
            .header-container { flex-direction: column; align-items: stretch; }
            .search-bar { max-width: 100%; }
            .nav-links { justify-content: center; margin-top: 12px; }
        }
        @media (max-width: 576px) {
            .input-row { grid-template-columns: 1fr; }
            .btn-group { flex-direction: column; }
        }
    </style>
</head>
<body>

    <!-- ====================== HEADER ====================== -->
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="https://via.placeholder.com/36?text=CP" alt="Logo">
                <span class="title">CAREER PATH RECOMMENDER</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search jobs, skills, companies...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="nav-links">
                <a href="homepage.html">Home</a>
                <a href="jobs.html">More Jobs</a>
                <a href="test.html">Test Now</a>
                <div class="user-menu">
                    <div class="user-icon" onclick="toggleDropdown()">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="dropdown" id="user-dropdown">
                        <a href="profile.html"><i class="fas fa-user-circle"></i> My Profile</a>
                        <a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ====================== MAIN ====================== -->
    <main>
        <div class="container">
            <!-- Left: Form -->
            <div class="form-panel">
                <div>
                    <div class="progress-header">
                        <div class="score">
                            <div class="score-bar"><div class="score-fill" id="score-fill"></div></div>
                            <span id="score-text">10%</span> Your resume score
                        </div>
                        <div class="add-job">
                            <i class="fas fa-plus-circle"></i> <span id="add-job-text">Add job title</span>
                        </div>
                    </div>

                    <button class="customize-btn">
                        <i class="fas fa-palette"></i> Customize
                    </button>

                    <h2 class="section-title">Personal Details</h2>
                    <p class="section-desc">Users who added phone number and email received 64% more positive feedback from recruiters.</p>

                    <div class="input-row">
                        <div class="input-group">
                            <label>Job Title</label>
                            <input type="text" id="job-title" placeholder="The role you want">
                        </div>
                        <div class="photo-upload">
                            <div class="photo-preview" id="photo-preview">
                                <i class="fas fa-user" style="font-size:2rem; color:#94a3b8;"></i>
                            </div>
                            <a href="#" class="upload-link" onclick="document.getElementById('photo-input').click()">Upload photo</a>
                            <input type="file" id="photo-input" accept="image/*" style="display:none;">
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label>First Name</label>
                            <input type="text" id="first-name" placeholder="e.g. Sarah">
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" id="last-name" placeholder="e.g. Lim">
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label>Email *</label>
                            <input type="email" id="email" placeholder="sarah.lim@email.com">
                        </div>
                        <div class="input-group">
                            <label>Phone</label>
                            <input type="tel" id="phone" placeholder="+60 12-345 6789">
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Address</label>
                        <input type="text" id="address" placeholder="123 Jalan Bahagia, Taman Sejahtera">
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label>City / State</label>
                            <input type="text" id="city" placeholder="Kuala Lumpur">
                        </div>
                        <div class="input-group">
                            <label>Country</label>
                            <input type="text" id="country" value="Malaysia" readonly>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="btn-group">
                        <button class="btn save-btn" id="save-btn">
                            <i class="fas fa-cloud"></i> Save
                        </button>
                        <button class="btn next-btn" id="next-btn">
                            Next: Employment History
                        </button>
                    </div>
                    <p class="terms">
                        By signing up by email you agree with our <a href="#">Terms of use</a> and <a href="#">Privacy Policy</a>, and topresume.com's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>.
                    </p>
                </div>
            </div>

            <!-- Right: Preview -->
            <div class="preview-panel">
                <div class="resume-preview">
                    <div class="preview-header">
                        <div class="preview-name" id="preview-name">Your Name</div>
                        <div class="preview-title" id="preview-title">Job Title</div>
                        <div class="preview-contact" id="preview-contact">
                            <span id="preview-email">email@domain.com</span>
                            <span>|</span>
                            <span id="preview-phone">+60 00-000 0000</span>
                        </div>
                    </div>

                    <div class="preview-section">
                        <h3>Summary</h3>
                        <p id="preview-summary" style="color:#94a3b8; font-style:italic;">
                            Start typing to see your professional summary here...
                        </p>
                    </div>

                    <div class="preview-section">
                        <h3>Experience</h3>
                        <div id="preview-experience">
                            <p style="color:#94a3b8; font-style:italic;">Your work history will appear here</p>
                        </div>
                    </div>

                    <div class="preview-section">
                        <h3>Education</h3>
                        <div id="preview-education">
                            <p style="color:#94a3b8; font-style:italic;">Your education will appear here</p>
                        </div>
                    </div>

                    <div class="preview-section">
                        <h3>Skills</h3>
                        <div id="preview-skills">
                            <p style="color:#94a3b8; font-style:italic;">Your skills will appear here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ====================== FOOTER ====================== -->
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="about.html">About Us</a>
                <a href="contact.html">Contact</a>
                <a href="privacy.html">Privacy Policy</a>
                <a href="terms.html">Terms of Use</a>
                <a href="help.html">Help Center</a>
            </div>
            <div class="copyright">
                © 2025 Career Path Recommender. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Toggle Dropdown
        function toggleDropdown() {
            document.getElementById('user-dropdown').classList.toggle('show');
        }
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('user-dropdown').classList.remove('show');
            }
        });

        // Resume Logic
        const inputs = {
            'job-title': document.getElementById('job-title'),
            'first-name': document.getElementById('first-name'),
            'last-name': document.getElementById('last-name'),
            'email': document.getElementById('email'),
            'phone': document.getElementById('phone'),
            'address': document.getElementById('address'),
            'city': document.getElementById('city'),
            'country': document.getElementById('country')
        };

        const preview = {
            name: document.getElementById('preview-name'),
            title: document.getElementById('preview-title'),
            email: document.getElementById('preview-email'),
            phone: document.getElementById('preview-phone')
        };

        const scoreFill = document.getElementById('score-fill');
        const scoreText = document.getElementById('score-text');
        let score = 10;

        function updatePreview() {
            const fullName = `${inputs['first-name'].value || 'Your'} ${inputs['last-name'].value || 'Name'}`.trim();
            preview.name.textContent = fullName;
            preview.title.textContent = inputs['job-title'].value || 'Job Title';
            preview.email.textContent = inputs.email.value || 'email@domain.com';
            preview.phone.textContent = inputs.phone.value || '+60 00-000 0000';

            const filled = Object.values(inputs).filter(i => i.value.trim() !== '' && i !== inputs.country).length;
            score = Math.min(10 + filled * 15, 100);
            scoreFill.style.width = `${score}%`;
            scoreText.textContent = `${score}%`;
        }

        document.getElementById('photo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('photo-preview').innerHTML = `<img src="${ev.target.result}" alt="Profile">`;
                };
                reader.readAsDataURL(file);
            }
        });

        Object.values(inputs).forEach(input => input.addEventListener('input', updatePreview));

        document.getElementById('next-btn').addEventListener('click', () => {
            alert('Moving to Employment History... (Demo)');
        });

        document.getElementById('save-btn').addEventListener('click', () => {
            localStorage.setItem('userResume', 'true');
            alert('Resume saved! You can now apply with it.');
        });

        updatePreview();
    </script>
</body>
</html>