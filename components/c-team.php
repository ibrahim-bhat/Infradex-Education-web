<?php
$team_members = [
    [
        'name' => 'Ibrahim Bhat',
        'role' => 'Lead Developer & Full Stack Developer',
        'image' => './images/ibrahim.jpg',
        'bio' => 'Full-stack developer with expertise in modern web technologies and system architecture. Passionate about creating scalable and efficient solutions.',
        'social' => [
            'linkedin' => 'https://www.linkedin.com/in/ibrahim-bhat-971689202/',
            'github' => 'https://github.com/ibrahim-bhat',
            'twitter' => 'https://twitter.com/ibrahim_bhat_',
            'portfolio' => 'https://ibrahimbhat.com/'
        ],
        'skills' => ['PHP', 'JavaScript', 'React', 'Node.js', 'MySQL', 'VPS Deployment' , 'SEO']
    ],
    [
        'name' => 'Khushboo Lone',
        'role' => 'Frontend Developer',
        'image' => './images/khushboo.jpg',
        'bio' => 'Passionate about creating responsive and accessible web applications with modern JavaScript frameworks.',
        'social' => [
            'linkedin' => 'https://www.linkedin.com/in/khushbooramzan/',
        ],
        'skills' => ['React', 'JavaScript', 'HTML 5', 'CSS', 'Tailwind CSS']
    ]
];
?>
<style>
.team-section-advanced {
    background: linear-gradient(120deg, #232526 0%, #414345 100%);
    padding: 60px 0;
    color: #fff;
    font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
}
.team-section-advanced .section-title {
    font-size: 2.8rem;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 8px;
    background: linear-gradient(90deg, #e53170, #ffd700);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.team-section-advanced .section-desc {
    font-size: 1.2rem;
    color: #d1d1d1;
    margin-bottom: 40px;
}
.team-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 2.5rem;
    max-width: 1100px;
    margin: 0 auto;
}
.team-card {
    background: rgba(30, 32, 34, 0.95);
    border-radius: 22px;
    box-shadow: 0 8px 32px rgba(229, 49, 112, 0.08), 0 2px 8px rgba(0,0,0,0.10);
    overflow: hidden;
    position: relative;
    transition: transform 0.3s cubic-bezier(.22,1,.36,1), box-shadow 0.3s;
    border: 1.5px solid rgba(229, 49, 112, 0.12);
    z-index: 1;
}
.team-card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 16px 48px rgba(229, 49, 112, 0.18), 0 4px 16px rgba(0,0,0,0.13);
    border-color: #ffd700;
}
.team-card .card-bg {
    position: absolute;
    top: -40px; left: -40px;
    width: 120px; height: 120px;
    background: radial-gradient(circle, #e53170 0%, #ffd700 100%);
    opacity: 0.12;
    border-radius: 50%;
    z-index: 0;
}
.team-card-content {
    position: relative;
    z-index: 2;
    padding: 2.2rem 1.5rem 1.5rem 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.team-card-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 4px solid #ffd700;
    box-shadow: 0 2px 12px #e5317040;
    object-fit: cover;
    margin-bottom: 1.1rem;
    background: #fff;
    transition: transform 0.3s;
}
.team-card:hover .team-card-img {
    transform: scale(1.08) rotate(-4deg);
}
.team-card-name {
    font-size: 1.25rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
    color: #ffd700;
}
.team-card-role {
    font-size: 1.05rem;
    color: #e53170;
    margin-bottom: 0.7rem;
    font-weight: 500;
}
.team-card-bio {
    font-size: 0.98rem;
    color: #eaeaea;
    text-align: center;
    margin-bottom: 1.1rem;
    min-height: 48px;
}
.team-card-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    justify-content: center;
    margin-bottom: 1.2rem;
}
.team-card-skill {
    background: #232526;
    color: #ffd700;
    font-size: 0.83rem;
    padding: 4px 11px;
    border-radius: 12px;
    font-weight: 500;
    box-shadow: 0 1px 4px #e5317022;
}
.team-card-socials {
    display: flex;
    gap: 0.7rem;
    margin-bottom: 0.1rem;
}
.team-card-socials a {
    color: #e53170;
    font-size: 1.25rem;
    background: #fff2;
    padding: 7px 11px;
    border-radius: 50%;
    transition: background 0.2s, color 0.2s, transform 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.team-card-socials a:hover {
    background: #ffd700;
    color: #232526;
    transform: scale(1.15);
}
@media (max-width: 600px) {
    .team-section-advanced {
        padding: 32px 0;
    }
    .team-section-advanced .section-title {
        font-size: 2rem;
    }
    .team-cards-grid {
        gap: 1.5rem;
    }
    .team-card-content {
        padding: 1.2rem 0.5rem 1rem 0.5rem;
    }
}
</style>
<section class="team-section-advanced">
    <div class="container">
        <div class="section-title text-center">Our Development Team</div>
        <!-- <div class="section-desc text-center">The talented professionals who brought this platform to life</div> -->
        <div class="team-cards-grid">
            <?php foreach ($team_members as $member): ?>
            <div class="team-card" data-aos="fade-up">
                <div class="card-bg"></div>
                <div class="team-card-content">
                    <img class="team-card-img" src="<?php echo $member['image']; ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                    <div class="team-card-name"><?php echo htmlspecialchars($member['name']); ?></div>
                    <div class="team-card-role"><?php echo htmlspecialchars($member['role']); ?></div>
                    <div class="team-card-bio"><?php echo htmlspecialchars($member['bio']); ?></div>
                    <div class="team-card-skills">
                        <?php foreach ($member['skills'] as $skill): ?>
                            <span class="team-card-skill"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="team-card-socials">
                        <?php foreach ($member['social'] as $platform => $url): ?>
                            <?php
                                $icon = '';
                                switch ($platform) {
                                    case 'linkedin': $icon = '<i class="fab fa-linkedin-in"></i>'; break;
                                    case 'github': $icon = '<i class="fab fa-github"></i>'; break;
                                    case 'twitter': $icon = '<i class="fab fa-twitter"></i>'; break;
                                    case 'dribbble': $icon = '<i class="fab fa-dribbble"></i>'; break;
                                    case 'behance': $icon = '<i class="fab fa-behance"></i>'; break;
                                    case 'instagram': $icon = '<i class="fab fa-instagram"></i>'; break;
                                    case 'stack-overflow': $icon = '<i class="fab fa-stack-overflow"></i>'; break;
                                    case 'codepen': $icon = '<i class="fab fa-codepen"></i>'; break;
                                    case 'devto': $icon = '<i class="fab fa-dev"></i>'; break;
                                    case 'medium': $icon = '<i class="fab fa-medium-m"></i>'; break;
                                    case 'portfolio': $icon = '<i class="fas fa-globe"></i>'; break;
                                    default: $icon = '<i class="fas fa-link"></i>';
                                }
                            ?>
                            <a href="<?php echo $url; ?>" target="_blank" title="<?php echo ucfirst($platform); ?>">
                                <?php echo $icon; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Font Awesome for social icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!-- Optionally, add AOS (Animate On Scroll) for animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration: 900, once: true});</script>

</section>

<style>
.dev-card {
    perspective: 1000px;
    height: 350px;
    margin-bottom: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.5s;
}

.dev-card:hover {
    transform: translateY(-10px);
}

.dev-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.dev-card:hover .dev-card-inner {
    transform: rotateY(180deg);
}

.dev-card-front, .dev-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 15px;
    overflow: hidden;
}

.dev-card-front {
    background: linear-gradient(145deg, #2c3e50, #3498db);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.dev-card-back {
    background: linear-gradient(145deg, #3498db, #2c3e50);
    color: white;
    transform: rotateY(180deg);
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.dev-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
    margin-bottom: 15px;
}

.dev-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.dev-info h4 {
    margin: 10px 0 5px;
    font-weight: 600;
}

.dev-info p {
    opacity: 0.8;
    margin: 0;
}

.dev-social {
    margin-top: 15px;
}

.dev-social a {
    display: inline-block;
    width: 36px;
    height: 36px;
    line-height: 36px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    margin: 0 5px;
    color: white;
    transition: all 0.3s;
}

.dev-social a:hover {
    background: white;
    color: #3498db;
    transform: scale(1.1);
}

.gradient-text {
    background: linear-gradient(90deg, #3498db, #2c3e50);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
    margin-bottom: 20px;
}
</style>
