<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>College Hunt - Squid Game Edition | Infradex</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
    /* Base Styles */
    :root {
        --squid-pink: #E53170;
        --squid-teal: #0F969C;
        --squid-yellow: #FFD700;
        --squid-black: #001011;
        --squid-white: #F6F7F8;
    }
    
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    
    body {
        font-family: 'Bebas Neue', sans-serif;
        background-color: var(--squid-black);
        color: var(--squid-white);
        line-height: 1.6;
        overflow-x: hidden;
    }
    
    img {
        max-width: 100%;
        height: auto;
    }
    
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, var(--squid-pink) 0%, var(--squid-teal) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 100px 20px;
        clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
    }
    
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==') center/cover;
        opacity: 0.3;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .logo {
        width: 220px;
        margin-bottom: 30px;
        /* animation: float 6s ease-in-out infinite; */
    }
    
    .hero h1 {
        font-family: 'Anton', sans-serif;
        font-size: 5rem;
        text-transform: uppercase;
        letter-spacing: 5px;
        margin-bottom: 1rem;
        background: linear-gradient(to right, #fff, var(--squid-yellow));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 3px 3px 0 rgba(0,0,0,0.2);
    }
    
    .hero h2 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        text-shadow: 2px 2px 0 rgba(0,0,0,0.2);
    }
    
    .hero p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 2rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    
    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    
    .btn {
        display: inline-block;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: 'Anton', sans-serif;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .btn-primary {
        background: var(--squid-yellow);
        color: var(--squid-black);
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
    }
    
    .btn-secondary {
        background: transparent;
        border: 2px solid white;
        color: white;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    
    /* Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    
    /* Countdown Timer Styles */
    .countdown-container {
        display: flex;
        justify-content: center;
        margin: 2rem auto;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .countdown-item {
        background: rgba(0, 0, 0, 0.5);
        padding: 1rem;
        min-width: 100px;
        border-radius: 10px;
        text-align: center;
        border: 2px solid var(--squid-teal);
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(229, 49, 112, 0.3);
    }
    
    .countdown-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--squid-pink);
    }
    
    .countdown-item .number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--squid-yellow);
        font-family: 'Press Start 2P', cursive;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    
    .countdown-item .text {
        font-size: 0.9rem;
        color: var(--squid-white);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .event-dates {
        font-size: 1.8rem;
        color: var(--squid-white);
        background: rgba(0, 0, 0, 0.5);
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border-radius: 5px;
        margin-bottom: 1.5rem;
        border: 1px solid var(--squid-pink);
        font-family: 'Anton', sans-serif;
        letter-spacing: 1px;
    }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 3.5rem;
        }
        
        .hero h2 {
            font-size: 2rem;
        }
        
        .btn {
            padding: 12px 30px;
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 480px) {
        .hero {
            padding: 80px 20px;
        }
        
        .hero h1 {
            font-size: 2.5rem;
        }
        
        .hero h2 {
            font-size: 1.5rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn {
            width: 100%;
            max-width: 250px;
            margin: 5px 0;
        }
        
        .countdown-item {
            min-width: 80px;
        }
        
        .countdown-item .number {
            font-size: 1.8rem;
        }
        
        .countdown-item .text {
            font-size: 0.8rem;
        }
    }
    /* Sections */
    .section {
        padding: 6rem 0;
        position: relative;
    }
    
    .bg-dark {
        background: rgba(0, 0, 0, 0.7);
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }
    
    .section-title {
        font-size: 3rem;
        margin-bottom: 1rem;
        font-family: 'Anton', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    
    .highlight {
        color: var(--squid-yellow);
    }
    
    .divider {
        width: 80px;
        height: 4px;
        background: var(--squid-teal);
        margin: 0 auto;
        border-radius: 2px;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.8);
        margin-top: 1rem;
    }
    
    /* Campaign Cards */
    .campaign-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .campaign-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .campaign-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(229, 49, 112, 0.2);
    }
    
    .campaign-icon {
        width: 70px;
        height: 70px;
        background: var(--squid-pink);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        color: white;
    }
    
    .campaign-card h3 {
        color: var(--squid-teal);
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .stat-item {
        background: rgba(15, 150, 156, 0.1);
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        border: 1px solid rgba(15, 150, 156, 0.2);
    }
    
    .stat-item h3 {
        font-size: 2.5rem;
        color: var(--squid-yellow);
        margin-bottom: 0.5rem;
        font-family: 'Anton', sans-serif;
    }
    
    /* Timeline */
    .timeline {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        width: 4px;
        background: var(--squid-teal);
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -2px;
        border-radius: 2px;
    }
    
    .timeline-item {
        padding: 1.5rem 3rem;
        position: relative;
        width: 50%;
        box-sizing: border-box;
    }
    
    .timeline-item:nth-child(odd) {
        left: 0;
        text-align: right;
    }
    
    .timeline-item:nth-child(even) {
        left: 50%;
        text-align: left;
    }
    
    .timeline-dot {
        width: 20px;
        height: 20px;
        background: var(--squid-pink);
        border: 3px solid var(--squid-teal);
        border-radius: 50%;
        position: absolute;
        top: 30px;
        right: -10px;
        z-index: 1;
    }
    
    .timeline-item:nth-child(even) .timeline-dot {
        left: -10px;
        right: auto;
    }
    
    .timeline-content {
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(229, 49, 112, 0.1);
    }
    
    .timeline-content h3 {
        color: var(--squid-yellow);
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-size: 1.3rem;
    }
    
    /* Pricing Cards */
    .pricing-cards {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 3rem;
        flex-wrap: wrap;
    }
    
    .pricing-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        padding: 2.5rem 2rem;
        width: 100%;
        max-width: 350px;
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .pricing-card.featured {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid var(--squid-yellow);
        z-index: 2;
    }
    
    .popular-tag {
        position: absolute;
        top: -12px;
        right: 30px;
        background: var(--squid-yellow);
        color: var(--squid-black);
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
    }
    
    .pricing-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .pricing-header h3 {
        font-size: 2rem;
        margin: 0 0 0.5rem;
        color: var(--squid-teal);
        font-family: 'Anton', sans-serif;
        letter-spacing: 2px;
    }
    
    .price {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--squid-yellow);
        margin: 0.5rem 0;
    }
    
    .features {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem;
    }
    
    .features li {
        padding: 0.7rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
        padding-left: 1.8rem;
    }
    
    .features li:before {
        content: '✓';
        color: var(--squid-teal);
        position: absolute;
        left: 0;
        font-weight: bold;
    }
    
    .btn-outline {
        background: transparent;
        border: 2px solid var(--squid-teal);
        color: white;
    }
    
    .btn-outline:hover {
        background: var(--squid-teal);
        color: white;
    }
    
    /* Add-ons */
    .addons-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }
    
    .addon-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .addon-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(229, 49, 112, 0.1);
    }
    
    .addon-card i {
        font-size: 2.5rem;
        color: var(--squid-teal);
        margin-bottom: 1rem;
    }
    
    .addon-card h3 {
        margin: 0;
        font-size: 1.2rem;
        color: white;
    }
    
    /* Contact Section */
    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
    }
    
    .contact-item i {
        font-size: 1.8rem;
        color: var(--squid-teal);
        margin-top: 0.5rem;
    }
    
    .contact-item h3 {
        color: var(--squid-yellow);
        margin: 0 0 0.5rem;
        font-size: 1.3rem;
    }
    
    .contact-item p {
        margin: 0.3rem 0;
    }
    
    .contact-item a {
        color: white;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .contact-item a:hover {
        color: var(--squid-teal);
        text-decoration: underline;
    }
    
    /* Responsive Styles */
    @media (max-width: 992px) {
        .pricing-card.featured {
            transform: none;
        }
        
        .pricing-cards {
            gap: 1.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .section {
            padding: 4rem 0;
        }
        
        .section-title {
            font-size: 2.2rem;
        }
        
        .timeline::before {
            left: 20px;
        }
        
        .timeline-item {
            width: 100%;
            padding-left: 50px;
            padding-right: 0;
        }
        
        .timeline-item:nth-child(odd),
        .timeline-item:nth-child(even) {
            left: 0;
            text-align: left;
            padding-right: 0;
        }
        
        .timeline-dot {
            left: 11px !important;
            right: auto !important;
        }
    }
    
    @media (max-width: 576px) {
        .section-title {
            font-size: 1.8rem;
        }
        
        .pricing-card {
            padding: 1.5rem 1rem;
        }
        
        .features li {
            font-size: 0.95rem;
        }
    }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero" style="position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 2rem; background: linear-gradient(135deg, #e53170 0%, #0f969c 100%); overflow: hidden;">
        <div class="hero-content" style="position: relative; z-index: 2; max-width: 1200px; margin: 0 auto;">
            <img src="images/eee.png" alt="Infradex Logo" class="logo" style="max-width: 12000px; margin-bottom: 2rem;">
            <h1 style="font-size: 5rem; font-weight: 100; margin-bottom: 1rem; color: white; text-shadow: 0px 0px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; letter-spacing: 5px; text-transform: uppercase; font-family: 'Anton', sans-serif;">
                COLLEGE HUNT
            </h1>
            <h2 style="font-size: 3rem; color: #ffd700; margin-bottom: 1.5rem; text-shadow: 2px 2px 0 #000; font-family: 'Bebas Neue', sans-serif; letter-spacing: 3px;">
                Squid Game Edition
            </h2>
            <p style="font-size: 1.5rem; color: white; max-width: 800px; margin: 0 auto 1.5rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                A Viral Youth Marketing Campaign Connecting Students to India's Top Colleges
            </p>
            
            <!-- Event Dates -->
            <div class="event-dates">
                <i class="far fa-calendar-alt"></i> JULY 6-7, 2025
            </div>
            
            <!-- Countdown Timer -->
            <div class="countdown-container">
                <div class="countdown-item">
                    <div class="number" id="days">00</div>
                    <div class="text">Days</div>
                </div>
                <div class="countdown-item">
                    <div class="number" id="hours">00</div>
                    <div class="text">Hours</div>
                </div>
                <div class="countdown-item">
                    <div class="number" id="minutes">00</div>
                    <div class="text">Minutes</div>
                </div>
                <div class="countdown-item">
                    <div class="number" id="seconds">00</div>
                    <div class="text">Seconds</div>
                </div>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <p style="margin: 0.5rem 0; color: #ffd700; font-size: 2rem;">
                    <i class="fas fa-camera" style="margin-right: 8px;"></i> Event by Elaman Visuals
                </p>
                <p style="margin: 0.5rem 0; color: #ffd700; font-size: 2rem;">
                    <i class="fas fa-star" style="margin-right: 8px;"></i> Main Sponsor: Infradex Education
                </p>
            </div>
            <div class="cta-buttons" style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
                <a href="#pricing" class="btn" style="background: #ffd700; color: #000; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid #ffd700; font-family: 'Anton', sans-serif;">
                    View Packages
                </a>
                <!-- <a href="#contact" class="btn" style="background: transparent; color: white; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: bold; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; border: 2px solid white; font-family: 'Anton', sans-serif; z-index: 1000;">
                    Contact Us
                </a> -->
            </div>
        </div>
        <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48cGF0aCBkPSJNMCwwIEwxMDAsMCBMMTAwLDEwMCBMMCwxMDAgWiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMSkiIHN0cm9rZS13aWR0aD0iMSIvPjwvc3ZnPg==');"></div>
        <div class="hero-shapes" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
            <div style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -150px; right: -150px;"></div>
            <div style="position: absolute; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; bottom: -100px; left: -100px;"></div>
            <div style="position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%; top: 50%; left: 70%;"></div>
        </div>
    </section>

    <!-- Campaign Overview -->
    <section class="section" id="overview">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Campaign <span class="highlight">Overview</span></h2>
                <div class="divider"></div>
            </div>
            
            <div class="campaign-cards">
                <div class="campaign-card">
                    <div class="campaign-icon">
                        <i class="fas fa-flag"></i>
                    </div>
                    <h3>Campaign Name</h3>
                    <p>College Hunt: Squid Game Edition</p>
                </div>
                
                <div class="campaign-card">
                    <div class="campaign-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3>Theme</h3>
                    <p>Inspired by Squid Game, reimagined as a fun, safe, and interactive college exploration experience</p>
                </div>
                
                <div class="campaign-card">
                    <div class="campaign-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Objective</h3>
                    <p>Bridge the gap between students and top-tier colleges through engaging experiences</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Squid Game -->
    <section class="section bg-dark">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Why <span class="highlight">Squid Game</span>?</h2>
                <div class="divider"></div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>1.65B+</h3>
                    <p>Hours viewed on Netflix</p>
                </div>
                <div class="stat-item">
                    <h3>74%</h3>
                    <p>Of 16-22 year-olds in India engaged</p>
                </div>
                <div class="stat-item">
                    <h3>90%+</h3>
                    <p>Brand recognition among Gen Z</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Campaign Flow -->
    <section class="section" id="flow">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Campaign <span class="highlight">Flow</span></h2>
                <div class="divider"></div>
            </div>
            
            <div class="timeline">
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>1. Mini-Zones (Street Campaigning)</h3>
                        <p>Squid Game challenges (safe, fun, themed)</p>
                    </div>
                </div>
                
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>2. College Booths</h3>
                        <p>Real-time Q&A, brochures, admission help</p>
                    </div>
                </div>
                
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>3. VIP Pass Giveaways</h3>
                        <p>Entry to the Main Big Event (for 12th pass students)</p>
                    </div>
                </div>
                
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h3>4. Main Event</h3>
                        <p>Themed mega-interaction with exciting activities</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Packages -->
    <section class="section bg-dark" id="pricing">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Sponsorship <span class="highlight">Packages</span></h2>
                <div class="divider"></div>
                <p class="section-subtitle">Choose the perfect package for your brand</p>
            </div>
            
            <div class="pricing-cards">
                <!-- Bronze Package -->
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-header">
                        <h3>BRONZE</h3>
                        <div class="price">₹30,000</div>
                    </div>
                    <ul class="features">
                        <li>Logo on standee</li>
                        <li>30 VIP Passes</li>
                        <li>300+ leads</li>
                        <li>Shared info desk</li>
                        <li>1 Reel + 1 Story</li>
                        <li>Thank-you mention</li>
                    </ul>
                    <a href="https://docs.google.com/forms/d/1jQ7qOd6i2d5UjyYiXLQ5Ci23WffKU4GakIRBfWfwhoA/edit?pli=1" target="_blank" class="btn btn-outline">Get Started</a>
                </div>
                
                <!-- Gold Package (Featured) -->
                <div class="pricing-card featured" data-aos="fade-up">
                    <div class="popular-tag">MOST POPULAR</div>
                    <div class="pricing-header">
                        <h3>GOLD</h3>
                        <div class="price">₹60,000</div>
                    </div>
                    <ul class="features">
                        <li>Main Partner branding</li>
                        <li>100 VIP Passes</li>
                        <li>1000+ direct leads</li>
                        <li>Prime Booth placement</li>
                        <li>3 Reels + 5 Stories</li>
                        <li>10-min career talk slot</li>
                        <li>Logo in aftermovie</li>
                        <li>Brochure in VIP bags</li>
                    </ul>
                    <a href="https://docs.google.com/forms/d/1jQ7qOd6i2d5UjyYiXLQ5Ci23WffKU4GakIRBfWfwhoA/edit?pli=1" target="_blank" class="btn">Get Started</a>
                </div>
                
                <!-- Silver Package -->
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-header">
                        <h3>SILVER</h3>
                        <div class="price">₹50,000</div>
                    </div>
                    <ul class="features">
                        <li>Logo on all posters</li>
                        <li>60 VIP Passes</li>
                        <li>600+ leads</li>
                        <li>Medium Booth</li>
                        <li>2 Reels + 2 Stories</li>
                        <li>5-min talk slot</li>
                        <li>Logo in aftermovie</li>
                        <li>Brochure distribution</li>
                    </ul>
                    <a href="https://docs.google.com/forms/d/1jQ7qOd6i2d5UjyYiXLQ5Ci23WffKU4GakIRBfWfwhoA/edit?pli=1" target="_blank" class="btn btn-outline">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Add-Ons -->
    <section class="section" id="addons">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Add-Ons & <span class="highlight">Benefits</span></h2>
                <div class="divider"></div>
            </div>
            
            <div class="addons-grid">
                <div class="addon-card">
                    <i class="fas fa-video"></i>
                    <h3>Video/Photo Coverage</h3>
                </div>
                <div class="addon-card">
                    <i class="fas fa-database"></i>
                    <h3>Student Database</h3>
                </div>
                <div class="addon-card">
                    <i class="fas fa-hashtag"></i>
                    <h3>Social Media Visibility</h3>
                </div>
                <div class="addon-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>Career Talks</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section bg-dark" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Let's <span class="highlight">Partner Up</span></h2>
                <div class="divider"></div>
                <p class="section-subtitle">Limited Gold Partnerships Available</p>
            </div>
            
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h3>Contact</h3>
                        <p><a href="tel:+918899986821">+91 88999 86821</a></p>
                        <p><a href="tel:+917006982993">+91 70069 82993</a></p>
                        <p><a href="tel:+919796931231">+91 97969 31231</a></p>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-globe"></i>
                    <div>
                        <h3>Website</h3>
                        <p><a href="https://www.infradexedu.in" target="_blank">www.infradexedu.in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Add the AOS initialization and custom animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Set the date we're counting down to - July 6, 2025
        const countDownDate = new Date("July 6, 2025 00:00:00").getTime();
        
        // Update the count down every 1 second
        const countdownTimer = setInterval(function() {
            // Get today's date and time
            const now = new Date().getTime();
            
            // Find the distance between now and the count down date
            const distance = countDownDate - now;
            
            // Time calculations for days, hours, minutes and seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Display the result with leading zeros
            document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;
            
            // If the count down is finished, display message
            if (distance < 0) {
                clearInterval(countdownTimer);
                document.getElementById("days").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
                
                // You could add a message that the event has started
                const countdownContainer = document.querySelector(".countdown-container");
                if (countdownContainer) {
                    const eventStartedElement = document.createElement("div");
                    eventStartedElement.innerHTML = "<div style='font-size: 1.5rem; color: var(--squid-yellow); margin-top: 1rem;'>Event is happening now!</div>";
                    countdownContainer.parentNode.insertBefore(eventStartedElement, countdownContainer.nextSibling);
                }
            }
        }, 1000);
        
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Add floating animation to logo
        const logo = document.querySelector('.logo');
        if (logo) {
            logo.style.animation = 'float 3s ease-in-out infinite';
        }
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Initialize AOS animation library
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
</body>
</html>
