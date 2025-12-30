# 🎯 AI-Powered Career Path Recommender System

A comprehensive web-based career guidance platform that combines **MBTI personality assessment** with **AI-powered analysis** to provide personalized career recommendations.

## 📋 Table of Contents
- [About the Project](#about-the-project)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Project Structure](#project-structure)
- [API Integration](#api-integration)
- [Future Enhancements](#future-enhancements)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

---

## 📖 About the Project

The **AI-Powered Career Path Recommender System** is a Final Year Project developed to help students and job seekers discover suitable career paths based on their personality, skills, interests, and academic background.

The system integrates:
- **MBTI Personality Assessment** - Scientific personality testing
- **Google Gemini API** - AI-powered career analysis
- **Job Management System** - Browse, filter, and apply for jobs
- **Resume Builder** - Create professional resumes with live preview
- **Application Tracking** - Monitor job application status

### 🎓 Academic Project
- **Institution:** Southern University College
- **Course:** Final Year Project (FYP)
- **Supervisor:** Miss Chan Ler Kuan
- **Student:** Brian See Yong Siang
- **Year:** 2025

---

## ✨ Features

### 👤 User Features
- ✅ **Secure Authentication** - Register and login with encrypted passwords
- ✅ **MBTI Personality Test** - Complete 4-dimension personality assessment
- ✅ **AI Career Recommendations** - Get personalized career suggestions powered by Google Gemini API
- ✅ **Job Browsing** - Search and filter jobs by salary, type, location, date
- ✅ **Job Applications** - Apply for jobs directly through the platform
- ✅ **Application Tracking** - Monitor your application history and status
- ✅ **Resume Builder** - Create professional resumes with live preview
- ✅ **Profile Management** - Update personal information, skills, and interests

### 👨‍💼 Admin Features
- ✅ **User Management** - View, edit, suspend, or delete user accounts
- ✅ **Job Management** - Add, edit, or remove job listings
- ✅ **Test Question Management** - Update MBTI assessment questions
- ✅ **Dashboard Analytics** - View system statistics and metrics

---

## 🛠️ Technology Stack

### Backend
- **Framework:** Laravel 10.x
- **Language:** PHP 8.1+
- **Database:** MySQL 8.0
- **Web Server:** Apache / Nginx

### Frontend
- **HTML5** - Page structure
- **CSS3** - Styling and responsive design
- **JavaScript** - Client-side interactivity
- **Bootstrap** (optional) - UI components

### AI Integration
- **Google Gemini API** - AI-powered career recommendations

### Development Tools
- **Composer** - PHP dependency manager
- **Git & GitHub** - Version control
- **VS Code** - Code editor
- **XAMPP / WAMP** - Local development environment

---

## 📦 Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Node.js & NPM (optional)
- Google Gemini API Key

### Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/career-recommender-2.git
cd career-recommender-2
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
```bash
cp .env.example .env
```

Edit `.env` file:
```env
APP_NAME="Career Path Recommender"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=career_recommender
DB_USERNAME=root
DB_PASSWORD=your_password

GEMINI_API_KEY=my_gemini_api_key_
```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Database Setup
```bash
php artisan migrate
php artisan db:seed  # Optional: seed with sample data
```

### Step 6: Start Development Server
```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🚀 Usage

### For Users:
1. **Register** - Create a new account
2. **Login** - Access your dashboard
3. **Take MBTI Test** - Complete personality assessment
4. **View Recommendations** - Get AI-powered career suggestions
5. **Browse Jobs** - Search for suitable positions
6. **Apply for Jobs** - Submit applications
7. **Build Resume** - Create professional CV
8. **Track Applications** - Monitor your progress

### For Admins:
1. **Login** with admin credentials
2. **Manage Users** - View and edit user accounts
3. **Manage Jobs** - Add/edit/delete job listings
4. **Update Tests** - Modify MBTI questions
5. **View Analytics** - Check system statistics

### Default Admin Login:
```
Email: admin@career.com
Password: admin123
```
⚠️ **Change default credentials after first login!**

---

## 📁 Project Structure
```
career-recommender-2/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── TestController.php
│   │       ├── JobController.php
│   │       └── AdminController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Test.php
│   │   ├── Job.php
│   │   └── Application.php
│   └── Services/
│       └── GeminiService.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── css/
│   ├── js/
│   └── images/
│
├── resources/
│   └── views/
│       ├── auth/
│       ├── user/
│       └── admin/
│
├── routes/
│   └── web.php
│
├── .env.example
├── composer.json
├── README.md
└── package.json
```

---

## 🤖 API Integration

### Google Gemini API

The system integrates with Google Gemini API for AI-powered career recommendations.

**Configuration:**
```php
// .env
GEMINI_API_KEY=your_api_key_here
```

**Usage Example:**
```php
// app/Services/GeminiService.php
public function getCareerRecommendations($userData) {
    $prompt = "Based on MBTI type: {$userData['mbti']}, 
               Skills: {$userData['skills']}, 
               Interests: {$userData['interests']}, 
               Recommend suitable careers.";
    
    // Send request to Gemini API
    $response = $this->callGeminiAPI($prompt);
    
    return $response;
}
```

**Get API Key:**
1. Visit [Google AI Studio](https://ai.google.dev/)
2. Sign in with Google account
3. Create new API key
4. Copy key to `.env` file

---

## 🔮 Future Enhancements

- [ ] Real-time job API integration (LinkedIn, Indeed, JobStreet)
- [ ] Mobile application (iOS & Android)
- [ ] Resume export to PDF/Word
- [ ] Multiple personality assessment frameworks
- [ ] Multilingual support (Bahasa Malaysia, Mandarin, Tamil)
- [ ] Email notifications
- [ ] Advanced analytics dashboard
- [ ] User feedback and rating system
- [ ] Social features and networking

---

## 🤝 Contributing

This is an academic project and is not open for contributions. However, if you have suggestions or find bugs, feel free to open an issue.

---

## 📄 License

This project is developed as a Final Year Project for academic purposes at Southern University College.

**All Rights Reserved © 2025**

---

## 📧 Contact

**Student:** Brian See Yong Siang  
**Email:** b240096b@sc.edu.my  
**Institution:** Southern University College  
**Supervisor:** Miss Chan Ler Kuan

**Project Repository:** [https://github.com/yourusername/career-recommender-2]

---

## 🙏 Acknowledgments

- **Supervisor:** Miss Chan Ler Kuan - For guidance and support throughout the project
- **Google Gemini API** - For providing AI-powered recommendation capabilities
- **Laravel Community** - For excellent documentation and resources
- **Southern University College** - For providing the opportunity to develop this project

---

## 📊 Project Status

✅ **Completed** - All core features implemented and tested  
📅 **Completion Date:** December 2025  
🎓 **Academic Submission:** Final Year Project (FYP)

---

**Made with ❤️ by Brian See Yong Siang**
