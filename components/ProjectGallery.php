<?php
/**
 * Project Gallery Component
 * 
 * Displays a gallery of projects with filtering options
 * 
 * @param array $projects The array of project data
 * @param string $defaultCategory The default category to show (default: 'websites')
 */

// Default parameters
$defaultCategory = $defaultCategory ?? 'websites';
?>

<section class="gallery container" data-aos="fade-up" data-aos-duration="1500">
    <h2>My Projects</h2>

    <!-- Filter Buttons -->
    <div class="filter-bar">
        <button class="filter-button <?php echo ($defaultCategory === 'websites') ? 'active' : ''; ?>" 
                data-category="websites">Websites</button>
        <button class="filter-button <?php echo ($defaultCategory === 'art') ? 'active' : ''; ?>" 
                data-category="art">Art &amp; Design</button>
        <button class="filter-button <?php echo ($defaultCategory === 'misc') ? 'active' : ''; ?>" 
                data-category="misc">Misc</button>
    </div>

    <div class="projects-grid">
        <?php 
        // Display all projects
        foreach ($projects as $project):
            // Set parameter for the ProjectCard component
            $showAnimation = true;
            // Include the project card component
            include 'components/ProjectCard.php';
        endforeach; 
        ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-button');
    const projects = document.querySelectorAll('.project');
    
    // Initial state: filter to default category
    filterProjects('<?php echo $defaultCategory; ?>');
    
    // Add click event listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedCategory = button.getAttribute('data-category');
            filterProjects(selectedCategory);
            
            // Update active button state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
    
    // Function to filter projects by category
    function filterProjects(category) {
        projects.forEach(project => {
            const projectCategory = project.getAttribute('data-category');
            
            // If "all" is selected or the category matches, show the project
            if (category === 'all' || projectCategory === category) {
                project.style.display = 'block';
                // Add a small delay to each project appearance for a cascade effect
                setTimeout(() => {
                    project.classList.add('visible');
                }, 50 * Array.from(projects).indexOf(project));
            } else {
                project.style.display = 'none';
                project.classList.remove('visible');
            }
        });
    }
});
</script> 