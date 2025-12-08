<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs - Career Path Recommender</title>
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
        .dropdown a:hover { background: #334155; }
        .dropdown button {
            background: none;
            border: none;
            color: #f87171;
            cursor: pointer;
            padding: 12px 16px;
            width: 100%;
            text-align: left;
            font-family: inherit;
            font-size: 0.95rem;
            transition: 0.2s;
        }
        .dropdown button:hover { background: #334155; }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            margin-top: 20px;
            padding-bottom: 40px;
        }

        /* Filters */
        .filters {
            background: #1e293b;
            border-radius: 16px;
            padding: 20px;
            height: fit-content;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            position: sticky;
            top: 80px;
        }
        .filter-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #e2e8f0;
            margin-bottom: 20px;
        }
        .filter-group {
            margin-bottom: 20px;
        }
        .filter-group h3 {
            font-size: 0.95rem;
            margin-bottom: 10px;
            color: #cbd5e1;
            font-weight: 600;
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

        /* Job List */
        .job-list-section {
            background: #1e293b;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .results-info {
            color: #94a3b8;
            font-size: 0.95rem;
        }
        .sort-by select {
            padding: 8px 12px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 10px;
            color: #e2e8f0;
            font-size: 0.9rem;
        }

        .job-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .job-card {
            background: #0f172a;
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid #334155;
            cursor: pointer;
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
            white-space: nowrap;
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

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .pagination a, .pagination span {
            padding: 10px 16px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 10px;
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .pagination a:hover {
            background: #10b981;
            border-color: #10b981;
        }
        .pagination .active {
            background: #10b981;
            border-color: #10b981;
        }
        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content { grid-template-columns: 1fr; }
            .filters { position: static; }
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
                    <span class="title">JOB PARTNER</span>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search jobs, skills, companies...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="nav-links">
                    <a href="{{ route('homepage') }}">Home</a>
                    <a href="{{ route('jobs') }}" class="active">More Jobs</a>
                    <a href="{{ route('test') }}">Test Now</a>
                    <div class="user-menu">
                        <div class="user-icon" onclick="toggleDropdown()">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="dropdown" id="user-dropdown">
                            <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> My Profile</a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit"><i class="fas fa-sign-out-alt"></i> Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
            <!-- Filters Sidebar -->
            <div class="filters">
                <div class="filter-title">🔍 Filters</div>
                
                <form method="GET" action="{{ route('jobs') }}">
                    <div class="filter-group">
                        <h3>Job Type</h3>
                        <select name="job_type">
                            <option value="">All Types</option>
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <h3>Location</h3>
                        <input type="text" name="location" placeholder="e.g. Kuala Lumpur" value="{{ request('location') }}">
                    </div>

                    <button type="submit" style="width: 100%; padding: 10px; background: #10b981; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; margin-top: 10px;">
                        Apply Filters
                    </button>
                </form>
            </div>

            <!-- Job List -->
            <div class="job-list-section">
                <div class="results-header">
                    <div class="results-info">
                        Showing <strong>{{ $jobs->count() }}</strong> of <strong>{{ $jobs->total() }}</strong> jobs
                    </div>
                    <div class="sort-by">
                        <select onchange="window.location.href='?sort='+this.value">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                        </select>
                    </div>
                </div>

                <div class="job-list">
                    @forelse($jobs as $job)
                        <div class="job-card" onclick="window.location.href='{{ route('apply') }}?id={{ $job->id }}'">
                            <div class="job-header">
                                <div>
                                    <div class="job-title">{{ $job->title }}</div>
                                    <div class="company"><i class="fas fa-building"></i> {{ $job->company }}</div>
                                </div>
                                @if($job->salary)
                                    <span class="salary">{{ $job->salary }}</span>
                                @endif
                            </div>
                            <div class="job-meta">
                                <span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                                <span class="tag">{{ ucfirst(str_replace('-', ' ', $job->job_type)) }}</span>
                                @if($job->required_skills)
                                    @foreach(array_slice($job->required_skills, 0, 3) as $skill)
                                        <span class="tag">{{ $skill }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <button class="apply-btn" onclick="event.stopPropagation(); window.location.href='{{ route('apply') }}?id={{ $job->id }}'">Apply Now</button>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 60px 20px;">
                            <i class="fas fa-briefcase" style="font-size: 4rem; color: #334155; margin-bottom: 20px;"></i>
                            <p style="font-size: 1.2rem; color: #94a3b8;">No jobs found. Try adjusting your filters!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($jobs->hasPages())
                    <div class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($jobs->onFirstPage())
                            <span class="disabled">« Previous</span>
                        @else
                            <a href="{{ $jobs->previousPageUrl() }}">« Previous</a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                            @if ($page == $jobs->currentPage())
                                <span class="active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($jobs->hasMorePages())
                            <a href="{{ $jobs->nextPageUrl() }}">Next »</a>
                        @else
                            <span class="disabled">Next »</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
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