<?php
// Optional: Pass a custom message through parameters
$message = isset($comingSoonMessage) ? $comingSoonMessage : "Your application is currently under review. You will receive a confirmation email once the review is complete. Stay tuned!";
$title = isset($comingSoonTitle) ? $comingSoonTitle : "Application Under Review";
?>

<div class="coming-soon-wrapper">
    <div class="coming-soon-content">
        <div class="coming-soon-header">
            <h2><?php echo htmlspecialchars($title); ?></h2>
            <p class="subtitle"><?php echo htmlspecialchars($message); ?></p>
        </div>
        <div class="rocket-animation">
            <i class="fas fa-envelope"></i>
            <div class="rocket-smoke"></div>
        </div>
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        <p class="progress-text">Review in Progress</p>
        <p class="signature">Best wishes from Infradex Education</p>
    </div>
</div>

<style>
.coming-soon-wrapper {
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
    border-radius: 15px;
    margin: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
    overflow: hidden;
}

.coming-soon-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.coming-soon-content {
    text-align: center;
    color: #fff;
    z-index: 1;
    padding: 2rem;
}

.coming-soon-header h2 {
    font-size: 3rem;
    margin-bottom: 1rem;
    font-weight: 700;
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.subtitle {
    font-size: 1.2rem;
    color: #ecf0f1;
    margin-bottom: 2rem;
}

.rocket-animation {
    position: relative;
    font-size: 4rem;
    margin: 2rem 0;
    animation: rocketFloat 3s ease-in-out infinite;
}

.rocket-smoke {
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    width: 8px;
    height: 8px;
    background: rgba(255,255,255,0.6);
    border-radius: 50%;
    box-shadow: 
        0 0 10px #fff,
        0 0 20px #fff,
        0 0 30px #fff;
    animation: smoke 1s linear infinite;
}

.progress-bar {
    width: 200px;
    height: 6px;
    background: rgba(255,255,255,0.1);
    border-radius: 3px;
    margin: 2rem auto;
    overflow: hidden;
}

.progress-fill {
    width: 70%;
    height: 100%;
    background: linear-gradient(90deg, #4ecdc4, #ff6b6b);
    border-radius: 3px;
    animation: progressFill 2s ease-in-out infinite;
}

.progress-text {
    font-size: 0.9rem;
    color: #bdc3c7;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.signature {
    margin-top: 1rem;
    font-style: italic;
    color: #ecf0f1;
    font-size: 0.9rem;
}

@keyframes rocketFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

@keyframes smoke {
    0% { 
        transform: translateX(-50%) scale(1);
        opacity: 0.8;
    }
    100% { 
        transform: translateX(-50%) scale(2);
        opacity: 0;
    }
}

@keyframes progressFill {
    0% { transform: translateX(-100%); }
    50% { transform: translateX(0); }
    100% { transform: translateX(100%); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .coming-soon-wrapper {
        margin: 10px;
        min-height: 300px;
    }

    .coming-soon-header h2 {
        font-size: 2rem;
    }

    .subtitle {
        font-size: 1rem;
    }

    .rocket-animation {
        font-size: 3rem;
    }
}
</style> 