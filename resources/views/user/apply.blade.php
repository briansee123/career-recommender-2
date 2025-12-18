<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
        }
        .card {
            background: white; padding: 40px; border-radius: 20px;
            width: 100%; max-width: 600px; margin: 20px;
        }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; }
        .btn {
            background: #667eea; color: white; padding: 12px 20px;
            border: none; border-radius: 8px; width: 100%; cursor: pointer; font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="text-align: center; margin-bottom: 30px; color: #667eea;">Apply for {{ $job->title }}</h2>
        
        <form action="{{ route('apply.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>
            
            <div class="form-group">
                <label>Resume (PDF/DOCX)</label>
                <input type="file" name="resume" required>
            </div>
            
            <button type="submit" class="btn">Submit Application</button>
            <a href="{{ route('jobs') }}" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">Cancel</a>
        </form>
    </div>
</body>
</html>