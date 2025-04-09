<?php include '../components/header.php'; ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Infradex Tech Team</h1>
        <p class="lead text-muted">Meet the brilliant minds behind Infradex</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card team-member-card">
                <div class="card-body text-center p-4">
                    <div class="team-member-img-wrapper mb-4">
                        <img src="../assets/images/team/ibrahim.jpg" alt="Ibrahim Bhat" class="rounded-circle team-member-img">
                    </div>
                    <h3 class="card-title mb-2 text-white">Ibrahim Bhat</h3>
                    <p class="text-primary mb-3">Full Stack Developer</p>
                    <p class="card-text mb-4 text-white-50">Passionate developer with expertise in creating modern, responsive web applications. Specializing in both frontend and backend development.</p>
                    
                    <div class="social-links mb-4">
                        <a href="https://ibrahimbhat.com" target="_blank" class="btn btn-outline-primary me-2">
                            <i class="fas fa-globe me-2"></i>Website
                        </a>
                        <a href="https://github.com/ibrahim-bhat" target="_blank" class="btn btn-outline-dark me-2">
                            <i class="fab fa-github me-2"></i>GitHub
                        </a>
                        <a href="https://linkedin.com/in/ibrahimbhat" target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-linkedin me-2"></i>LinkedIn
                        </a>
                    </div>

                    <div class="skills-section">
                        <h5 class="mb-3 text-white">Technical Skills</h5>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <span class="badge bg-primary">PHP</span>
                            <span class="badge bg-primary">JavaScript</span>
                            <span class="badge bg-primary">HTML5</span>
                            <span class="badge bg-primary">CSS3</span>
                            <span class="badge bg-primary">MySQL</span>
                            <span class="badge bg-primary">Bootstrap</span>
                            <span class="badge bg-primary">Laravel</span>
                            <span class="badge bg-primary">React</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.team-member-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(128, 0, 255, 0.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.team-member-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(128, 0, 255, 0.3);
    box-shadow: 0 10px 30px rgba(128, 0, 255, 0.15);
}

.team-member-img-wrapper {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.team-member-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 5px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.team-member-card:hover .team-member-img {
    border-color: rgba(128, 0, 255, 0.3);
    box-shadow: 0 0 20px rgba(128, 0, 255, 0.2);
}

.social-links .btn {
    border-radius: 50px;
    padding: 8px 20px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(128, 0, 255, 0.2);
}

.social-links .btn:hover {
    transform: translateY(-2px);
    background: rgba(128, 0, 255, 0.1);
    border-color: rgba(128, 0, 255, 0.4);
    box-shadow: 0 5px 15px rgba(128, 0, 255, 0.2);
}

.skills-section {
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
    border: 1px solid rgba(128, 0, 255, 0.1);
}

.skills-section .badge {
    padding: 8px 15px;
    font-size: 0.9rem;
    border-radius: 50px;
    transition: transform 0.3s ease;
    background: linear-gradient(45deg, rgba(128, 0, 255, 0.2), rgba(74, 0, 224, 0.2));
    border: 1px solid rgba(128, 0, 255, 0.3);
}

.skills-section .badge:hover {
    transform: scale(1.05);
    background: linear-gradient(45deg, rgba(128, 0, 255, 0.3), rgba(74, 0, 224, 0.3));
    box-shadow: 0 0 15px rgba(128, 0, 255, 0.2);
}

@media (max-width: 768px) {
    .team-member-img-wrapper {
        width: 150px;
        height: 150px;
    }
    
    .social-links .btn {
        margin-bottom: 10px;
    }
}
</style>

<?php include '../components/footer.php'; ?> 