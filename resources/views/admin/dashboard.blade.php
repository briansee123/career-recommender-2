<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Career Path Recommender</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ====================== HEADER - CLEAN VERSION ====================== */
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

        /* User Menu & Dropdown */
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
            font-weight: 600;
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
            min-width: 200px;
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
            padding: 14px 16px;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: 0.2s;
        }
        .dropdown a:hover { background: #334155; }
        .dropdown a.logout { 
            color: #f87171; 
            border-top: 1px solid #334155; 
        }

        /* ====================== MAIN LAYOUT & REST OF PAGE (UNCHANGED) ====================== */
        .main-layout { display: flex; flex: 1; overflow: hidden; }

        .sidebar {
            width: 260px;
            background: #1e293b;
            padding: 24px 0;
            border-right: 1px solid #334155;
            flex-shrink: 0;
        }
        .sidebar-header {
            padding: 0 24px 16px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #e2e8f0;
            border-bottom: 1px solid #334155;
            margin-bottom: 16px;
        }
        .sidebar-menu {
            list-style: none;
        }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .sidebar-menu a:hover {
            background: #334155;
            color: #e2e8f0;
            border-left: 4px solid #10b981;
        }
        .sidebar-menu a.active {
            background: #334155;
            color: #10b981;
            border-left: 4px solid #10b981;
        }
        .sidebar-menu i { width: 20px; font-size: 1.1rem; }

        .dashboard-content {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
        }
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #e2e8f0;
            margin-bottom: 8px;
        }
        .breadcrumb {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 24px;
        }
        .breadcrumb a { color: #3b82f6; text-decoration: none; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: #1e293b;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-6px); }
        .stat-icon {
            width: 56px; height: 56px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; color: white;
        }
        .stat-icon.users { background: #3b82f6; }
        .stat-icon.jobs { background: #10b981; }
        .stat-icon.apps { background: #f59e0b; }
        .stat-icon.active { background: #8b5cf6; }

        .stat-info h3 {
            font-size: 2rem; font-weight: 700; color: #e2e8f0; margin-bottom: 4px;
        }
        .stat-info p { color: #94a3b8; font-size: 0.95rem; }

        .charts-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }
        .chart-card {
            background: #1e293b;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .chart-placeholder {
            height: 200px;
            background: #0f172a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-style: italic;
        }

        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; padding: 16px 0; }
            .charts-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- HEADER - CLEAN: Only Logo + User Dropdown -->
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="https://via.placeholder.com/36?text=CP" alt="Logo">
                <span class="title">CAREER PATH RECOMMENDER</span>
            </div>

            <!-- User Icon with Dropdown (Homepage, My Profile, Log Out) -->
            <div class="user-menu">
                <div class="user-icon" onclick="toggleDropdown()">A</div>
                <div class="dropdown" id="user-dropdown">
                    <a href="homepage.html">Homepage</a>
                    <a href="admin-profile.html">My Profile</a>
                    <a href="login.html" class="logout">Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN LAYOUT (unchanged) -->
    <div class="main-layout">
        <aside class="sidebar">
            <div class="sidebar-header">Admin Panel</div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="admin-users.html">Edit Users</a></li>
                <li><a href="admin-questions.html">Edit Test Questions</a></li>
                <li><a href="admin-jobs.html">Edit Jobs</a></li>
            </ul>
        </aside>

        <main class="dashboard-content">
            <h1 class="page-title">Admin Dashboard</h1>
            <div class="breadcrumb">
                <a href="homepage.html">Home</a> / Dashboard
            </div>

            <!-- Stats Grid & Charts remain exactly the same -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon users">Users</div>
                    <div class="stat-info">
                        <h3>1,248</h3>
                        <p>Total Users</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon jobs">Briefcase</div>
                    <div class="stat-info">
                        <h3>83,408</h3>
                        <p>Total Jobs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon apps">File</div>
                    <div class="stat-info">
                        <h3>5,672</h3>
                        <p>Applications</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon active">Check</div>
                    <div class="stat-info">
                        <h3>892</h3>
                        <p>Active Today</p>
                    </div>
                </div>
            </div>

            <div class="charts-row">
                <div class="chart-card">
                    <h3 class="chart-title">User Growth</h3>
                    <div class="chart-placeholder">Line Chart: +12% this month</div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">Job Applications</h3>
                    <div class="chart-placeholder">Bar Chart: Top 5 roles</div>
                </div>
            </div>

            <div class="charts-row">
                <div class="chart-card">
                    <h3 class="chart-title">Test Completion Rate</h3>
                    <div class="chart-placeholder">Pie Chart: 78% completed</div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">Platform Usage</h3>
                    <div class="chart-placeholder">Donut Chart: Mobile vs Desktop</div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('user-dropdown').classList.toggle('show');
        }
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('user-dropdown').classList.remove('show');
            }
        });
    </script>
</body>
</html>