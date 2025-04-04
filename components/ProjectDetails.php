<?php
/**
 * Project Details Component
 * 
 * Displays detailed information about a project in a card-based layout
 * 
 * @param array $project The project data array
 */

// Ensure required data exists
if (empty($project) || !is_array($project)) {
    return;
}
?>

<!-- Enhanced Project Content Cards -->
<div class="project-content">
    <!-- Overview Card -->
    <div class="project-card" data-aos="fade-up">
        <div class="card-icon"><i class="fas fa-info-circle"></i></div>
        <h3>Project Overview</h3>
        <p><?php echo nl2br(htmlspecialchars($project['long_description'], ENT_QUOTES, 'UTF-8')); ?></p>
    </div>

    <!-- Technologies Card -->
    <div class="project-card" data-aos="fade-up" data-aos-delay="100">
        <div class="card-icon"><i class="fas fa-code"></i></div>
        <h3>Technologies Used</h3>
        <div class="tech-list">
            <?php
            $technologies = explode(',', $project['technologies']);
            foreach ($technologies as $tech): 
                $tech = trim($tech);
                if (empty($tech)) continue;
                
                // Map technologies to icons (expand this as needed)
                $techIcon = 'fa-solid fa-code'; // Default icon
                
                if (stripos($tech, 'html') !== false) $techIcon = 'fa-html5';
                else if (stripos($tech, 'css') !== false) $techIcon = 'fa-css3-alt';
                else if (stripos($tech, 'javascript') !== false) $techIcon = 'fa-js';
                else if (stripos($tech, 'react') !== false) $techIcon = 'fa-react';
                else if (stripos($tech, 'node') !== false) $techIcon = 'fa-node-js';
                else if (stripos($tech, 'php') !== false) $techIcon = 'fa-php';
                else if (stripos($tech, 'python') !== false) $techIcon = 'fa-python';
                else if (stripos($tech, 'database') !== false || stripos($tech, 'mysql') !== false) $techIcon = 'fa-database';
                else if (stripos($tech, 'photoshop') !== false) $techIcon = 'fa-image';
                else if (stripos($tech, 'illustrator') !== false) $techIcon = 'fa-bezier-curve';
            ?>
                <div class="tech-item">
                    <span class="tech-icon"><i class="fab <?php echo $techIcon; ?>"></i></span>
                    <span class="tech-name"><?php echo htmlspecialchars($tech, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Project Timeline (if available) -->
    <?php if (!empty($project['date_start']) && !empty($project['date_end'])): ?>
    <div class="project-card" data-aos="fade-up" data-aos-delay="200">
        <div class="card-icon"><i class="fas fa-calendar-alt"></i></div>
        <h3>Project Timeline</h3>
        <div class="timeline-bar">
            <div class="timeline-start"><?php echo htmlspecialchars($project['date_start'], ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="timeline-progress"></div>
            <div class="timeline-end"><?php echo htmlspecialchars($project['date_end'], ENT_QUOTES, 'UTF-8'); ?></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Links Card -->
    <?php if (!empty($project['live_link']) && $project['live_link'] !== 'Not Currently Hosted'): ?>
    <div class="project-card" data-aos="fade-up" data-aos-delay="300">
        <div class="card-icon"><i class="fas fa-link"></i></div>
        <h3>Project Links</h3>
        <p>Check out the live version of this project to see it in action.</p>
        <a href="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>" 
           class="btn" 
           target="_blank" 
           rel="noopener noreferrer">
            View Live Project <i class="fas fa-external-link-alt"></i>
        </a>
    </div>
    <?php endif; ?>
</div>

<?php
// Check if there are related projects in the same category
// This requires the $projects array to be available
if (isset($projects) && is_array($projects) && count($projects) > 1): 
    // Get current project category
    $currentCategory = $project['category'];
    $relatedProjects = [];
    
    // Find up to 3 related projects in the same category
    foreach ($projects as $relatedProject) {
        if ($relatedProject['id'] !== $project['id'] && $relatedProject['category'] === $currentCategory) {
            $relatedProjects[] = $relatedProject;
            if (count($relatedProjects) >= 3) break;
        }
    }
    
    // Display related projects if any found
    if (!empty($relatedProjects)):
?>
    <div class="related-projects" data-aos="fade-up">
        <h3>Related Projects</h3>
        <div class="related-projects-grid">
            <?php 
            foreach ($relatedProjects as $relatedProject):
                // Use the project card component with customized parameters
                $project = $relatedProject;
                $showAnimation = false;
                include 'components/ProjectCard.php';
            endforeach; 
            ?>
        </div>
    </div>
<?php 
    endif;
endif; 
?> 