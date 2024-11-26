<!-- about.php -->
<?php
// about.php

// Include the projects data
include 'data/projects.php';

// Set the page title
$pageTitle = 'Elliot Tindall | Portfolio';

// Include the header
include 'includes/header.php';
?>

<!-- Projects Gallery -->
<section class="gallery container" data-aos="fade-up">
    <h2>My Projects</h2>
    <div class="projects-grid">
        <?php foreach ($projects as $project): ?>
            <div class="project" data-aos="zoom-in">
                <a href="project.php?id=<?php echo htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>" class="project-link" aria-label="View details of <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> Thumbnail" loading="lazy">
                    <div class="overlay">
                        <h3><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// Include the footer
include 'includes/footer.php';
?>
