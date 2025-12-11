<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAREER PATH RECOMMENDER - Jobs</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Quicksand', sans-serif;
            background: #f8fafc;
            color: #334155;
            line-height: 1.6;
            min-height: 100vh;
        }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }

        /* Main Content Adjustments */
        .main-content {
            margin-top: 30px;
            padding-bottom: 60px;
        }

        .results-info {
            color: #64748b;
            font-size: 1.1rem;
            margin: 20px 0;
            font-weight: 500;
        }

        /* Job List */
        .job-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .job-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .job-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .job-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .job-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
        }
        .company {
            font-size: 1rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 6px;
        }
        .salary {
            background: #f0fdf4;
            color: #16a34a;
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin: 16px 0;
            color: #64748b;
            font-size: 0.95rem;
        }
        .tag {
            background: #e0e7ff;
            color: #6366f1;
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .apply-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .apply-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(102,126,234,0.4);
        }

        .empty-state {
            text-align: center;
            padding: 100px 20px;
            color: #94a3b8;
        }
        .empty-state i {
            font-size: 5rem;
            margin-bottom: 24px;
            opacity: 0.4;
        }
        .empty-state h3 {
            font-size: 1.8rem;
            margin-bottom: 12px;
            color: #334155;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }
        .pagination a, .pagination span {
            padding: 10px 18px;
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }
        .pagination a:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-form > div:first-child {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

{{-- NEW PURPLE GRADIENT HEADER --}}
<header style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 18px 0; box-shadow: 0 4px 20px rgba(0,0,0,0.15); position: sticky; top: 0; z-index: 1000;">
    < at the top of the file

    <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 2rem;">💼</span>
            <span style="font-size: 1.6rem; font-weight: 700; color: white;">CAREER PATH RECOMMENDER</span>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="{{ route('homepage') }}" style="color: white; text-decoration: none; font-weight: 600; padding: 8px 16px; border-radius: 10px; transition: 0.2s;">Home</a>
            <a href="{{ route('jobs') }}" style="color: white; text-decoration: none; font-weight: 600; padding: 8px 16px; border-radius: 10px; background: rgba(255,255,255,0.2);">More Jobs</a>
            <a href="{{ route('test') }}" style="color: white; text-decoration: none; font-weight: 600; padding: 8px 16px; border-radius: 10px; transition: 0.2s;">Test Now</a>
            
            <div style="position: relative;" class="user-menu">
                <div style="width: 45px; height: 45px; background: white; color: #667eea; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; cursor: pointer; font-size: 1.2rem;" onclick="toggleDropdown()">
                    {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                </div>
                <div id="userDropdown" style="display: none; position: absolute; top: 55px; right: 0; background: white; min-width: 180px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); overflow: hidden; z-index: 1000;">
                    <a href="{{ route('profile') }}" style="display: block; padding: 12px 20px; color: #667eea; text-decoration: none; font-weight: 600; transition: 0.2s;">👤 My Profile</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="width: 100%; text-align: left; padding: 12px 20px; background: none; border: none; color: #ef4444; font-weight: 600; cursor: pointer; border-top: 1px solid #f1f5f9;">🚪 Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    {{-- NEW SEARCH/FILTER FORM --}}
    <form action="{{ route('jobs') }}" method="GET" class="search-form" style="background: white; padding: 30px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Search jobs, companies..." value="{{ request('search') }}" style="padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem;">
            
            <select name="job_type" style="padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px;">
                <option value="">All Types</option>
                <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
            </select>
            
            <select name="date_posted" style="padding: 12px; border: 2px solid #e2e8f0; border-radius: 12px;">
                <option value="">Any Time</option>
                <option value="today" {{ request('date_posted') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date_posted') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date_posted') == 'month' ? 'selected' : '' }}>This Month</option>
            </select>
        </div>
        
        <div style="display: flex; gap: 12px;">
            <button type="submit" style="flex: 1; padding: 14px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer;">🔍 Search Jobs</button>
            <a href="{{ route('jobs') }}" style="padding: 14px 30px; background: #f1f5f9; color: #64748b; border-radius: 12px; text-decoration: none; font-weight: 600; display: inline-block; text-align: center;">Clear Filters</a>
        </div>
    </form>

    <div class="results-info">
        Showing <strong>{{ $jobs->total() }}</strong> job results
    </div>

    <div class="main-content">
        <div class="job-list">
            @forelse($jobs as $job)
            <div class="job-card">
                <div class="job-header">
                    <div>
                        <div class="job-title">{{ $job->title }}</div>
                        <div class="company"><i class="fas fa-building"></i> {{ $job->company }}</div>
                    </div>
                    <span class="salary">
                        @if($job->salary_min && $job->salary_max)
                            MYR {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
                        @else
                            Salary Negotiable
                        @endif
                    </span>
                </div>
                <div class="job-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                    <span class="tag">{{ $job->job_type }}</span>
                </div>
                <a href="{{ route('apply.show', ['job_id' => $job->id]) }}" class="apply-btn">Apply Now</a>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-briefcase"></i>
                <h3>No Jobs Available</h3>
                <p>Check back later for new opportunities!</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
    <div class="pagination">
        @if($jobs->onFirstPage())
            <span>&laquo; Previous</span>
        @else
            <a href="{{ $jobs->previousPageUrl() }}">&laquo; Previous</a>
        @endif

        @foreach(range(1, $jobs->lastPage()) as $page)
            @if($page == $jobs->currentPage())
                <span class="active">{{ $page }}</span>
            @else
                <a href="{{ $jobs->url($page) }}">{{ $page }}</a>
            @endif
        @endforeach

        @if($jobs->hasMorePages())
            <a href="{{ $jobs->nextPageUrl() }}">Next &raquo;</a>
        @else
            <span>Next &raquo;</span>
        @endif
    </div>
    @endif
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    window.addEventListener('click', function(e) {
        if (!e.target.closest('.user-menu')) {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) dropdown.style.display = 'none';
        }
    });
</script>
</body>
</html>