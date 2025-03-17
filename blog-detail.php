<?php
require_once 'config/db_connect.php';

// Get blog post ID from URL
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$post_id) {
    header('Location: blogs.php');
    exit();
}

// Fetch blog post with author and category details
$sql = "SELECT p.*, u.name as author_name, u.profile_photo, c.name as category_name, 
        COUNT(DISTINCT bv.id) as view_count, COUNT(DISTINCT bc.id) as comment_count 
        FROM blog_posts p 
        LEFT JOIN users u ON p.author_id = u.id 
        LEFT JOIN blog_categories c ON p.category_id = c.id 
        LEFT JOIN blog_views bv ON p.id = bv.post_id 
        LEFT JOIN blog_comments bc ON p.id = bc.post_id AND bc.status = 'approved'
        WHERE p.id = ? AND p.status = 'published'
        GROUP BY p.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    header('Location: blogs.php');
    exit();
}

// Fetch stats if it's a card layout
$stats = [];
if ($post['display_type'] === 'card') {
    $stmt = $conn->prepare("SELECT * FROM blog_post_stats WHERE post_id = ? ORDER BY order_index");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stats = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Fetch FAQs
$faqs = [];
$stmt = $conn->prepare("SELECT * FROM blog_faqs WHERE post_id = ? ORDER BY order_index");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$faqs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Record view
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_agent = $_SERVER['HTTP_USER_AGENT'];

$stmt = $conn->prepare("INSERT INTO blog_views (post_id, user_id, ip_address, user_agent) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $post_id, $user_id, $ip_address, $user_agent);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['meta_title'] ?: $post['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($post['meta_description']); ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
            color: #333;
            line-height: 1.6;
        }

        /* Card Layout Styles */
        .blog-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .blog-card .card-header {
            background: white;
            padding: 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .blog-card .card-body {
            padding: 30px;
        }

        .blog-card .featured-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .blog-card .subtitle {
            color: var(--primary-color);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .blog-card .rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .blog-card .rating .stars {
            color: var(--warning-color);
        }

        .blog-card .rating .reviews {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .blog-card .highlight {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            margin: 10px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .stat-item {
            background: var(--light-color);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .stat-item .stat-icon {
            font-size: 24px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stat-item .stat-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .stat-item .stat-label {
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        /* Standard Blog Layout Styles */
        .blog-standard {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
        }

        .blog-standard .featured-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .blog-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }

        .blog-content h2 {
            color: var(--dark-color);
            margin: 30px 0 20px;
            font-weight: 600;
        }

        .blog-content p {
            margin-bottom: 20px;
        }

        .blog-content img {
            max-width: 100%;
            border-radius: 10px;
            margin: 20px 0;
        }

        /* Author Section */
        .author-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 30px 0;
            padding: 20px;
            background: var(--light-color);
            border-radius: 15px;
        }

        .author-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h5 {
            margin: 0;
            color: var(--dark-color);
        }

        .author-info p {
            margin: 5px 0 0;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 50px;
        }

        .faq-item {
            background: white;
            border-radius: 15px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-question {
            padding: 20px;
            background: var(--light-color);
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 20px;
            display: none;
        }

        .faq-question.active + .faq-answer {
            display: block;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-outline {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-card .card-header,
            .blog-card .card-body,
            .blog-standard {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container py-5">
        <?php if ($post['display_type'] === 'card'): ?>
            <!-- Card Layout -->
            <div class="blog-card">
                <?php if ($post['featured_image']): ?>
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="featured-image">
                <?php endif; ?>

                <div class="card-header">
                    <?php if ($post['card_subtitle']): ?>
                        <div class="subtitle"><?php echo htmlspecialchars($post['card_subtitle']); ?></div>
                    <?php endif; ?>

                    <h1 class="h2 mt-3"><?php echo htmlspecialchars($post['title']); ?></h1>

                    <?php if ($post['card_rating']): ?>
                        <div class="rating">
                            <div class="stars">
                                <?php
                                $rating = $post['card_rating'];
                                $fullStars = floor($rating);
                                $hasHalfStar = $rating - $fullStars >= 0.5;
                                
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $fullStars) {
                                        echo '<i class="fas fa-star"></i>';
                                    } elseif ($i == $fullStars + 1 && $hasHalfStar) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    } else {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="reviews">
                                <?php echo number_format($post['card_rating'], 1); ?> 
                                (<?php echo number_format($post['card_reviews_count']); ?> reviews)
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($post['card_highlight_text']): ?>
                        <div class="highlight"><?php echo htmlspecialchars($post['card_highlight_text']); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($stats)): ?>
                        <div class="stats-grid">
                            <?php foreach ($stats as $stat): ?>
                                <div class="stat-item">
                                    <?php if ($stat['stat_icon']): ?>
                                        <div class="stat-icon">
                                            <i class="<?php echo htmlspecialchars($stat['stat_icon']); ?>"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="stat-value"><?php echo htmlspecialchars($stat['stat_value']); ?></div>
                                    <div class="stat-label"><?php echo htmlspecialchars($stat['stat_key']); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="action-buttons">
                        <?php if ($post['card_button_text'] && $post['card_button_link']): ?>
                            <a href="<?php echo htmlspecialchars($post['card_button_link']); ?>" class="btn btn-custom btn-primary">
                                <?php echo htmlspecialchars($post['card_button_text']); ?>
                            </a>
                        <?php endif; ?>
                        <a href="#" class="btn btn-custom btn-outline">Download Brochure</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="blog-content">
                        <?php echo $post['content']; ?>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Standard Blog Layout -->
            <div class="blog-standard">
                <h1 class="mb-4"><?php echo htmlspecialchars($post['title']); ?></h1>

                <div class="author-section">
                    <img src="<?php echo $post['profile_photo'] ?: 'assets/images/default-avatar.png'; ?>" 
                         alt="<?php echo htmlspecialchars($post['author_name']); ?>" 
                         class="author-image">
                    <div class="author-info">
                        <h5><?php echo htmlspecialchars($post['author_name']); ?></h5>
                        <p>Posted in <?php echo htmlspecialchars($post['category_name']); ?> • 
                           <?php echo date('F j, Y', strtotime($post['created_at'])); ?> • 
                           <?php echo $post['view_count']; ?> views</p>
                    </div>
                </div>

                <?php if ($post['featured_image']): ?>
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                         alt="<?php echo htmlspecialchars($post['title']); ?>" 
                         class="featured-image">
                <?php endif; ?>

                <div class="blog-content">
                    <?php echo $post['content']; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($faqs)): ?>
            <!-- FAQs Section -->
            <div class="faq-section">
                <h2 class="mb-4">Frequently Asked Questions</h2>
                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item">
                        <div class="faq-question">
                            <?php echo htmlspecialchars($faq['question']); ?>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <?php echo $faq['answer']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'components/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // FAQ Toggle
            $('.faq-question').click(function() {
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                $(this).next('.faq-answer').slideToggle();
            });

            // Initialize first FAQ as open
            $('.faq-question:first').addClass('active')
                                  .find('i').toggleClass('fa-chevron-down fa-chevron-up');
            $('.faq-answer:first').show();
        });
    </script>
</body>
</html> 