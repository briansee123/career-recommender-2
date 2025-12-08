<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Partner - Find Your Perfect Career Path</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            color: #333;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating elements for relaxing atmosphere */
        .floating-circles {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }

        .circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 5s;
        }

        .circle:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-30px) translateX(20px); }
            50% { transform: translateY(-60px) translateX(-20px); }
            75% { transform: translateY(-30px) translateX(20px); }
        }

        /* Header Navigation */
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
            position: relative;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #667eea;
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* User Profile Dropdown */
        .user-menu {
            position: relative;
        }

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

        .user-icon:hover {
            transform: scale(1.1);
        }

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

        .dropdown a:first-child {
            border-radius: 10px 10px 0 0;
        }

        .dropdown a:last-child {
            border-radius: 0 0 10px 10px;
        }

        .dropdown a:hover {
            background: #f5f5f5;
        }

        /* Hero Section */
        .hero {
            position: relative;
            z-index: 1;
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

        .reassurance {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.15);
            padding: 15px 30px;
            border-radius: 30px;
            display: inline-block;
            margin-top: 10px;
            backdrop-filter: blur(5px);
        }

        /* Main Content */
        .container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 60px;
        }

        /* Test Button */
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

        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .job-card:hover::before {
            opacity: 0.1;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .job-card-content {
            position: relative;
            z-index: 1;
        }

        .job-card h3 {
            color: #667eea;
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .job-info {
            color: #555;
            font-size: 0.95rem;
            margin: 5px 0;
        }

        .learn-more {
            display: inline-block;
            margin-top: 15px;
            color: #764ba2;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.3s;
        }

        .learn-more:hover {
            transform: translateX(5px);
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

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 50px 20px;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #f093fb;
        }

        .footer p {
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.8);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-links {
            margin-top: 30px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #f093fb;
        }

        .copyright {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.6);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-links a {
                font-size: 0.9rem;
            }

            .jobs-grid {
                grid-template-columns: 1fr;
            }

            .test-btn {
                padding: 15px 40px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-circles">
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
                    <div class="user-icon" onclick="toggleDropdown()">👤</div>
                    <div class="dropdown" id="userDropdown">
    <a href="{{ route('profile') }}">Go Profile</a>
    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" style="background: none; border: none; color: #555; cursor: pointer; padding: 12px 20px; width: 100%; text-align: left; font-family: inherit; font-size: inherit; transition: background 0.3s;">
            Log Out
        </button>
    </form>
</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>JOB PARTNER</h1>
        <p>Your powerful tool to the perfect career path.</p>
        <div class="reassurance">
            ✨ Take your time. Finding the right job is a journey, not a race. ✨
        </div>
    </section>

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
            
            <div class="jobs-grid">
    <div class="job-card" onclick="window.location.href='{{ route('apply') }}?job=Software%20Engineer'">
        <div class="job-card-content">
            <h3>Software Engineer</h3>
            <p class="job-info">🏢 Company: Google Inc.</p>
            <p class="job-info">📍 Location: Mountain View, CA</p>
            <p class="job-info">💼 Skills: Python, C++, AWS</p>
            <a href="{{ route('apply') }}?job=Software%20Engineer" class="learn-more">Learn More →</a>
        </div>
    </div>

    <div class="job-card" onclick="window.location.href='{{ route('apply') }}?job=Data%20Scientist'">
        <div class="job-card-content">
            <h3>Data Scientist</h3>
            <p class="job-info">🏢 Company: Amazon</p>
            <p class="job-info">📍 Location: Seattle, WA</p>
            <p class="job-info">💼 Skills: R, Python, Machine Learning</p>
            <a href="{{ route('apply') }}?job=Data%20Scientist" class="learn-more">Learn More →</a>
        </div>
    </div>

    <div class="job-card" onclick="window.location.href='{{ route('apply') }}?job=UX/UI%20Designer'">
        <div class="job-card-content">
            <h3>UX/UI Designer</h3>
            <p class="job-info">🏢 Company: Adobe</p>
            <p class="job-info">📍 Location: San Jose, CA</p>
            <p class="job-info">💼 Skills: Figma, Sketch, Prototyping</p>
            <a href="{{ route('apply') }}?job=UX/UI%20Designer" class="learn-more">Learn More →</a>
        </div>
    </div>

    <div class="job-card" onclick="window.location.href='{{ route('apply') }}?job=Marketing%20Analyst'">
        <div class="job-card-content">
            <h3>Marketing Analyst</h3>
            <p class="job-info">🏢 Company: Meta</p>
            <p class="job-info">📍 Location: Menlo Park, CA</p>
            <p class="job-info">💼 Skills: SEO, SEM, Data Analysis</p>
            <a href="{{ route('apply') }}?job=Marketing%20Analyst" class="learn-more">Learn More →</a>
        </div>
    </div>

    <div class="job-card" onclick="window.location.href='{{ route('apply') }}?job=Product%20Manager'">
        <div class="job-card-content">
            <h3>Product Manager</h3>
            <p class="job-info">🏢 Company: Apple</p>
            <p class="job-info">📍 Location: Cupertino, CA</p>
            <p class="job-info">💼 Skills: Agile, Project Management</p>
            <a href="{{ route('apply') }}?job=Product%20Manager" class="learn-more">Learn More →</a>
        </div>
    </div>

    <div class="job-card" onclick="window.location.href='{{ route('apply') }}?job=DevOps%20Engineer'">
        <div class="job-card-content">
            <h3>DevOps Engineer</h3>
            <p class="job-info">🏢 Company: Netflix</p>
            <p class="job-info">📍 Location: Los Gatos, CA</p>
            <p class="job-info">💼 Skills: Docker, Kubernetes, CI/CD</p>
            <a href="{{ route('apply') }}?job=DevOps%20Engineer" class="learn-more">Learn More →</a>
        </div>
    </div>
</div>

            <div class="more-jobs-link">
                <a href="{{ route('jobs') }}">View More Jobs →</a>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <h3>About Job Partner</h3>
            <p>
                At Job Partner, we believe finding your dream career should be a fulfilling journey, 
                not a stressful race. We're here to guide you every step of the way with personalized 
                recommendations, insightful personality tests, and a supportive community. Remember, 
                there's no rush – the right opportunity will come at the right time. You've got this! 💜
            </p>
            <div class="footer-links">
                <a href="about.html">About Us</a>
                <a href="contact.html">Contact</a>
                <a href="privacy.html">Privacy Policy</a>
                <a href="terms.html">Terms of Service</a>
                <a href="faq.html">FAQ</a>
            </div>
            <div class="copyright">
                © 2024 Job Partner. All rights reserved. Made with 💜 for job seekers everywhere.
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
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