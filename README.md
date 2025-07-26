# 🎓 Registrar Office Management System

A comprehensive web-based management system for University of the Cordilleras, built with Laravel framework. This system streamlines academic administration, grade management, and user authentication across all university colleges.

## 🏛️ About University of the Cordilleras

The University of the Cordilleras comprises **10 distinct colleges** offering diverse academic programs:

- **College of Law** - Bachelor of Laws
- **College of Accountancy** - Bachelor of Accountancy  
- **College of Arts and Sciences** - English Language Studies, Political Science, Communication, Psychology, Behavioral Science
- **College of Business Administration** - Business Administration, Entrepreneurship, Office Administration, Real Estate Management, Digital Marketing
- **College of Criminal Justice Education** - Criminology, Forensic Science
- **College of Engineering and Architecture** - Architecture, Civil Engineering, Computer Engineering, Electronics Engineering, Environmental Engineering
- **College of Hospitality and Tourism Management** - Hospitality Management, Tourism Management
- **College of Information Technology and Computer Science** - Computer Science, Data Analytics, Information Technology
- **College of Nursing** - Bachelor of Science in Nursing
- **College of Teacher Education** - Elementary Education, Secondary Education

## ✨ Key Features

### 🔐 Multi-Role Authentication System
- **Students** - Dual login with Student ID or Email
- **Faculty** - Course and grade management
- **Deans** - College-wide administration and approvals
- **Admin** - System-wide management

### 📚 Academic Management
- Grade completion applications with digital workflow
- Dean approval system with digital signatures
- Academic year and semester management
- Subject and course tracking
- Student enrollment management

### 👥 User Management
- Comprehensive user profiles with emergency contacts
- Role-based access control
- Secure password hashing
- Email verification system

### 📋 Grade Management
- Student grade tracking and reporting
- Faculty grade submission interface
- Dean approval workflow for grade changes
- Academic performance analytics

## 🚀 Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- Laravel 11.x
- SQLite (included) or MySQL
- Node.js & NPM (for frontend assets)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Registrar-Office/RegistrarOffice2.git
   cd RegistrarOffice2
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

## 👤 Default Login Credentials

### 🔑 Administrator
- **Email**: `admin@registrar.edu`
- **Password**: `admin123`

### 👨‍🎓 Sample Students (Dual Login Options)
- **Student ID**: `2020-20-1000` OR **Email**: `john.michael.1@students.uc-bcf.edu.ph`
- **Password**: `student123`

### 👨‍🏫 Sample Faculty
- **Email**: `maria.santos@uc.edu.ph`
- **Password**: `faculty123`

### 👨‍💼 Sample Dean
- **Email**: `dean.law@uc.edu.ph`
- **Password**: `dean123`

## 📊 System Statistics

- **Total Users**: 172
  - 1 System Administrator
  - 10 College Deans
  - 42 Faculty Members
  - 119 Students across all programs

- **Academic Programs**: 25+ degree programs
- **Colleges**: 10 distinct colleges
- **Student Distribution**: 10-15 students per college

## 🏗️ Technical Architecture

### Backend Framework
- **Laravel 11.x** - PHP web application framework
- **SQLite** - Lightweight database (easily switchable to MySQL)
- **Eloquent ORM** - Database object-relational mapping

### Frontend Technologies
- **Blade Templates** - Laravel's templating engine
- **Bootstrap** - Responsive CSS framework
- **JavaScript** - Interactive user interfaces
- **Vite** - Modern frontend build tool

### Security Features
- **CSRF Protection** - Cross-site request forgery prevention
- **Password Hashing** - Bcrypt encryption
- **Role-based Access Control** - Multi-level user permissions
- **Input Validation** - Server-side form validation
- **SQL Injection Prevention** - Eloquent ORM protection

## 📁 Project Structure

```
RegistrarOffice2/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database schema migrations
│   ├── seeders/            # Database seeders
│   └── database.sqlite     # SQLite database file
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php             # Web routes
│   └── console.php         # Artisan commands
└── public/                 # Public web directory
```

## 🔄 Database Schema

### Core Tables
- **users** - All system users (students, faculty, deans, admin)
- **faculties** - Faculty-specific information
- **subjects** - Course and subject catalog
- **student_grades** - Academic performance records
- **grade_completion_applications** - Grade change workflow
- **academic_years** - Academic calendar management
- **announcements** - System-wide communications

### Key Relationships
- Users → Roles (student, faculty, dean, admin)
- Students → Grades → Subjects
- Faculty → Subjects → Students
- Deans → Colleges → Faculty/Students
- Applications → Approvals → Digital Signatures

## 🚦 Development Workflow

### Running Migrations
```bash
php artisan migrate
```

### Seeding Sample Data
```bash
php artisan db:seed --class=StudentUsersSeeder
php artisan db:seed --class=FacultySeeder
php artisan db:seed --class=DeanUserSeeder
```

### Fresh Installation
```bash
php artisan migrate:fresh --seed
```

## 📈 Future Enhancements

- [ ] Real-time notifications system
- [ ] Mobile application support
- [ ] Advanced reporting and analytics
- [ ] Integration with external systems
- [ ] Automated email notifications
- [ ] Document management system
- [ ] Online payment integration
- [ ] Student portal enhancements

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For technical support or questions about the system:

- **Email**: support@uc-bcf.edu.ph
- **GitHub Issues**: [Report a Bug](https://github.com/Registrar-Office/RegistrarOffice2/issues)
- **Documentation**: [Wiki](https://github.com/Registrar-Office/RegistrarOffice2/wiki)

## 🏆 Acknowledgments

- **University of the Cordilleras** - For providing the educational framework
- **Laravel Community** - For the excellent framework and documentation
- **Contributors** - All developers who have contributed to this project

---

*Built with ❤️ for University of the Cordilleras*