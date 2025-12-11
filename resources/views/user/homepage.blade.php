<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Partner - Find Your Perfect Career Path</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Navigation */
        .navbar {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #667eea;
        }
        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }
        .nav-links a:hover { color: #667eea; }
        .user-menu { position: relative; }
        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .user-icon:hover { transform: scale(1.1); }
        .dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            min-width: 160px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
        }
        .dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown a {
            display: block;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            transition: background 0.3s;
        }
        .dropdown a:hover { background: #f5f5f5; }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 80px 20px 60px;
            max-width: 900px;
            margin: 0 auto;
        }
        .hero h1 {
            font-size: 3.5rem;
            color: white;
            margin-bottom: 15px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .hero p {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 20px;
            font-weight: 300;
        }

        /* Success Message */
        .success-message {
            max-width: 1200px;
            margin: 20px auto;
            padding: 15px 30px;
            background: #10b981;
            color: white;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 60px;
        }

        /* Test CTA */
        .test-cta {
            text-align: center;
            margin: 50px 0;
        }
        .test-btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            padding: 20px 60px;
            font-size: 1.4rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .test-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(245, 87, 108, 0.4);
        }

        /* Jobs Section */
        .jobs-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 2rem;
            color: #333;
            font-weight: 600;
        }
        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        .job-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            padding: 25px;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        .job-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }
        .company {
            font-size: 0.95rem;
            color: #666;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
        }
        .job-info {
            color: #555;
            font-size: 0.85rem;
            margin: 5px 0;
        }
        .salary {
            background: #10b981;
            color: white;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }
        .apply-btn {
            background: linear-gradient(90deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: 0.2s;
            margin-top: 15px;
            width: 100%;
        }
        .apply-btn:hover {
            transform: scale(1.05);
        }
        .more-jobs-link {
            text-align: center;
            margin-top: 20px;
        }
        .more-jobs-link a {
            color: #667eea;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: border-color 0.3s;
        }
        .more-jobs-link a:hover {
            border-bottom-color: #667eea;
        }

        .no-jobs {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        .no-jobs i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .jobs-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">JOB PARTNER</div>
            <div class="nav-links">
                <a href="{{ route('homepage') }}">Home</a>
                <a href="{{ route('jobs') }}">More Jobs</a>
                <a href="{{ route('test') }}">Test Now</a>
                <div class="user-menu">
                    <div class="user-icon" onclick="toggleDropdown()">
                        {{ auth()->user()->avatar ?? '👤' }}
                    </div>
                    <div class="dropdown" id="userDropdown">
                        <a href="{{ route('profile') }}">Go Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Hero Section -->
    <section class="hero">
        <h1>JOB PARTNER</h1>
        <p>Your powerful tool to the perfect career path.</p>
    </section>

    <!-- Success Message -->
    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    <!-- Main Content -->
    <div class="container">
        <!-- Test CTA -->
        <div class="test-cta">
            <a href="{{ route('test') }}" class="test-btn">🎯 Test Your Personality Now!</a>
        </div>

        <!-- Featured Jobs -->
        <section class="jobs-section">
            <div class="section-header">
                <h2 class="section-title">Featured Jobs for You</h2>
            </div>
            
            @if($featuredJobs->count() > 0)
            <div class="jobs-grid">
                @foreach($featuredJobs as $job)
<div class="job-card">
    <h3 class="job-title">{{ $job->title }}</h3>
    <p class="company"><i class="fas fa-building"></i> {{ $job->company }}</p>
    <p class="job-info"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</p>
    <p class="job-info"><i class="fas fa-briefcase"></i> {{ $job->job_type }}</p>
    @if($job->salary_min && $job->salary_max)
    <span class="salary">RM {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}</span>
    @endif
    <a href="{{ route('apply.show', ['job_id' => $job->id]) }}" class="apply-btn" style="display: block; text-align: center; text-decoration: none;">Apply Now →</a>
</div>
@endforeach
            </div>

            <div class="more-jobs-link">
                <a href="{{ route('jobs') }}">View More Jobs →</a>
            </div>
            @else
            <div class="no-jobs">
                <i class="fas fa-briefcase"></i>
                <h3>No jobs available yet</h3>
                <p>Admin can add jobs from the admin panel</p>
            </div>
            @endif
        </section>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.user-icon')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown.classList.contains('active')) {
                    dropdown.classList.remove('active');
                }
            }
        }
    </script>
</body>
</html>