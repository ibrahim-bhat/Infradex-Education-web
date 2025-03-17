<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>India - InfradexEducation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/5d-styles.css" rel="stylesheet">
    <link href="../../css/university-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="scanlines"></div>

    <?php include '../../components/navbar.php'; ?>

    <div class="container mt-5 pt-5">
        <!-- Country Header -->
        <div class="university-header text-center">
            <div class="container">
                <h1 class="display-4 fw-bold"><i class="fas fa-landmark me-3"></i>Universities in India</h1>
                <p class="lead">Discover top educational institutions across India offering quality programs for international students</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section mb-4">
            <h4 class="text-white mb-3"><i class="fas fa-filter me-2"></i>Filter by State</h4>
            <div class="d-flex flex-wrap">
                <button class="btn btn-primary filter-btn active" data-filter="all">All States</button>
                <button class="btn btn-primary filter-btn" data-filter="maharashtra">Maharashtra</button>
                <button class="btn btn-primary filter-btn" data-filter="delhi">Delhi</button>
                <button class="btn btn-primary filter-btn" data-filter="other">Other States</button>
            </div>
        </div>

        <!-- University Card 1: BVDU -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>BVDU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Bharati Vidyapeeth Deemed University (BVDU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra (Multiple Campuses)</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1964</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Bharati Vidyapeeth Deemed University (BVDU), established in 1964, is a prominent private university based in Pune, India. With multiple campuses across cities like New Delhi, Navi Mumbai, Sangli, Solapur, Kolhapur, Karad, Satara, and Panchgani, BVDU offers a diverse range of academic programs across various disciplines.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Campuses across India:</h5>
                    <div>
                        <span class="campus-badge">Pune (Main)</span>
                        <span class="campus-badge">New Delhi</span>
                        <span class="campus-badge">Navi Mumbai</span>
                        <span class="campus-badge">Sangli</span>
                        <span class="campus-badge">Solapur</span>
                        <span class="campus-badge">Kolhapur</span>
                        <span class="campus-badge">Karad</span>
                        <span class="campus-badge">Satara</span>
                        <span class="campus-badge">Panchgani</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="undergraduate-tab" data-bs-toggle="tab" data-bs-target="#undergraduate" type="button" role="tab" aria-controls="undergraduate" aria-selected="true">Undergraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="postgraduate-tab" data-bs-toggle="tab" data-bs-target="#postgraduate" type="button" role="tab" aria-controls="postgraduate" aria-selected="false">Postgraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="diploma-tab" data-bs-toggle="tab" data-bs-target="#diploma" type="button" role="tab" aria-controls="diploma" aria-selected="false">Diploma</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab" data-bs-toggle="tab" data-bs-target="#admissions" type="button" role="tab" aria-controls="admissions" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab" data-bs-toggle="tab" data-bs-target="#rankings" type="button" role="tab" aria-controls="rankings" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContent">
                    <!-- Undergraduate Programs -->
                    <div class="tab-pane fade show active" id="undergraduate" role="tabpanel" aria-labelledby="undergraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Undergraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>B.Sc. Nursing</strong><br>
                                        Duration: 4 years<br>
                                        Campuses: Pune Dhankawadi, Navi Mumbai, Sangli, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>B.Pharm</strong><br>
                                        Duration: 4 years<br>
                                        Campuses: Pune Erandwane, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>B.H.M.S.</strong><br>
                                        Duration: 4.5 years + 1 year internship<br>
                                        Campuses: Pune Dhankawadi, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>B.Sc. Biotechnology</strong><br>
                                        Duration: 3 years<br>
                                        Campuses: Pune Dhankawadi, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>B.Com</strong><br>
                                        Duration: 3 years<br>
                                        Campuses: Pune Erandwane, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>B.Arch</strong><br>
                                        Duration: 5 years<br>
                                        Campuses: Pune Dhankawadi, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Postgraduate Programs -->
                    <div class="tab-pane fade" id="postgraduate" role="tabpanel" aria-labelledby="postgraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-user-graduate me-2"></i>Postgraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>MD (Anatomy)</strong><br>
                                        Duration: 3 years<br>
                                        Campuses: Pune Dhankawadi, Sangli, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>M.Arch</strong><br>
                                        Duration: 2 years<br>
                                        Specialization: Sustainable Architecture<br>
                                        Campuses: Pune Dhankawadi, Bharati Vidyapeeth Bhavan (Pune)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>M.Tech</strong><br>
                                        Duration: 2 years<br>
                                        Specializations: Civil and Hydraulics, Computer, Chemical, Mechanical (CAD-CAM), Electrical (Power Systems), Electronics (VLSI)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>MBA</strong><br>
                                        Available through: School of Online Education
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>MCA</strong><br>
                                        Available through: Online Program
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Diploma Programs -->
                    <div class="tab-pane fade" id="diploma" role="tabpanel" aria-labelledby="diploma-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-certificate me-2"></i>Diploma Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>PG Diploma in Counselling</strong><br>
                                        Duration: 1 year<br>
                                        Campus: Pune Erandwane
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>PG Diploma in Corporate Social Responsibility</strong><br>
                                        Duration: 1 year<br>
                                        Campus: Pune Erandwane
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Diploma in Environment Education</strong><br>
                                        Duration: 1 year<br>
                                        Campus: Pune Dhankawadi
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>PG Diploma in Balroga</strong><br>
                                        Duration: 2 years<br>
                                        Type: Ayurved program<br>
                                        Campus: Pune Dhankawadi
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>PG Diploma in Gynaecology & Obstetrics</strong><br>
                                        Duration: 2 years<br>
                                        Type: Ayurved course<br>
                                        Campus: Pune Dhankawadi
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions" role="tabpanel" aria-labelledby="admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Undergraduate Courses</strong><br>
                                        Admissions are typically based on merit from qualifying examinations or entrance tests specific to the course.
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Postgraduate Courses</strong><br>
                                        Candidates may need to appear for entrance examinations or interviews, depending on the program.
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Diploma Courses</strong><br>
                                        Admission criteria vary; prospective students should consult the specific program details.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings" role="tabpanel" aria-labelledby="rankings-tab">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="program-card">
                                    <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings and Recognition</h4>
                                    <div class="mb-4">
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 76th
                                            <small>Among universities in India (NIRF 2022)</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 131st
                                            <small>Engineering college (NIRF 2022)</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 17th
                                            <small>College of Pharmacy (NIRF 2021)</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alumni-section">
                                    <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">S</div>
                                        <div class="alumni-info">
                                            <h5>Shaheer Sheikh</h5>
                                            <p>Renowned television actor</p>
                                        </div>
                                    </div>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">P</div>
                                        <div class="alumni-info">
                                            <h5>Pravin Tarde</h5>
                                            <p>Noted filmmaker and actor</p>
                                        </div>
                                    </div>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">S</div>
                                        <div class="alumni-info">
                                            <h5>Saurabh Bharadwaj</h5>
                                            <p>Prominent politician</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 2: MIT-WPU -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>MIT-WPU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">MIT World Peace University (MIT-WPU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 2017 (MIT Group est. 1983)</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>MIT World Peace University (MIT-WPU) is a prominent private institution that evolved from the Maharashtra Institute of Technology (MIT). Recognized by the University Grants Commission (UGC), it offers diverse programs across various disciplines, combining academic excellence with holistic development.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">UGC Recognized</span>
                        <span class="campus-badge">State-of-the-art Campus</span>
                        <span class="campus-badge">100,000+ Alumni Network</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="mitwpu-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mitwpu-undergraduate-tab" data-bs-toggle="tab" data-bs-target="#mitwpu-undergraduate" type="button" role="tab" aria-controls="mitwpu-undergraduate" aria-selected="true">Undergraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mitwpu-postgraduate-tab" data-bs-toggle="tab" data-bs-target="#mitwpu-postgraduate" type="button" role="tab" aria-controls="mitwpu-postgraduate" aria-selected="false">Postgraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mitwpu-research-tab" data-bs-toggle="tab" data-bs-target="#mitwpu-research" type="button" role="tab" aria-controls="mitwpu-research" aria-selected="false">Research</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mitwpu-admissions-tab" data-bs-toggle="tab" data-bs-target="#mitwpu-admissions" type="button" role="tab" aria-controls="mitwpu-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="mitwpu-programTabsContent">
                    <!-- Undergraduate Programs -->
                    <div class="tab-pane fade show active" id="mitwpu-undergraduate" role="tabpanel" aria-labelledby="mitwpu-undergraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Undergraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering and Technology</strong><br>
                                        B.Tech programs in Computer Science, Mechanical, Civil, Electronics, Chemical, Petroleum Engineering, Robotics, Cyber Security, Gaming Technology
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Design Programs</strong><br>
                                        B.Des. in Product Design, UX Design, Visual Communication, Interior Design, Fashion Design
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Arts and Humanities</strong><br>
                                        BFA, BA in English, Psychology, Political Science, Liberal Arts
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Commerce and Management</strong><br>
                                        B.Com, BBA, BBA in Sales and Marketing
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Science and Health Sciences</strong><br>
                                        B.Sc. programs, B.Pharm, B.Sc. Nursing, Pharm.D
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Postgraduate Programs -->
                    <div class="tab-pane fade" id="mitwpu-postgraduate" role="tabpanel" aria-labelledby="mitwpu-postgraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-user-graduate me-2"></i>Postgraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering M.Tech Programs</strong><br>
                                        Specializations in Computer Science (AI), Mechanical, Civil, Chemical, Electrical, Electronics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Design and Arts</strong><br>
                                        M.Des. in Industrial Design, MA in English, Psychology, Creative Communication
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Management</strong><br>
                                        MBA, MBA in Innovation and Design
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Science and Health</strong><br>
                                        M.Sc. programs, Masters of Public Health, Pharm.D (Post Baccalaureate)
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Research Programs -->
                    <div class="tab-pane fade" id="mitwpu-research" role="tabpanel" aria-labelledby="mitwpu-research-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-microscope me-2"></i>Doctoral Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Ph.D. Programs</strong><br>
                                        - Electronics and Communication Engineering<br>
                                        - Computer Engineering<br>
                                        - Mathematics<br>
                                        - Physics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="mitwpu-admissions" role="tabpanel" aria-labelledby="mitwpu-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Entrance Exams</strong><br>
                                        MIT-WPU CET, JEE Main, MHT-CET, CAT, MAT, NMAT, XAT, UCEED, NATA
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>B.Tech Requirements</strong><br>
                                        50% in 10+2 (PCM/PCB), Valid entrance exam scores
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>MBA Requirements</strong><br>
                                        60% in bachelor's degree, Valid entrance scores, GD-PI
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alumni-section">
                            <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                            <div class="d-flex flex-wrap">
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">A</div>
                                    <div class="alumni-info">
                                        <h5>Ashim Patil</h5>
                                        <p>Technology Entrepreneur</p>
                                    </div>
                                </div>
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">S</div>
                                    <div class="alumni-info">
                                        <h5>Dr. Sheetal Vij</h5>
                                        <p>Renowned Academician</p>
                                    </div>
                                </div>
                                <div class="alumni-item">
                                    <div class="alumni-avatar">V</div>
                                    <div class="alumni-info">
                                        <h5>Dr. Vikrant Gaikwad</h5>
                                        <p>Healthcare Professional</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 3: SPPU -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>SIU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Symbiosis International (Deemed University) (SIU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 2002</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Symbiosis International (Deemed University) (SIU) is a prominent private university located in Pune, India. It offers a diverse range of programs across various disciplines, emphasizing quality education and global standards.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">Global Partnerships</span>
                        <span class="campus-badge">State-of-the-art Facilities</span>
                        <span class="campus-badge">Distinguished Alumni Network</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="siu-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="siu-undergraduate-tab" data-bs-toggle="tab" data-bs-target="#siu-undergraduate" type="button" role="tab" aria-controls="siu-undergraduate" aria-selected="true">Undergraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="siu-postgraduate-tab" data-bs-toggle="tab" data-bs-target="#siu-postgraduate" type="button" role="tab" aria-controls="siu-postgraduate" aria-selected="false">Postgraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="siu-research-tab" data-bs-toggle="tab" data-bs-target="#siu-research" type="button" role="tab" aria-controls="siu-research" aria-selected="false">Research</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="siu-admissions-tab" data-bs-toggle="tab" data-bs-target="#siu-admissions" type="button" role="tab" aria-controls="siu-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="siu-programTabsContent">
                    <!-- Undergraduate Programs -->
                    <div class="tab-pane fade show active" id="siu-undergraduate" role="tabpanel" aria-labelledby="siu-undergraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Undergraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering</strong><br>
                                        B.Tech in Computer Science, Information Technology, Electronics & Telecommunication, Mechanical Engineering, Civil Engineering
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Management</strong><br>
                                        BBA with specializations in Marketing, Finance, Human Resource Management, International Business
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Law</strong><br>
                                        BA LLB, BBA LLB
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Design</strong><br>
                                        B.Des in Communication Design, Industrial Design, Fashion Communication
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Liberal Arts</strong><br>
                                        BA in various disciplines
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Postgraduate Programs -->
                    <div class="tab-pane fade" id="siu-postgraduate" role="tabpanel" aria-labelledby="siu-postgraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-user-graduate me-2"></i>Postgraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Management</strong><br>
                                        MBA with specializations in Marketing, Finance, Operations, Human Resources, Innovation and Entrepreneurship
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering</strong><br>
                                        M.Tech in Computer Science, Electronics & Telecommunication, Geoinformatics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Law</strong><br>
                                        LLM with specializations in Business and Corporate Law, Constitutional and Administrative Law, Innovation, Technology and IP Law
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Health Sciences</strong><br>
                                        Master's programs in Hospital and Healthcare Management, Nutrition and Dietetics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Research Programs -->
                    <div class="tab-pane fade" id="siu-research" role="tabpanel" aria-labelledby="siu-research-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-microscope me-2"></i>Doctoral Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Ph.D. Programs</strong><br>
                                        Available in Management, Law, Engineering, Health Sciences, Media and Communication, Humanities and Social Sciences
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="siu-admissions" role="tabpanel" aria-labelledby="siu-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Undergraduate Admissions</strong><br>
                                        SET (Symbiosis Entrance Test) required, followed by PI-WAT for shortlisted candidates
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Postgraduate Admissions</strong><br>
                                        SNAP test required, followed by GE-PIWAT for shortlisted candidates
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Doctoral Admissions</strong><br>
                                        Ph.D. Entrance Test (PET) followed by research proposal presentation and interview
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alumni-section">
                            <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                            <div class="d-flex flex-wrap">
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">N</div>
                                    <div class="alumni-info">
                                        <h5>Neeraj Ghaywan</h5>
                                        <p>Acclaimed Film Director</p>
                                    </div>
                                </div>
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">B</div>
                                    <div class="alumni-info">
                                        <h5>Babu Antony</h5>
                                        <p>Renowned Actor</p>
                                    </div>
                                </div>
                                <div class="alumni-item">
                                    <div class="alumni-avatar">R</div>
                                    <div class="alumni-info">
                                        <h5>Radhika Maira Tabrez</h5>
                                        <p>Award-winning Writer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 4: COEP -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>COEP</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">COEP Technological University</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1854</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>COEP Technological University, formerly known as the College of Engineering, Pune (COEP), is a prestigious public engineering institution located in Pune, Maharashtra, India. Established in 1854, it is one of the oldest engineering colleges in Asia and has a rich history of academic excellence.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">37-acre Urban Campus</span>
                        <span class="campus-badge">Historic Heritage Building</span>
                        <span class="campus-badge">State-of-the-art Facilities</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="coep-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="coep-undergraduate-tab" data-bs-toggle="tab" data-bs-target="#coep-undergraduate" type="button" role="tab" aria-controls="coep-undergraduate" aria-selected="true">Undergraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="coep-postgraduate-tab" data-bs-toggle="tab" data-bs-target="#coep-postgraduate" type="button" role="tab" aria-controls="coep-postgraduate" aria-selected="false">Postgraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="coep-research-tab" data-bs-toggle="tab" data-bs-target="#coep-research" type="button" role="tab" aria-controls="coep-research" aria-selected="false">Research</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="coep-admissions-tab" data-bs-toggle="tab" data-bs-target="#coep-admissions" type="button" role="tab" aria-controls="coep-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="coep-programTabsContent">
                    <!-- Undergraduate Programs -->
                    <div class="tab-pane fade show active" id="coep-undergraduate" role="tabpanel" aria-labelledby="coep-undergraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>B.Tech Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Core Engineering</strong><br>
                                        Civil Engineering, Mechanical Engineering, Electrical Engineering, Metallurgy and Materials Technology
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Computer & Electronics</strong><br>
                                        Computer Science and Engineering, Electronics and Telecommunication Engineering, Instrumentation and Control Engineering
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Specialized Programs</strong><br>
                                        Manufacturing Science and Engineering, Robotics & Artificial Intelligence, Planning
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Postgraduate Programs -->
                    <div class="tab-pane fade" id="coep-postgraduate" role="tabpanel" aria-labelledby="coep-postgraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-user-graduate me-2"></i>M.Tech Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Civil Engineering</strong><br>
                                        Structural Engineering, Geotechnical Engineering, Hydraulics Engineering, Environmental and Water Resources Engineering
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Mechanical & Manufacturing</strong><br>
                                        Mechanical Design Engineering, Thermal Engineering, Manufacturing Engineering and Automation, Mechatronics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Electronics & Computing</strong><br>
                                        Signal Processing, VLSI and Embedded Systems, Computer Engineering, Information Security, Control Systems
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Research Programs -->
                    <div class="tab-pane fade" id="coep-research" role="tabpanel" aria-labelledby="coep-research-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-microscope me-2"></i>Doctoral Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering Disciplines</strong><br>
                                        Civil, Mechanical, Electrical, Electronics and Telecommunication, Computer, Metallurgy and Materials Science, Production Engineering
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Applied Sciences</strong><br>
                                        Environmental Sciences and Chemistry
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="coep-admissions" role="tabpanel" aria-labelledby="coep-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>B.Tech Admissions</strong><br>
                                        Maharashtra State (80%): MHT-CET | All India (20%): JEE Main | Admission through DTE CAP
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>M.Tech Admissions</strong><br>
                                        Valid GATE score required, followed by DTE CAP counseling
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Ph.D. Admissions</strong><br>
                                        University entrance test followed by interview for shortlisted candidates
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alumni-section">
                            <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                            <div class="d-flex flex-wrap">
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">M</div>
                                    <div class="alumni-info">
                                        <h5>Sir M. Visvesvaraya</h5>
                                        <p>Bharat Ratna Awardee</p>
                                    </div>
                                </div>
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">T</div>
                                    <div class="alumni-info">
                                        <h5>Thomas Kailath</h5>
                                        <p>National Medal of Science Recipient</p>
                                    </div>
                                </div>
                                <div class="alumni-item">
                                    <div class="alumni-avatar">S</div>
                                    <div class="alumni-info">
                                        <h5>Sharad Pawar</h5>
                                        <p>Former Union Minister</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 5: DPU -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>DPU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Dr. D. Y. Patil Vidyapeeth (DPU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 2003</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Dr. D. Y. Patil Vidyapeeth (DPU) is a prestigious deemed-to-be university recognized by UGC. It has earned NAAC 'A++' grade accreditation with a CGPA of 3.64 in its third cycle (2022-2029). The university encompasses 15 constituent institutions offering diverse programs across medical, dental, management, engineering and other disciplines.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">NAAC A++ Accredited</span>
                        <span class="campus-badge">15 Constituent Institutions</span>
                        <span class="campus-badge">Category-I Deemed University</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="dpu-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="dpu-programs-tab" data-bs-toggle="tab" data-bs-target="#dpu-programs" type="button" role="tab" aria-controls="dpu-programs" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dpu-rankings-tab" data-bs-toggle="tab" data-bs-target="#dpu-rankings" type="button" role="tab" aria-controls="dpu-rankings" aria-selected="false">Rankings</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dpu-admissions-tab" data-bs-toggle="tab" data-bs-target="#dpu-admissions" type="button" role="tab" aria-controls="dpu-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="dpu-programTabsContent">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="dpu-programs" role="tabpanel" aria-labelledby="dpu-programs-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Key Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Sciences</strong><br>
                                        MBBS, MD, MS, BDS, MDS, BHMS, BAMS, and super-specialty courses
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Technology & Management</strong><br>
                                        B.Tech, M.Tech in Biotechnology & Bioinformatics, BBA, MBA, Ph.D. in Management
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare & Allied Sciences</strong><br>
                                        Physiotherapy, Nursing, Optometry, Allied Health Sciences programs
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="dpu-rankings" role="tabpanel" aria-labelledby="dpu-rankings-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings & Recognition</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-trophy"></i>
                                    <div>
                                        <strong>NIRF Rankings 2024</strong><br>
                                        5th in Dental Category | 11th in Medical Category | 44th in University Category
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                    <div>
                                        <strong>Accreditations</strong><br>
                                        NAAC A++ Grade (CGPA 3.64) | QS I-GAUGE Diamond Rating | ISO 9001:2015 & 14001:2015
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="dpu-admissions" role="tabpanel" aria-labelledby="dpu-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Medical & Dental</strong><br>
                                        NEET-UG for MBBS/BDS, NEET-PG for MD/MS/MDS
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Management & Engineering</strong><br>
                                        CAT/MAT/JEE Main scores or university entrance test + GD-PI
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Other Programs</strong><br>
                                        Merit-based admissions and university entrance tests
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alumni-section">
                            <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni Network</h4>
                            <p class="text-white">DPU boasts a diverse and accomplished alumni network across various fields including medicine, dentistry, biotechnology, and management, making significant contributions both nationally and internationally.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 6: Fergusson College -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>FC</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Fergusson College</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1885</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Fergusson College, established in 1885 by the Deccan Education Society, is a prestigious autonomous institution in Pune affiliated with Savitribai Phule Pune University. The college offers diverse undergraduate and postgraduate programs across arts and sciences on its historic 65-acre campus.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">65-acre Heritage Campus</span>
                        <span class="campus-badge">NAAC 'A' Grade</span>
                        <span class="campus-badge">Autonomous Status</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="fc-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="fc-undergraduate-tab" data-bs-toggle="tab" data-bs-target="#fc-undergraduate" type="button" role="tab" aria-controls="fc-undergraduate" aria-selected="true">Undergraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="fc-postgraduate-tab" data-bs-toggle="tab" data-bs-target="#fc-postgraduate" type="button" role="tab" aria-controls="fc-postgraduate" aria-selected="false">Postgraduate</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="fc-facilities-tab" data-bs-toggle="tab" data-bs-target="#fc-facilities" type="button" role="tab" aria-controls="fc-facilities" aria-selected="false">Facilities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="fc-admissions-tab" data-bs-toggle="tab" data-bs-target="#fc-admissions" type="button" role="tab" aria-controls="fc-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="fc-programTabsContent">
                    <!-- Undergraduate Programs -->
                    <div class="tab-pane fade show active" id="fc-undergraduate" role="tabpanel" aria-labelledby="fc-undergraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Undergraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Bachelor of Arts (B.A.)</strong><br>
                                        Economics, Hindi, Political Science, Sanskrit with minors in Applied Statistics, Geography, Logic, Mathematics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Bachelor of Science (B.Sc.)</strong><br>
                                        Animation, Computer Science, Mathematics, Physics with various subject combinations including CPME, CPMG, CPMS, CPBZ
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Bachelor of Vocation (B.Voc.)</strong><br>
                                        Digital Art and Animation, Interior Design, Media and Communication, Fashion Technology
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Postgraduate Programs -->
                    <div class="tab-pane fade" id="fc-postgraduate" role="tabpanel" aria-labelledby="fc-postgraduate-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-user-graduate me-2"></i>Postgraduate Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Master of Arts (M.A.)</strong><br>
                                        Economics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Master of Science (M.Sc.)</strong><br>
                                        Analytical Chemistry, Computer Applications, Environmental Science, Industrial Mathematics with Computer Applications
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Diploma Courses</strong><br>
                                        Advertising and Communication Design, Fashion Design, Interior Design, Spoken English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="fc-facilities" role="tabpanel" aria-labelledby="fc-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-book"></i>
                                    <div>
                                        <strong>Academic Facilities</strong><br>
                                        Library with 3,00,000+ books, State-of-the-art laboratories, Multiple auditoriums and amphitheater
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-running"></i>
                                    <div>
                                        <strong>Sports & Recreation</strong><br>
                                        Extensive playgrounds, Indoor sports facilities, Gymnasium, Student clubs and societies
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Student Amenities</strong><br>
                                        Separate hostels for boys and girls, Spacious cafeteria, Botanical gardens
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="fc-admissions" role="tabpanel" aria-labelledby="fc-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Undergraduate Admissions</strong><br>
                                        Merit-based on HSC (12th) results, Online application through college website
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Postgraduate Admissions</strong><br>
                                        Entrance examination followed by merit-based selection
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alumni-section">
                            <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                            <div class="d-flex flex-wrap">
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">G</div>
                                    <div class="alumni-info">
                                        <h5>Gopal Krishna Gokhale</h5>
                                        <p>Freedom Fighter & Social Reformer</p>
                                    </div>
                                </div>
                                <div class="alumni-item me-4">
                                    <div class="alumni-avatar">V</div>
                                    <div class="alumni-info">
                                        <h5>Vikram Sarabhai</h5>
                                        <p>Father of Indian Space Program</p>
                                    </div>
                                </div>
                                <div class="alumni-item">
                                    <div class="alumni-avatar">P</div>
                                    <div class="alumni-info">
                                        <h5>P.L. Deshpande</h5>
                                        <p>Renowned Marathi Writer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- University Card 7: AIT -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>AIT</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Army Institute of Technology (AIT)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1994</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>The Army Institute of Technology (AIT) is a premier engineering college operated by the Army Welfare Education Society (AWES), exclusively catering to children of serving and retired Army personnel. Located in the serene Dighi Hills of Pune, AIT is affiliated with Savitribai Phule Pune University and approved by AICTE.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">AICTE Approved</span>
                        <span class="campus-badge">NBA Accredited</span>
                        <span class="campus-badge">NAAC Accredited</span>
                        <span class="campus-badge">96% Placement Rate</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="ait-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ait-programs-tab" data-bs-toggle="tab" data-bs-target="#ait-programs" type="button" role="tab" aria-controls="ait-programs" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ait-facilities-tab" data-bs-toggle="tab" data-bs-target="#ait-facilities" type="button" role="tab" aria-controls="ait-facilities" aria-selected="false">Facilities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ait-placements-tab" data-bs-toggle="tab" data-bs-target="#ait-placements" type="button" role="tab" aria-controls="ait-placements" aria-selected="false">Placements</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ait-admissions-tab" data-bs-toggle="tab" data-bs-target="#ait-admissions" type="button" role="tab" aria-controls="ait-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="ait-programTabsContent">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="ait-programs" role="tabpanel" aria-labelledby="ait-programs-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Academic Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Computer Engineering</strong><br>
                                        B.E. Program | 120 seats
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Electronics and Telecommunication Engineering</strong><br>
                                        B.E. Program | 120 seats
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Information Technology</strong><br>
                                        B.E. Program | 60 seats
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Mechanical Engineering</strong><br>
                                        B.E. Program | 60 seats<br>
                                        M.E. in Mechanical Design | 18 seats
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="ait-facilities" role="tabpanel" aria-labelledby="ait-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-book"></i>
                                    <div>
                                        <strong>Academic Infrastructure</strong><br>
                                        Modern classrooms, well-equipped laboratories, comprehensive library
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Accommodation</strong><br>
                                        On-campus hostels with secure and comfortable living arrangements
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-running"></i>
                                    <div>
                                        <strong>Sports & Recreation</strong><br>
                                        Various sports facilities and recreational activities
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Placements -->
                    <div class="tab-pane fade" id="ait-placements" role="tabpanel" aria-labelledby="ait-placements-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-briefcase me-2"></i>Placement Highlights</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-chart-line"></i>
                                    <div>
                                        <strong>Placement Statistics (2023)</strong><br>
                                        96% Placement Rate<br>
                                        Average Package: ₹14.2 LPA<br>
                                        Highest Package: ₹52 LPA
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-building"></i>
                                    <div>
                                        <strong>Top Recruiters</strong><br>
                                        Dream Plug Technologies, Google, Microsoft, Cisco, Goldman Sachs
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="ait-admissions" role="tabpanel" aria-labelledby="ait-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Eligibility</strong><br>
                                        - Children of serving/retired Army personnel<br>
                                        - 50% aggregate in 10+2 (PCM)<br>
                                        - Valid JEE Main score
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-file-alt"></i>
                                    <div>
                                        <strong>Application Process</strong><br>
                                        Apply through AIT official website with required documents
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 8: PCCOE -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>PCCOE</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Pimpri Chinchwad College of Engineering</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Nigdi, Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1999</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>PCCOE is a premier autonomous engineering institution managed by the Pimpri Chinchwad Education Trust (PCET). Affiliated with Savitribai Phule Pune University and approved by AICTE, the institute is known for its excellence in engineering education.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Accreditations & Rankings:</h5>
                    <div>
                        <span class="campus-badge">NBA Accredited</span>
                        <span class="campus-badge">NAAC 'A' Grade</span>
                        <span class="campus-badge">ISO 9001:2015</span>
                        <span class="campus-badge">Rank 22 - Silicon India</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="pccoe-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pccoe-programs-tab" data-bs-toggle="tab" data-bs-target="#pccoe-programs" type="button" role="tab" aria-controls="pccoe-programs" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pccoe-facilities-tab" data-bs-toggle="tab" data-bs-target="#pccoe-facilities" type="button" role="tab" aria-controls="pccoe-facilities" aria-selected="false">Facilities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pccoe-rankings-tab" data-bs-toggle="tab" data-bs-target="#pccoe-rankings" type="button" role="tab" aria-controls="pccoe-rankings" aria-selected="false">Rankings</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pccoe-admissions-tab" data-bs-toggle="tab" data-bs-target="#pccoe-admissions" type="button" role="tab" aria-controls="pccoe-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="pccoe-programTabsContent">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="pccoe-programs" role="tabpanel" aria-labelledby="pccoe-programs-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Academic Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Undergraduate Programs (B.E.)</strong><br>
                                        - Mechanical Engineering (180 seats)<br>
                                        - Electronics and Telecommunication (180 seats)<br>
                                        - Computer Engineering (240 seats)<br>
                                        - Information Technology (120 seats)<br>
                                        - Civil Engineering (60 seats)<br>
                                        - CS&E (AI & ML) (120 seats)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Postgraduate Programs (M.E.)</strong><br>
                                        - Mechanical Design<br>
                                        - Computational Mechanics<br>
                                        - VLSI and Embedded Systems<br>
                                        - Computer Engineering<br>
                                        - AI & Data Science<br>
                                        - Construction Management
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="pccoe-facilities" role="tabpanel" aria-labelledby="pccoe-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-book"></i>
                                    <div>
                                        <strong>Academic Infrastructure</strong><br>
                                        State-of-the-art classrooms, laboratories, and library
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Accommodation</strong><br>
                                        On-campus hostels with modern amenities
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-running"></i>
                                    <div>
                                        <strong>Sports & Recreation</strong><br>
                                        Comprehensive sports facilities and recreational areas
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="pccoe-rankings" role="tabpanel" aria-labelledby="pccoe-rankings-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings & Recognition</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-trophy"></i>
                                    <div>
                                        <strong>National Rankings</strong><br>
                                        - Rank 22 among Top 100 Engineering Colleges (Silicon India)<br>
                                        - Rank 67 among Private Engineering Colleges (The WEEK)<br>
                                        - Rank 15 in Times Engineering Institute Ranking
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                    <div>
                                        <strong>Accreditations</strong><br>
                                        - NAAC 'A' Grade (3.20 score)<br>
                                        - NBA Accredited Programs<br>
                                        - ISO 9001:2015 Certified
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="pccoe-admissions" role="tabpanel" aria-labelledby="pccoe-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Eligibility</strong><br>
                                        - 10+2 with Physics, Mathematics, and Chemistry<br>
                                        - Valid MHT-CET or JEE Main score
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-file-alt"></i>
                                    <div>
                                        <strong>Application Process</strong><br>
                                        Apply through Maharashtra CET Cell or institute website
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 9: GIPE -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>GIPE</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Gokhale Institute of Politics and Economics</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Deccan Gymkhana, Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1930</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>GIPE is one of India's premier research and training institutes in economics, operating under the Servants of India Society. The institute is renowned for its excellence in economic research and education.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Campus Features:</h5>
                    <div>
                        <span class="campus-badge">5.25 Acres Main Campus</span>
                        <span class="campus-badge">5.39 Acres Residential Campus</span>
                        <span class="campus-badge">Historic Library</span>
                        <span class="campus-badge">UGC Recognized</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="gipe-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="gipe-programs-tab" data-bs-toggle="tab" data-bs-target="#gipe-programs" type="button" role="tab" aria-controls="gipe-programs" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gipe-facilities-tab" data-bs-toggle="tab" data-bs-target="#gipe-facilities" type="button" role="tab" aria-controls="gipe-facilities" aria-selected="false">Facilities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gipe-research-tab" data-bs-toggle="tab" data-bs-target="#gipe-research" type="button" role="tab" aria-controls="gipe-research" aria-selected="false">Research</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gipe-admissions-tab" data-bs-toggle="tab" data-bs-target="#gipe-admissions" type="button" role="tab" aria-controls="gipe-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="gipe-programTabsContent">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="gipe-programs" role="tabpanel" aria-labelledby="gipe-programs-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Academic Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Undergraduate Program</strong><br>
                                        B.Sc. (Economics) - 4 years
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Postgraduate Programs</strong><br>
                                        - M.Sc. (Economics)<br>
                                        - M.Sc. (Financial Economics)<br>
                                        - M.Sc. (Agribusiness Economics)<br>
                                        - M.Sc. (International Business Economics & Finance)<br>
                                        - M.Sc. (Population Studies and Health Economics)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctoral Program</strong><br>
                                        Ph.D. in Economics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="gipe-facilities" role="tabpanel" aria-labelledby="gipe-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-book"></i>
                                    <div>
                                        <strong>Dhananjaya Rao Gadgil Library</strong><br>
                                        Houses rare books dating back to 1680, UN publications repository
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Accommodation</strong><br>
                                        Separate hostels for male and female students
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-university"></i>
                                    <div>
                                        <strong>Academic Infrastructure</strong><br>
                                        Academic block, faculty block, administration block, seminar hall
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Research -->
                    <div class="tab-pane fade" id="gipe-research" role="tabpanel" aria-labelledby="gipe-research-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-microscope me-2"></i>Research Areas</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-chart-line"></i>
                                    <div>
                                        <strong>Major Research Fields</strong><br>
                                        Agricultural economics, population studies, economic history, monetary economics, international economics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-award"></i>
                                    <div>
                                        <strong>Recognition</strong><br>
                                        UGC Centre of Advanced Study in Economics since 1964
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="gipe-admissions" role="tabpanel" aria-labelledby="gipe-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>B.Sc. Economics</strong><br>
                                        - 60% in 12th standard (50% for SC/ST)<br>
                                        - CUET scores required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>M.Sc. Programs</strong><br>
                                        Bachelor's degree with economics background<br>
                                        Entrance examination conducted by GIPE
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Ph.D. Program</strong><br>
                                        Master's degree in economics or related field<br>
                                        Entrance test and interview
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card: VU -->
        <div class="university-card" data-state="maharashtra">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>VU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Vishwakarma University</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Kondhwa, Pune, Maharashtra</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 2017</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Vishwakarma University (VU) is a state-private university operating under the Bansilal Ramnath Agarwal Charitable Trust (BRACT), with over 35 years of legacy in education. Located in Kondhwa, Pune, the university is approximately 10 km from Pune Railway Station and 17 km from Pune Airport.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Key Features:</h5>
                    <div>
                        <span class="campus-badge">UGC Recognized</span>
                        <span class="campus-badge">AIU Member</span>
                        <span class="campus-badge">International Collaborations</span>
                        <span class="campus-badge">Modern Campus</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="vu-programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="vu-programs-tab" data-bs-toggle="tab" data-bs-target="#vu-programs" type="button" role="tab" aria-controls="vu-programs" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vu-facilities-tab" data-bs-toggle="tab" data-bs-target="#vu-facilities" type="button" role="tab" aria-controls="vu-facilities" aria-selected="false">Facilities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vu-achievements-tab" data-bs-toggle="tab" data-bs-target="#vu-achievements" type="button" role="tab" aria-controls="vu-achievements" aria-selected="false">Achievements</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vu-admissions-tab" data-bs-toggle="tab" data-bs-target="#vu-admissions" type="button" role="tab" aria-controls="vu-admissions" aria-selected="false">Admissions</button>
                    </li>
                </ul>

                <div class="tab-content" id="vu-programTabsContent">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="vu-programs" role="tabpanel" aria-labelledby="vu-programs-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Academic Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Architecture & Design</strong><br>
                                        - B.Arch (5 years)<br>
                                        - B.Des (Product/Visual/UI & UX Design)<br>
                                        - BA Animation & Multimedia
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering & Technology</strong><br>
                                        - B.Tech (Multiple specializations)<br>
                                        - M.Tech Programs
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Management & Commerce</strong><br>
                                        - BBA<br>
                                        - B.Com<br>
                                        - MBA
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Other Programs</strong><br>
                                        - B.Pharm/M.Pharm<br>
                                        - BA LLB<br>
                                        - Ph.D. Programs
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="vu-facilities" role="tabpanel" aria-labelledby="vu-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Life</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-users"></i>
                                    <div>
                                        <strong>Student Clubs</strong><br>
                                        Photography, Literary, Adventure, Fine Arts, Cultural, and Sports Clubs
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-globe"></i>
                                    <div>
                                        <strong>International Collaborations</strong><br>
                                        Partnerships with universities in USA, Canada, Germany, and Taiwan
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="tab-pane fade" id="vu-achievements" role="tabpanel" aria-labelledby="vu-achievements-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-trophy me-2"></i>Recognition & Achievements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-award"></i>
                                    <div>
                                        <strong>Accreditations</strong><br>
                                        UGC Recognition, AIU Membership
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-star"></i>
                                    <div>
                                        <strong>Awards</strong><br>
                                        Best Innovations Award at ACMA-LIONS Innovations Expo 2017
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="vu-admissions" role="tabpanel" aria-labelledby="vu-admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Process</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Engineering (B.Tech)</strong><br>
                                        MHT-CET or JEE-Main scores required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Architecture (B.Arch)</strong><br>
                                        NATA or JEE Main Paper 2 scores required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Management (MBA)</strong><br>
                                        MHT-CET/CMAT/CAT/VUNET scores required<br>
                                        First-year fee: INR 2.50 Lakhs
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


        <footer class="footer-section mt-5">
            <?php include '../../components/footer.php'; ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../../js/navbar-scroll.js"></script>
        <script>
            // Filter functionality
            document.addEventListener('DOMContentLoaded', function() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const universityCards = document.querySelectorAll('.university-card');

                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons
                        filterButtons.forEach(btn => btn.classList.remove('active'));

                        // Add active class to clicked button
                        this.classList.add('active');

                        const filter = this.getAttribute('data-filter');

                        universityCards.forEach(card => {
                            if (filter === 'all' || card.getAttribute('data-state') === filter) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });
            });
        </script>
</body>

</html>