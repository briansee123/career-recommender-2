<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job - Career Path Recommender</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: #121826;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .apply-container {
            background: #1e293b;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            max-width: 680px;
            width: 100%;
            padding: 40px 36px;
            position: relative;
            overflow: hidden;
        }
        .apply-container::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 20px;
            transition: 0.2s;
        }
        .back-link:hover { color: #e2e8f0; }

        .apply-title {
            font-size: 2rem;
            font-weight: 700;
            color: #e2e8f0;
            margin-bottom: 8px;
        }
        .job-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: #10b981;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .slogan {
            color: #94a3b8;
            font-size: 1.05rem;
            margin-bottom: 28px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
            font-size: 1rem;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 12px;
            color: #e2e8f0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        /* Resume Section */
        .resume-section {
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 24px;
            position: relative;
        }
        .resume-status {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            margin-bottom: 12px;
        }
        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
        .status-success { background: #064e3b; color: #6ee7b7; }
        .status-warning { background: #7c2d12; color: #fdba74; }

        .upload-area {
            border: 2px dashed #334155;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            background: #1e293b;
        }
        .upload-area:hover {
            border-color: #10b981;
            background: #0f172a;
        }
        .upload-area input[type="file"] {
            display: none;
        }
        .upload-text {
            color: #94a3b8;
            font-size: 0.95rem;
        }
        .upload-btn {
            background: #334155;
            color: #e2e8f0;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.2s;
        }
        .upload-btn:hover { background: #10b981; }

        .build-resume {
            margin-top: 12px;
            font-size: 0.9rem;
            color: #3b82f6;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .build-resume:hover { color: #60a5fa; }

        /* Buttons */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        .btn {
            flex: 1;
            padding: 14px 0;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .submit-btn {
            background: linear-gradient(90deg, #10b981, #34d399);
            color: white;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }
        .back-btn {
            background: #334155;
            color: #e2e8f0;
        }
        .back-btn:hover {
            background: #475569;
            transform: translateY(-2px);
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: #10b981;
            color: white;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            z-index: 1000;
        }
        .toast.show {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-10px);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .apply-container { padding: 32px 24px; }
            .btn-group { flex-direction: column; }
        }
    </style>
</head>
<body>

    <div class="apply-container">
        <a href="jobs.html" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Jobs
        </a>

        <h1 class="apply-title">Apply for Position</h1>
        <div class="job-name" id="job-title">
            <i class="fas fa-briefcase"></i> Loading job...
        </div>
        <p class="slogan">We’ll help you take the next step in your career journey.</p>

        <form id="apply-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" required placeholder="e.g. Alex Tan">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" required placeholder="alex@example.com">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" required placeholder="+60 12-345 6789">
            </div>

            <!-- Resume Section -->
            <div class="resume-section" id="resume-section">
                <div class="resume-status" id="resume-status">
                    <!-- Dynamically updated -->
                </div>
                <div id="resume-upload-area" class="upload-area">
                    <input type="file" id="resume-file" accept=".pdf,.doc,.docx">
                    <i class="fas fa-cloud-upload-alt" style="font-size:1.5rem; color:#94a3b8;"></i>
                    <p class="upload-text">Drop your resume here or click to browse</p>
                    <button type="button" class="upload-btn" onclick="document.getElementById('resume-file').click()">
                        Choose File
                    </button>
                </div>
                <a href="profile.html#resume-builder" class="build-resume">
                    <i class="fas fa-magic"></i> Or build one with our AI Resume Maker
                </a>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn submit-btn">Submit Application</button>
                <button type="button" class="btn back-btn" onclick="history.back()">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span>Application submitted successfully!</span>
    </div>

    <script>
        // Get job title from URL
        const params = new URLSearchParams(window.location.search);
        const jobTitle = params.get('job') ? decodeURIComponent(params.get('job')) : 'Unknown Position';
        document.getElementById('job-title').innerHTML = `<i class="fas fa-briefcase"></i> ${jobTitle}`;

        // Simulate resume check from profile (in real app: fetch from localStorage or API)
        const hasResume = localStorage.getItem('userResume') === 'true'; // Demo flag

        const resumeSection = document.getElementById('resume-section');
        const resumeStatus = document.getElementById('resume-status');
        const uploadArea = document.getElementById('resume-upload-area');

        if (hasResume) {
            resumeStatus.innerHTML = `
                <div class="status-icon status-success"><i class="fas fa-check"></i></div>
                <span>Your resume is attached automatically</span>
            `;
            uploadArea.style.display = 'none';
        } else {
            resumeStatus.innerHTML = `
                <div class="status-icon status-warning"><i class="fas fa-exclamation-triangle"></i></div>
                <span>No resume found. Please upload or create one.</span>
            `;
            uploadArea.style.display = 'block';
        }

        // File input feedback
        document.getElementById('resume-file').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'No file chosen';
            document.querySelector('.upload-text').textContent = fileName;
        });

        // Submit form
        document.getElementById('apply-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // In real app: validate + send to backend
            const toast = document.getElementById('toast');
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
                // Optional: redirect
                // window.location.href = 'jobs.html';
            }, 3000);
        });
    </script>
</body>
</html>