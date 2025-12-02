<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: #f1f5f9;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ====================== HEADER ====================== */
        header {
            background: #0f172a;
            padding: 14px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

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
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .user-icon:hover { background: #2563eb; }
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

        /* ====================== MAIN LAYOUT ====================== */
        .main-layout {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* ====================== SIDEBAR ====================== */
        .sidebar {
            width: 260px;
            background: #1e40af;
            padding: 24px 0;
            border-right: 1px solid #1d4ed8;
            flex-shrink: 0;
        }
        .sidebar-header {
            padding: 0 24px 16px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #e0e7ff;
            border-bottom: 1px solid #1d4ed8;
            margin-bottom: 16px;
        }
        .sidebar-menu {
            list-style: none;
        }
        .sidebar-menu li {
            margin-bottom: 4px;
        }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #dbeafe;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .sidebar-menu a:hover {
            background: #1d4ed8;
            color: white;
        }
        .sidebar-menu a.active {
            background: #1d4ed8;
            color: white;
            border-left: 4px solid #60a5fa;
        }
        .sidebar-menu i {
            width: 20px;
            font-size: 1.1rem;
        }

        /* ====================== CONTENT ====================== */
        .content {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
            background: #f8fafc;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
        }
        .search-add {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-box input {
            padding: 10px 14px 10px 40px;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            font-size: 1rem;
            width: 280px;
            background: white;
            transition: all 0.3s;
        }
        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .search-box i {
            position: absolute;
            left: 12px;
            color: #64748b;
        }

        /* ====================== DROPDOWN: Add User / Add Admin ====================== */
        .dropdown-menu {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }
        .dropdown-toggle:hover {
            background: #2563eb;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 180px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
            z-index: 1000;
            margin-top: 6px;
        }
        .dropdown-content a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: #334155;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }
        .dropdown-content a:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .dropdown-menu:hover .dropdown-content {
            display: block;
        }

        /* ====================== TABLE ====================== */
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #f1f5f9;
        }
        th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 0.95rem;
            border-bottom: 1px solid #e2e8f0;
        }
        th:first-child { width: 60px; }
        th:last-child { text-align: center; }
        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #e2e8f0;
        }
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .user-name {
            font-weight: 600;
            color: #1e293b;
        }
        .user-email {
            font-size: 0.85rem;
            color: #64748b;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status.active { background: #dcfce7; color: #166534; }
        .status.inactive { background: #fef3c7; color: #713f12; }
        .status.suspended { background: #fee2e2; color: #991b1b; }

        .action-btn {
            background: none;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: 0.2s;
        }
        .action-btn.edit { color: #3b82f6; }
        .action-btn.edit:hover { background: #dbeafe; }
        .action-btn.delete { color: #ef4444; }
        .action-btn.delete:hover { background: #fee2e2; }
        .action-btn.ban { color: #f59e0b; }
        .action-btn.ban:hover { background: #fef3c7; }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: white;
            border-top: 1px solid #e2e8f0;
            font-size: 0.95rem;
            color: #64748b;
        }
        .pagination-links {
            display: flex;
            gap: 6px;
        }
        .pagination-links a {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            transition: 0.2s;
        }
        .pagination-links a:hover {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        .pagination-links a.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; padding: 16px 0; }
            .page-header { flex-direction: column; align-items: stretch; }
            .search-add { width: 100%; }
            .search-box input { width: 100%; }
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }
            tr { border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 12px; padding: 12px; }
            td { border: none; position: relative; padding-left: 50%; }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                width: 45%;
                font-weight: 600;
                color: #475569;
            }
            .action-cell { text-align: right; padding-left: 16px; }
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
            <div class="nav-links">
                <a href="admin-homepage.html">Home</a>
                <a href="test.html">Test Now</a>
                <div class="user-menu">
                    <div class="user-icon" onclick="toggleDropdown()">
                        Admin
                    </div>
                    <div class="dropdown" id="user-dropdown">
                        <a href="profile.html">My Profile</a>
                        <a href="#" class="logout">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ====================== MAIN LAYOUT ====================== -->
    <div class="main-layout">
        <!-- ====================== SIDEBAR ====================== -->
        <aside class="sidebar">
            <div class="sidebar-header">Admin Panel</div>
            <ul class="sidebar-menu">
                <li><a href="admin-homepage.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="usermanagement.html" class="active"><i class="fas fa-users"></i> Edit Users</a></li>
                <li><a href="admin-questions.html"><i class="fas fa-question-circle"></i> Edit Test Questions</a></li>
                <li><a href="admin-jobs.html"><i class="fas fa-briefcase"></i> Edit Jobs</a></li>
            </ul>
        </aside>

        <!-- ====================== CONTENT ====================== -->
        <main class="content">
            <div class="page-header">
                <h1 class="page-title">User Management</h1>
                <div class="search-add">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search users..." id="search-input">
                    </div>

                    <!-- DROPDOWN: Add User / Add Admin -->
                    <div class="dropdown-menu">
                        <button class="dropdown-toggle">
                            <i class="fas fa-plus"></i> Add New <i class="fas fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#" onclick="alert('Opening Add User Form...')">
                                <i class="fas fa-user"></i> Add User
                            </a>
                            <a href="#" onclick="alert('Opening Add Admin Form...')">
                                <i class="fas fa-user-shield"></i> Add Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="user-cell">
                                <div class="user-avatar">
                                    <img src="https://i.pravatar.cc/150?img=1" alt="Andrew">
                                </div>
                                <div>
                                    <div class="user-name">Andrew Mike</div>
                                    <div class="user-email">andrew@admin.com</div>
                                </div>
                            </td>
                            <td>04/10/2014</td>
                            <td>Admin</td>
                            <td><span class="status active">Active</span></td>
                            <td class="action-cell">
                                <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" title="Delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="user-cell">
                                <div class="user-avatar">
                                    <img src="https://i.pravatar.cc/150?img=2" alt="John">
                                </div>
                                <div>
                                    <div class="user-name">John Doe</div>
                                    <div class="user-email">john@publisher.com</div>
                                </div>
                            </td>
                            <td>06/09/2015</td>
                            <td>Publisher</td>
                            <td><span class="status active">Active</span></td>
                            <td class="action-cell">
                                <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn ban" title="Suspend"><i class="fas fa-ban"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="user-cell">
                                <div class="user-avatar">
                                    <img src="https://i.pravatar.cc/150?img=3" alt="Michael">
                                </div>
                                <div>
                                    <div class="user-name">Micheal Holz</div>
                                    <div class="user-email">micheal@pub.com</div>
                                </div>
                            </td>
                            <td>09/05/2016</td>
                            <td>Publisher</td>
                            <td><span class="status inactive">Inactive</span></td>
                            <td class="action-cell">
                                <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" title="Delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="user-cell">
                                <div class="user-avatar">
                                    <img src="https://i.pravatar.cc/150?img=4" alt="Alex">
                                </div>
                                <div>
                                    <div class="user-name">Alex Mike</div>
                                    <div class="user-email">alex@reviewer.com</div>
                                </div>
                            </td>
                            <td>11/09/2018</td>
                            <td>Reviewer</td>
                            <td><span class="status suspended">Suspended</span></td>
                            <td class="action-cell">
                                <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn ban" title="Reactivate"><i class="fas fa-undo"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="user-cell">
                                <div class="user-avatar">
                                    <img src="https://i.pravatar.cc/150?img=5" alt="Paula">
                                </div>
                                <div>
                                    <div class="user-name">Paula Wilson</div>
                                    <div class="user-email">paula@reviewer.com</div>
                                </div>
                            </td>
                            <td>09/09/2019</td>
                            <td>Reviewer</td>
                            <td><span class="status active">Active</span></td>
                            <td class="action-cell">
                                <button class="action-btn edit" title="Edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" title="Delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination">
                    <div>Showing 5 out of 25 entries</div>
                    <div class="pagination-links">
                        <a href="#">Previous</a>
                        <a href="#">1</a>
                        <a href="#" class="active">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">Next</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle User Dropdown
        function toggleDropdown() {
            document.getElementById('user-dropdown').classList.toggle('show');
        }
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('user-dropdown').classList.remove('show');
            }
        });

        // Search filter
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</body>
</html>