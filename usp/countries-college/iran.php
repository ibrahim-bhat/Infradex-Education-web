<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iran - InfradexEducation</title>
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

    <ass="container mt-5 pt-5">
        <!-- Country Header -->
        <div class="university-header text-center">
            <div class="container">
                <h1 class="display-4 fw-bold"><i class="fas fa-landmark me-3"></i>Universities in Iran</h1>
                <p class="lead">Discover top educational institutions across Iran offering quality programs for international students</p>
            </div>
        </div>

        <!-- University Card 1: Tehran University of Medical Sciences (TUMS) -->
        <div class="university-card" data-state="tehran">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>TUMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Tehran University of Medical Sciences (TUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Tehran, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1851</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Tehran University of Medical Sciences (TUMS), established in 1851 as part of Dar ol-Fonoon and later integrated into the University of Tehran in 1934, stands as Iran's largest and most prestigious medical university. In 1986, TUMS became an independent institution, focusing on medical education and research.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Public Health</span>
                        <span class="campus-badge">School of Allied Medical Sciences</span>
                        <span class="campus-badge">School of Rehabilitation</span>
                        <span class="campus-badge">School of Nutritional Sciences</span>
                        <span class="campus-badge">School of Advanced Technologies</span>
                        <span class="campus-badge">School of Persian Medicine</span>
                        <span class="campus-badge">Virtual School</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab" data-bs-toggle="tab" data-bs-target="#programs" type="button" role="tab" aria-controls="programs" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab" data-bs-toggle="tab" data-bs-target="#admissions" type="button" role="tab" aria-controls="admissions" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab" data-bs-toggle="tab" data-bs-target="#rankings" type="button" role="tab" aria-controls="rankings" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContent">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs" role="tabpanel" aria-labelledby="programs-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctor of Medicine (MBBS.)</strong><br>
                                        Duration: 5 years + 1 year internship<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctor of Dental Surgery (D.D.S.)</strong><br>
                                        Duration: 5 years + 1 year internship<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctor of Pharmacy (PharMBBS.)</strong><br>
                                        Duration: 5 years + 1 year internship<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions" role="tabpanel" aria-labelledby="admissions-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Age Requirement</strong><br>
                                        Minimum 17 years by December 31 of admission year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Qualifications</strong><br>
                                        High school completion with Physics, Chemistry, Biology, and English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
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
                                            <i class="fas fa-trophy me-1"></i> 501-600
                                            <small>Times Higher Education World Rankings 2025</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 2nd
                                            <small>In Iran (EduRank)</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 555th
                                            <small>Worldwide (EduRank)</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alumni-section">
                                    <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">M</div>
                                        <div class="alumni-info">
                                            <h5>Dr. Mohammad Gharib</h5>
                                            <p>Pioneer in Iranian pediatrics</p>
                                        </div>
                                    </div>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">B</div>
                                        <div class="alumni-info">
                                            <h5>Dr. Bagher Larijani</h5>
                                            <p>Former Deputy Minister for Medical Education</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- University Card 2: Shiraz University of Medical Sciences (SUMS) -->
        <div class="university-card" data-state="shiraz">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>SUMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Shiraz University of Medical Sciences (SUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Shiraz, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1946</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Shiraz University of Medical Sciences (SUMS), established in 1946, is one of Iran's oldest and most prestigious medical universities. Located in Shiraz, it originated as the Institute of Health for Higher Education and evolved into a comprehensive institution overseeing public hospitals, clinics, and healthcare centers in the Fars province.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing</span>
                        <span class="campus-badge">School of Allied Health Sciences</span>
                        <span class="campus-badge">School of Health</span>
                        <span class="campus-badge">School of Rehabilitation Sciences</span>
                        <span class="campus-badge">School of Advanced Medical Sciences</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsSums" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-sums" data-bs-toggle="tab" data-bs-target="#programs-sums" type="button" role="tab" aria-controls="programs-sums" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-sums" data-bs-toggle="tab" data-bs-target="#admissions-sums" type="button" role="tab" aria-controls="admissions-sums" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-sums" data-bs-toggle="tab" data-bs-target="#rankings-sums" type="button" role="tab" aria-controls="rankings-sums" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentSums">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-sums" role="tabpanel" aria-labelledby="programs-tab-sums">
                        <div class="program-card">
                            <h4 class="program-title">Undergraduate Programs</h4>
                            <ul class="program-list">
                                <li>Medicine (5 years + 1 year internship)</li>
                                <li>Dentistry</li>
                                <li>Pharmacy</li>
                                <li>Nursing</li>
                                <li>Allied Health Sciences</li>
                            </ul>
                            
                            <h4 class="program-title mt-4">Postgraduate Programs</h4>
                            <p>Various specialties across medical and health sciences including:</p>
                            <ul class="program-list">
                                <li>Clinical Specializations</li>
                                <li>Research-based Programs</li>
                                <li>Advanced Medical Studies</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-sums" role="tabpanel" aria-labelledby="admissions-tab-sums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-file-alt me-2"></i>Admission Requirements</h4>
                            <ul class="requirements-list">
                                <li>Highly competitive admission process (10% acceptance rate)</li>
                                <li>Strong academic records</li>
                                <li>International students welcome</li>
                            </ul>
                            
                            <div class="mt-4">
                                <h5 class="text-white">Required Documents:</h5>
                                <ul class="requirements-list">
                                    <li>Academic transcripts</li>
                                    <li>Language proficiency proof</li>
                                    <li>Letters of recommendation</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings-sums" role="tabpanel" aria-labelledby="rankings-tab-sums">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="program-card">
                                    <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings and Recognition</h4>
                                    <div class="mb-4">
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 351-400
                                            <small>QS Rankings (Pharmacy & Pharmacology)</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 501-550
                                            <small>QS Rankings (Medicine)</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 564th
                                            <small>CWTS Leiden Ranking 2024</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 246th
                                            <small>Biomedical & Health Sciences</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 822nd
                                            <small>U.S. News Best Global Universities</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 2: Iran University of Medical Sciences (IUMS) -->
        <div class="university-card" data-state="tehran">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>IUMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Iran University of Medical Sciences (IUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Tehran, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1974</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Iran University of Medical Sciences (IUMS), established in 1974, is a prominent public medical university located in Tehran, Iran, near the iconic Milad Tower. Since 1986, it has operated under the administration of the Ministry of Health and Medical Education, positioning itself as a leading academic health institution in both the country and the region.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Notable Alumni:</h5>
                    <div>
                        <span class="campus-badge">Minoo Lenarz - German Medical Professor</span>
                        <span class="campus-badge">Masoud Pezeshkian - Iranian Politician</span>
                        <span class="campus-badge">Mohammad Esfahani - Iranian Singer</span>
                        <span class="campus-badge">Masoumeh Abad - Iranian Author</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsIUMS" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-iums" data-bs-toggle="tab" data-bs-target="#programs-iums" type="button" role="tab" aria-controls="programs-iums" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-iums" data-bs-toggle="tab" data-bs-target="#admissions-iums" type="button" role="tab" aria-controls="admissions-iums" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-iums" data-bs-toggle="tab" data-bs-target="#rankings-iums" type="button" role="tab" aria-controls="rankings-iums" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentIUMS">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-iums" role="tabpanel" aria-labelledby="programs-tab-iums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medicine (MBBS.)</strong><br>
                                        Duration: 5 years + 1 year internship
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Dentistry (D.D.S.)</strong><br>
                                        Duration: 5 years + 1 year internship
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Pharmacy (PharMBBS.)</strong><br>
                                        Duration: 5 years + 1 year internship
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-iums" role="tabpanel" aria-labelledby="admissions-tab-iums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Requirements</strong><br>
                                        High school diploma with focus on sciences
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Proficiency</strong><br>
                                        English or Persian language proficiency certification
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings-iums" role="tabpanel" aria-labelledby="rankings-tab-iums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings and Recognition</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-trophy me-1"></i> 743rd
                                    <small>U.S. News Best Global Universities</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-trophy me-1"></i> 41st
                                    <small>Times Impact Ranking (Global)</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-trophy me-1"></i> 1st
                                    <small>Times Impact Ranking (National)</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card: Shahid Beheshti University (SBU) -->
        <div class="university-card" data-state="tehran">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>SBU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Shahid Beheshti University (SBU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Tehran, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1959</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Shahid Beheshti University (SBU), established in 1959, is a prominent public university located in Tehran, Iran. Renowned for its comprehensive academic programs and research initiatives, SBU has earned a significant position in both national and international academic communities.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Faculties:</h5>
                    <div>
                        <span class="campus-badge">Engineering</span>
                        <span class="campus-badge">Sciences</span>
                        <span class="campus-badge">Humanities and Social Sciences</span>
                        <span class="campus-badge">Business and Management</span>
                        <span class="campus-badge">Law</span>
                        <span class="campus-badge">Psychology</span>
                        <span class="campus-badge">Economics</span>
                        <span class="campus-badge">Political Science</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsSbu" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-sbu" data-bs-toggle="tab" data-bs-target="#programs-sbu" type="button" role="tab" aria-controls="programs-sbu" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-sbu" data-bs-toggle="tab" data-bs-target="#admissions-sbu" type="button" role="tab" aria-controls="admissions-sbu" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-sbu" data-bs-toggle="tab" data-bs-target="#rankings-sbu" type="button" role="tab" aria-controls="rankings-sbu" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentSbu">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-sbu" role="tabpanel" aria-labelledby="programs-tab-sbu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Engineering Programs</strong><br>
                                        Civil, Mechanical, Electrical, Computer, Chemical Engineering
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Science Programs</strong><br>
                                        Physics, Chemistry, Biology, Mathematics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Business & Management</strong><br>
                                        Business Administration and Management courses
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-sbu" role="tabpanel" aria-labelledby="admissions-tab-sbu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Information</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Acceptance Rate</strong><br>
                                        Approximately 25% acceptance rate
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Student Body</strong><br>
                                        Approximately 11,500 students
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Requirements</strong><br>
                                        Academic performance evaluation
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings-sbu" role="tabpanel" aria-labelledby="rankings-tab-sbu">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="program-card">
                                    <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings and Recognition</h4>
                                    <div class="mb-4">
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 851-900
                                            <small>QS World University Rankings 2025</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 1039th
                                            <small>U.S. News Best Global Universities</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 906th
                                            <small>EduRank Global Ranking</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alumni-section">
                                    <h4 class="program-title"><i class="fas fa-users me-2"></i>Notable Alumni</h4>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">M</div>
                                        <div class="alumni-info">
                                            <h5>Mir-Hossein Mousavi</h5>
                                            <p>Former Prime Minister of Iran</p>
                                        </div>
                                    </div>
                                    <div class="alumni-item">
                                        <div class="alumni-avatar">H</div>
                                        <div class="alumni-info">
                                            <h5>Hossein Amirabdollahian</h5>
                                            <p>Iran's Minister of Foreign Affairs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- University Card: Urmia University of Medical Sciences (UMSU) -->
        <div class="university-card" data-state="urmia">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>UMSU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Urmia University of Medical Sciences (UMSU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Urmia, West Azerbaijan, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1986</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Urmia University of Medical Sciences (UMSU) is a reputable public institution dedicated to advancing medical education, research, and healthcare services in the West Azerbaijan region. With a student body of 4,000-4,999 and 300-399 academic staff members, UMSU maintains high standards in medical education and research.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Health and Paramedical Sciences</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsUMSU" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-umsu" data-bs-toggle="tab" data-bs-target="#programs-umsu" type="button" role="tab" aria-controls="programs-umsu" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-umsu" data-bs-toggle="tab" data-bs-target="#admissions-umsu" type="button" role="tab" aria-controls="admissions-umsu" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-umsu" data-bs-toggle="tab" data-bs-target="#rankings-umsu" type="button" role="tab" aria-controls="rankings-umsu" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentUMSU">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-umsu" role="tabpanel" aria-labelledby="programs-tab-umsu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctor of Medicine (MBBS.)</strong><br>
                                        General Medicine and Specialized Fields<br>
                                        Duration: 5 years + 1 year internship<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctor of Dental Surgery (D.D.S.)</strong><br>
                                        Oral Health and Dental Surgery<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Doctor of Pharmacy (PharMBBS.)</strong><br>
                                        Pharmaceutical Sciences and Clinical Pharmacy<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-umsu" role="tabpanel" aria-labelledby="admissions-tab-umsu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Requirements</strong><br>
                                        Strong academic background in sciences
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Proficiency</strong><br>
                                        English or Persian language proficiency
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings-umsu" role="tabpanel" aria-labelledby="rankings-tab-umsu">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="program-card">
                                    <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings and Recognition</h4>
                                    <div class="mb-4">
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 1551st
                                            <small>U.S. News Best Global Universities</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 78th
                                            <small>In Iran (EduRank)</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-trophy me-1"></i> 5215th
                                            <small>Worldwide (EduRank)</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card 4: Golestan University of Medical Sciences (GoUMS) -->
        <div class="university-card" data-state="gorgan">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>GoUMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Golestan University of Medical Sciences (GoUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Gorgan, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1967</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Golestan University of Medical Sciences (GoUMS), established in 1967, is a prominent public institution located in Gorgan, Iran. Initially focused on nursing education, the university expanded its academic offerings with the establishment of the Gorgan School of Medicine in 1992. The university now oversees 13 healthcare centers and operates 25 hospitals across Golestan province.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">Faculty of Medicine</span>
                        <span class="campus-badge">Faculty of Dentistry</span>
                        <span class="campus-badge">Faculty of Health Care</span>
                        <span class="campus-badge">Faculty of Nursing and Midwifery</span>
                        <span class="campus-badge">Faculty of Paramedicine</span>
                        <span class="campus-badge">Faculty of Medical Modern Technologies</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsGoums" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-goums" data-bs-toggle="tab" data-bs-target="#programs-goums" type="button" role="tab" aria-controls="programs-goums" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-goums" data-bs-toggle="tab" data-bs-target="#admissions-goums" type="button" role="tab" aria-controls="admissions-goums" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-goums" data-bs-toggle="tab" data-bs-target="#rankings-goums" type="button" role="tab" aria-controls="rankings-goums" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentGoums">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-goums" role="tabpanel" aria-labelledby="programs-tab-goums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medicine (MBBS.)</strong><br>
                                        Duration: 5 years + 1 year internship<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Dentistry (D.D.S.)</strong><br>
                                        Duration: 5 years + 1 year internship<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Nursing (B.Sc.)</strong><br>
                                        Duration: 4 years<br>
                                        Medium of Instruction: English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-goums" role="tabpanel" aria-labelledby="admissions-tab-goums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Acceptance Rate</strong><br>
                                        Approximately 36% (Moderately Competitive)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in English or Persian
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Requirements</strong><br>
                                        Strong background in sciences and mathematics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings-goums" role="tabpanel" aria-labelledby="rankings-tab-goums">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="program-card">
                                    <h4 class="program-title"><i class="fas fa-award me-2"></i>Research Centers</h4>
                                    <div class="mb-4">
                                        <span class="ranking-badge">
                                            <i class="fas fa-microscope me-1"></i>
                                            <small>Cancer Research Center</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-dna me-1"></i>
                                            <small>Cellular and Molecular Biology Research Center</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-heartbeat me-1"></i>
                                            <small>Infertility and Reproductive Health Research Center</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-user-nurse me-1"></i>
                                            <small>Nursing Care Research Center</small>
                                        </span>
                                        <span class="ranking-badge">
                                            <i class="fas fa-tooth me-1"></i>
                                            <small>Oral Health Research Center</small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="d-flex flex-wrap align-items-center">
        <!-- University Card: Arak University of Medical Sciences (AUMS) -->
        <div class="university-card" data-state="arak">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>AUMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Arak University of Medical Sciences (AUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Arak, Markazi Province, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1986</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Arak University of Medical Sciences (AUMS) is a public medical institution operating under Iran's Ministry of Health and Medical Education. The university focuses on medical research, healthcare professional training, and providing comprehensive health services throughout the Markazi Province.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Health</span>
                        <span class="campus-badge">School of Paramedical Sciences</span>
                        <span class="campus-badge">School of Dentistry</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsAums" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-aums" data-bs-toggle="tab" data-bs-target="#programs-aums" type="button" role="tab" aria-controls="programs-aums" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-aums" data-bs-toggle="tab" data-bs-target="#admissions-aums" type="button" role="tab" aria-controls="admissions-aums" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-aums" data-bs-toggle="tab" data-bs-target="#rankings-aums" type="button" role="tab" aria-controls="rankings-aums" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentAums">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-aums" role="tabpanel" aria-labelledby="programs-tab-aums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Programs</strong><br>
                                        Medicine (MBBS - 5 years + 1 year internship), Dentistry, Pharmacy
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare Programs</strong><br>
                                        Nursing, Midwifery, Public Health
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Paramedical Programs</strong><br>
                                        Laboratory Sciences, Radiology, Operating Room
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-aums" role="tabpanel" aria-labelledby="admissions-tab-aums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Background</strong><br>
                                        Strong foundation in sciences and mathematics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="rankings-aums" role="tabpanel" aria-labelledby="rankings-tab-aums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-book me-1"></i>
                                    <small>Modern Library</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-home me-1"></i>
                                    <small>Student Housing</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-running me-1"></i>
                                    <small>Sports Facilities</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-laptop me-1"></i>
                                    <small>Distance Learning Platform</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-plane me-1"></i>
                                    <small>Study Abroad Programs</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card: Islamic Azad University, Tehran Medical Sciences Branch (IAUTMS) -->
        <div class="university-card" data-state="tehran">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>IAUTMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Islamic Azad University, Tehran Medical Sciences Branch (IAUTMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Tehran, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1985</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Islamic Azad University, Tehran Medical Sciences Branch (IAUTMS), established in 1985, is a prominent private medical university in Tehran. Operating under the Islamic Azad University system, it has grown into a leading institution for medical education with a campus spanning over 116,000 square meters and approximately 2,500 full-time faculty members.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">Faculty of Medicine</span>
                        <span class="campus-badge">Faculty of Dentistry</span>
                        <span class="campus-badge">Faculty of Pharmacy</span>
                        <span class="campus-badge">Faculty of Nursing and Midwifery</span>
                        <span class="campus-badge">Faculty of Health and Medical Engineering</span>
                        <span class="campus-badge">Faculty of Advanced Sciences and Technology</span>
                        <span class="campus-badge">Faculty of Paramedical Sciences</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsIautms" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-iautms" data-bs-toggle="tab" data-bs-target="#programs-iautms" type="button" role="tab" aria-controls="programs-iautms" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-iautms" data-bs-toggle="tab" data-bs-target="#admissions-iautms" type="button" role="tab" aria-controls="admissions-iautms" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="facilities-tab-iautms" data-bs-toggle="tab" data-bs-target="#facilities-iautms" type="button" role="tab" aria-controls="facilities-iautms" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentIautms">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-iautms" role="tabpanel" aria-labelledby="programs-tab-iautms">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Programs</strong><br>
                                        Medicine (MBBS - 5 years + 1 year internship), Dentistry, Pharmacy
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare Programs</strong><br>
                                        Nursing, Midwifery, Paramedical Sciences
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Advanced Studies</strong><br>
                                        Medical Engineering, Advanced Sciences and Technology
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-iautms" role="tabpanel" aria-labelledby="admissions-tab-iautms">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Background</strong><br>
                                        Strong foundation in sciences and mathematics
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="facilities-iautms" role="tabpanel" aria-labelledby="facilities-tab-iautms">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-book me-1"></i>
                                    <small>Extensive Medical Libraries</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-flask me-1"></i>
                                    <small>Research Laboratories</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-running me-1"></i>
                                    <small>Sports Facilities</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-hospital me-1"></i>
                                    <small>Teaching Hospitals</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-tree me-1"></i>
                                    <small>Green Spaces</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <div>
                        <h2 class="fw-bold mb-2">Zanjan University of Medical Sciences (ZUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Zanjan, Iran</p>
                        <p class="mb-1"><i class="fas fa-calendar-alt me-2"></i>Established: 1987</p>
                        <p class="mb-0"><i class="fas fa-language me-2"></i>Medium of Instruction: English</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Zanjan University of Medical Sciences (ZUMS) is a public medical institution dedicated to advancing healthcare education and research. The university integrates practical experience with academic learning through its various healthcare facilities and research centers. The MBBS program is a 5-year course followed by 1 year of mandatory internship.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Health</span>
                        <span class="campus-badge">School of Paramedical Sciences</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsZums" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-zums" data-bs-toggle="tab" data-bs-target="#programs-zums" type="button" role="tab" aria-controls="programs-zums" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-zums" data-bs-toggle="tab" data-bs-target="#admissions-zums" type="button" role="tab" aria-controls="admissions-zums" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="facilities-tab-zums" data-bs-toggle="tab" data-bs-target="#facilities-zums" type="button" role="tab" aria-controls="facilities-zums" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentZums">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-zums" role="tabpanel" aria-labelledby="programs-tab-zums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Programs</strong><br>
                                        Medicine, Dentistry, Pharmacy
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare Programs</strong><br>
                                        Nursing, Midwifery, Public Health
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Paramedical Sciences</strong><br>
                                        Laboratory Sciences, Radiology, Operating Room
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-zums" role="tabpanel" aria-labelledby="admissions-tab-zums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Background</strong><br>
                                        Strong foundation in sciences
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="facilities-zums" role="tabpanel" aria-labelledby="facilities-tab-zums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Research and Facilities</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-microscope me-1"></i>
                                    <small>Research Centers</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-hospital me-1"></i>
                                    <small>Teaching Hospitals</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-book me-1"></i>
                                    <small>Medical Library</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-flask me-1"></i>
                                    <small>Modern Laboratories</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-laptop me-1"></i>
                                    <small>Digital Resources</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card: Kerman University of Medical Sciences (KMU) -->
        <div class="university-card" data-state="kerman">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>KMU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Kerman University of Medical Sciences (KMU)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Kerman, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1978</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Kerman University of Medical Sciences (KMU) is the largest medical sciences university in southeastern Iran. Since its establishment in 1978, KMU has been dedicated to advancing medical education, research, and healthcare services, offering over 125 undergraduate and postgraduate programs.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Public Health</span>
                        <span class="campus-badge">School of Paramedics</span>
                        <span class="campus-badge">School of Iranian Traditional Medicine</span>
                        <span class="campus-badge">School of Health Care Management</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsKmu" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-kmu" data-bs-toggle="tab" data-bs-target="#programs-kmu" type="button" role="tab" aria-controls="programs-kmu" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-kmu" data-bs-toggle="tab" data-bs-target="#admissions-kmu" type="button" role="tab" aria-controls="admissions-kmu" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="facilities-tab-kmu" data-bs-toggle="tab" data-bs-target="#facilities-kmu" type="button" role="tab" aria-controls="facilities-kmu" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentKmu">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-kmu" role="tabpanel" aria-labelledby="programs-tab-kmu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Programs</strong><br>
                                        Medicine, Dentistry, Pharmacy
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare Programs</strong><br>
                                        Nursing, Midwifery, Public Health
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Specialized Programs</strong><br>
                                        Traditional Medicine, Healthcare Management
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-kmu" role="tabpanel" aria-labelledby="admissions-tab-kmu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Background</strong><br>
                                        Strong foundation in sciences
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="facilities-kmu" role="tabpanel" aria-labelledby="facilities-tab-kmu">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-hospital me-1"></i>
                                    <small>Healthcare Services</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-microscope me-1"></i>
                                    <small>Research Centers</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-book me-1"></i>
                                    <small>Medical Libraries</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-users me-1"></i>
                                    <small>Student Organizations</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-trophy me-1"></i> 1252nd
                                    <small>U.S. News Best Global Universities</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card: Hamadan University of Medical Sciences (UMSHA) -->
        <div class="university-card" data-state="hamadan">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>UMSHA</span>

        <!-- University Card: Hamadan University of Medical Sciences (UMSHA) -->
        <div class="university-card" data-state="hamadan">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>UMSHA</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Hamadan University of Medical Sciences (UMSHA)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Hamadan, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1986</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Hamadan University of Medical Sciences (UMSHA) is a prominent public medical university dedicated to advancing medical education, research, and healthcare services in the Hamadan region. With over 70 undergraduate and postgraduate programs, UMSHA maintains high standards in medical education and contributes significantly to medical research through its various specialized centers.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Public Health</span>
                        <span class="campus-badge">School of Paramedical Sciences</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsUmsha" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-umsha" data-bs-toggle="tab" data-bs-target="#programs-umsha" type="button" role="tab" aria-controls="programs-umsha" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-umsha" data-bs-toggle="tab" data-bs-target="#admissions-umsha" type="button" role="tab" aria-controls="admissions-umsha" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-umsha" data-bs-toggle="tab" data-bs-target="#rankings-umsha" type="button" role="tab" aria-controls="rankings-umsha" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentUmsha">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-umsha" role="tabpanel" aria-labelledby="programs-tab-umsha">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Programs</strong><br>
                                        Medicine (MBBS - 5 years + 1 year internship), Dentistry, Pharmacy
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare Programs</strong><br>
                                        Nursing, Midwifery, Public Health
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Paramedical Programs</strong><br>
                                        Laboratory Sciences, Radiology, Physiotherapy
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-umsha" role="tabpanel" aria-labelledby="admissions-tab-umsha">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Background</strong><br>
                                        Strong foundation in sciences and mathematics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="rankings-umsha" role="tabpanel" aria-labelledby="rankings-tab-umsha">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Campus Facilities</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-hospital me-1"></i>
                                    <small>Healthcare Services</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-microscope me-1"></i>
                                    <small>Research Centers</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-book me-1"></i>
                                    <small>Medical Libraries</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-users me-1"></i>
                                    <small>Student Organizations</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-trophy me-1"></i> 1631st
                                    <small>U.S. News Best Global Universities</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- University Card: Isfahan University of Medical Sciences (IUMS) -->
        <div class="university-card" data-state="isfahan">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>IUMS</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Isfahan University of Medical Sciences (IUMS)</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Isfahan, Iran</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1946</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Isfahan University of Medical Sciences (IUMS) is a leading public medical institution in Iran, dedicated to advancing medical education, research, and healthcare services. With over 32,000 published scientific papers and 448,000 citations, IUMS demonstrates strong research capabilities and academic excellence.</p>

                <div class="mb-4">
                    <h5 class="text-white mb-2">Schools:</h5>
                    <div>
                        <span class="campus-badge">School of Medicine</span>
                        <span class="campus-badge">School of Dentistry</span>
                        <span class="campus-badge">School of Pharmacy</span>
                        <span class="campus-badge">School of Nursing and Midwifery</span>
                        <span class="campus-badge">School of Public Health</span>
                        <span class="campus-badge">School of Rehabilitation Sciences</span>
                        <span class="campus-badge">School of Advanced Technologies</span>
                        <span class="campus-badge">School of Allied Medical Sciences</span>
                        <span class="campus-badge">School of Management & Medical Information</span>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="programTabsIums" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="programs-tab-iums" data-bs-toggle="tab" data-bs-target="#programs-iums" type="button" role="tab" aria-controls="programs-iums" aria-selected="true">Programs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="admissions-tab-iums" data-bs-toggle="tab" data-bs-target="#admissions-iums" type="button" role="tab" aria-controls="admissions-iums" aria-selected="false">Admissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rankings-tab-iums" data-bs-toggle="tab" data-bs-target="#rankings-iums" type="button" role="tab" aria-controls="rankings-iums" aria-selected="false">Rankings</button>
                    </li>
                </ul>

                <div class="tab-content" id="programTabsContentIums">
                    <!-- Programs -->
                    <div class="tab-pane fade show active" id="programs-iums" role="tabpanel" aria-labelledby="programs-tab-iums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>Major Programs</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Medical Programs</strong><br>
                                        Medicine (MBBS - 5 years + 1 year internship), Dentistry, Pharmacy, and Specialized Medical Fields
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Healthcare Programs</strong><br>
                                        Nursing, Midwifery, Public Health, Rehabilitation Sciences
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-certificate"></i>
                                    <div>
                                        <strong>Advanced Studies</strong><br>
                                        Medical Technologies, Healthcare Management, Medical Informatics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admissions -->
                    <div class="tab-pane fade" id="admissions-iums" role="tabpanel" aria-labelledby="admissions-tab-iums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        Proficiency in Persian or English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Academic Background</strong><br>
                                        Strong foundation in sciences and mathematics
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rankings -->
                    <div class="tab-pane fade" id="rankings-iums" role="tabpanel" aria-labelledby="rankings-tab-iums">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-award me-2"></i>Rankings and Facilities</h4>
                            <div class="mb-4">
                                <span class="ranking-badge">
                                    <i class="fas fa-trophy me-1"></i> 1114th
                                    <small>U.S. News Best Global Universities</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-book me-1"></i> 32,000+
                                    <small>Published Research Papers</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-quote-right me-1"></i> 448,000+
                                    <small>Research Citations</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-hospital me-1"></i>
                                    <small>Modern Healthcare Facilities</small>
                                </span>
                                <span class="ranking-badge">
                                    <i class="fas fa-microscope me-1"></i>
                                    <small>Advanced Research Centers</small>
                                </span>
                            </div>
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

</body>

</html>
