<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Path Recommender - Test</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            margin: 40px 20px;
        }
        .back-link {
            color: #4a90e2;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.05rem;
            display: inline-block;
            margin-bottom: 18px;
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
        .submit-btn:hover {
            opacity: 0.9;
        }
        .result-section {
            display: none;
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
            text-align: left;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <a href="/" class="back-link">← Back to Homepage</a>
        
        <div class="test-title">
            Job Partner! <span class="emoji">🌴🌞</span>
        </div>
        <div class="test-desc">
            Your AI-powered guide to the perfect career path
        </div>
        
        <form id="test-form">
            @csrf
            <div class="section-header">Career & Personality Test</div>
            
            <div class="input-group">
                <label for="skills">Your Skills (comma separated):</label>
                <input type="text" id="skills" name="skills" required placeholder="e.g. Python, Communication, Problem Solving">
            </div>
            
            <div class="input-group">
                <label for="interests">Your Interests:</label>
                <input type="text" id="interests" name="interests" required placeholder="e.g. Technology, Design, Business">
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
            
            <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">
            
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
            
            <button type="submit" class="submit-btn" id="submit-btn">Show My Result</button>
        </form>
        
        <div class="result-section" id="result">
            <div class="result-title">Your MBTI Type:</div>
            <div class="result-mbti" id="mbti-type"></div>
            <div class="result-title">Recommended Careers:</div>
            <div class="result-jobs" id="mbti-jobs"></div>
            <div id="specific-jobs"></div>
        </div>
    </div>

    <script>
        document.getElementById('test-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form data
            const skills = document.getElementById('skills').value;
            const interests = document.getElementById('interests').value;
            const academic = document.getElementById('academic').value;
            
            // Get MBTI answers
            const q1 = document.querySelector('input[name="q1"]:checked');
            const q2 = document.querySelector('input[name="q2"]:checked');
            const q3 = document.querySelector('input[name="q3"]:checked');
            const q4 = document.querySelector('input[name="q4"]:checked');
            
            if (!q1 || !q2 || !q3 || !q4) {
                alert('Please answer all questions!');
                return;
            }
            
            const mbti = q1.value + q2.value + q3.value + q4.value;
            
            // Show MBTI type immediately
            document.getElementById('mbti-type').textContent = mbti;
            document.getElementById('result').style.display = 'block';
            document.getElementById('result').scrollIntoView({behavior: 'smooth'});
            
            // Show loading state
            document.getElementById('mbti-jobs').innerHTML = '<div style="text-align:center; padding:20px;">🤖 AI is analyzing your personality...<br><small>Generating personalized recommendations...</small></div>';
            document.getElementById('specific-jobs').innerHTML = '';
            
            // Call AI to get personalized career recommendations
            fetch('/ai/analyze-career-test', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    mbti: mbti,
                    skills: skills,
                    interests: interests,
                    academic: academic
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display AI-generated recommendations with formatting
                    const formattedText = data.recommendations.replace(/\n/g, '<br>');
                    document.getElementById('mbti-jobs').innerHTML = formattedText;
                    
                    // Add "Apply Now" buttons if user is logged in
                    if (data.isLoggedIn) {
                        document.getElementById('specific-jobs').innerHTML = `
                            <div style="margin-top:24px; text-align:center;">
                                <p style="color:#4a90e2; font-weight:600; margin-bottom:12px;">Ready to apply? 🚀</p>
                                <a href="/jobs" style="display:inline-block; padding:12px 32px; background:linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%); color:white; text-decoration:none; border-radius:25px; font-weight:600; box-shadow:0 4px 15px rgba(74,144,226,0.3);">
                                    Browse Jobs
                                </a>
                            </div>
                        `;
                    } else {
                        document.getElementById('specific-jobs').innerHTML = `
                            <div style="margin-top:24px; text-align:center;">
                                <p style="color:#666; margin-bottom:12px;">Create an account to save your results and apply for jobs! 📝</p>
                                <a href="/signup" style="display:inline-block; padding:12px 32px; background:#4a90e2; color:white; text-decoration:none; border-radius:25px; font-weight:600;">
                                    Sign Up Now
                                </a>
                            </div>
                        `;
                    }
                }
            })
            .catch(error => {
                console.error('AI Error:', error);
                // Fallback to basic recommendations
                document.getElementById('mbti-jobs').innerHTML = getFallbackRecommendations(mbti);
            });
        });

        // Fallback recommendations (if AI fails)
        function getFallbackRecommendations(mbti) {
            const fallbacks = {
                'INTJ': 'Your INTJ personality shows exceptional strategic thinking! 🎯<br><br><b>Recommended Careers:</b><br>1. Software Architect - Salary: MYR 6,000-12,000/month<br>2. Data Scientist - Salary: MYR 5,000-10,000/month<br>3. Management Consultant - Salary: MYR 4,500-9,000/month<br><br>Your logical thinking will lead you to great success! 🌟',
                'ENTJ': 'Your ENTJ leadership qualities are impressive! 💼<br><br><b>Recommended Careers:</b><br>1. Project Manager - Salary: MYR 5,000-10,000/month<br>2. Business Analyst - Salary: MYR 4,500-8,500/month<br>3. Marketing Director - Salary: MYR 6,000-12,000/month<br><br>You\'re born to lead! ✨',
                'INFP': 'Your INFP creativity and empathy are wonderful! 💜<br><br><b>Recommended Careers:</b><br>1. UX/UI Designer - Salary: MYR 3,500-7,000/month<br>2. Content Writer - Salary: MYR 3,000-6,000/month<br>3. Counselor - Salary: MYR 3,200-6,500/month<br><br>Your creativity will make the world better! 🌈'
            };
            
            return fallbacks[mbti] || 'You have amazing potential! 🌟<br><br><b>Recommended Careers:</b><br>1. Software Developer - Salary: MYR 4,000-8,000/month<br>2. Marketing Specialist - Salary: MYR 3,500-7,000/month<br>3. HR Executive - Salary: MYR 3,000-6,000/month<br><br>Your unique skills will take you far! 💪';
        }
    </script>
</body>
</html>