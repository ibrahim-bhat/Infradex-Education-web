<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History | Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/dashboard.css" rel="stylesheet">
</head>
<body>
    <div class="glow-overlay"></div>
    <div class="scanlines"></div>

    <div class="dashboard-container">
        <dashboard-sidebar></dashboard-sidebar>

        <main class="main-content">
            <dashboard-header></dashboard-header>

            <div class="dashboard-content">
                <div class="section-header">
                    <h2>Payment History</h2>
                </div>

                <div class="payment-history">
                    <div class="payment-card">
                        <div class="payment-info">
                            <div class="payment-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="payment-details">
                                <h4>Web Development Course</h4>
                                <p>Transaction ID: #123456</p>
                                <span class="payment-date">Paid on: 15 March 2024</span>
                            </div>
                        </div>
                        <div class="payment-amount">
                            <span class="amount">$299</span>
                            <span class="status success">Completed</span>
                        </div>
                    </div>
                    <!-- More payment cards -->
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/sidebar.js"></script>
    <script src="./components/header.js"></script>
    <script src="../js/dashboard.js"></script>
</body>
</html> 