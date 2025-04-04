<?php
require_once 'security.php';
session_start();

// Validate session and security
Security::validateSession();

require_once '../includes/db.php';

try {
    $db = Database::getInstance()->getConnection();
    
    // Sanitize and validate page parameter
    $page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
    $page = ($page > 0) ? $page : 1;
    
    $per_page = 10;
    $offset = ($page - 1) * $per_page;
    
    // Get total count
    $total = $db->query("SELECT COUNT(*) FROM contact_submissions")->fetchColumn();
    $total_pages = ceil($total / $per_page);
    
    // Validate page is within bounds
    if ($page > $total_pages) {
        $page = $total_pages;
        $offset = ($page - 1) * $per_page;
    }
    
    // Get submissions for current page
    $stmt = $db->prepare("
        SELECT * FROM contact_submissions 
        ORDER BY submission_date DESC 
        LIMIT :limit OFFSET :offset
    ");
    
    $stmt->bindValue(':limit', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $submissions = $stmt->fetchAll();
    
} catch (Exception $e) {
    error_log("Admin Error: " . $e->getMessage());
    $error = "An error occurred while fetching submissions.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form Submissions</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .submissions-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .submissions-table th,
        .submissions-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .submissions-table th {
            background-color: #f5f5f5;
        }
        .submissions-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-email_failed { background-color: #f8d7da; color: #721c24; }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #ddd;
            text-decoration: none;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Contact Form Submissions</h1>
            <a href="logout.php" class="btn">Logout</a>
        </div>
        
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php else: ?>
            <table class="submissions-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $submission): ?>
                        <tr>
                            <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($submission['submission_date']))); ?></td>
                            <td><?php echo htmlspecialchars($submission['name']); ?></td>
                            <td><?php echo htmlspecialchars($submission['email']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($submission['message'])); ?></td>
                            <td>
                                <span class="status status-<?php echo htmlspecialchars($submission['status']); ?>">
                                    <?php echo htmlspecialchars(ucfirst($submission['status'])); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($submission['ip_address']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" 
                           class="<?php echo $page === $i ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html> 