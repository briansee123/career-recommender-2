<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Career Path Recommender</title>
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

        /* HEADER - ONLY USER ICON */
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
            padding: 0 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        /* User Menu & Dropdown */
        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-icon {
            width: 45px;
            height: 45px;
            background: #fd79a8;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 2px 10px rgba(253, 121, 168, 0.3);
        }
        .user-icon:hover { 
            background: #f43f5e;
            transform: scale(1.05);
        }
        .dropdown {
            position: absolute;
            top: 55px;
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
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: 0.2s;
        }
        .dropdown a:hover { 
            background: #334155;
            padding-left: 24px;
        }
        .dropdown a.logout { 
            color: #f87171; 
            border-top: 1px solid #334155; 
        }

        /* MAIN LAYOUT */
        .main-layout { display: flex; flex: 1; overflow: hidden; }

        /* SIDEBAR */
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

        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; }
        }
    </style>
</head>
<body>

    <!-- HEADER - ONLY USER ICON -->
    <header>
        <div class="header-container">
            <div class="user-menu">
                <div class="user-icon" onclick="toggleDropdown()">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="dropdown" id="user-dropdown">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i> Homepage
                    </a>
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-cog"></i> My Profile
                    </a>
                    <a href="{{ route('logout') }}" class="logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- MAIN LAYOUT -->
    <div class="main-layout">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">Admin Panel</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Edit Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.questions') }}" class="{{ request()->routeIs('admin.questions') ? 'active' : '' }}">
                        <i class="fas fa-question-circle"></i> Edit Test Questions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jobs') }}" class="{{ request()->routeIs('admin.jobs') ? 'active' : '' }}">
                        <i class="fas fa-briefcase"></i> Edit Jobs
                    </a>
                </li>
            </ul>
        </aside>

        <!-- CONTENT -->
        <main>
            @yield('content')
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