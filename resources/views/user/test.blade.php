@extends('layouts.app')

@section('title', 'Career Path Test')

@section('content')
<!-- Standard Navigation Header -->
<header style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 18px 0; box-shadow: 0 4px 20px rgba(0,0,0,0.15); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 1.8rem; font-weight: 700; color: white;">JOB PARTNER</span>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="{{ route('homepage') }}" style="color: white; text-decoration: none; font-weight: 600; padding: 8px 16px; border-radius: 10px; transition: 0.2s;">Home</a>
            <a href="{{ route('jobs') }}" style="color: white; text-decoration: none; font-weight: 600; padding: 8px 16px; border-radius: 10px; transition: 0.2s;">More Jobs</a>
            <a href="{{ route('test') }}" style="color: white; text-decoration: none; font-weight: 600; padding: 8px 16px; border-radius: 10px; background: rgba(255,255,255,0.2);">Test Now</a>
            
            <div style="position: relative;" class="user-menu">
                <div style="width: 45px; height: 45px; background: white; color: #667eea; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; cursor: pointer; font-size: 1.2rem;" onclick="toggleDropdown()">
                    {{ auth()->check() ? (auth()->user()->avatar ?? strtoupper(substr(auth()->user()->name, 0, 1))) : 'U' }}
                </div>
                <div id="userDropdown" style="display: none; position: absolute; top: 55px; right: 0; background: white; min-width: 180px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); overflow: hidden; z-index: 1000;">
                    <a href="{{ route('profile') }}" style="display: block; padding: 12px 20px; color: #667eea; text-decoration: none; font-weight: 600; transition: 0.2s;">Go Profile</a>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="width: 100%; text-align: left; padding: 12px 20px; background: none; border: none; color: #ef4444; font-weight: 600; cursor: pointer; border-top: 1px solid #f1f5f9;">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div style="min-height: calc(100vh - 85px); background: linear-gradient(120deg, #aeefff 0%, #fceabb 100%); display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
    <div style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(0,0,0,0.10); max-width: 700px; width: 100%; padding: 40px 32px 32px 32px;">
        
        <!-- Back Link Removed Here -->

        <div style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 8px; letter-spacing: 1px;">
            Job Partner! <span style="font-size: 2rem;">🌴🌞</span>
        </div>
        
        <div style="color: #555; font-size: 1.1rem; margin-bottom: 32px; text-align: center;">
            Your AI-powered guide to the perfect career path
        </div>

        <form id="test-form">
            @csrf
            <div style="font-size: 1.3rem; font-weight: 600; color: #4a90e2; margin-top: 24px; margin-bottom: 10px; text-align: left;">
                Career & Personality Test
            </div>

            <div style="margin-bottom: 18px;">
                <label style="font-weight: 600; margin-bottom: 6px; margin-top: 10px; color: #222; display: block;">Your Skills (comma separated):</label>
                <input type="text" id="skills" name="skills" required style="width: 100%; padding: 8px 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; background: #fdfad6; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="font-weight: 600; margin-bottom: 6px; margin-top: 10px; color: #222; display: block;">Your Interests:</label>
                <input type="text" id="interests" name="interests" required style="width: 100%; padding: 8px 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; background: #fdfad6; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="font-weight: 600; margin-bottom: 6px; margin-top: 10px; color: #222; display: block;">Academic Background:</label>
                <select id="academic" name="academic" required style="width: 100%; padding: 8px 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; background: #fdfad6; font-size: 1rem;">
                    <option value="">Select...</option>
                    <option value="Science">Science</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Business">Business</option>
                    <option value="Arts">Arts</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <hr style="margin: 20px 0;">

            <div style="font-size: 1.3rem; font-weight: 600; color: #4a90e2; margin-top: 24px; margin-bottom: 20px;">
                Personality Quiz (Mini-MBTI)
            </div>

            <div style="margin-top: 24px;">
                @foreach($questions as $index => $question)
                <div style="background: #f4f4f4; border-radius: 8px; padding: 18px; margin-bottom: 18px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <p style="font-weight: 600; margin-bottom: 10px;">{{ $question->question }}</p>
                    <div>
                        @foreach($question->options as $key => $option)
                        @php
                            $val = is_array($option) ? ($option['value'] ?? '') : $key;
                            $txt = is_array($option) ? ($option['text'] ?? '') : $option;
                        @endphp
                        <label style="display: block; margin-bottom: 8px; font-size: 1rem; cursor: pointer;">
                            <input type="radio" name="q{{ $index + 1 }}" value="{{ $val }}" required>
                            {{ $txt }}
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <button type="submit" style="width: 100%; padding: 14px 0; border: none; border-radius: 8px; background: linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%); color: #fff; font-size: 1.2rem; font-weight: 700; cursor: pointer; margin-top: 24px; box-shadow: 0 2px 6px rgba(74,144,226,0.09);">
                Show My Result
            </button>
        </form>

        <div id="result" style="margin-top: 32px; background: #e6f7ff; border-radius: 10px; padding: 24px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: none;">
            <div style="font-size: 1.5rem; font-weight: 700; color: #4a90e2; margin-bottom: 10px;">
                Your MBTI Type:
            </div>
            <div id="mbti-type" style="font-size: 1.2rem; font-weight: 600; color: #f76b1c; margin-bottom: 12px;"></div>
            
            <div style="font-size: 1.5rem; font-weight: 700; color: #4a90e2; margin-bottom: 10px; margin-top: 20px;">
                Recommended Careers:
            </div>
            <div id="mbti-jobs" style="font-size: 1.1rem; color: #333; white-space: pre-line;"></div>
            
            <div style="margin-top: 20px;">
                <a href="{{ route('jobs') }}" style="display: inline-block; padding: 12px 30px; background: linear-gradient(90deg, #4a90e2 0%, #f76b1c 100%); color: white; text-decoration: none; border-radius: 25px; font-weight: 600;">
                    Browse Jobs
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Header Dropdown Script
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

    // Test Form Script
    document.getElementById('test-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Get MBTI answers
        const mbti = @json($questions->count()) === 4 ? 
            (document.querySelector('input[name="q1"]:checked')?.value || '') +
            (document.querySelector('input[name="q2"]:checked')?.value || '') +
            (document.querySelector('input[name="q3"]:checked')?.value || '') +
            (document.querySelector('input[name="q4"]:checked')?.value || '')
            : '';
        
        if (mbti.length !== 4) {
            alert('Please answer all questions!');
            return;
        }

        const skills = document.getElementById('skills').value;
        const interests = document.getElementById('interests').value;
        const academic = document.getElementById('academic').value;

        // Show loading
        const resultDiv = document.getElementById('result');
        resultDiv.style.display = 'block';
        document.getElementById('mbti-type').textContent = 'Analyzing...';
        document.getElementById('mbti-jobs').textContent = '🤖 AI is analyzing your personality...';

        // Call AI API
        fetch('/ai/analyze-career-test', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
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
                document.getElementById('mbti-type').textContent = data.mbti;
                document.getElementById('mbti-jobs').textContent = data.recommendations;
            } else {
                document.getElementById('mbti-type').textContent = mbti;
                document.getElementById('mbti-jobs').textContent = 'Unable to get AI recommendations at this time. Please try again later.';
            }
            resultDiv.scrollIntoView({ behavior: 'smooth' });
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('mbti-type').textContent = mbti;
            document.getElementById('mbti-jobs').textContent = 'Error connecting to AI service. Please try again.';
        });
    });
</script>
@endsection