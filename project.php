<!-- project.php -->
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

<!-- Navigation Back to Home -->
<nav class="breadcrumb">
    <a href="about.php">&larr; Back to Portfolio</a>
</nav>

<!-- Project Details -->
<section class="project-details container" data-aos="fade-up">
    <!-- Project Screenshots First -->
    <?php if (!empty($project['images']['screenshots'])): ?>
        <div class="screenshots">
            <h3>Screenshots:</h3>
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
    
    <!-- Project Title -->
    <h2><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
    
    <!-- Project Summary -->
    <p class="summary"><?php echo nl2br(htmlspecialchars($project['long_description'], ENT_QUOTES, 'UTF-8')); ?></p>

    <!-- Technologies Used -->
    <div class="technologies">
        <h3>Technologies Used:</h3>
        <ul>
            <?php
            $technologies = explode(',', $project['technologies']);
            foreach ($technologies as $tech) {
                echo '<li>' . htmlspecialchars(trim($tech), ENT_QUOTES, 'UTF-8') . '</li>';
            }
            ?>
        </ul>
    </div>

    <!-- Live Link -->
    <?php if (!empty($project['live_link']) && $project['live_link'] !== 'Not Currently Hosted'): ?>
        <div class="live-link">
            <h3>Live Site:</h3>
            <a href="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" aria-label="Visit <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> Live Site">
                <?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </div>
    <?php endif; ?>
</section>

<?php
// Include the footer
include 'includes/footer.php';
?>
