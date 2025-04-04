<?php
/**
 * Project Hero Component
 * 
 * Displays the hero section for a project page with breadcrumb navigation
 * 
 * @param array $project The project data array
 */

// Ensure required data exists
if (empty($project) || !is_array($project)) {
    return;
}

// Get project title with proper escaping
$projectTitle = htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8');
?>

<!-- Hero Section with Breadcrumbs -->
<div class="project-hero">
    <div class="container">
        
        <div class="hero-content">
            <h1><?php echo $projectTitle; ?></h1>
            
            <?php if (!empty($project['category'])): ?>
            <div class="project-category">
                <span class="category-badge">
                    <?php 
                    // Set icon based on category
                    $categoryIcon = 'fa-folder';
                    if ($project['category'] === 'websites') $categoryIcon = 'fa-globe';
                    else if ($project['category'] === 'art') $categoryIcon = 'fa-paint-brush';
                    else if ($project['category'] === 'misc') $categoryIcon = 'fa-star';
                    ?>
                    <i class="fas <?php echo $categoryIcon; ?>"></i>
                    <?php echo ucfirst(htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8')); ?>
                </span>
            </div>
            <?php endif; ?>
            
            <p class="project-summary">
                <?php echo htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8'); ?>
            </p>
            
        </div>
    </div>
</div> 