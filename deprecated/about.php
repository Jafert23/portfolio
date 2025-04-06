<link rel="stylesheet" href="css/projects.css">
<?php
// about.php

// Include the project data
include 'data/projects.php';

// Set the page title
$pageTitle = 'Elliot Tindall | Portfolio';

// Include the header (if you have a separate header file)
include 'includes/aboutheader.php';
?>

<section class="gallery container" data-aos="fade-up" data-aos-duration="1500">
    <h2>My Projects</h2>

    <!-- Filter Buttons with modern styling -->
    <div class="filter-bar">
        <button class="filter-button active" data-category="websites">Websites</button>
        <button class="filter-button" data-category="art">Art &amp; Design</button>
        <button class="filter-button" data-category="misc">Misc</button>
    </div>

    <div class="projects-grid">
        <?php foreach ($projects as $project): ?>
            <div class="project"
                 data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-aos="fade-up">
                 
                <a href="<?php echo $project['id'] === 'Resume' || $project['id'] === 'moodboard' ? 
                            htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8') : 
                            'project-details-redesign.php?id=' . htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                   class="project-link"
                   <?php if ($project['id'] === 'Resume' || $project['id'] === 'moodboard'): ?>target="_blank"<?php endif; ?>>

                    <!-- Category Tag -->
                    <span class="project-category">
                        <?php 
                        $category = $project['category'];
                        echo htmlspecialchars(ucfirst($category), ENT_QUOTES, 'UTF-8'); 
                        ?>
                    </span>
                    
                    <div class="project-image">
                        <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"
                             loading="lazy">
                    </div>
                    
                    <!-- Project info displayed below the image -->
                    <div class="project-info">
                        <h3><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <?php if (!empty($project['short_description'])): ?>
                            <p><?php echo htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-button');
    const projects = document.querySelectorAll('.project');

    // --- DEFAULT TO "websites" ---
    projects.forEach(project => {
        project.style.display =
            (project.getAttribute('data-category') === 'websites')
            ? 'block'
            : 'none';
    });

    // --- FILTERING LOGIC ---
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedCategory = button.getAttribute('data-category');

            // Hide all projects first
            projects.forEach(project => {
                project.style.display = 'none';
            });

            // Show only those matching the selected category
            projects.forEach(project => {
                if (project.getAttribute('data-category') === selectedCategory) {
                    project.style.display = 'block';
                }
            });

            // Toggle the .active class among buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
});
</script>

<?php
// Include the footer 
include 'includes/footer.php';
?> 