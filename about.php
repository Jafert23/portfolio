<!-- about.php -->
<?php
// about.php

// Include the project data
include 'data/projects.php';

// Set the page title
$pageTitle = 'Elliot Tindall | Portfolio';

// Include the header (if you have a separate header file)
include 'includes/aboutheader.php';
?>

<section class="gallery container" data-aos="fade-up">
    <br>
    <h2>My Projects</h2>

    <!-- Filter Buttons (no "All") -->
    <div class="filter-bar">
        <button class="filter-button" data-category="websites">Websites</button>
        <button class="filter-button" data-category="art">Art &amp; Design</button>
        <button class="filter-button" data-category="misc">Misc</button>
    </div>

    <div class="projects-grid">
        <?php foreach ($projects as $project): ?>
            <div class="project"
                 data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-aos="zoom-in">
                 
                <a href="project.php?id=<?php echo htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                   class="project-link"
                   aria-label="View details of <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">

                    <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
                         alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> Thumbnail"
                         loading="lazy">

                    <div class="overlay">
                        <h3><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
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

    // Optional: mark the "Websites" button as active
    const websitesButton = document.querySelector('.filter-button[data-category="websites"]');
    if (websitesButton) {
        websitesButton.classList.add('active');
    }

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
// Include the footer (if you have a separate footer file)
include 'includes/footer.php';
?>
