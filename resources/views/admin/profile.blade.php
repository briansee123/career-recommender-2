<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - Supreme Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #2d1b69 0%, #1a0033 100%);
            min-height: 100vh;
            color: #e0d4ff;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            background: linear-gradient(90deg, #4a148c, #7b1fa2);
            padding: 18px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 8px 32px rgba(74, 20, 140, 0.4);
            border-bottom: 1px solid #9c27b0;
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
            gap: 14px;
            font-size: 1.6rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
        }
        .logo-icon { font-size: 2.2rem; color: #ffd700; }
        .logo-title {
            background: linear-gradient(90deg, #ffd700, #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 1px;
        }

        .user-menu { position: relative; }
        .user-icon {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            color: #4a148c;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
            transition: all 0.4s;
        }
        .user-icon:hover { transform: scale(1.15); box-shadow: 0 0 30px rgba(255, 215, 0, 0.8); }
        .dropdown {
            position: absolute; top: 65px; right: 0;
            background: #4a148c; min-width: 220px;
            border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.5);
            overflow: hidden; opacity: 0; visibility: hidden;
            transform: translateY(-15px); transition: all 0.4s ease; z-index: 1000;
            border: 1px solid #7b1fa2;
        }
        .dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown a {
            display: flex; align-items: center; gap: 12px;
            padding: 16px 20px; color: #e0d4ff; text-decoration: none;
            font-weight: 600; transition: 0.3s;
        }
        .dropdown a:hover { background: #6a1b9a; padding-left: 28px; }
        .dropdown a.logout { color: #ff6b6b; border-top: 1px solid #7b1fa2; }

        /* MAIN LAYOUT */
        .main-layout { display: flex; flex: 1; overflow: hidden; }

        /* SIDEBAR */
        .sidebar {
            width: 280px; background: rgba(74, 20, 140, 0.95);
            padding: 30px 0; box-shadow: 8px 0 30px rgba(0,0,0,0.4);
            backdrop-filter: blur(10px); border-right: 1px solid #7b1fa2;
        }
        .sidebar-header {
            padding: 0 30px 24px; font-size: 1.4rem; font-weight: 700;
            color: #ffd700; border-bottom: 2px solid #7b1fa2;
            margin-bottom: 24px; display: flex; align-items: center; gap: 12px;
            font-family: 'Playfair Display', serif;
        }
        .sidebar-header::before { content: "Crown"; font-size: 1.8rem; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 16px;
            padding: 16px 30px; color: #d1c4e9; text-decoration: none;
            font-weight: 600; transition: all 0.4s;
            border-left: 4px solid transparent;
        }
        .sidebar-menu a:hover {
            background: rgba(123, 31, 162, 0.5); color: white;
            border-left-color: #ffd700; padding-left: 36px;
        }
        .sidebar-menu a.active {
            background: linear-gradient(90deg, #7b1fa2, transparent);
            color: #ffd700; border-left-color: #ffd700; font-weight: 700;
        }

        /* CONTENT */
        .content { flex: 1; padding: 40px; overflow-y: auto; }
        .page-header {
            text-align: center; margin-bottom: 40px;
        }
        .greeting {
            font-family: 'Playfair Display', serif;
            font-size: 3.2rem; font-weight: 700;
            background: linear-gradient(90deg, #ffd700, #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }
        .greeting span { font-size: 2.5rem; }
        .subtitle {
            font-size: 1.3rem; color: #b388ff; font-weight: 500;
        }

        .profile-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 40px;
        }
        .profile-card {
            background: rgba(74, 20, 140, 0.7);
            border-radius: 24px; padding: 40px; text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            border: 1px solid #7b1fa2;
            backdrop-filter: blur(10px);
        }
        .avatar {
            width: 150px; height: 150px; border-radius: 50%;
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 4rem; color: #4a148c; font-weight: bold;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.6);
        }
        .admin-name {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; color: #ffd700; margin-bottom: 8px;
        }
        .admin-rank {
            background: linear-gradient(90deg, #ffd700, #ff8c00);
            color: #4a148c; padding: 8px 24px; border-radius: 50px;
            display: inline-block; font-weight: 700; font-size: 1rem;
            letter-spacing: 1px;
        }
        .stats {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px;
        }
        .stat-item {
            background: rgba(123, 31, 162, 0.5); padding: 20px; border-radius: 16px;
            border: 1px solid #9c27b0;
        }
        .stat-value {
            font-size: 2rem; font-weight: 700; color: #ffd700;
        }
        .stat-label { font-size: 0.9rem; color: #b388ff; margin-top: 6px; }

        .activity-log {
            background: rgba(74, 20, 140, 0.7); border-radius: 24px;
            padding: 30px; border: 1px solid #7b1fa2;
            backdrop-filter: blur(10px);
        }
        .activity-title {
            font-size: 1.6rem; color: #ffd700; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .activity-item {
            padding: 16px 0; border-bottom: 1px dashed #7b1fa2;
            display: flex; align-items: center; gap: 14px; color: #e0d4ff;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-icon {
            width: 40px; height: 40px; border-radius: 50%;
            background: #ffd700; color: #4a148c;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }

        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; }
            .profile-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-container">
            <div class="logo">
                <span class="logo-icon">Diamond</span>
                <span class="logo-title">CAREER PATH RECOMMENDER</span>
            </div>
            <div class="user-menu">
                <div class="user-icon" onclick="toggleDropdown()">A</div>
                <div class="dropdown" id="userDropdown">
                    <a href="homepage.html">Homepage</a>
                    <a href="admin-profile.html">Admin Profile</a>
                    <a href="#" class="logout">Log Out</a>
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
                <li><a href="admin-dashboard.html">Dashboard</a></li>
                <li><a href="admin-users.html">Edit Users</a></li>
                <li><a href="testquestionsmanagement.html">Edit Test Questions</a></li>
                <li><a href="admin-jobs.html">Edit Jobs</a></li>
                <li><a href="admin-profile.html" class="active">Admin Profile</a></li>
            </ul>
        </aside>

        <!-- CONTENT -->
        <main class="content">
            <div class="page-header">
                <h1 class="greeting">Hi, Supreme Admin <span>Crown</span></h1>
                <p class="subtitle">You have full control over the entire system</p>
            </div>

            <div class="profile-grid">
                <div class="profile-card">
                    <div class="avatar">A</div>
                    <h2 class="admin-name">Master Admin</h2>
                    <div class="admin-rank">SUPREME AUTHORITY</div>
                    <div class="stats">
                        <div class="stat-item">
                            <div class="stat-value">1,284</div>
                            <div class="stat-label">Total Users</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">156</div>
                            <div class="stat-label">Job Listings</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">48</div>
                            <div class="stat-label">Test Questions</div>
                        </div>
                    </div>
                </div>

                <div class="activity-log">
                    <h3 class="activity-title">Recent Activity</h3>
                    <div class="activity-item">
                        <div class="activity-icon">Briefcase</div>
                        <div>Added 12 new job listings</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">Question Circle</div>
                        <div>Updated personality test questions</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">User Check</div>
                        <div>Promoted 3 users to moderator</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">Shield</div>
                        <div>Blocked 5 spam accounts</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">Trophy</div>
                        <div>Achieved "Supreme Admin" status</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
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