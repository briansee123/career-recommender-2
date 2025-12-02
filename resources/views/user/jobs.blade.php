<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAREER PATH RECOMMENDER</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: #121826;
            color: #e2e8f0;
            line-height: 1.6;
            min-height: 100vh;
        }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 16px; }

        /* Header */
        header {
            background: #0f172a;
            padding: 14px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header-top {
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
            font-size: 1.3rem;
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

        /* Nav Links */
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

        /* User Dropdown */
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
        .dropdown a:hover {
            background: #334155;
        }
        .dropdown a.logout {
            color: #f87171;
            border-top: 1px solid #334155;
        }

        /* Nav Tabs */
        .nav-tabs {
            display: flex;
            gap: 32px;
            margin: 20px 0;
            border-bottom: 1px solid #334155;
            overflow-x: auto;
            padding-bottom: 8px;
        }
        .nav-tabs a {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 0;
            white-space: nowrap;
            position: relative;
        }
        .nav-tabs a.active {
            color: #10b981;
        }
        .nav-tabs a.active::after {
            content: '';
            position: absolute;
            bottom: -9px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #10b981;
            border-radius: 2px;
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            margin-top: 20px;
        }

        /* Filters */
        .filters {
            background: #1e293b;
            border-radius: 16px;
            padding: 20px;
            height: fit-content;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .filter-group {
            margin-bottom: 20px;
        }
        .filter-group h3 {
            font-size: 1.1rem;
            margin-bottom: 12px;
            color: #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filter-group select, .filter-group input {
            width: 100%;
            padding: 10px 12px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 10px;
            color: #e2e8f0;
            font-size: 0.95rem;
        }
        .location-near-me {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }
        .location-near-me input[type="checkbox"] {
            accent-color: #10b981;
        }
        .range-slider {
            -webkit-appearance: none;
            height: 6px;
            border-radius: 3px;
            background: #334155;
            outline: none;
            margin: 12px 0;
        }
        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            background: #10b981;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Job List */
        .job-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .job-card {
            background: #1e293b;
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid #334155;
            position: relative;
            overflow: hidden;
        }
        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            border-color: #10b981;
        }
        .job-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .job-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #e2e8f0;
        }
        .company {
            font-size: 0.95rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }
        .salary {
            background: #064e3b;
            color: #6ee7b7;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 0.85rem;
            color: #94a3b8;
            margin: 12px 0;
        }
        .tag {
            background: #334155;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.8rem;
        }
        .apply-btn {
            background: linear-gradient(90deg, #10b981, #34d399);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .apply-btn:hover {
            transform: scale(1.05);
        }

        /* Results Info & Location */
        .results-info {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 16px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content { grid-template-columns: 1fr; }
            .filters { order: 2; }
        }
        @media (max-width: 768px) {
            .header-top { flex-direction: column; align-items: stretch; }
            .search-bar { max-width: 100%; }
            .nav-links { justify-content: center; margin-top: 12px; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-top">
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
                    <a href="jobs.html" class="active">More Jobs</a>
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
        </div>
    </header>

    <!-- Nav Tabs -->
    <div class="container">
        <div class="nav-tabs">
            <a href="#" class="active">Jobs</a>
            <a href="#">Companies</a>
            <a href="#">Forums</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="results-info">
            Showing <strong>83,408</strong> jobs results in <strong>Malaysia</strong>
        </div>

        <div class="main-content">
            <!-- Job List -->
            <div class="job-list">
                <!-- Job Card 1 -->
                <div class="job-card">
                    <div class="job-header">
                        <div>
                            <div class="job-title">Junior Graphic Designer</div>
                            <div class="company"><i class="fas fa-palette"></i> CreativeBloom Studio</div>
                        </div>
                        <span class="salary">MYR 2,800 - 3,800</span>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-map-marker-alt"></i> Kuala Lumpur</span>
                        <span class="tag">Full Time</span>
                        <span class="tag">Fresh Grad</span>
                        <span class="tag">Medical</span>
                    </div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <!-- Job Card 2 -->
                <div class="job-card">
                    <div class="job-header">
                        <div>
                            <div class="job-title">Content Writer (Part-Time)</div>
                            <div class="company"><i class="fas fa-pen-fancy"></i> StoryCraft Media</div>
                        </div>
                        <span class="salary">MYR 1,200 - 2,000</span>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-map-marker-alt"></i> Remote</span>
                        <span class="tag">Part Time</span>
                        <span class="tag">Flexible</span>
                        <span class="tag">WFH</span>
                    </div>
                    <button class="apply-btn">Apply Now</button>
                </div>

                <!-- Job Card 3 -->
                <div class="job-card">
                    <div class="job-header">
                        <div>
                            <div class="job-title">Frontend Developer</div>
                            <div class="company"><i class="fas fa-code"></i> NexaTech</div>
                        </div>
                        <span class="salary">MYR 4,500 - 6,500</span>
                    </div>
                    <div class="job-meta">
                        <span><i class="fas fa-map-marker-alt"></i> Cyberjaya</span>
                        <span class="tag">Full Time</span>
                        <span class="tag">Hybrid</span>
                        <span class="tag">Dental</span>
                    </div>
                    <button class="apply-btn">Apply Now</button>
                </div>
            </div>

            <!-- Filters Sidebar -->
            <div class="filters">
                <div class="filter-group">
                    <h3>Salary Range</h3>
                    <input type="range" class="range-slider" min="1000" max="10000" value="5000">
                    <div style="display:flex; justify-content:space-between; font-size:0.85rem; color:#94a3b8;">
                        <span>RM 1,000</span>
                        <span>RM 10,000+</span>
                    </div>
                </div>

                <div class="filter-group">
                    <h3>Job Type</h3>
                    <select>
                        <option>All Types</option>
                        <option>Full Time</option>
                        <option>Part Time</option>
                        <option>Internship</option>
                        <option>Contract</option>
                    </select>
                </div>

                <div class="filter-group">
                    <h3>Date Posted</h3>
                    <select>
                        <option>Any Time</option>
                        <option>Last 24 Hours</option>
                        <option>Last 3 Days</option>
                        <option>Last Week</option>
                    </select>
                </div>

                <div class="filter-group">
                    <h3>Benefits</h3>
                    <select>
                        <option>Any</option>
                        <option>Medical Coverage</option>
                        <option>Dental</option>
                        <option>EPF & SOCSO</option>
                        <option>Annual Leave</option>
                    </select>
                </div>

                <div class="filter-group">
                    <h3>Location Near Me</h3>
                    <div class="location-near-me">
                        <input type="checkbox" id="near-me">
                        <label for="near-me" style="font-size:0.9rem; cursor:pointer;">Use my location</label>
                    </div>
                    <select style="margin-top:8px;">
                        <option>Within 1 KM</option>
                        <option>Within 5 KM</option>
                        <option>Within 10 KM</option>
                        <option>Within 25 KM</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle User Dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('user-dropdown').classList.remove('show');
            }
        });

        // Demo: Location alert
        document.getElementById('near-me').addEventListener('change', function() {
            if (this.checked) {
                alert('Location access enabled! Showing jobs near you...');
            }
        });
    </script>
</body>
</html>