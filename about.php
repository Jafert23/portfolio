<!-- about.php -->
<?php
// Include the project data
include 'data/projects.php';

// Set the page title
$pageTitle = 'Elliot Tindall | Portfolio';

// Include the header, if you have a separate file
include 'includes/aboutheader.php';
?>

<section class="gallery container" data-aos="fade-up">
    <br> <!-- adds space between header and main-->
    <h2>My Projects</h2>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <!-- "All" button if you want to show all categories at once. 
             If you only want one category at a time with NO "All," remove this. -->
       <!-- <button class="filter-button" data-category="all">All</button> -->

        <!-- The main 3 categories -->
        <button class="filter-button" data-category="websites">Websites</button>
        <button class="filter-button" data-category="art">Art &amp; Design</button>
        <button class="filter-button" data-category="misc">Misc.</button>
    </div>

    <div class="projects-grid">
        <?php foreach ($projects as $project): ?>
            <!-- Include a data-category attribute that matches the project['category'] -->
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

<!-- JS to handle filtering -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-button');
    const projects = document.querySelectorAll('.project');

    // OPTIONAL: If you want to default to one category (e.g., "websites") on page load:
    //     projects.forEach(project => {
    //       project.style.display = (project.getAttribute('data-category') === 'websites') 
    //                               ? 'block' 
    //                               : 'none';
    //     });

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // 1) Get the category from the button
            const selectedCategory = button.getAttribute('data-category');

            // 2) Hide all projects
            projects.forEach(project => {
                project.style.display = 'none';
            });

            // 3) If "all" is selected, show everything
            if (selectedCategory === 'all') {
                projects.forEach(project => {
                    project.style.display = 'block';
                });
            } 
            // Otherwise, only show projects matching the selected category
            else {
                projects.forEach(project => {
                    if (project.getAttribute('data-category') === selectedCategory) {
                        project.style.display = 'block';
                    }
                });
            }

            // 4) Highlight the active button (optional)
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
});
</script>

<?php
// Include the footer, if you have a separate file
include 'includes/footer.php';
?>
