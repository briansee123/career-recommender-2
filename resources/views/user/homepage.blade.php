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
            overflow-x: hidden;
            position: relative;
        }

        /* Floating Circles Animation */
        .floating-circles {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }
        .circle:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .circle:nth-child(2) { width: 120px; height: 120px; top: 60%; right: 10%; animation-delay: 5s; }
        .circle:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 10s; }
        .circle:nth-child(4) { width: 150px; height: 150px; top: 30%; right: 20%; animation-delay: 7s; }
        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-30px) translateX(20px); }
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky; top: 0; z-index: 1000;
        }
        .nav-container {
            max-width: 1400px; margin: 0 auto; padding: 0 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo { font-size: 1.8rem; font-weight: 700; color: #667eea; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: #667eea; }
        
        .user-menu { position: relative; }
        .user-icon {
            width: 45px; height: 45px; border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; cursor: pointer;
            transition: transform 0.3s;
            font-size: 1.2rem;
        }
        .user-icon:hover { transform: scale(1.1); }
        .dropdown {
            position: absolute; top: 55px; right: 0;
            background: white; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            min-width: 180px; display: none; overflow: hidden;
        }
        .dropdown.active { display: block; }
        .dropdown a {
            display: block; padding: 12px 20px; color: #555;
            text-decoration: none; transition: background 0.3s;
        }
        .dropdown a:hover { background: #f5f5f5; }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 100px 20px 80px;
            color: white;
            position: relative;
            z-index: 1;
        }
        .hero h1 { font-size: 4rem; font-weight: 800; margin-bottom: 15px; letter-spacing: -1px; text-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .hero p { font-size: 1.4rem; font-weight: 300; margin-bottom: 40px; opacity: 0.95; }

        /* Badges & Buttons */
        .quote-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 50px;
            font-size: 1.1rem;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .cta-btn {
            background: linear-gradient(90deg, #ff758c 0%, #ff7eb3 100%);
            color: white;
            padding: 18px 50px;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(255, 117, 140, 0.4);
            transition: all 0.3s;
        }
        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255, 117, 140, 0.5);
        }

        /* Featured Jobs Section */
        .jobs-container {
            background: white;
            border-radius: 30px 30px 0 0;
            padding: 60px 40px;
            position: relative;
            z-index: 2;
            min-height: 500px;
        }
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 40px;
            padding-left: 10px;
            border-left: 5px solid #667eea;
        }

        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        .job-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
            transition: all 0.3s;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .job-title { font-size: 1.3rem; font-weight: 700; color: #333; margin-bottom: 10px; }
        .company { color: #666; display: flex; align-items: center; gap: 8px; font-weight: 500; margin-bottom: 15px; }
        .tags { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }
        .tag { background: #f3f4f6; color: #666; padding: 5px 12px; border-radius: 15px; font-size: 0.85rem; }
        
        .apply-link {
            display: block;
            text-align: center;
            background: #f8f9fa;
            color: #667eea;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .apply-link:hover {
            background: #667eea;
            color: white;
        }

        .empty-state { text-align: center; color: #999; padding: 50px; font-size: 1.2rem; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.8rem; }
            .jobs-container { padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <!-- Floating Background -->
    <div class="floating-circles">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

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
                        {{ auth()->check() ? (auth()->user()->avatar ?? strtoupper(substr(auth()->user()->name, 0, 1))) : 'U' }}
                    </div>
                    <div class="dropdown" id="userDropdown">
                        <a href="{{ route('profile') }}">Go Profile</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>JOB PARTNER</h1>
        <p>Your powerful tool to the perfect career path.</p>

        <div class="quote-badge">
            ✨ Take your time. Finding the right job is a journey, not a race. ✨
        </div>

        <br>

        <a href="{{ route('test') }}" class="cta-btn">
            🎯 Test Your Personality Now!
        </a>
    </div>

    <!-- Featured Jobs Section -->
    <div class="jobs-container">
        <h2 class="section-title">Featured Jobs for You</h2>

        @if(isset($featuredJobs) && $featuredJobs->count() > 0)
        <div class="jobs-grid">
            @foreach($featuredJobs as $job)
            <div class="job-card">
                <div class="job-title">{{ $job->title }}</div>
                <div class="company">
                    <i class="fas fa-building"></i> {{ $job->company }}
                </div>
                <div class="tags">
                    <span class="tag"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                    <span class="tag"><i class="fas fa-clock"></i> {{ $job->job_type }}</span>
                </div>
                <a href="{{ route('apply.show', ['job_id' => $job->id]) }}" class="apply-link">
                    Apply Now →
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-briefcase" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.3;"></i>
            <p>No featured jobs available right now.</p>
        </div>
        @endif
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            if (!event.target.closest('.user-icon')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown) dropdown.style.display = 'none';
            }
        }
    </script>
</body>
</html>