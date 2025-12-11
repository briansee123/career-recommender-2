<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Path Recommender - Test</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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
        .result-section.show {
            display: block;
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
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loading.show {
            display: block;
        }
        .error-message {
            display: none;
            background: #fee;
            color: #c00;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }
        .error-message.show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <a href="{{ route('homepage') }}" class="back-link">← Back to Homepage</a>
        
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
                @foreach($questions as $question)
                <div class="quiz-question">
                    <p>Q{{ $loop->iteration }}: {{ $question->question }}</p>
                    <div class="quiz-options">
                       @foreach($question->options as $option)
<label>
    <input type="radio" name="q{{ $loop->parent->iteration }}" value="{{ $option['value'] }}" required>
    {{ $option['text'] }}
</label>
@endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            <button type="submit" class="submit-btn" id="submit-btn">Show My Result</button>
        </form>

        <div class="loading" id="loading">
            <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #4a90e2;"></i>
            <p>Processing your results...</p>
        </div>

        <div class="error-message" id="error-message"></div>
        
        <div class="result-section" id="result">
            <div class="result-title">Your MBTI Type:</div>
            <div class="result-mbti" id="mbti-type"></div>
            <div class="result-title">Recommended Careers:</div>
            <div class="result-jobs" id="mbti-jobs"></div>
        </div>
    </div>

    <script>
        document.getElementById('test-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // Show loading, hide error
            document.getElementById('loading').classList.add('show');
            document.getElementById('error-message').classList.remove('show');
            document.getElementById('result').classList.remove('show');
            document.getElementById('submit-btn').disabled = true;
            
            // Submit via AJAX
            fetch('{{ route("test.submit") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Hide loading
                document.getElementById('loading').classList.remove('show');
                document.getElementById('submit-btn').disabled = false;
                
                if (data.success) {
                    // Show results
                    document.getElementById('mbti-type').textContent = data.mbti_type;
                    document.getElementById('mbti-jobs').textContent = data.recommendations;
                    document.getElementById('result').classList.add('show');
                    
                    // Scroll to results
                    document.getElementById('result').scrollIntoView({ behavior: 'smooth' });
                } else {
                    // Show error
                    document.getElementById('error-message').textContent = data.message || 'Error processing test. Please try again.';
                    document.getElementById('error-message').classList.add('show');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loading').classList.remove('show');
                document.getElementById('submit-btn').disabled = false;
                document.getElementById('error-message').textContent = 'Network error. Please check your connection and try again.';
                document.getElementById('error-message').classList.add('show');
            });
        });
    </script>
</body>
</html>