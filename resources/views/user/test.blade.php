<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Path Recommender - Test</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(120deg, #aeefff 0%, #fceabb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .test-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            max-width: 700px;
            width: 100%;
            padding: 40px 32px 32px 32px;
            margin: 40px 0;
        }
        .test-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        .test-title .emoji {
            font-size: 2rem;
        }
        .test-desc {
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 32px;
            text-align: center;
        }
        .section-header {
            font-size: 1.3rem;
            font-weight: 600;
            color: #4a90e2;
            margin-top: 24px;
            margin-bottom: 10px;
            text-align: left;
        }
        .input-group {
            margin-bottom: 18px;
        }
        .input-group label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #222;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fdfad6;
            font-size: 1rem;
            margin-top: 4px;
        }
        .quiz-section {
            margin-top: 24px;
        }
        .quiz-question {
            background: #f4f4f4;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 18px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .quiz-question p {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .quiz-options label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
            cursor: pointer;
        }
        .submit-btn {
            width: 100%;
            padding: 14px 0;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%);
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 24px;
            box-shadow: 0 2px 6px rgba(74,144,226,0.09);
            transition: background 0.2s;
        }
        .result-section {
            margin-top: 32px;
            background: #e6f7ff;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .result-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4a90e2;
            margin-bottom: 10px;
        }
        .result-mbti {
            font-size: 1.2rem;
            font-weight: 600;
            color: #f76b1c;
            margin-bottom: 12px;
        }
        .result-jobs {
            font-size: 1.1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <div style="margin-bottom:18px;">
            <a href="homepage.html" style="color:#4a90e2;font-weight:600;text-decoration:none;font-size:1.05rem;">← Back to Homepage</a>
        </div>
        <div class="test-title">
            Job Partner! <span class="emoji">🌴🌞</span>
        </div>
        <div class="test-desc">
            Your AI-powered guide to the perfect career path
        </div>
        <form id="test-form">
            <div class="section-header">Career & Personality Test</div>
            <div class="input-group">
                <label for="skills">Your Skills (comma separated):</label>
                <input type="text" id="skills" name="skills" required>
            </div>
            <div class="input-group">
                <label for="interests">Your Interests:</label>
                <input type="text" id="interests" name="interests" required>
            </div>
            <div class="input-group">
                <label for="academic">Academic Background:</label>
                <select id="academic" name="academic" required>
                    <option value="">Select...</option>
                    <option value="Science">Science</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Business">Business</option>
                    <option value="Arts">Arts</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <hr>
            <div class="section-header">Personality Quiz (Mini-MBTI)</div>
            <div class="quiz-section">
                <div class="quiz-question">
                    <p>Q1: In a group project, are you the one who...</p>
                    <div class="quiz-options">
                        <label><input type="radio" name="q1" value="E" required> A. Takes charge and talks a lot</label>
                        <label><input type="radio" name="q1" value="I"> B. Listens and thinks before speaking</label>
                    </div>
                </div>
                <div class="quiz-question">
                    <p>Q2: When solving problems, do you prefer...</p>
                    <div class="quiz-options">
                        <label><input type="radio" name="q2" value="S" required> A. Practical solutions</label>
                        <label><input type="radio" name="q2" value="N"> B. Creative ideas</label>
                    </div>
                </div>
                <div class="quiz-question">
                    <p>Q3: When making decisions, do you rely more on...</p>
                    <div class="quiz-options">
                        <label><input type="radio" name="q3" value="T" required> A. Logic and facts</label>
                        <label><input type="radio" name="q3" value="F"> B. Feelings and values</label>
                    </div>
                </div>
                <div class="quiz-question">
                    <p>Q4: Do you prefer your life to be...</p>
                    <div class="quiz-options">
                        <label><input type="radio" name="q4" value="J" required> A. Organized and planned</label>
                        <label><input type="radio" name="q4" value="P"> B. Flexible and spontaneous</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-btn">Show My Result</button>
        </form>
        <div id="result" class="result-section" style="display:none;">
            <div class="result-title">Your MBTI Type:</div>
            <div class="result-mbti" id="mbti-type"></div>
            <div class="result-title">Recommended Careers:</div>
            <div class="result-jobs" id="mbti-jobs"></div>
            <div id="specific-jobs"></div>
        </div>
    </div>
    <script>
        const mbtiJobs = {
            'ISTJ': 'Accountant, Auditor, Engineer, Analyst',
            'ISFJ': 'Nurse, Teacher, Counselor, Administrator',
            'INFJ': 'Psychologist, Writer, Consultant, Teacher',
            'INTJ': 'Scientist, Strategist, Software Developer',
            'ISTP': 'Mechanic, Pilot, Detective, Engineer',
            'ISFP': 'Designer, Chef, Artist, Nurse',
            'INFP': 'Writer, Counselor, Graphic Designer',
            'INTP': 'Programmer, Architect, Researcher',
            'ESTP': 'Entrepreneur, Sales, Paramedic, Athlete',
            'ESFP': 'Actor, Event Planner, Teacher, Designer',
            'ENFP': 'Journalist, Marketer, Counselor, Actor',
            'ENTP': 'Inventor, Consultant, Engineer, Lawyer',
            'ESTJ': 'Manager, Judge, Police Officer, Teacher',
            'ESFJ': 'Nurse, Social Worker, Event Planner',
            'ENFJ': 'Teacher, HR Manager, Counselor, Coach',
            'ENTJ': 'Executive, Lawyer, Entrepreneur, Manager'
        };

        // Specific jobs with apply links (dummy links)
        const mbtiSpecificJobs = {
            'ISTJ': [
                { title: 'Accountant at Deloitte', link: '#' },
                { title: 'Engineer at Siemens', link: '#' }
            ],
            'ISFJ': [
                { title: 'Nurse at Mayo Clinic', link: '#' },
                { title: 'Teacher at Local School', link: '#' }
            ],
            'INFJ': [
                { title: 'Psychologist at MindCare', link: '#' },
                { title: 'Writer at Penguin Books', link: '#' }
            ],
            'INTJ': [
                { title: 'Scientist at NASA', link: '#' },
                { title: 'Software Developer at Google', link: '#' }
            ],
            'ISTP': [
                { title: 'Mechanic at BMW', link: '#' },
                { title: 'Engineer at Tesla', link: '#' }
            ],
            'ISFP': [
                { title: 'Designer at IDEO', link: '#' },
                { title: 'Chef at Ritz Carlton', link: '#' }
            ],
            'INFP': [
                { title: 'Writer at Medium', link: '#' },
                { title: 'Counselor at YouthCare', link: '#' }
            ],
            'INTP': [
                { title: 'Programmer at Microsoft', link: '#' },
                { title: 'Architect at Foster + Partners', link: '#' }
            ],
            'ESTP': [
                { title: 'Entrepreneur at StartupHub', link: '#' },
                { title: 'Paramedic at Red Cross', link: '#' }
            ],
            'ESFP': [
                { title: 'Actor at Broadway', link: '#' },
                { title: 'Event Planner at EventCo', link: '#' }
            ],
            'ENFP': [
                { title: 'Journalist at BBC', link: '#' },
                { title: 'Marketer at Ogilvy', link: '#' }
            ],
            'ENTP': [
                { title: 'Inventor at TechLabs', link: '#' },
                { title: 'Consultant at McKinsey', link: '#' }
            ],
            'ESTJ': [
                { title: 'Manager at Walmart', link: '#' },
                { title: 'Police Officer at NYPD', link: '#' }
            ],
            'ESFJ': [
                { title: 'Nurse at Mercy Hospital', link: '#' },
                { title: 'Event Planner at PartyTime', link: '#' }
            ],
            'ENFJ': [
                { title: 'Teacher at International School', link: '#' },
                { title: 'HR Manager at Unilever', link: '#' }
            ],
            'ENTJ': [
                { title: 'Executive at IBM', link: '#' },
                { title: 'Lawyer at Baker McKenzie', link: '#' }
            ]
        };

        document.getElementById('test-form').addEventListener('submit', function(event) {
            event.preventDefault();
            // Get MBTI answers
            const q1 = document.querySelector('input[name="q1"]:checked').value;
            const q2 = document.querySelector('input[name="q2"]:checked').value;
            const q3 = document.querySelector('input[name="q3"]:checked').value;
            const q4 = document.querySelector('input[name="q4"]:checked').value;
            const mbti = q1 + q2 + q3 + q4;

            document.getElementById('mbti-type').textContent = mbti;
            document.getElementById('mbti-jobs').textContent = mbtiJobs[mbti] || 'Various careers based on your skills and interests!';
            document.getElementById('result').style.display = 'block';

            // Show specific jobs with apply buttons
            const jobs = mbtiSpecificJobs[mbti] || [];
            let jobsHtml = '';
            if (jobs.length > 0) {
                jobsHtml += '<div style="margin-top:18px;"><b>Specific Jobs You Can Apply:</b></div>';
                jobs.forEach(job => {
                    jobsHtml += `<div style="margin:10px 0;">
                        <span>${job.title}</span>
                        <button class="apply-btn" style="margin-left:12px;padding:6px 16px;border-radius:6px;border:none;background:#4a90e2;color:#fff;cursor:pointer;">Apply</button>
                    </div>`;
                });
            }
            document.getElementById('specific-jobs').innerHTML = jobsHtml;

            // Add event listeners for apply buttons
            document.querySelectorAll('.apply-btn').forEach(btn => {
                btn.onclick = function() {
                    alert('Your application has been submitted!');
                };
            });

            document.getElementById('result').scrollIntoView({behavior: 'smooth'});
        });
    </script>
</body>
</html>