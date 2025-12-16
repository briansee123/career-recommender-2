<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Build Your Resume - Career Path Recommender</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        /* ====================== PURPLE GRADIENT HEADER ====================== */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 18px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 1.6rem;
            font-weight: 700;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .nav-links a:hover {
            background: rgba(255,255,255,0.2);
        }
        .user-menu {
            position: relative;
        }
        .user-icon {
            width: 45px;
            height: 45px;
            background: white;
            color: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .dropdown {
            display: none;
            position: absolute;
            top: 55px;
            right: 0;
            background: white;
            min-width: 180px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            z-index: 1000;
        }
        .dropdown.show { display: block; }
        .dropdown a, .dropdown button {
            display: block;
            width: 100%;
            padding: 12px 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }
        .dropdown a:hover, .dropdown button:hover { background: #f1f5f9; }
        .dropdown .logout { color: #ef4444; border-top: 1px solid #f1f5f9; }

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

        /* ====================== LEFT PANEL - FORM ====================== */
        .form-panel {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .score {
            font-size: 0.95rem;
            font-weight: 600;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .score-bar {
            width: 80px;
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }
        .score-fill {
            height: 100%;
            background: #667eea;
            width: 10%;
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 24px 0 16px;
            color: #1e293b;
        }
        .section-desc {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 20px;
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .input-group {
            margin-bottom: 16px;
        }
        .input-group label {
            display: block;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
            font-size: 0.95rem;
        }
        .input-group input, .input-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .input-group input:focus, .input-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .photo-upload {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 16px 0;
        }
        .photo-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 3px dashed #94a3b8;
        }
        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .upload-link {
            color: #667eea;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }
        .btn {
            flex: 1;
            padding: 14px 0;
            border: none;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .save-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .back-btn {
            background: #e2e8f0;
            color: #475569;
        }
        .back-btn:hover {
            background: #cbd5e1;
        }

        /* ====================== RIGHT PANEL - PREVIEW ====================== */
        .preview-panel {
            background: #f8fafc;
            padding: 40px;
            border-left: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
        }
        .resume-preview {
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .preview-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .preview-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
        }
        .preview-title {
            font-size: 1.1rem;
            color: #64748b;
            margin-top: 4px;
        }
        .preview-contact {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 12px;
            font-size: 0.9rem;
            color: #475569;
        }
        .preview-section {
            margin-top: 24px;
        }
        .preview-section h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 2px solid #667eea;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .preview-item {
            margin-bottom: 16px;
        }
        .preview-item h4 {
            font-weight: 600;
            color: #1e293b;
        }
        .preview-item p {
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 2px;
        }

        .success-message {
            background: #10b981;
            color: white;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: none;
        }
        .success-message.show {
            display: block;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .container { grid-template-columns: 1fr; }
            .preview-panel { order: -1; padding: 24px; }
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
                <span>💼</span>
                <span>CAREER PATH RECOMMENDER</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('homepage') }}">Home</a>
                <a href="{{ route('jobs') }}">More Jobs</a>
                <a href="{{ route('test') }}">Test Now</a>
                <div class="user-menu">
                    <div class="user-icon" onclick="toggleDropdown()">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="dropdown" id="userDropdown">
                        <a href="{{ route('profile') }}">👤 My Profile</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout">🚪 Log Out</button>
                        </form>
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
                <div id="success-message" class="success-message">
                    ✅ Resume saved successfully!
                </div>

                <div>
                    <div class="progress-header">
                        <div class="score">
                            <div class="score-bar"><div class="score-fill" id="score-fill"></div></div>
                            <span id="score-text">10%</span> Complete
                        </div>
                    </div>

                    <h2 class="section-title">Personal Details</h2>
                    <p class="section-desc">Fill in your information to build a professional resume</p>

                    <form id="resume-form" action="{{ route('resume.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @php
                            $resume = auth()->user()->resume;
                        @endphp

                        <div class="input-row">
                            <div class="input-group">
                                <label>Job Title *</label>
                                <input type="text" name="job_title" id="job-title" placeholder="e.g. Software Engineer" required value="{{ $resume->job_title ?? '' }}">
                            </div>
                            <div class="photo-upload">
                                <div class="photo-preview" id="photo-preview">
                                    @if($resume && $resume->photo)
                                        <img src="{{ Storage::url($resume->photo) }}" alt="Profile">
                                    @else
                                        <span style="font-size:2rem; color:#94a3b8;">👤</span>
                                    @endif
                                </div>
                                <a href="#" class="upload-link" onclick="document.getElementById('photo-input').click(); return false;">Upload photo</a>
                                <input type="file" id="photo-input" name="photo" accept="image/*" style="display:none;">
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <label>First Name *</label>
                                <input type="text" name="first_name" id="first-name" placeholder="e.g. Sarah" required value="{{ $resume->first_name ?? explode(' ', auth()->user()->name)[0] ?? '' }}">
                            </div>
                            <div class="input-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="last-name" placeholder="e.g. Lim" value="{{ $resume->last_name ?? '' }}">
                            </div>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <label>Email *</label>
                                <input type="email" name="email" id="email" placeholder="your@email.com" required value="{{ $resume->email ?? auth()->user()->email }}">
                            </div>
                            <div class="input-group">
                                <label>Phone</label>
                                <input type="tel" name="phone" id="phone" placeholder="+60 12-345 6789" value="{{ $resume->phone ?? '' }}">
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" placeholder="123 Jalan Bahagia" value="{{ $resume->address ?? '' }}">
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <label>City / State</label>
                                <input type="text" name="city" id="city" placeholder="Kuala Lumpur" value="{{ $resume->city ?? '' }}">
                            </div>
                            <div class="input-group">
                                <label>Country</label>
                                <input type="text" name="country" id="country" value="Malaysia" readonly>
                            </div>
                        </div>

                        <h2 class="section-title">Professional Summary</h2>
                        <div class="input-group">
                            <label>About You</label>
                            <textarea name="summary" id="summary" placeholder="Write a brief professional summary...">{{ $resume->summary ?? '' }}</textarea>
                        </div>

                        <h2 class="section-title">Work Experience</h2>
                        <div class="input-group">
                            <label>Company Name</label>
                            <input type="text" name="experience_company" id="exp-company" placeholder="e.g. Google Malaysia" value="{{ $resume->experience_company ?? '' }}">
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label>Job Title</label>
                                <input type="text" name="experience_title" id="exp-title" placeholder="e.g. Senior Developer" value="{{ $resume->experience_title ?? '' }}">
                            </div>
                            <div class="input-group">
                                <label>Duration</label>
                                <input type="text" name="experience_duration" id="exp-duration" placeholder="e.g. 2020 - 2023" value="{{ $resume->experience_duration ?? '' }}">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Description</label>
                            <textarea name="experience_description" id="exp-description" placeholder="Describe your responsibilities...">{{ $resume->experience_description ?? '' }}</textarea>
                        </div>

                        <h2 class="section-title">Education</h2>
                        <div class="input-group">
                            <label>Institution</label>
                            <input type="text" name="education_institution" id="edu-institution" placeholder="e.g. Universiti Malaya" value="{{ $resume->education_institution ?? '' }}">
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label>Degree</label>
                                <input type="text" name="education_degree" id="edu-degree" placeholder="e.g. BSc Computer Science" value="{{ $resume->education_degree ?? '' }}">
                            </div>
                            <div class="input-group">
                                <label>Year</label>
                                <input type="text" name="education_year" id="edu-year" placeholder="e.g. 2016 - 2020" value="{{ $resume->education_year ?? '' }}">
                            </div>
                        </div>

                        <h2 class="section-title">Skills</h2>
                        <div class="input-group">
                            <label>Your Skills (comma separated)</label>
                            <input type="text" name="skills" id="skills" placeholder="e.g. PHP, Laravel, JavaScript, React" value="{{ $resume->skills ?? '' }}">
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn back-btn" onclick="window.location.href='{{ route('profile') }}'">
                                Cancel
                            </button>
                            <button type="submit" class="btn save-btn">
                                💾 Save Resume
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Preview -->
            <div class="preview-panel">
                <div class="resume-preview">
                    <div class="preview-header">
                        <div class="preview-name" id="preview-name">{{ $resume->first_name ?? auth()->user()->name }} {{ $resume->last_name ?? '' }}</div>
                        <div class="preview-title" id="preview-title">{{ $resume->job_title ?? 'Your Job Title' }}</div>
                        <div class="preview-contact" id="preview-contact">
                            <span id="preview-email">{{ $resume->email ?? auth()->user()->email }}</span>
                            <span>|</span>
                            <span id="preview-phone">{{ $resume->phone ?? '+60 00-000 0000' }}</span>
                        </div>
                    </div>

                    <div class="preview-section">
                        <h3>Summary</h3>
                        <p id="preview-summary" style="color:#64748b;">
                            {{ $resume->summary ?? 'Your professional summary will appear here...' }}
                        </p>
                    </div>

                    <div class="preview-section">
                        <h3>Experience</h3>
                        <div id="preview-experience">
                            @if($resume && $resume->experience_company)
                                <div class="preview-item">
                                    <h4>{{ $resume->experience_title }}</h4>
                                    <p>{{ $resume->experience_company }} | {{ $resume->experience_duration }}</p>
                                    <p>{{ $resume->experience_description }}</p>
                                </div>
                            @else
                                <p style="color:#94a3b8; font-style:italic;">Your work history will appear here</p>
                            @endif
                        </div>
                    </div>

                    <div class="preview-section">
                        <h3>Education</h3>
                        <div id="preview-education">
                            @if($resume && $resume->education_institution)
                                <div class="preview-item">
                                    <h4>{{ $resume->education_degree }}</h4>
                                    <p>{{ $resume->education_institution }} | {{ $resume->education_year }}</p>
                                </div>
                            @else
                                <p style="color:#94a3b8; font-style:italic;">Your education will appear here</p>
                            @endif
                        </div>
                    </div>

                    <div class="preview-section">
                        <h3>Skills</h3>
                        <div id="preview-skills">
                            @if($resume && $resume->skills)
                                <p>{{ $resume->skills }}</p>
                            @else
                                <p style="color:#94a3b8; font-style:italic;">Your skills will appear here</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        console.log('✅ Script loading...');

        // Toggle Dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) {
                dropdown.classList.toggle('show');
            }
        }

        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown) {
                    dropdown.classList.remove('show');
                }
            }
        });

        // Get all input elements with null checks
        function getElement(id) {
            const el = document.getElementById(id);
            if (!el) console.warn('Element not found:', id);
            return el;
        }

        const inputs = {
            'job-title': getElement('job-title'),
            'first-name': getElement('first-name'),
            'last-name': getElement('last-name'),
            'email': getElement('email'),
            'phone': getElement('phone'),
            'summary': getElement('summary'),
            'exp-company': getElement('exp-company'),
            'exp-title': getElement('exp-title'),
            'exp-duration': getElement('exp-duration'),
            'exp-description': getElement('exp-description'),
            'edu-institution': getElement('edu-institution'),
            'edu-degree': getElement('edu-degree'),
            'edu-year': getElement('edu-year'),
            'skills': getElement('skills')
        };

        const scoreFill = getElement('score-fill');
        const scoreText = getElement('score-text');

        // Update preview function
        function updatePreview() {
            if (!inputs['first-name'] || !inputs['job-title']) return;

            const fullName = `${inputs['first-name'].value || 'Your'} ${inputs['last-name']?.value || 'Name'}`.trim();
            const nameEl = document.getElementById('preview-name');
            if (nameEl) nameEl.textContent = fullName;
            
            const titleEl = document.getElementById('preview-title');
            if (titleEl) titleEl.textContent = inputs['job-title'].value || 'Your Job Title';
            
            const emailEl = document.getElementById('preview-email');
            if (emailEl && inputs.email) emailEl.textContent = inputs.email.value || 'email@domain.com';
            
            const phoneEl = document.getElementById('preview-phone');
            if (phoneEl && inputs.phone) phoneEl.textContent = inputs.phone.value || '+60 00-000 0000';
            
            const summaryEl = document.getElementById('preview-summary');
            if (summaryEl && inputs.summary) summaryEl.textContent = inputs.summary.value || 'Your professional summary will appear here...';
            
            // Update experience
            const expEl = document.getElementById('preview-experience');
            if (expEl && (inputs['exp-company']?.value || inputs['exp-title']?.value)) {
                expEl.innerHTML = `
                    <div class="preview-item">
                        <h4>${inputs['exp-title']?.value || 'Job Title'}</h4>
                        <p>${inputs['exp-company']?.value || 'Company'} | ${inputs['exp-duration']?.value || 'Duration'}</p>
                        <p>${inputs['exp-description']?.value || 'Description'}</p>
                    </div>
                `;
            }
            
            // Update education
            const eduEl = document.getElementById('preview-education');
            if (eduEl && (inputs['edu-institution']?.value || inputs['edu-degree']?.value)) {
                eduEl.innerHTML = `
                    <div class="preview-item">
                        <h4>${inputs['edu-degree']?.value || 'Degree'}</h4>
                        <p>${inputs['edu-institution']?.value || 'Institution'} | ${inputs['edu-year']?.value || 'Year'}</p>
                    </div>
                `;
            }
            
            // Update skills
            const skillsEl = document.getElementById('preview-skills');
            if (skillsEl && inputs.skills?.value) {
                skillsEl.innerHTML = `<p>${inputs.skills.value}</p>`;
            }
            
            // Calculate completion score
            const filled = Object.values(inputs).filter(i => i && i.value && i.value.trim() !== '').length;
            const score = Math.min(10 + filled * 6, 100);
            if (scoreFill) scoreFill.style.width = `${score}%`;
            if (scoreText) scoreText.textContent = `${score}%`;
        }

        // Photo preview
        const photoInput = getElement('photo-input');
        if (photoInput) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        const preview = document.getElementById('photo-preview');
                        if (preview) {
                            preview.innerHTML = `<img src="${ev.target.result}" alt="Profile">`;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Attach input listeners
        Object.values(inputs).forEach(input => {
            if (input) {
                input.addEventListener('input', updatePreview);
            }
        });

// Form submission
const form = getElement('resume-form');
if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        console.log('=== SUBMITTING FORM ===');
        
        const formData = new FormData(this);
        const saveBtn = this.querySelector('.save-btn');
        
        if (saveBtn) {
            saveBtn.innerHTML = '⏳ Saving...';
            saveBtn.disabled = true;
        }
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            console.log('Status:', response.status);
            
            // Check if response is actually JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                throw new Error('Response is not JSON');
            }
        })
        .then(data => {
            console.log('Data received:', data);
            
            if (data.success) {
                // Show success alert
                alert('✅ Resume saved successfully!');
                
                // Redirect to profile after 1 second
                setTimeout(function() {
                    window.location.href = '{{ route("profile") }}';
                }, 1000);
            } else {
                alert('❌ Error: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('❌ Error saving resume: ' + error.message);
        })
        .finally(() => {
            if (saveBtn) {
                saveBtn.innerHTML = '💾 Save Resume';
                saveBtn.disabled = false;
            }
        });
    });
} else {
    console.error('❌ Form not found!');
}
        // Initial preview update
        updatePreview();

        console.log('✅ Script loaded successfully');
    </script>
</body>
</html>