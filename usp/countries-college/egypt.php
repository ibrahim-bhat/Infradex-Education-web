<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egypt - InfradexEducation</title>
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
                <h1 class="display-4 fw-bold"><i class="fas fa-landmark me-3"></i>Universities in Egypt</h1>
                <p class="lead">Discover top educational institutions across Egypt offering quality programs for international students</p>
            </div>
        </div>

        <!-- Overview Section -->
        <div class="overview-section mb-5">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h3 class="mb-4"><i class="fas fa-info-circle me-2"></i>Overview</h3>
                    <p>Egypt is home to some of the oldest and most prestigious medical universities in the world, attracting both domestic and international students due to its affordable tuition fees, well-established institutions, and globally recognized degrees. Egyptian medical schools are known for their rigorous academic programs, extensive clinical training, and strong research output.</p>

                    <h4 class="mt-4 mb-3"><i class="fas fa-graduation-cap me-2"></i>Studying MBBS in Egypt: A Popular Choice</h4>
                    <p>Egypt has become a sought-after destination for international students pursuing an MBBS degree. The country offers quality medical education at an affordable cost, with globally recognized universities and excellent career opportunities.</p>

                    <div class="key-features mt-4">
                        <h5 class="mb-3">Program Highlights:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-clock me-2"></i>
                                    <span>Duration: 6 years (English medium)</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-dollar-sign me-2"></i>
                                    <span>Tuition: $5,000 - $8,000 per year</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-user-graduate me-2"></i>
                                    <span>Eligibility: 10+2 completed</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-globe me-2"></i>
                                    <span>Global Recognition: WHO & NMC Approved</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Universities Table -->
        <div class="universities-table mb-5">
            <h3 class="mb-4"><i class="fas fa-university me-2"></i>Top Medical Universities in Egypt</h3>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>University</th>
                            <th>Established</th>
                            <th>World Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Cairo University Faculty of Medicine</td>
                            <td>1908</td>
                            <td>727</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ain Shams University Faculty of Medicine</td>
                            <td>1947</td>
                            <td>1480</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Alexandria University Faculty of Medicine</td>
                            <td>1942</td>
                            <td>1938</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Mansoura University Faculty of Medicine</td>
                            <td>1974</td>
                            <td>1863</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Tanta University Faculty of Medicine</td>
                            <td>1962</td>
                            <td>2707</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Why Choose Section -->
        <div class="why-choose-section mb-5">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h3 class="mb-4"><i class="fas fa-check-circle me-2"></i>Why Choose Egypt for MBBS?</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Strong diplomatic ties with India</li>
                                <li><i class="fas fa-check me-2"></i>Internationally accredited universities</li>
                                <li><i class="fas fa-check me-2"></i>Affordable education costs</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Global recognition of degrees</li>
                                <li><i class="fas fa-check me-2"></i>Rich cultural experience</li>
                                <li><i class="fas fa-check me-2"></i>English medium instruction</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- University Card -->
        <div class="university-card" data-state="cairo">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>CU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Cairo University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Cairo, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1827</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Cairo University's Faculty of Medicine, known as Kasr Al-Ainy School of Medicine, is one of the oldest and most prestigious medical schools in Africa and the Middle East. The institution is ranked 1st in Egypt and 546th globally.</p>

                <ul class="nav nav-tabs" id="cairoTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="cairo-courses-tab" data-bs-toggle="tab" data-bs-target="#cairo-courses" type="button" role="tab" aria-controls="cairo-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cairo-admission-tab" data-bs-toggle="tab" data-bs-target="#cairo-admission" type="button" role="tab" aria-controls="cairo-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cairo-fees-tab" data-bs-toggle="tab" data-bs-target="#cairo-fees" type="button" role="tab" aria-controls="cairo-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cairo-facilities-tab" data-bs-toggle="tab" data-bs-target="#cairo-facilities" type="button" role="tab" aria-controls="cairo-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="cairoTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="cairo-courses" role="tabpanel" aria-labelledby="cairo-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="cairo-admission" role="tabpanel" aria-labelledby="cairo-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Higher secondary education with minimum 75% in Physics, Chemistry, and Biology
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma</li>
                                <li><i class="fas fa-file-alt me-2"></i>Academic transcripts</li>
                                <li><i class="fas fa-file-alt me-2"></i>English proficiency proof</li>
                                <li><i class="fas fa-passport me-2"></i>Passport copy</li>
                                <li><i class="fas fa-image me-2"></i>Passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="cairo-fees" role="tabpanel" aria-labelledby="cairo-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        Approximately $7,500 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $1,000 - $2,000 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="cairo-facilities" role="tabpanel" aria-labelledby="cairo-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="university-card" data-state="cairo">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>ASU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Ain Shams University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Cairo, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1947</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Founded in 1947, Ain Shams University Faculty of Medicine is one of Egypt's leading medical schools, offering a wide range of undergraduate and postgraduate programs in medicine and allied health sciences. The university is consistently ranked among the top universities in Egypt and the Arab region, with a history of producing graduates who have excelled in various medical fields.</p>

                <ul class="nav nav-tabs" id="ainShamsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ainShams-courses-tab" data-bs-toggle="tab" data-bs-target="#ainShams-courses" type="button" role="tab" aria-controls="ainShams-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ainShams-admission-tab" data-bs-toggle="tab" data-bs-target="#ainShams-admission" type="button" role="tab" aria-controls="ainShams-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ainShams-fees-tab" data-bs-toggle="tab" data-bs-target="#ainShams-fees" type="button" role="tab" aria-controls="ainShams-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ainShams-facilities-tab" data-bs-toggle="tab" data-bs-target="#ainShams-facilities" type="button" role="tab" aria-controls="ainShams-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="ainShamsTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="ainShams-courses" role="tabpanel" aria-labelledby="ainShams-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="ainShams-admission" role="tabpanel" aria-labelledby="ainShams-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Completion of higher secondary education with focus on science subjects
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-file-alt me-2"></i>Proof of English language proficiency</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="ainShams-fees" role="tabpanel" aria-labelledby="ainShams-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        Approximately $7,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $1,000 - $2,000 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="ainShams-facilities" role="tabpanel" aria-labelledby="ainShams-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university offers hostel accommodations equipped with necessary amenities to ensure a conducive living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="university-card" data-state="alexandria">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>AU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Alexandria University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Alexandria, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1942</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Established in 1942, Alexandria University Faculty of Medicine serves as a major center for medical education in the northern region of Egypt. The university is recognized among the top universities in Egypt and holds a reputable position globally.</p>

                <ul class="nav nav-tabs" id="alexandriaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="alexandria-courses-tab" data-bs-toggle="tab" data-bs-target="#alexandria-courses" type="button" role="tab" aria-controls="alexandria-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="alexandria-admission-tab" data-bs-toggle="tab" data-bs-target="#alexandria-admission" type="button" role="tab" aria-controls="alexandria-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="alexandria-fees-tab" data-bs-toggle="tab" data-bs-target="#alexandria-fees" type="button" role="tab" aria-controls="alexandria-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="alexandria-facilities-tab" data-bs-toggle="tab" data-bs-target="#alexandria-facilities" type="button" role="tab" aria-controls="alexandria-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="alexandriaTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="alexandria-courses" role="tabpanel" aria-labelledby="alexandria-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="alexandria-admission" role="tabpanel" aria-labelledby="alexandria-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Completion of higher secondary education with a strong foundation in science subjects
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-file-alt me-2"></i>Proof of English language proficiency</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="alexandria-fees" role="tabpanel" aria-labelledby="alexandria-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        Approximately $8,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $1,000 - $2,000 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="alexandria-facilities" role="tabpanel" aria-labelledby="alexandria-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university provides hostel facilities with essential amenities to ensure a comfortable living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="university-card" data-state="mansoura">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>MU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Mansoura University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Mansoura, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1972</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Mansoura University is renowned for its Faculty of Medicine, which has become a leading medical institution in Egypt. The university has significantly contributed to cultural, scientific, and educational development in the region and has produced numerous distinguished alumni who have made significant contributions to medicine and healthcare.</p>

                <ul class="nav nav-tabs" id="mansouraTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mansoura-courses-tab" data-bs-toggle="tab" data-bs-target="#mansoura-courses" type="button" role="tab" aria-controls="mansoura-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mansoura-admission-tab" data-bs-toggle="tab" data-bs-target="#mansoura-admission" type="button" role="tab" aria-controls="mansoura-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mansoura-fees-tab" data-bs-toggle="tab" data-bs-target="#mansoura-fees" type="button" role="tab" aria-controls="mansoura-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mansoura-facilities-tab" data-bs-toggle="tab" data-bs-target="#mansoura-facilities" type="button" role="tab" aria-controls="mansoura-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="mansouraTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="mansoura-courses" role="tabpanel" aria-labelledby="mansoura-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-book"></i>
                                    <div>
                                        <strong>Curriculum</strong><br>
                                        Extensive theoretical knowledge and practical clinical experience
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="mansoura-admission" role="tabpanel" aria-labelledby="mansoura-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Minimum 75% in Physics, Chemistry, and Biology at higher secondary level
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-file-alt me-2"></i>Proof of English language proficiency</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                                <li><i class="fas fa-file-medical me-2"></i>Medical certificate</li>
                                <li><i class="fas fa-file-alt me-2"></i>NEET scorecard (if available)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="mansoura-fees" role="tabpanel" aria-labelledby="mansoura-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        Approximately $6,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        Approximately $600 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="mansoura-facilities" role="tabpanel" aria-labelledby="mansoura-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university provides hostel accommodations equipped with necessary amenities to ensure a conducive living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="university-card" data-state="assiut">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>AU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Assiut University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Assiut, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1957</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Assiut University is the first university in Upper Egypt, serving as a major center for medical education in the region. The Faculty of Medicine offers a range of undergraduate and postgraduate programs in medicine and allied health sciences. The university is ranked #489 in Best Global Universities.</p>

                <ul class="nav nav-tabs" id="assiutTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="assiut-courses-tab" data-bs-toggle="tab" data-bs-target="#assiut-courses" type="button" role="tab" aria-controls="assiut-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assiut-admission-tab" data-bs-toggle="tab" data-bs-target="#assiut-admission" type="button" role="tab" aria-controls="assiut-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assiut-fees-tab" data-bs-toggle="tab" data-bs-target="#assiut-fees" type="button" role="tab" aria-controls="assiut-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assiut-facilities-tab" data-bs-toggle="tab" data-bs-target="#assiut-facilities" type="button" role="tab" aria-controls="assiut-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="assiutTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="assiut-courses" role="tabpanel" aria-labelledby="assiut-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="assiut-admission" role="tabpanel" aria-labelledby="assiut-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Minimum 70% in Physics, Chemistry, and Biology in higher secondary education
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-file-alt me-2"></i>Proof of English language proficiency</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                                <li><i class="fas fa-file-medical me-2"></i>Medical certificate</li>
                                <li><i class="fas fa-file-alt me-2"></i>NEET scorecard (if available)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="assiut-fees" role="tabpanel" aria-labelledby="assiut-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        Approximately $6,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        Approximately $600 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="assiut-facilities" role="tabpanel" aria-labelledby="assiut-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university provides hostel accommodations equipped with necessary amenities to ensure a conducive living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="university-card" data-state="tanta">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>TU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Tanta University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Tanta, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1962</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Tanta University is a prominent public university located in Tanta, Egypt. The Faculty of Medicine is one of its leading faculties, offering comprehensive medical education and training to both local and international students. The university is ranked 14th among medical faculties in Egypt and 4397th globally.</p>

                <ul class="nav nav-tabs" id="tantaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tanta-courses-tab" data-bs-toggle="tab" data-bs-target="#tanta-courses" type="button" role="tab" aria-controls="tanta-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tanta-admission-tab" data-bs-toggle="tab" data-bs-target="#tanta-admission" type="button" role="tab" aria-controls="tanta-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tanta-fees-tab" data-bs-toggle="tab" data-bs-target="#tanta-fees" type="button" role="tab" aria-controls="tanta-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tanta-facilities-tab" data-bs-toggle="tab" data-bs-target="#tanta-facilities" type="button" role="tab" aria-controls="tanta-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="tantaTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="tanta-courses" role="tabpanel" aria-labelledby="tanta-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="tanta-admission" role="tabpanel" aria-labelledby="tanta-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Minimum 75% in Physics, Chemistry, and Biology in higher secondary education
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-file-alt me-2"></i>NEET scorecard (if available)</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="tanta-fees" role="tabpanel" aria-labelledby="tanta-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        Approximately $6,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $1,000 - $2,000 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="tanta-facilities" role="tabpanel" aria-labelledby="tanta-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university offers hostel accommodations equipped with necessary amenities to ensure a conducive living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="university-card" data-state="zagazig">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>ZU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Zagazig University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Zagazig, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1974</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Zagazig University is a prominent public university located in Zagazig, Egypt. The Faculty of Medicine is one of its leading faculties, offering comprehensive medical education and training to both local and international students. The university holds a significant position among Egyptian medical faculties, reflecting its commitment to quality education and research.</p>

                <ul class="nav nav-tabs" id="zagazigTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="zagazig-courses-tab" data-bs-toggle="tab" data-bs-target="#zagazig-courses" type="button" role="tab" aria-controls="zagazig-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="zagazig-admission-tab" data-bs-toggle="tab" data-bs-target="#zagazig-admission" type="button" role="tab" aria-controls="zagazig-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="zagazig-fees-tab" data-bs-toggle="tab" data-bs-target="#zagazig-fees" type="button" role="tab" aria-controls="zagazig-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="zagazig-facilities-tab" data-bs-toggle="tab" data-bs-target="#zagazig-facilities" type="button" role="tab" aria-controls="zagazig-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="zagazigTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="zagazig-courses" role="tabpanel" aria-labelledby="zagazig-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <p>The Faculty of Medicine offers a comprehensive MBBS program designed to provide extensive theoretical knowledge and practical clinical experience.</p>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (5 years academic + 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="zagazig-admission" role="tabpanel" aria-labelledby="zagazig-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Minimum 75% in Physics, Chemistry, and Biology in higher secondary education
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Minimum 17 years by December 31st of admission year
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-file-alt me-2"></i>NEET scorecard (if available)</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="zagazig-fees" role="tabpanel" aria-labelledby="zagazig-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        $5,000 - $8,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $600 - $800 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="zagazig-facilities" role="tabpanel" aria-labelledby="zagazig-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university provides hostel accommodations equipped with necessary amenities to ensure a conducive living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="university-card" data-state="helwan">
    <div class="card-header">
        <div class="d-flex flex-wrap align-items-center">
            <div class="university-logo">
                <span>HU</span>
            </div>
            <div>
                <h2 class="fw-bold mb-2">Helwan University Faculty of Medicine</h2>
                <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Helwan, Egypt</p>
                <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 1975</p>
            </div>
        </div>
    </div>
                                    </div>
            <div class="card-body">
                <p>Helwan University is a public university located in Helwan, Egypt. The Faculty of Medicine is dedicated to providing quality medical education and research opportunities. The university is recognized for its contributions to medical education and research within Egypt.</p>

                <ul class="nav nav-tabs" id="helwanTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="helwan-courses-tab" data-bs-toggle="tab" data-bs-target="#helwan-courses" type="button" role="tab" aria-controls="helwan-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="helwan-admission-tab" data-bs-toggle="tab" data-bs-target="#helwan-admission" type="button" role="tab" aria-controls="helwan-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="helwan-fees-tab" data-bs-toggle="tab" data-bs-target="#helwan-fees" type="button" role="tab" aria-controls="helwan-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="helwan-facilities-tab" data-bs-toggle="tab" data-bs-target="#helwan-facilities" type="button" role="tab" aria-controls="helwan-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="helwanTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="helwan-courses" role="tabpanel" aria-labelledby="helwan-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <p>The Faculty of Medicine offers an MBBS program designed to equip students with comprehensive medical knowledge and clinical skills.</p>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="helwan-admission" role="tabpanel" aria-labelledby="helwan-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Completion of higher secondary education with a strong foundation in science subjects
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        As specified by the university
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Transcripts of academic records</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Recent passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="helwan-fees" role="tabpanel" aria-labelledby="helwan-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        $5,000 - $8,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $600 - $800 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="helwan-facilities" role="tabpanel" aria-labelledby="helwan-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university offers hostel accommodations with essential amenities to ensure a comfortable living environment for students.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
                            </ul>

                            <h4 class="program-title mt-4"><i class="fas fa-user-graduate me-2"></i>Notable Alumni</h4>
                            <p>Helwan University has a growing list of alumni who have made notable contributions in various medical fields.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="university-card" data-state="beni-suef">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="university-logo">
                        <span>BSU</span>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-2">Beni-Suef University Faculty of Medicine</h2>
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Beni-Suef, Egypt</p>
                        <p class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Established: 2005</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Beni-Suef University is a public university located in Beni-Suef, Egypt. The Faculty of Medicine aims to provide high-quality medical education and promote research initiatives. The university is gaining recognition for its commitment to medical education and research.</p>

                <ul class="nav nav-tabs" id="beniSuefTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="beniSuef-courses-tab" data-bs-toggle="tab" data-bs-target="#beniSuef-courses" type="button" role="tab" aria-controls="beniSuef-courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="beniSuef-admission-tab" data-bs-toggle="tab" data-bs-target="#beniSuef-admission" type="button" role="tab" aria-controls="beniSuef-admission" aria-selected="false">Admission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="beniSuef-fees-tab" data-bs-toggle="tab" data-bs-target="#beniSuef-fees" type="button" role="tab" aria-controls="beniSuef-fees" aria-selected="false">Fees</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="beniSuef-facilities-tab" data-bs-toggle="tab" data-bs-target="#beniSuef-facilities" type="button" role="tab" aria-controls="beniSuef-facilities" aria-selected="false">Facilities</button>
                    </li>
                </ul>

                <div class="tab-content" id="beniSuefTabsContent">
                    <!-- Courses -->
                    <div class="tab-pane fade show active" id="beniSuef-courses" role="tabpanel" aria-labelledby="beniSuef-courses-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-graduation-cap me-2"></i>MBBS Program</h4>
                            <p>The Faculty of Medicine offers an MBBS program that integrates theoretical knowledge with practical clinical training.</p>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <strong>Duration</strong><br>
                                        6 years (including 1 year internship)
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Medium of Instruction</strong><br>
                                        English
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Admission -->
                    <div class="tab-pane fade" id="beniSuef-admission" role="tabpanel" aria-labelledby="beniSuef-admission-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-clipboard-check me-2"></i>Admission Requirements</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-user-graduate"></i>
                                    <div>
                                        <strong>Educational Qualifications</strong><br>
                                        Completion of higher secondary education with a focus on science subjects
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-language"></i>
                                    <div>
                                        <strong>Language Requirements</strong><br>
                                        English proficiency required
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-user"></i>
                                    <div>
                                        <strong>Age Criteria</strong><br>
                                        Must satisfy university age criteria
                                    </div>
                                </li>
                            </ul>

                            <h5 class="mt-4 mb-3">Required Documents</h5>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-file-alt me-2"></i>Completed application form</li>
                                <li><i class="fas fa-file-alt me-2"></i>High school diploma or equivalent</li>
                                <li><i class="fas fa-file-alt me-2"></i>Academic transcripts</li>
                                <li><i class="fas fa-passport me-2"></i>Copy of passport</li>
                                <li><i class="fas fa-image me-2"></i>Passport-sized photographs</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Fees -->
                    <div class="tab-pane fade" id="beniSuef-fees" role="tabpanel" aria-labelledby="beniSuef-fees-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-money-bill-wave me-2"></i>Fee Structure</h4>
                            <ul class="program-list">
                                <li>
                                    <i class="fas fa-dollar-sign"></i>
                                    <div>
                                        <strong>Tuition Fee</strong><br>
                                        $5,000 - $8,000 per year
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    <div>
                                        <strong>Hostel Fee</strong><br>
                                        $600 - $800 per year
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="tab-pane fade" id="beniSuef-facilities" role="tabpanel" aria-labelledby="beniSuef-facilities-tab">
                        <div class="program-card">
                            <h4 class="program-title"><i class="fas fa-building me-2"></i>Hostel Facilities</h4>
                            <p>The university provides hostel facilities equipped with necessary amenities to support students' living and learning experiences.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check me-2"></i>Separate male and female accommodations</li>
                                <li><i class="fas fa-check me-2"></i>Well-furnished rooms</li>
                                <li><i class="fas fa-check me-2"></i>Study areas</li>
                                <li><i class="fas fa-check me-2"></i>Recreation facilities</li>
                                <li><i class="fas fa-check me-2"></i>Dining options</li>
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
</body>

</html>
