<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>College Hunt: Squid Game Edition - Details | Infradex</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Press+Start+2P&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --dark-color: #1a1a1a;
            --light-color: #f5f5f5;
            --text-color: #333333;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-color);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 2rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        h1 {
            font-family: 'Anton', sans-serif;
            font-size: 2.5rem;
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--light-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .tagline {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 1rem;
        }
        
        section {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
        }
        
        ul {
            list-style: none;
            padding-left: 1rem;
        }
        
        ul li {
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 1.5rem;
        }
        
        ul li:before {
            content: '✓';
            color: var(--primary-color);
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        
        .pass-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .pass-card {
            flex: 1 1 300px;
            background: #f9f9f9;
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid #e0e0e0;
            position: relative;
            overflow: hidden;
        }
        
        .pass-card.vip {
            border: 2px solid var(--accent-color);
        }
        
        .pass-card.vip:before {
            content: 'VIP';
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent-color);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .pass-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }
        
        .pass-price {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--accent-color);
        }
        
        .event-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }
        
        .event-detail {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .event-detail i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }
        
        input, select, textarea {
            width: 100%;
            padding: 0.8rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            background: #fff;
            color: var(--text-color);
            font-family: 'Roboto', sans-serif;
        }
        
        input:focus, select:focus, textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        
        .radio-group {
            display: flex;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        input[type="radio"] {
            width: auto;
        }
        
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Anton', sans-serif;
            letter-spacing: 1px;
            text-decoration: none;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.3);
            background: #2980b9;
        }
        
        .notes {
            font-size: 0.9rem;
            color: #555;
        }
        
        .notes li {
            margin-bottom: 0.5rem;
        }
        
        footer {
            text-align: center;
            margin: 3rem 0 1rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 1rem 0;
        }
        
        .social-links a {
            color: var(--secondary-color);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--primary-color);
        }
        
        .contact-info {
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        
        .contact-info a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .contact-info a:hover {
            text-decoration: underline;
        }
        
        .highlight {
            color: var(--accent-color);
            font-weight: bold;
        }
        
        .cta-text {
            font-family: 'Press Start 2P', cursive;
            font-size: 1rem;
            text-align: center;
            margin: 2rem 0;
            line-height: 1.8;
            color: var(--secondary-color);
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            .pass-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            section {
                padding: 1.5rem;
            }
            
            .event-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>College Hunt: Squid Game Edition</h1>
            <p class="tagline">🔥 Kashmir's Biggest Student Event is Here!</p>
        </div>
            <div style="text-align:center; margin: 2rem 0;">
                <a href="squidgame.php" class="btn" style="background: var(--accent-color);">
                    College Registration
                </a>
            </div>
    </header>
    
    <div class="container">
        <section>
            <h2>🧠 Think You've Got What It Takes to Win the Game?</h2>
            <p>Welcome to <strong>College Hunt: Squid Game Edition</strong> — a one-of-a-kind experience where fun, future, and thrill collide!</p>
            <p>Join thousands of students as you compete in live Squid Game–inspired challenges, discover top colleges and career options, and experience a high-energy event like never before.</p>
        </section>
        
        <section>
            <h2>🎟️ Choose Your Pass:</h2>
            <div class="pass-container">
                <div class="pass-card">
                    <div class="pass-title">✅ Normal Pass</div>
                    <div class="pass-price">Free entry</div>
                    <ul>
                        <li>Access to all public zones</li>
                        <li>Play select games</li>
                        <li>Meet college reps</li>
                        <li>Attend career talks</li>
                    </ul>
                </div>
                
                <div class="pass-card vip">
                    <div class="pass-title">💎 VIP Pass</div>
                    <div class="pass-price">₹250 (Limited)</div>
                    <ul>
                        <li>Entry to <strong>VIP Game Championship</strong></li>
                        <li>Priority access to college booths</li>
                        <li>Fast-track entries</li>
                        <li>Featured in highlight reels</li>
                        <li>Free entry to the surprise celebrity show</li>
                    </ul>
                </div>
            </div>
        </section>
        
        <section>
            <h2>📅 Event Dates</h2>
            <div class="event-details">
                <div class="event-detail">
                    <i class="far fa-calendar-alt"></i>
                    <span>6 & 7 July 2025</span>
                </div>
                <div class="event-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Indoor stadium, Srinagar</span>
                </div>
                <div class="event-detail">
                    <i class="far fa-clock"></i>
                    <span>Gates Open: 10:00 AM onwards</span>
                </div>
            </div>
        </section>
        
        <section>
            <h2>📲 Register Now</h2>
            <p>Fill out the form below to secure your spot. It takes less than 30 seconds!</p>
            <div style="text-align:center; margin: 2rem 0;">
                <a href="https://forms.gle/your-google-form-link" target="_blank" class="btn">
                    Register
                </a>
            </div>
        </section>
        
        <section>
            <h2>⚠️ Important Notes:</h2>
            <ul class="notes">
                <li>Entry without registration may not be permitted.</li>
                <li>Passes will be verified at the gate via QR code or confirmation SMS.</li>
                <li>VIP perks are limited and strictly first-come-first-serve.</li>
            </ul>
        </section>
        
        <div class="cta-text">👀 See You In The Game. Don't Get Left Behind.</div>
        
        <footer>
            <p>Follow us:</p>
            <div class="social-links">
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
            <div class="contact-info">
                <p>📞 For any queries: <span class="highlight">+91-8899986821</span> | ✉️ <a href="mailto:hello@collegehunt.in">hello@collegehunt.in</a></p>
            </div>
        </footer>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registration-form');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Here you would normally send the form data to the server
                // This is just a placeholder to show a success message
                alert('Thank you for registering! Your pass details will be sent to your phone shortly.');
                form.reset();
            });
        });
    </script>
</body>
</html>
