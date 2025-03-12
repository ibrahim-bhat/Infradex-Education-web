<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship | Student Dashboard | Infradex Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/dashboard.css" rel="stylesheet">
</head>

<body>
    <div class="glow-overlay"></div>
    <div class="scanlines"></div>

    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>

        <main class="main-content">
            <dashboard-header></dashboard-header>

            <div class="dashboard-content">
                <!-- Schemes for Higher Education -->
                <div class="scholarship-section mb-5">
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Important Notice:</strong> Students can apply for these scholarships through the National Scholarship Portal (NSP). 
                        Please ensure you have all required documents ready before starting your application.
                    </div>

                    <div class="section-header mb-4">
                        <h2>Schemes for Higher Education</h2>
                        <p class="text-muted">Higher Education is the shared responsibility of both the Centre and the States. The coordination and determination of standards in institutions is the constitutional obligation of the Central Government.</p>
                        <p>The Central Government provides grants to UGC and establishes Central Universities in the country. Meritorious students, from families with or without necessary means, need an incentive or encouragement to keep on working hard in their studies and go to the next level of education in their academic career.</p>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Significant Fellowship Schemes/Scholarships:</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Scholarship Name</th>
                                            <th>Provider</th>
                                            <th>Application Period</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Prime Minister Special Scholarship Scheme (PMSSS), J&K</td>
                                            <td>AICTE – All India Council for Technical Education, MHRD</td>
                                            <td>Between April and May</td>
                                        </tr>
                                        <tr>
                                            <td>Combined Counselling Board (CCB) Scholarship, J&K</td>
                                            <td>Combined Counselling Board</td>
                                            <td>Between December and April</td>
                                        </tr>
                                        <tr>
                                            <td>KEI High school Scholarship Program (HSSP)</td>
                                            <td>Kashmir Education Initiative (KEI)</td>
                                            <td>Between November and December</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <h6 class="text-primary">General Eligibility Criteria:</h6>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Academic Qualifications:</strong>
                                        <ul>
                                            <li>Minimum 40-50% marks in qualifying examination</li>
                                            <li>Course-specific requirements may vary</li>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Course-Specific Requirements:</strong>
                                        <ul>
                                            <li>Polytechnic: 33% in Class 10th/12th</li>
                                            <li>BCA/BBA/Specialized Engineering: 40% minimum</li>
                                            <li>B.Tech Lateral Entry/Agriculture/B.Arch/Biotech/BDS: 50% minimum</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Rest of the content remains the same -->
                    <!-- Schemes for Elementary Education -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Schemes for Elementary Education:</h5>
                            <ul>
                                <li>Sarva Shiksha Abhiyan</li>
                                <li>Mid Day Meal</li>
                                <li>Mahila Samakhya</li>
                                <li>Strengthening for providing quality Education in Madrassas (SPQEM)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- J&K Scholarships -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Prime Minister's Special Scholarship Scheme (PMSSS) for J&K Students</h5>
                            <p><strong>Benefits:</strong></p>
                            <ul>
                                <li>General Degree Courses: Up to ₹30,000 per annum (academic fees) + ₹1 lakh per annum (maintenance)</li>
                                <li>Professional Courses: Up to ₹1.25 lakh per annum (academic fees) + ₹1 lakh per annum (maintenance)</li>
                                <li>Medical Courses: Up to ₹3 lakh per annum (academic fees) + ₹1 lakh per annum (maintenance)</li>
                            </ul>
                            <p><strong>Eligibility:</strong></p>
                            <ul>
                                <li>J&K residents who passed Class 12 from J&K Board or CBSE-affiliated schools in J&K</li>
                                <li>Family income below ₹8 lakh per annum</li>
                            </ul>
                        </div>
                    </div>

                    <!-- MOMA Scholarships -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Ministry of Minority Affairs (MOMA) Scholarships</h5>
                            
                            <h6>1. Pre-Matric Scholarship Scheme</h6>
                            <ul>
                                <li>For Class 1-10 students from minority communities</li>
                                <li>Family income limit: ₹1 lakh per annum</li>
                                <li>Benefits: Up to ₹500 admission fee, ₹350 monthly tuition fee, ₹600 monthly maintenance (hostellers)</li>
                            </ul>

                            <h6>2. Post-Matric Scholarship Scheme</h6>
                            <ul>
                                <li>For higher secondary and above</li>
                                <li>Minimum 50% marks required</li>
                                <li>Family income limit: ₹2 lakh per annum</li>
                                <li>Benefits: Up to ₹7,000 annual fees, ₹1,200 monthly maintenance (hostellers)</li>
                            </ul>

                            <h6>3. Merit-cum-Means Scholarship</h6>
                            <ul>
                                <li>For professional/technical courses</li>
                                <li>Family income limit: ₹2.5 lakh per annum</li>
                                <li>Benefits: Up to ₹20,000 course fee, ₹1,000 monthly maintenance (hostellers)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Application Process -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>How to Apply</h5>
                            <p>Applications are accepted through the National Scholarship Portal (NSP). Students need to:</p>
                            <ul>
                                <li>Register on NSP using Aadhaar or Enrollment ID</li>
                                <li>Complete the One Time Registration (OTR)</li>
                                <li>Fill scholarship application form</li>
                                <li>Upload required documents</li>
                            </ul>
                            <p><strong>Important Dates:</strong></p>
                            <ul>
                                <li>PMSSS J&K: Between April and May</li>
                                <li>CCB Scholarship: Between December and April</li>
                                <li>KEI High School Scholarship: Between November and December</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/sidebar.js"></script>
    <script src="./components/header.js"></script>
    <script src="./js/dashboard.js"></script>
</body>

</html>