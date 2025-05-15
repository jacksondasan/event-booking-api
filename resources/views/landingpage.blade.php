<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Booking API</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #8e4aad;
            --primary-dark: #45136f;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(rgba(69, 19, 111, 0.8), rgba(142, 74, 173, 0.8)), url('https://source.unsplash.com/1600x900/?event,conference');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            color: white;
            position: relative;
        }

        .wave-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-bottom svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .navbar {
            background: transparent !important;
            transition: 0.3s;
        }

        .navbar.scrolled {
            background: rgba(69, 19, 111, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(142, 74, 173, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            border: 1px solid rgba(142, 74, 173, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .api-section {
            background: linear-gradient(135deg, #f8f9fa 0%, rgba(142, 74, 173, 0.1) 100%);
            padding: 5rem 0;
        }

        .code-block {
            background-color: var(--primary-dark);
            color: #f8f8f2;
            padding: 2rem;
            border-radius: 15px;
            margin: 1rem 0;
            box-shadow: 0 5px 15px rgba(69, 19, 111, 0.2);
            position: relative;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: transform 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
        }

        .feature-list-item {
            padding: 1rem;
            border: none;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            background: white;
            box-shadow: 0 3px 10px rgba(142, 74, 173, 0.1);
            transition: transform 0.3s ease;
        }

        .feature-list-item:hover {
            transform: translateX(10px);
            background: rgba(142, 74, 173, 0.05);
        }

        .feature-list-item i {
            color: var(--primary);
            margin-right: 10px;
        }

        .stats-section {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary));
            color: white;
            padding: 4rem 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        footer {
            background: var(--primary-dark);
            color: white;
            padding: 3rem 0;
        }

        .social-links {
            margin-top: 1.5rem;
        }

        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--primary);
        }

        .section-heading {
            position: relative;
            display: inline-block;
            color: var(--primary-dark);
        }

        .section-heading::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-calendar-check me-2"></i>EventAPI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/login" class="nav-link">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">
                            <i class="fas fa-user-plus me-1"></i> Register
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#features" class="nav-link">
                            <i class="fas fa-star me-1"></i> Features
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#docs" class="nav-link">
                            <i class="fas fa-book me-1"></i> Docs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container text-center" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-4">Next-Gen Event Booking API</h1>
            <p class="lead mb-4 fw-light" style="font-size: 1.3rem;">
                Empower your applications with our robust event management solution
            </p>
            <div class="mt-5">
                <a href="#features" class="btn btn-primary btn-custom btn-lg me-3">
                    <i class="fas fa-rocket me-2"></i>Get Started
                </a>
                <a href="#docs" class="btn btn-outline-light btn-custom btn-lg">
                    <i class="fas fa-book me-2"></i>Documentation
                </a>
            </div>
        </div>
        <div class="wave-bottom">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-number">99.9%</div>
                        <div>Uptime Guarantee</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-number">50K+</div>
                        <div>API Requests Daily</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">1000+</div>
                        <div>Active Users</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 section-heading">Powerful Features</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="h4 mb-3">Event Management</h3>
                        <p class="text-muted">Comprehensive event management with support for complex scheduling and capacity tracking</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="h4 mb-3">Attendee Management</h3>
                        <p class="text-muted">Streamlined attendee registration with automated verification and profile management</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h3 class="h4 mb-3">Smart Booking</h3>
                        <p class="text-muted">Intelligent booking system with real-time capacity updates and duplicate prevention</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Documentation Section -->
    <section id="docs" class="api-section">
        <div class="container">
            <h2 class="text-center mb-5 section-heading">API Documentation</h2>
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <h4 class="mb-4"><i class="fas fa-code me-2"></i>Quick Start</h4>
                    <div class="code-block">
                        <pre><span style="color: #ff79c6">GET</span>    /api/events
<span style="color: #ff79c6">POST</span>   /api/events
<span style="color: #ff79c6">GET</span>    /api/events/{id}
<span style="color: #ff79c6">POST</span>   /api/bookings
<span style="color: #ff79c6">GET</span>    /api/attendees</pre>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h4 class="mb-4"><i class="fas fa-list-check me-2"></i>Features</h4>
                    <div class="feature-list">
                        <div class="feature-list-item">
                            <i class="fas fa-check-circle"></i> RESTful API Design
                        </div>
                        <div class="feature-list-item">
                            <i class="fas fa-check-circle"></i> JWT Authentication
                        </div>
                        <div class="feature-list-item">
                            <i class="fas fa-check-circle"></i> Input Validation
                        </div>
                        <div class="feature-list-item">
                            <i class="fas fa-check-circle"></i> Rate Limiting
                        </div>
                        <div class="feature-list-item">
                            <i class="fas fa-check-circle"></i> Real-time Updates
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="h5 mb-3">Event Booking API</h3>
                    <p class="text-white-50">Empowering developers to create amazing event experiences</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-links">
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1)">
            <div class="text-center">
                <p class="mb-0 text-white-50">© 2025 Event Booking API. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
