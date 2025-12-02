<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jobs - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #1a1a1a;
            color: white;
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
            gap: 10px;
            font-size: 1.35rem;
            font-weight: 700;
        }
        .logo-icon { font-size: 1.8rem; }
        .logo-title {
            background: linear-gradient(90deg, #66bb6a, #4caf50);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 0.5px;
        }

        .user-menu { position: relative; }
        .user-icon {
            width: 44px; height: 44px;
            background: #ff4081; color: white;
            border-radius: 50%; display: flex;
            align-items: center; justify-content: center;
            font-size: 1.1rem; cursor: pointer;
            transition: all 0.3s;
        }
        .user-icon:hover { transform: scale(1.12); box-shadow: 0 0 15px rgba(255,64,129,0.4); }
        .dropdown {
            position: absolute; top: 55px; right: 0;
            background: white; min-width: 180px;
            border-radius: 14px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden; opacity: 0; visibility: hidden;
            transform: translateY(-10px); transition: all 0.3s ease; z-index: 1000;
        }
        .dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown a {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; color: #2e7d32; text-decoration: none;
            font-weight: 600; font-size: 0.95rem; transition: 0.2s;
        }
        .dropdown a:hover { background: #f1f8f4; color: #4caf50; padding-left: 20px; }
        .dropdown a.logout { color: #f87171; border-top: 1px solid #e8f5e9; }

        .main-layout { display: flex; flex: 1; overflow: hidden; }

        .sidebar {
            width: 260px; background: white; padding: 24px 0;
            box-shadow: 4px 0 15px rgba(76, 175, 80, 0.1); flex-shrink: 0;
        }
        .sidebar-header {
            padding: 0 24px 16px; font-size: 1.1rem; font-weight: 700;
            color: #2e7d32; border-bottom: 2px solid #e8f5e9;
            margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
        }
        .sidebar-header::before { content: "Shield"; font-size: 1.3rem; }
        .sidebar-menu { list-style: none; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 24px; color: #66bb6a; text-decoration: none;
            font-weight: 600; transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .sidebar-menu a:hover {
            background: #f1f8f4; color: #4caf50;
            border-left-color: #81c784; padding-left: 28px;
        }
        .sidebar-menu a.active {
            background: linear-gradient(90deg, #e8f5e9 0%, transparent 100%);
            color: #2e7d32; border-left-color: #4caf50; font-weight: 700;
        }
        .sidebar-menu i { width: 20px; font-size: 1.1rem; }

        .content { flex: 1; padding: 32px; overflow-y: auto; }
        .page-header {
            background: white; border-radius: 20px; padding: 30px 40px;
            margin-bottom: 30px; box-shadow: 0 10px 40px rgba(76, 175, 80, 0.15);
        }
        .page-title {
            font-size: 2rem; font-weight: 700; color: #2e7d32;
            margin-bottom: 8px; display: flex; align-items: center; gap: 12px;
        }
        .page-title::before { content: "Briefcase"; font-size: 2.2rem; }
        .breadcrumb { color: #66bb6a; font-size: 0.95rem; }
        .breadcrumb a { color: #4caf50; text-decoration: none; font-weight: 600; }
        .breadcrumb a:hover { text-decoration: underline; }

        .summary-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px; margin-bottom: 25px;
        }
        .summary-card {
            background: white; padding: 20px; border-radius: 16px;
            text-align: center; box-shadow: 0 6px 20px rgba(76, 175, 80, 0.1);
            transition: transform 0.3s;
        }
        .summary-card:hover { transform: translateY(-5px); }
        .summary-label {
            font-size: 0.85rem; color: #66bb6a; text-transform: uppercase;
            letter-spacing: 1px; margin-bottom: 8px;
        }
        .summary-value {
            font-size: 2.2rem; font-weight: 700;
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        .controls {
            background: white; padding: 25px 40px; border-radius: 20px;
            margin-bottom: 25px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 10px 40px rgba(76, 175, 80, 0.15);
            flex-wrap: wrap; gap: 15px;
        }
        .search-box { position: relative; flex: 1; max-width: 400px; }
        .search-box input {
            width: 100%; padding: 12px 45px 12px 20px;
            border: 2px solid #c8e6c9; border-radius: 25px;
            font-size: 14px; outline: none; transition: all 0.3s;
        }
        .search-box input:focus {
            border-color: #66bb6a; box-shadow: 0 0 0 3px rgba(102, 187, 106, 0.1);
        }
        .search-box::after {
            content: "Search"; position: absolute; right: 18px; top: 50%;
            transform: translateY(-50%); font-size: 1.1rem;
        }
        .filter-group { display: flex; gap: 15px; align-items: center; }
        .filter-select {
            padding: 10px 18px; border: 2px solid #c8e6c9; border-radius: 20px;
            background: white; font-size: 14px; cursor: pointer; outline: none;
            transition: all 0.3s; font-weight: 600; color: #4caf50;
        }
        .filter-select:hover { border-color: #66bb6a; background: #f1f8f4; }
        .add-btn {
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            color: white; border: none; padding: 12px 28px; border-radius: 25px;
            font-size: 15px; font-weight: 600; cursor: pointer;
            display: flex; align-items: center; gap: 8px; transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        .add-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4); }
        .add-btn::before { content: "Plus"; font-size: 16px; }

        .table-container {
            background: white; border-radius: 20px; padding: 25px 40px 40px;
            overflow-x: auto; box-shadow: 0 10px 40px rgba(76, 175, 80, 0.15);
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); }
        th {
            padding: 15px; text-align: left; font-weight: 700;
            color: #2e7d32; font-size: 13px; text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tbody tr {
            border-bottom: 1px solid #e8f5e9; transition: all 0.3s;
        }
        tbody tr:hover { background: #f1f8f4; }
        td { padding: 18px 15px; font-size: 14px; color: #424242; }
        .status-badge {
            padding: 6px 14px; border-radius: 20px; font-size: 12px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .status-active { background: #c8e6c9; color: #1b5e20; }
        .status-inactive { background: #fff9c4; color: #f57f17; }
        .status-blocked { background: #ffcdd2; color: #c62828; }
        .company-info { display: flex; align-items: center; gap: 10px; }
        .company-icon {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, #81c784 0%, #66bb6a 100%);
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; color: white; font-size: 16px;
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
        }

        /* Action Dropdown Button */
        .action-dropdown {
            position: relative; display: inline-block;
        }
        .action-btn {
            background: #f1f8f4; border: 2px solid #c8e6c9;
            color: #4caf50; padding: 8px 16px; border-radius: 20px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all 0.3s; display: flex; align-items: center; gap: 6px;
        }
        .action-btn:hover { background: #e8f5e9; border-color: #66bb6a; }
        .action-btn::after { content: "Down Arrow"; font-size: 10px; }
        .action-menu {
            display: none; position: absolute; right: 0; top: 40px;
            background: white; min-width: 160px; border-radius: 12px;
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3); z-index: 10;
            border: 2px solid #e8f5e9; overflow: hidden;
        }
        .action-menu a {
            display: block; padding: 10px 16px; color: #424242;
            text-decoration: none; font-size: 13px; font-weight: 600;
            transition: 0.2s;
        }
        .action-menu a:hover { background: #f1f8f4; color: #4caf50; padding-left: 20px; }
        .action-dropdown.open .action-menu { display: block; }

        .availability { font-weight: 700; }
        .available-yes { color: #4caf50; }
        .available-yes::before { content: "Checkmark "; }
        .available-no { color: #f57f17; }
        .available-no::before { content: "Cross "; }

        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(46, 125, 50, 0.3); backdrop-filter: blur(5px); }
        .modal-content { background: white; margin: 5% auto; padding: 30px; border-radius: 20px; width: 90%; max-width: 600px; box-shadow: 0 15px 50px rgba(76, 175, 80, 0.4); animation: slideDown 0.3s ease; }
        @keyframes slideDown { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e8f5e9; }
        .modal-header h2 { color: #2e7d32; font-size: 24px; display: flex; align-items: center; gap: 10px; }
        .modal-header h2::before { content: "Plus"; font-size: 1.5rem; }
        .close { color: #aaa; font-size: 28px; font-weight: bold; cursor: pointer; transition: all 0.3s; }
        .close:hover { color: #4caf50; transform: rotate(90deg); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2e7d32; font-weight: 700; font-size: 14px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px 15px; border: 2px solid #c8e6c9; border-radius: 12px; font-size: 14px; outline: none; transition: all 0.3s; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #66bb6a; box-shadow: 0 0 0 3px rgba(102, 187, 106, 0.1); }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 25px; }
        .btn-submit, .btn-cancel { padding: 12px 30px; border-radius: 20px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .btn-submit { background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%); color: white; border: none; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4); }
        .btn-cancel { background: #f5f5f5; color: #666; border: 2px solid #e0e0e0; }
        .btn-cancel:hover { background: #e0e0e0; }

        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { width: 100%; padding: 16px 0; }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-container">
            <div class="logo">
                <span class="logo-icon">Leaf</span>
                <span class="logo-title">CAREER PATH RECOMMENDER</span>
            </div>
            <div class="user-menu">
                <div class="user-icon" onclick="toggleDropdown()">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dropdown" id="userDropdown">
                    <a href="profile.html"><i class="fas fa-user-circle"></i> My Profile</a>
                    <a href="homepage.html"><i class="fas fa-home"></i> Homepage</a>
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
                <li><a href="admin-questions.html"><i class="fas fa-question-circle"></i> Edit Test Questions</a></li>
                <li><a href="admin-jobs.html" class="active"><i class="fas fa-briefcase"></i> Edit Jobs</a></li>
            </ul>
        </aside>

        <!-- CONTENT -->
        <main class="content">
            <div class="page-header">
                <h1 class="page-title">Job Management</h1>
                <div class="breadcrumb">
                    <a href="homepage.html">Home</a> / <a href="admin-dashboard.html">Dashboard</a> / Edit Jobs
                </div>
            </div>

            <!-- Summary -->
            <div class="summary-grid">
                <div class="summary-card"><div class="summary-label">Total Jobs</div><div class="summary-value" id="totalJobs">12</div></div>
                <div class="summary-card"><div class="summary-label">Active</div><div class="summary-value" id="activeJobs">8</div></div>
                <div class="summary-card"><div class="summary-label">Inactive</div><div class="summary-value" id="inactiveJobs">2</div></div>
                <div class="summary-card"><div class="summary-label">Blocked</div><div class="summary-value" id="blockedJobs">2</div></div>
            </div>

            <!-- Controls -->
            <div class="controls">
                <div class="search-box">
                    <input type="text" placeholder="Search jobs, companies, locations..." id="searchInput">
                </div>
                <div class="filter-group">
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="blocked">Blocked</option>
                    </select>
                    <button class="add-btn" onclick="openAddModal()">Add Job</button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Available</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="jobTableBody">
                        <!-- JS will fill this -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div id="jobModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Job</h2>
                <span class="close" onclick="closeModal()">x</span>
            </div>
            <form id="jobForm">
                <input type="hidden" id="editJobId">
                <div class="form-group">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" id="jobTitle" required>
                </div>
                <div class="form-group">
                    <label for="company">Company Name</label>
                    <input type="text" id="company" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="blocked">Blocked</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="available">Available</label>
                    <select id="available">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn-submit" id="submitBtn">Add Job</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Job Data
        let jobs = [
            { id: "JB001", title: "Senior Frontend Developer", company: "TechGrow Solutions", icon: "TG", location: "Kuala Lumpur, MY", status: "active", available: "yes", updated: "Nov 14, 2025" },
            { id: "JB002", title: "Marketing Manager", company: "Green Innovations", icon: "GI", location: "Penang, MY", status: "active", available: "yes", updated: "Nov 13, 2025" },
            { id: "JB003", title: "UX Designer", company: "Design Corp", icon: "DC", location: "Johor Bahru, MY", status: "inactive", available: "no", updated: "Nov 10, 2025" },
            { id: "JB004", title: "Data Analyst", company: "DataWise Inc", icon: "DW", location: "Cyberjaya, MY", status: "blocked", available: "no", updated: "Nov 8, 2025" },
            { id: "JB005", title: "Project Coordinator", company: "EcoSmart Systems", icon: "ES", location: "Shah Alam, MY", status: "active", available: "yes", updated: "Nov 14, 2025" },
            { id: "JB006", title: "Backend Engineer", company: "CloudPeak", icon: "CP", location: "Singapore", status: "active", available: "yes", updated: "Nov 12, 2025" },
            { id: "JB007", title: "HR Specialist", company: "PeopleFirst", icon: "PF", location: "Petaling Jaya, MY", status: "active", available: "yes", updated: "Nov 11, 2025" },
            { id: "JB008", title: "DevOps Engineer", company: "InfraCore", icon: "IC", location: "Remote", status: "inactive", available: "no", updated: "Nov 9, 2025" },
            { id: "JB009", title: "Product Manager", company: "NextGen Labs", icon: "NL", location: "Kuala Lumpur, MY", status: "active", available: "yes", updated: "Nov 14, 2025" },
            { id: "JB010", title: "Graphic Designer", company: "CreativeWave", icon: "CW", location: "George Town, MY", status: "blocked", available: "no", updated: "Nov 7, 2025" },
            { id: "JB011", title: "AI Researcher", company: "NeuraMind", icon: "NM", location: "Cyberjaya, MY", status: "active", available: "yes", updated: "Nov 13, 2025" },
            { id: "JB012", title: "Sales Executive", company: "GrowthPath", icon: "GP", location: "Subang Jaya, MY", status: "active", available: "yes", updated: "Nov 14, 2025" }
        ];

        // Render Table
        function renderJobs() {
            const tbody = document.getElementById('jobTableBody');
            tbody.innerHTML = jobs.map(job => `
                <tr data-id="${job.id}">
                    <td>${job.id}</td>
                    <td>${job.title}</td>
                    <td><div class="company-info"><div class="company-icon">${job.icon}</div><span>${job.company}</span></div></td>
                    <td>${job.location}</td>
                    <td><span class="status-badge status-${job.status}">${job.status.toUpperCase()}</span></td>
                    <td><span class="availability available-${job.available}">${job.available === 'yes' ? 'Yes' : 'No'}</span></td>
                    <td>${job.updated}</td>
                    <td>
                        <div class="action-dropdown">
                            <button class="action-btn" onclick="toggleActionMenu(this)">Actions</button>
                            <div class="action-menu">
                                <a href="#" onclick="event.preventDefault(); viewJob('${job.id}')">View Details</a>
                                <a href="#" onclick="event.preventDefault(); editJob('${job.id}')">Edit</a>
                                ${job.status === 'active' ? `<a href="#" onclick="event.preventDefault(); deactivateJob('${job.id}')">Deactivate</a>` : ''}
                                ${job.status === 'inactive' ? `<a href="#" onclick="event.preventDefault(); activateJob('${job.id}')">Activate</a>` : ''}
                                ${job.status !== 'blocked' ? `<a href="#" onclick="event.preventDefault(); blockJob('${job.id}')">Block / Ban</a>` : ''}
                                ${job.status === 'blocked' ? `<a href="#" onclick="event.preventDefault(); unblockJob('${job.id}')">Unblock</a>` : ''}
                                <a href="#" onclick="event.preventDefault(); deleteJob('${job.id}')">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            `).join('');
            updateSummary();
        }

        // Update Summary
        function updateSummary() {
            document.getElementById('totalJobs').textContent = jobs.length;
            document.getElementById('activeJobs').textContent = jobs.filter(j => j.status === 'active').length;
            document.getElementById('inactiveJobs').textContent = jobs.filter(j => j.status === 'inactive').length;
            document.getElementById('blockedJobs').textContent = jobs.filter(j => j.status === 'blocked').length;
        }

    // Action Functions
    function viewJob(id) { alert(`Viewing job: ${id}`); }
    function editJob(id) {
        const job = jobs.find(j => j.id === id);
        document.getElementById('modalTitle').textContent = 'Edit Job';
        document.getElementById('submitBtn').textContent = 'Update Job';
        document.getElementById('editJobId').value = id;
        document.getElementById('jobTitle').value = job.title;
        document.getElementById('company').value = job.company;
        document.getElementById('location').value = job.location;
        document.getElementById('status').value = job.status;
        document.getElementById('available').value = job.available;
        openModal();
    }
    function activateJob(id) { changeStatus(id, 'active', 'activated'); }
    function deactivateJob(id) { changeStatus(id, 'inactive', 'deactivated'); }
    function blockJob(id) { changeStatus(id, 'blocked', 'blocked/banned'); }
    function unblockJob(id) { changeStatus(id, 'active', 'unblocked'); }
    function deleteJob(id) {
        if (confirm(`Permanently delete ${id}?`)) {
            jobs = jobs.filter(j => j.id !== id);
            renderJobs();
        }
    }
    function changeStatus(id, status, action) {
        const job = jobs.find(j => j.id === id);
        if (!job) {
            alert(`Job ${id} not found.`);
            return;
        }
        job.status = status;
        job.updated = new Date().toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
        renderJobs();
        alert(`Job ${id} has been ${action}.`);
    }

        // Toggle Action Menu
        function toggleActionMenu(btn) {
            const dropdown = btn.parentElement;
            document.querySelectorAll('.action-dropdown').forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        }

        // Close menus on outside click
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.action-dropdown') && !e.target.closest('.user-menu')) {
                document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('open'));
                document.getElementById('userDropdown').classList.remove('show');
            }
        });

        // Modal
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Add New Job';
            document.getElementById('submitBtn').textContent = 'Add Job';
            document.getElementById('jobForm').reset();
            document.getElementById('editJobId').value = '';
            openModal();
        }
        function openModal() { document.getElementById('jobModal').style.display = 'block'; }
        function closeModal() { document.getElementById('jobModal').style.display = 'none'; }

        // Form Submit
        document.getElementById('jobForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('editJobId').value || `JB${String(jobs.length + 1).padStart(3, '0')}`;
            const newJob = {
                id, title: document.getElementById('jobTitle').value,
                company: document.getElementById('company').value,
                icon: document.getElementById('company').value.split(' ').map(w => w[0]).join('').substring(0,2).toUpperCase(),
                location: document.getElementById('location').value,
                status: document.getElementById('status').value,
                available: document.getElementById('available').value,
                updated: new Date().toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
            };
            if (document.getElementById('editJobId').value) {
                const index = jobs.findIndex(j => j.id === id);
                jobs[index] = { ...jobs[index], ...newJob };
            } else {
                jobs.push(newJob);
            }
            closeModal();
            renderJobs();
        });

        // Search & Filter
        document.getElementById('searchInput').addEventListener('input', filterJobs);
        document.getElementById('statusFilter').addEventListener('change', filterJobs);
        function filterJobs() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            document.querySelectorAll('#jobTableBody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                const rowStatus = row.querySelector('.status-badge').textContent.toLowerCase();
                row.style.display = (text.includes(query) && (!status || rowStatus === status)) ? '' : 'none';
            });
        }

        // User Dropdown
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        // Init
        renderJobs();
    </script>
</body>
</html>