<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Test Questions - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #87CEEB 0%, #E0F7FA 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            background: #0d47a1;
            color: white;
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.4rem;
            font-weight: 700;
        }
        .logo-icon { font-size: 2rem; }
        .logo-title {
            background: linear-gradient(90deg, #4fc3f7, #81d4fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-menu { position: relative; }
        .user-icon {
            width: 46px; height: 46px;
            background: #ff4081; color: white;
            border-radius: 50%; display: flex;
            align-items: center; justify-content: center;
            font-size: 1.2rem; cursor: pointer;
            transition: all 0.3s;
        }
        .user-icon:hover { transform: scale(1.1); box-shadow: 0 0 20px rgba(255,64,129,0.5); }
        .dropdown {
            position: absolute; top: 60px; right: 0;
            background: white; min-width: 200px;
            border-radius: 16px; box-shadow: 0 12px 30px rgba(0,0,0,0.2);
            overflow: hidden; opacity: 0; visibility: hidden;
            transform: translateY(-10px); transition: all 0.3s ease; z-index: 1000;
        }
        .dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown a {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 20px; color: #0277bd; text-decoration: none;
            font-weight: 600; font-size: 1rem; transition: 0.3s;
        }
        .dropdown a:hover { background: #e3f2fd; color: #0288d1; padding-left: 26px; }
        .dropdown a.logout { color: #e53935; border-top: 1px solid #bbdefb; }

        /* MAIN LAYOUT */
        .main-layout { display: flex; flex: 1; overflow: hidden; }

        /* SIDEBAR */
        .sidebar {
            width: 270px; background: white; padding: 30px 0;
            box-shadow: 4px 0 20px rgba(33, 150, 243, 0.15); flex-shrink: 0;
        }
        .sidebar-header {
            padding: 0 30px 20px; font-size: 1.3rem; font-weight: 700;
            color: #0277bd; border-bottom: 2px solid #bbdefb;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .sidebar-header::before { content: "Shield"; font-size: 1.5rem; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 30px; color: #0288d1; text-decoration: none;
            font-weight: 600; transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .sidebar-menu a:hover {
            background: #e3f2fd; color: #0277bd;
            border-left-color: #4fc3f7; padding-left: 34px;
        }
        .sidebar-menu a.active {
            background: linear-gradient(90deg, #bbdefb 0%, transparent 100%);
            color: #0277bd; border-left-color: #0288d1; font-weight: 700;
        }
        .sidebar-menu i { width: 22px; font-size: 1.2rem; }

        /* CONTENT */
        .content { flex: 1; padding: 40px; overflow-y: auto; }
        .page-header {
            background: white; border-radius: 20px; padding: 35px 45px;
            margin-bottom: 30px; box-shadow: 0 12px 40px rgba(33, 150, 243, 0.15);
        }
        .page-title {
            font-size: 2.3rem; font-weight: 700; color: #0277bd;
            display: flex; align-items: center; gap: 14px;
        }
        .page-title::before { content: "Question Circle"; font-size: 2.5rem; }

        .controls {
            background: white; padding: 25px 40px; border-radius: 20px;
            margin-bottom: 30px; display: flex; gap: 20px;
            box-shadow: 0 10px 35px rgba(33, 150, 243, 0.12);
            flex-wrap: wrap;
        }
        .btn-edit, .btn-upload {
            padding: 14px 32px; border-radius: 30px; font-size: 16px;
            font-weight: 700; cursor: pointer; transition: all 0.3s;
            display: flex; align-items: center; gap: 10px;
        }
        .btn-edit {
            background: linear-gradient(135deg, #0288d1, #4fc3f7);
            color: white; border: none;
            box-shadow: 0 6px 20px rgba(2, 136, 209, 0.3);
        }
        .btn-edit:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(2, 136, 209, 0.4); }
        .btn-upload {
            background: #e0e0e0; color: #999; border: none;
            cursor: not-allowed;
        }
        .btn-upload.enabled {
            background: linear-gradient(135deg, #00c853, #64dd17);
            color: white; cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 200, 83, 0.3);
        }
        .btn-upload.enabled:hover { transform: translateY(-3px); }

        .questions-container {
            background: white; border-radius: 20px; padding: 40px;
            box-shadow: 0 12px 40px rgba(33, 150, 243, 0.15);
        }
        .section-title {
            font-size: 1.6rem; color: #0277bd; font-weight: 700;
            margin-bottom: 20px; padding-bottom: 10px;
            border-bottom: 3px solid #bbdefb;
        }
        .question-block {
            background: #f5fbff; border-radius: 16px;
            padding: 24px; margin-bottom: 24px;
            border: 2px solid #bbdefb;
            transition: all 0.3s;
        }
        .question-block.editable {
            border-color: #0288d1; background: #e3f2fd;
            box-shadow: 0 6px 20px rgba(2, 136, 209, 0.1);
        }
        .question-text {
            font-weight: 700; font-size: 1.2rem; color: #01579b;
            margin-bottom: 16px;
        }
        .question-text textarea {
            width: 100%; padding: 12px; border: 2px solid #90caf9;
            border-radius: 12px; font-size: 1.1rem; font-family: inherit;
            resize: vertical; min-height: 60px;
        }
        .options {
            display: grid; gap: 14px;
        }
        .option {
            display: flex; align-items: center; gap: 12px;
            padding: 12px; background: white; border-radius: 12px;
            border: 2px solid #90caf9;
        }
        .option input[type="radio"] { margin: 0; }
        .option label {
            flex: 1; cursor: pointer; font-weight: 600; color: #0277bd;
        }
        .option input[type="text"] {
            flex: 1; padding: 10px; border: 2px solid #90caf9;
            border-radius: 10px; font-size: 1rem;
        }

        /* Toast Notification */
        .toast {
            position: fixed; bottom: 30px; left: 50%;
            transform: translateX(-50%); background: #00c853;
            color: white; padding: 16px 32px; border-radius: 50px;
            font-weight: 700; box-shadow: 0 10px 30px rgba(0,200,83,0.4);
            opacity: 0; visibility: hidden; transition: all 0.4s;
            z-index: 10000; display: flex; align-items: center; gap: 12px;
        }
        .toast.show { opacity: 1; visibility: visible; bottom: 50px; }
        .toast::before { content: "Checkmark Circle"; font-size: 1.5rem; }

        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; padding: 20px 0; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-container">
            <div class="logo">
                <span class="logo-icon">Cloud</span>
                <span class="logo-title">CAREER PATH RECOMMENDER</span>
            </div>
            <div class="user-menu">
                <div class="user-icon" onclick="toggleDropdown()">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dropdown" id="userDropdown">
                    <a href="homepage.html"><i class="fas fa-home"></i> Homepage</a>
                    <a href="admin-profile.html"><i class="fas fa-user-cog"></i> Admin Profile</a>
                    <a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN LAYOUT -->
    <div class="main-layout">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">Admin Panel</div>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin-users.html"><i class="fas fa-users"></i> Edit Users</a></li>
                <li><a href="testquestionsmanagement.html" class="active"><i class="fas fa-question-circle"></i> Edit Test Questions</a></li>
                <li><a href="admin-jobs.html"><i class="fas fa-briefcase"></i> Edit Jobs</a></li>
            </ul>
        </aside>

        <!-- CONTENT -->
        <main class="content">
            <div class="page-header">
                <h1 class="page-title">Current Test Questions</h1>
            </div>

            <div class="controls">
                <button class="btn-edit" id="editBtn" onclick="enableEditing()">
                    <i class="fas fa-edit"></i> Edit Questions
                </button>
                <button class="btn-upload" id="uploadBtn" disabled onclick="uploadChanges()">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Changes
                </button>
            </div>

            <div class="questions-container">
                <div class="section-title">Personality Quiz (Mini-MBTI)</div>

                <div class="question-block" data-q="q1">
                    <div class="question-text">
                        <textarea readonly>Q1: In a group project, are you the one who...</textarea>
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="q1" value="E" disabled>
                            <input type="text" value="A. Takes charge and talks a lot" readonly>
                        </div>
                        <div class="option">
                            <input type="radio" name="q1" value="I" disabled>
                            <input type="text" value="B. Listens and thinks before speaking" readonly>
                        </div>
                    </div>
                </div>

                <div class="question-block" data-q="q2">
                    <div class="question-text">
                        <textarea readonly>Q2: When solving problems, do you prefer...</textarea>
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="q2" value="S" disabled>
                            <input type="text" value="A. Practical solutions" readonly>
                        </div>
                        <div class="option">
                            <input type="radio" name="q2" value="N" disabled>
                            <input type="text" value="B. Creative ideas" readonly>
                        </div>
                    </div>
                </div>

                <div class="question-block" data-q="q3">
                    <div class="question-text">
                        <textarea readonly>Q3: When making decisions, do you rely more on...</textarea>
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="q3" value="T" disabled>
                            <input type="text" value="A. Logic and facts" readonly>
                        </div>
                        <div class="option">
                            <input type="radio" name="q3" value="F" disabled>
                            <input type="text" value="B. Feelings and values" readonly>
                        </div>
                    </div>
                </div>

                <div class="question-block" data-q="q4">
                    <div class="question-text">
                        <textarea readonly>Q4: Do you prefer your life to be...</textarea>
                    </div>
                    <div class="options">
                        <div class="option">
                            <input type="radio" name="q4" value="J" disabled>
                            <input type="text" value="A. Organized and planned" readonly>
                        </div>
                        <div class="option">
                            <input type="radio" name="q4" value="P" disabled>
                            <input type="text" value="B. Flexible and spontaneous" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast">Done upload new question</div>

    <script>
        let isEditing = false;
        let hasChanges = false;

        function enableEditing() {
            if (isEditing) return;
            isEditing = true;

            document.querySelectorAll('.question-block').forEach(block => {
                block.classList.add('editable');
                block.querySelectorAll('textarea, input[type="text"]').forEach(el => {
                    el.removeAttribute('readonly');
                    el.style.background = 'white';
                });
                block.querySelectorAll('input[type="radio"]').forEach(r => r.disabled = false);
            });

            // Track changes
            document.querySelectorAll('textarea, input[type="text"]').forEach(input => {
                input.addEventListener('input', () => {
                    hasChanges = true;
                    document.getElementById('uploadBtn').classList.add('enabled');
                    document.getElementById('uploadBtn').disabled = false;
                });
            });

            document.getElementById('editBtn').textContent = 'Editing Mode Active';
            document.getElementById('editBtn').style.opacity = '0.8';
        }

        function uploadChanges() {
            if (!hasChanges) return;

            // Show toast
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);

            // Reset
            hasChanges = false;
            document.getElementById('uploadBtn').classList.remove('enabled');
            document.getElementById('uploadBtn').disabled = true;
        }

        // Dropdown
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('userDropdown').classList.remove('show');
            }
        });
    </script>
</body>
</html>