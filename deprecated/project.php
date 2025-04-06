<?php
// Include the projects data
include 'data/projects.php';

// Include functions
require_once 'includes/functions.php';

// Get the project ID from the URL and sanitize it
$projectId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

// Find the project using the function from functions.php
$project = get_project_by_id($projects, $projectId);

// If project not found, redirect to homepage
if (!$project) {
    header('Location: index.php');
    exit;
}

// Set the page title and meta description
$pageTitle = htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') . ' | Elliot Tindall';
$metaDescription = htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8');

// Include the header
include 'includes/header.php';
?>

<!-- Project Details with Modern Layout -->
<section class="project-details container">
    <!-- Project Header with Breadcrumb -->
    <header class="project-header">
        <nav class="breadcrumb">
            <a href="about.php">Back to Portfolio</a>
        </nav>
    </header>
    
    <!-- Project Title -->
    <h2><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
    
    <!-- Project Metadata -->
    <div class="project-meta">
        <span class="project-category-label">
            <?php echo htmlspecialchars(ucfirst($project['category']), ENT_QUOTES, 'UTF-8'); ?>
        </span>
    </div>
    
    <!-- Project Description -->
    <p class="summary"><?php echo nl2br(htmlspecialchars($project['long_description'], ENT_QUOTES, 'UTF-8')); ?></p>

    <!-- Technologies Used - As Tags -->
    <div class="technologies">
        <h3>Technologies Used</h3>
        <div class="tech-tags">
            <?php
            $technologies = explode(',', $project['technologies']);
            foreach ($technologies as $tech) {
                $tech = trim($tech);
                if (!empty($tech)) {
                    echo '<span class="tech-tag">' . htmlspecialchars($tech, ENT_QUOTES, 'UTF-8') . '</span>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Live Link with Button -->
    <?php if (!empty($project['live_link']) && $project['live_link'] !== 'Not Currently Hosted'): ?>
        <div class="live-link">
            <h3>View Live Project</h3>
            <a href="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>" 
               target="_blank" rel="noopener noreferrer">
                Visit Project
            </a>
        </div>
    <?php endif; ?>
    
    <!-- Screenshots Gallery (will appear on right on desktop, top on mobile) -->
    <?php if (!empty($project['images']['screenshots'])): ?>
        <div class="screenshots">
            <h3>Project Gallery</h3>
            <div class="screenshot-gallery">
                <?php foreach ($project['images']['screenshots'] as $screenshot): ?>
                    <a href="<?php echo htmlspecialchars($screenshot, ENT_QUOTES, 'UTF-8'); ?>"
                       data-lightbox="<?php echo htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>"
                       data-title="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        <img src="<?php echo htmlspecialchars($screenshot, ENT_QUOTES, 'UTF-8'); ?>"
                             alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> Screenshot"
                             loading="lazy">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php
// Include the footer
include 'includes/footer.php';
?> 