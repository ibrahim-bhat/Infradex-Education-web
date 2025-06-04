

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Add AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
:root {
    --squid-pink: #E53170;
    --squid-teal: #0F969C;
    --squid-yellow: #FFD700;
    --squid-black: #001011;
    --squid-white: #F6F7F8;
}

/* Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Press+Start+2P&display=swap');

body {
    background-color: var(--squid-black);
    color: var(--squid-white);
    font-family: 'Bebas Neue', 'Rajdhani', sans-serif;
    line-height: 1.6;
    overflow-x: hidden;
    position: relative;
}

/* Animated Background */
.bg-pattern {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0.1;
    background: 
        radial-gradient(circle at 25% 25%, var(--squid-pink) 0%, transparent 25%),
        radial-gradient(circle at 75% 75%, var(--squid-teal) 0%, transparent 25%);
    background-size: 50px 50px;
    animation: moveBackground 30s linear infinite;
}

@keyframes moveBackground {
    0% { background-position: 0 0; }
    100% { background-position: 1000px 1000px; }
}

/* Grid Overlay */
.grid-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        linear-gradient(rgba(0, 0, 0, 0.2) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 0, 0, 0.2) 1px, transparent 1px);
    background-size: 20px 20px;
    pointer-events: none;
    z-index: -1;
    opacity: 0.3;
}

.squid-header {
    background: linear-gradient(135deg, var(--squid-pink) 0%, var(--squid-teal) 100%);
    padding: 6rem 0;
    text-align: center;
    position: relative;
    overflow: hidden;
    clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
    padding-bottom: 8rem;
    margin-bottom: -4rem;
    background: linear-gradient(135deg, #e53170 0%, #0f969c 100%);
    background-size: 200% 200%;
    animation: gradientBG 15s ease infinite;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Animated Shapes */
.shape {
    position: absolute;
    opacity: 0.1;
    z-index: 0;
}

.triangle {
    width: 0;
    height: 0;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    border-bottom: 86.6px solid var(--squid-yellow);
    animation: float 15s ease-in-out infinite;
}

.circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: var(--squid-pink);
    animation: pulse 8s ease-in-out infinite;
}

.square {
    width: 80px;
    height: 80px;
    background: var(--squid-teal);
    transform: rotate(45deg);
    animation: spin 20s linear infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.1; }
    50% { transform: scale(1.2); opacity: 0.2; }
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.squid-header h1 {
    font-size: 5.5rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 10px;
    margin: 0;
    text-shadow: 5px 5px 0 rgba(0,0,0,0.3);
    position: relative;
    z-index: 2;
    font-family: 'Anton', sans-serif;
    background: linear-gradient(to right, #fff, var(--squid-yellow));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-transform: uppercase;
    animation: titleGlow 2s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    from { text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px var(--squid-pink), 0 0 40px var(--squid-pink); }
    to { text-shadow: 0 0 20px #fff, 0 0 30px var(--squid-yellow), 0 0 40px var(--squid-yellow), 0 0 50px var(--squid-yellow); }
}

.squid-header h2 {
    font-size: 2.5rem;
    margin: 1.5rem 0 0;
    color: var(--squid-yellow);
    position: relative;
    z-index: 2;
    text-transform: uppercase;
    letter-spacing: 5px;
    font-family: 'Press Start 2P', cursive;
    text-shadow: 3px 3px 0 #000;
    animation: blink 1.5s step-end infinite;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Glitch Effect */
.glitch {
    position: relative;
    color: white;
    font-size: 4rem;
    letter-spacing: 0.5em;
    animation: glitch-skew 1s infinite linear alternate-reverse;
}

.glitch::before,
.glitch::after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    left: 0;
}

.glitch::before {
    animation: glitch 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both infinite;
    color: #0ff;
    z-index: -1;
}

.glitch::after {
    animation: glitch 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) reverse both infinite;
    color: #f0f;
    z-index: -2;
}

@keyframes glitch {
    0% { transform: translate(0); }
    20% { transform: translate(-3px, 3px); }
    40% { transform: translate(-3px, -3px); }
    60% { transform: translate(3px, 3px); }
    80% { transform: translate(3px, -3px); }
    100% { transform: translate(0); }
}

@keyframes glitch-skew {
    0% { transform: skew(0deg); }
    10% { transform: skew(3deg); }
    20% { transform: skew(-2deg); }
    30% { transform: skew(4deg); }
    40% { transform: skew(-3deg); }
    50% { transform: skew(2deg); }
    70% { transform: skew(-1deg); }
    80% { transform: skew(3deg); }
    90% { transform: skew(-2deg); }
    100% { transform: skew(0); }
}

.section {
    padding: 4rem 0;
    position: relative;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    color: var(--squid-pink);
    position: relative;
    display: inline-block;
}

.section-title:after {
    content: '';
    position: absolute;
    width: 80px;
    height: 5px;
    background: var(--squid-teal);
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(229, 49, 112, 0.2);
}

.pricing-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.pricing-card {
    background: rgba(15, 150, 156, 0.1);
    border-radius: 15px;
    padding: 2.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid var(--squid-teal);
    transform-style: preserve-3d;
    perspective: 1000px;
    cursor: pointer;
}

.pricing-card:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.03), transparent);
    transform: translateX(-100%);
    transition: 0.6s;
}

.pricing-card:hover:before {
    transform: translateX(100%);
}

.pricing-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 15px 30px rgba(15, 150, 156, 0.2);
    border-color: var(--squid-pink);
}

.pricing-card.gold {
    border: 2px solid var(--squid-yellow);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2);
    position: relative;
    z-index: 2;
}

.pricing-card.gold:after {
    content: 'POPULAR';
    position: absolute;
    top: 20px;
    right: -35px;
    background: var(--squid-yellow);
    color: var(--squid-black);
    padding: 5px 40px;
    transform: rotate(45deg);
    font-weight: bold;
    font-size: 0.8rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.pricing-card.gold {
    border-color: var(--squid-yellow);
    transform: scale(1.05);
}

.pricing-card.gold .price {
    color: var(--squid-yellow);
}

.pricing-card h3 {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: var(--squid-teal);
}

.pricing-card.gold h3 {
    color: var(--squid-yellow);
}

.price {
    font-size: 3rem;
    font-weight: 700;
    color: var(--squid-teal);
    margin: 1.5rem 0;
}

.features {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem;
    text-align: left;
}

.features li {
    padding: 0.8rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    padding-left: 1.5rem;
}

.features li:before {
    content: '✓';
    color: var(--squid-teal);
    position: absolute;
    left: 0;
    font-weight: bold;
    animation: bounceIn 0.5s ease-out;
}

@keyframes bounceIn {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}

/* Hover effect for features */
.features li {
    transition: all 0.3s ease;
    transform-origin: left;
}

.features li:hover {
    transform: translateX(10px);
    color: var(--squid-yellow);
}

.btn-squid {
    display: inline-block;
    background: var(--squid-pink);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    cursor: pointer;
    font-size: 1.1rem;
    position: relative;
    overflow: hidden;
    z-index: 1;
    box-shadow: 0 5px 15px rgba(229, 49, 112, 0.4);
    font-family: 'Anton', sans-serif;
}

.btn-squid:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--squid-teal), var(--squid-pink), var(--squid-yellow));
    background-size: 200% 200%;
    z-index: -1;
    transition: 0.5s;
    opacity: 0;
}

.btn-squid:hover:before {
    opacity: 1;
    animation: gradientBG 3s ease infinite;
}

.btn-squid span {
    position: relative;
    z-index: 1;
    transition: 0.3s;
}

.btn-squid:hover span {
    letter-spacing: 3px;
    color: white;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.btn-squid:hover {
    background: var(--squid-teal);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(229, 49, 112, 0.4);
}

.stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin: 4rem 0;
    text-align: center;
}

.stat-item {
    padding: 2rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: var(--squid-pink);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.timeline {
    position: relative;
    max-width: 800px;
    margin: 4rem auto;
}

.timeline:before {
    content: '';
    position: absolute;
    width: 2px;
    background: var(--squid-teal);
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -1px;
}

.timeline-item {
    padding: 10px 40px;
    position: relative;
    width: 50%;
    box-sizing: border-box;
    margin: 30px 0;
}

.timeline-item:nth-child(odd) {
    left: 0;
}

.timeline-item:nth-child(even) {
    left: 50%;
}

.timeline-content {
    padding: 20px;
    background: rgba(15, 150, 156, 0.1);
    border-radius: 10px;
    position: relative;
}

.timeline-content:after {
    content: '';
    position: absolute;
    border-style: solid;
    width: 0;
    height: 0;
    top: 30px;
}

.timeline-item:nth-child(odd) .timeline-content:after {
    right: -15px;
    border-width: 15px 0 15px 15px;
    border-color: transparent transparent transparent rgba(15, 150, 156, 0.1);
}

.timeline-item:nth-child(even) .timeline-content:after {
    left: -15px;
    border-width: 15px 15px 15px 0;
    border-color: transparent rgba(15, 150, 156, 0.1) transparent transparent;
}

.timeline-dot {
    width: 20px;
    height: 20px;
    background: var(--squid-pink);
    border-radius: 50%;
    position: absolute;
    top: 30px;
    right: -10px;
    z-index: 1;
}

.timeline-item:nth-child(even) .timeline-dot {
    left: -10px;
}

.contact-info {
    text-align: center;
    margin-top: 4rem;
}

.contact-info a {
    color: var(--squid-teal);
    text-decoration: none;
    font-weight: 700;
    transition: color 0.3s ease;
}

.contact-info a:hover {
    color: var(--squid-pink);
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .squid-header h1 {
        font-size: 3rem;
    }
    
    .squid-header h2 {
        font-size: 1.5rem;
    }
    
    .pricing-cards {
        grid-template-columns: 1fr;
    }
    
    .pricing-card.gold {
        transform: none;
    }
    
    .timeline:before {
        left: 31px;
    }
    
    .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
    }
    
    .timeline-item:nth-child(even) {
        left: 0;
    }
    
    .timeline-item:nth-child(odd) .timeline-content:after,
    .timeline-item:nth-child(even) .timeline-content:after {
        left: -15px;
        right: auto;
        border-width: 15px 15px 15px 0;
        border-color: transparent rgba(15, 150, 156, 0.1) transparent transparent;
    }
    
    .timeline-dot {
        left: 21px;
    }
}
</style>

<!-- Header Section -->
<!-- Animated Background Elements -->
<div class="bg-pattern"></div>
<div class="grid-overlay"></div>

<!-- Animated Shapes -->
<div class="shape triangle" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
<div class="shape circle" style="top: 20%; right: 8%; animation-delay: 2s;"></div>
<div class="shape square" style="bottom: 15%; left: 10%; animation-delay: 4s;"></div>
<div class="shape triangle" style="bottom: 25%; right: 5%; animation-delay: 6s; transform: rotate(180deg);"></div>

<header class="squid-header">
    <!-- Top Logo -->
    <div style="position: absolute; top: 20px; left: 20px; z-index: 1000;">
        <a href="/" style="display: inline-block;">
            <img src="images/eee.png" alt="Infradex Logo" style="height: 50px; width: auto;">
        </a>
    </div>
    <div class="container">
        <div class="glitch" data-text="COLLEGE HUNT">COLLEGE HUNT</div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem;">
            <img src="images/eee.png" alt="Infradex Logo" style="height: 80px; width: auto; margin-bottom: 1.5rem;">
            <h1>COLLEGE HUNT</h1>
            <h2>Squid Game Edition</h2>
        </div>
        <p class="lead" style="font-size: 1.5rem; max-width: 800px; margin: 2rem auto 0; position: relative; z-index: 2;">
            <span style="display: inline-block; animation: float 6s ease-in-out infinite;">
                A Viral Youth Marketing Campaign Connecting Students to India's Top Colleges
            </span>
        </p>
        <div style="margin-top: 3rem;">
            <a href="tel:+918899986821" class="btn-squid" style="margin-left: 1rem;">
                <span>Become a Sponsor</span>
            </a>
        </div>
        
        <!-- Animated Scroll Indicator -->
        <div class="scroll-indicator" style="position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);">
            <div style="width: 30px; height: 50px; border: 2px solid white; border-radius: 15px; position: relative;">
                <div style="width: 4px; height: 8px; background: white; border-radius: 2px; position: absolute; top: 8px; left: 50%; transform: translateX(-50%); animation: scroll 2s infinite;"></div>
            </div>
            <p style="margin-top: 1rem; font-size: 0.8rem; opacity: 0.8;">SCROLL DOWN</p>
        </div>
    </div>
</header>

<!-- Scroll Reveal Animation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Add scroll animation to elements
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.card, .pricing-card, .stat-item, .timeline-item');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Initial check
        animateOnScroll();
        
        // Check on scroll
        window.addEventListener('scroll', animateOnScroll);

        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
    
    // Scroll animation
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        const header = document.querySelector('.squid-header');
        header.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
    });
</script>

<!-- Scroll Animation CSS -->
<style>
    .card, .pricing-card, .stat-item, .timeline-item {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    @keyframes scroll {
        0% { transform: translate(-50%, 0); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translate(-50%, 20px); opacity: 0; }
    }
</style>

<!-- Campaign Overview -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Campaign Overview</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h3>Campaign Name</h3>
                    <p>College Hunt: Squid Game Edition</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h3>Theme</h3>
                    <p>Inspired by the global sensation Squid Game, reimagined into a fun, safe, and interactive college exploration game</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h3>Objective</h3>
                    <p>Bridge the gap between students and top-tier colleges through engaging experiences and viral marketing</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Squid Game -->
<section class="section" style="background: rgba(0,0,0,0.3);">
    <div class="container">
        <h2 class="section-title">Why Squid Game?</h2>
        <div class="card">
            <ul class="features">
                <li><strong>Global & National Popularity:</strong> Netflix's most-watched series with over 1.65 billion hours viewed</li>
                <li><strong>Teen Engagement:</strong> 74% of 16-22 year-olds in India have watched or interacted with Squid Game content (Statista, 2023)</li>
                <li><strong>Brand Recognition:</strong> 90%+ brand recognition among Gen Z</li>
                <li><strong>Interactive Experience:</strong> 4 culturally adapted, safe, and fun game modules themed around education and career decisions</li>
            </ul>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Student Market in Kashmir - 2025</h2>
        <div class="stats">
            <div class="stat-item">
                <div class="stat-number">70,000+</div>
                <p>Class 12 graduates in J&K (JKBOSE + CBSE + Private Boards)</p>
            </div>
            <div class="stat-item">
                <div class="stat-number">225,000+</div>
                <p>Impressions (15 Hotspots × 1,000+ footfall/day × 15 days)</p>
            </div>
            <div class="stat-item">
                <div class="stat-number">15,000+</div>
                <p>Estimated qualified leads through opt-in interactions</p>
            </div>
        </div>
        <p class="text-center">Primary focus area: Srinagar, Baramulla, Anantnag, Pulwama, Kupwara, Sopore</p>
    </div>
</section>

<!-- Campaign Flow -->
<section class="section" style="background: rgba(0,0,0,0.3);">
    <div class="container">
        <h2 class="section-title">Campaign Flow</h2>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-content">
                    <h3>1. Mini-Zones (Street Campaigning)</h3>
                    <p>Squid Game challenges (safe, fun, themed)</p>
                </div>
                <div class="timeline-dot"></div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h3>2. College Booths</h3>
                    <p>Real-time Q&A, brochures, reps, admission help</p>
                </div>
                <div class="timeline-dot"></div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h3>3. VIP Pass Giveaways</h3>
                    <p>Entry to the Main Big Event (only for recent 12th pass students)</p>
                </div>
                <div class="timeline-dot"></div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h3>4. Main Event</h3>
                    <p>Themed mega-interaction with exciting activities</p>
                </div>
                <div class="timeline-dot"></div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Sponsorship Packages</h2>
        <p class="text-center mb-5">All plans offer direct access to verified leads, branding, and face-to-face promotion.</p>
        
        <div class="pricing-cards">
            <!-- Bronze Package -->
            <div class="pricing-card">
                <h3>BRONZE</h3>
                <div class="price">₹30,000</div>
                <ul class="features">
                    <li>Logo on standee</li>
                    <li>30 VIP Passes</li>
                    <li>300+ leads, shared info desk</li>
                    <li>1 reel + 1 story promotion</li>
                    <li>Thank-you mention + poster</li>
                </ul>
                <a href="#contact" class="btn-squid">Choose Plan</a>
            </div>
            
            <!-- Gold Package -->
            <div class="pricing-card gold">
                <h3>GOLD</h3>
                <div class="price">₹60,000</div>
                <ul class="features">
                    <li>Main Partner branding on ALL materials</li>
                    <li>100 VIP Passes</li>
                    <li>3 stage mentions + 1-min promo talk</li>
                    <li>1000+ direct leads</li>
                    <li>Prime Booth</li>
                    <li>Full Social Media Package (3 reels + 5 stories)</li>
                    <li>10-min career talk slot</li>
                    <li>Logo in aftermovie brochure distribution in VIP bags</li>
                </ul>
                <a href="#contact" class="btn-squid">Choose Plan</a>
            </div>
            
            <!-- Silver Package -->
            <div class="pricing-card">
                <h3>SILVER</h3>
                <div class="price">₹50,000</div>
                <ul class="features">
                    <li>Logo on posters</li>
                    <li>60 VIP Passes</li>
                    <li>600+ leads</li>
                    <li>Medium Booth</li>
                    <li>2 reels + 2 stories</li>
                    <li>5-min talk by rep</li>
                    <li>Logo in aftermovie</li>
                    <li>Manual distribution of brochures</li>
                </ul>
                <a href="#contact" class="btn-squid">Choose Plan</a>
            </div>
        </div>
    </div>
</section>

<!-- Add-Ons -->
<section class="section" style="background: rgba(0,0,0,0.3);">
    <div class="container">
        <h2 class="section-title">Add-Ons & Benefits</h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="features">
                    <li>Video/Photo Coverage</li>
                    <li>Student Contact Database</li>
                    <li>Social Media Visibility</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="features">
                    <li>Career Talks</li>
                    <li>College material in VIP bags</li>
                    <li>Logo in campaign aftermovie</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Social Media & Outreach -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Social Media & Outreach Strategy</h2>
        <div class="card">
            <h3>Platforms</h3>
            <p>Instagram, YouTube, Facebook, Reddit</p>
            <h3>Influencer Collaborations</h3>
            <p>Partnerships with regional creators</p>
            <h3>Promotion</h3>
            <p>Paid promotion + organic approaches (engagement-based contests)</p>
            <h3>Estimated Reach</h3>
            <p>1M+ impressions in 15 days</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section" style="background: var(--squid-black);">
    <div class="container">
        <div style="text-align: center; margin-bottom: 2rem;">
            <img src="images/eee.png" alt="Infradex Logo" style="height: 60px; width: auto; margin: 0 auto 1rem; display: block;">
            <h2 class="section-title">Let's Partner Up</h2>
        </div>
        <div class="contact-info">
            <p><strong>For membership & sponsor slots:</strong> Available</p>
            <p><strong>Contact:</strong> <a href="tel:+918899986821">+91 88999 86821</a></p>
            <p><strong>More Info:</strong> <a href="https://www.infradexedu.in" target="_blank">www.infradexedu.in</a></p>
            <p class="mt-4">Limited Gold Partnerships Available</p>
            <div style="margin-top: 3rem; text-align: center;">
                <img src="images/eee.png" alt="Infradex Logo" style="height: 40px; width: auto; margin-bottom: 1.5rem; opacity: 0.8;">
                <div style="margin-top: 3rem;">
            <a href="tel:+918899986821" class="btn-squid" style="margin-left: 1rem;">
                <span>Become a Sponsor</span>
            </a>
        </div>
            </div>
        </div>
    </div>
</section>

