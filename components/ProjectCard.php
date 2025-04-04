<?php
/**
 * Project Card Component
 * 
 * Displays a single project card for use in the project gallery
 * 
 * @param array $project The project data array
 * @param bool $showAnimation Whether to show AOS animation (default: true)
 */

// Default parameters
$showAnimation = $showAnimation ?? true;
$animationAttributes = $showAnimation ? 'data-aos="zoom-in"' : '';

// Determine if this is an external link (like moodboard)
$isExternalLink = ($project['id'] === 'moodboard' && !empty($project['live_link']));
$projectLink = $isExternalLink 
    ? htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8')
    : 'project.php?id=' . htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8');
$targetAttribute = $isExternalLink ? 'target="_blank" rel="noopener noreferrer"' : '';
?>

<div class="project"
     data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>"
     <?php echo $animationAttributes; ?>
     <?php if ($isExternalLink): ?>
     data-live-link="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>"
     <?php endif; ?>>
     
    <a href="<?php echo $projectLink; ?>" 
       class="project-link"
       <?php echo $targetAttribute; ?>
       aria-label="View details of <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">

        <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
             alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> Thumbnail"
             loading="lazy">

        <div class="overlay">
            <h3><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
            
            <!-- Tech badges -->
            <div class="tech-badges">
                <?php
                $technologies = explode(',', $project['technologies']);
                $techCount = 0;
                foreach ($technologies as $tech):
                    $tech = trim($tech);
                    // Only show up to 3 tech badges
                    if ($techCount < 3 && !empty($tech)): 
                        $techCount++;
                ?>
                    <span class="tech-badge"><?php echo htmlspecialchars($tech); ?></span>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
            
            <p><?php echo htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
            
            <span class="view-project">View Project <i class="fas fa-arrow-right"></i></span>
        </div>
    </a>
</div> 