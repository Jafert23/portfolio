<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

// Handle CSV Export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    try {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM contact_submissions ORDER BY submission_date DESC");
        $submissions = $stmt->fetchAll();
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="submissions_' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Date', 'Name', 'Email', 'Message', 'Status', 'IP Address']);
        
        foreach ($submissions as $submission) {
            fputcsv($output, [
                $submission['submission_date'],
                $submission['name'],
                $submission['email'],
                $submission['message'],
                $submission['status'],
                $submission['ip_address']
            ]);
        }
        
        fclose($output);
        exit;
    } catch (Exception $e) {
        $error = "Error exporting data: " . $e->getMessage();
    }
}

try {
    $db = Database::getInstance()->getConnection();
    
    // Initialize filters
    $search = $_GET['search'] ?? '';
    $status_filter = $_GET['status'] ?? '';
    $date_from = $_GET['date_from'] ?? '';
    $date_to = $_GET['date_to'] ?? '';
    
    // Build query conditions
    $conditions = [];
    $params = [];
    
    if ($search) {
        $conditions[] = "(name LIKE ? OR email LIKE ? OR message LIKE ?)";
        $search_param = "%$search%";
        $params = array_merge($params, [$search_param, $search_param, $search_param]);
    }
    
    if ($status_filter) {
        $conditions[] = "status = ?";
        $params[] = $status_filter;
    }
    
    if ($date_from) {
        $conditions[] = "submission_date >= ?";
        $params[] = $date_from . " 00:00:00";
    }
    
    if ($date_to) {
        $conditions[] = "submission_date <= ?";
        $params[] = $date_to . " 23:59:59";
    }
    
    $where_clause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
    
    // Get submissions with pagination
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $per_page = 10;
    $offset = ($page - 1) * $per_page;
    
    // Get total count
    $count_sql = "SELECT COUNT(*) FROM contact_submissions $where_clause";
    $stmt = $db->prepare($count_sql);
    $stmt->execute($params);
    $total = $stmt->fetchColumn();
    $total_pages = ceil($total / $per_page);
    
    // Get submissions for current page
    $sql = "SELECT * FROM contact_submissions $where_clause ORDER BY submission_date DESC LIMIT ? OFFSET ?";
    $stmt = $db->prepare($sql);
    $params[] = $per_page;
    $params[] = $offset;
    $stmt->execute($params);
    $submissions = $stmt->fetchAll();
    
    // Get unique statuses for filter dropdown
    $statuses = $db->query("SELECT DISTINCT status FROM contact_submissions")->fetchAll(PDO::FETCH_COLUMN);
    
} catch (Exception $e) {
    $error = "Error fetching submissions: " . $e->getMessage();
}

// Function to maintain query parameters in pagination links
function buildQueryString($page, $current_params = []) {
    $params = array_merge($_GET, ['page' => $page]);
    return '?' . http_build_query($params);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form Submissions</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
        .filters {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .filters form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .filter-group {
            margin-bottom: 10px;
        }
        .filter-group label {
            display: block;
            margin-bottom: 5px;
        }
        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .btn-export {
            background-color: #28a745;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }
        .btn-reset {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Contact Form Submissions</h1>
            <div class="action-buttons">
                <a href="?export=csv" class="btn-export">Export CSV</a>
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
        
        <div class="filters">
            <form method="get" action="">
                <div class="filter-group">
                    <label for="search">Search:</label>
                    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Search name, email, or message">
                </div>
                
                <div class="filter-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status">
                        <option value="">All Statuses</option>
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?php echo htmlspecialchars($status); ?>"
                                    <?php echo $status_filter === $status ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars(ucfirst($status)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="date_from">From Date:</label>
                    <input type="date" id="date_from" name="date_from" value="<?php echo htmlspecialchars($date_from); ?>">
                </div>
                
                <div class="filter-group">
                    <label for="date_to">To Date:</label>
                    <input type="date" id="date_to" name="date_to" value="<?php echo htmlspecialchars($date_to); ?>">
                </div>
                
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <div class="action-buttons">
                        <button type="submit" class="btn">Apply Filters</button>
                        <a href="?" class="btn-reset">Reset</a>
                    </div>
                </div>
            </form>
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
                        <a href="<?php echo buildQueryString($i); ?>" 
                           class="<?php echo $page === $i ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <script>
        // Initialize date pickers
        flatpickr("#date_from", {
            dateFormat: "Y-m-d",
            maxDate: "today"
        });
        
        flatpickr("#date_to", {
            dateFormat: "Y-m-d",
            maxDate: "today"
        });
    </script>
</body>
</html> 