<?php
/**
 * Related Projects Component
 * Displays a grid of related projects based on the currently viewed project
 * 
 * @param array $relatedProjects - Array of project data for related projects
 */

// Don't display anything if there are no related projects
if (empty($relatedProjects)) {
    return;
}
?>

<div class="related-projects" data-aos="fade-up">
    <h2 class="related-title">Related Projects</h2>
    <div class="related-grid">
        <?php foreach ($relatedProjects as $relatedProject): 
            // Get technologies as an array for display
            $relatedTechList = explode(',', $relatedProject['technologies']);
            $relatedTechList = array_map('trim', $relatedTechList);
            // Get only the first 2 technologies for a more compact display
            $previewTechs = array_slice($relatedTechList, 0, 2);
        ?>
        <div class="project-card" data-aos="fade-up">
            <!-- Card image -->
            <div class="card-image">
                <img src="<?php echo htmlspecialchars($relatedProject['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
                     alt="<?php echo htmlspecialchars($relatedProject['title'], ENT_QUOTES, 'UTF-8'); ?>"
                     loading="lazy">
                
                <!-- Project type badge -->
                <div class="project-type">
                    <?php echo htmlspecialchars(ucfirst($relatedProject['category']), ENT_QUOTES, 'UTF-8'); ?>
                </div>
                
                <!-- Hover overlay with actions -->
                <div class="card-hover-overlay">
                    <div class="overlay-actions">
                        <a href="project-details-redesign.php?id=<?php echo htmlspecialchars($relatedProject['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                           class="overlay-btn">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card content -->
            <div class="card-content">
                <h3 class="card-title">
                    <?php echo htmlspecialchars($relatedProject['title'], ENT_QUOTES, 'UTF-8'); ?>
                </h3>
                
                <p class="card-description">
                    <?php echo htmlspecialchars($relatedProject['short_description'], ENT_QUOTES, 'UTF-8'); ?>
                </p>
                
                <!-- Technology tags preview -->
                <div class="tech-stack">
                    <?php foreach ($previewTechs as $tech): ?>
                        <span class="tech-tag">
                            <?php echo htmlspecialchars($tech, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    <?php endforeach; ?>
                    
                    <?php if (count($relatedTechList) > 2): ?>
                        <span class="tech-tag more-tag">+<?php echo count($relatedTechList) - 2; ?> more</span>
                    <?php endif; ?>
                </div>
                
                <!-- View project link -->
                <div class="related-project-action">
                    <a href="project-details-redesign.php?id=<?php echo htmlspecialchars($relatedProject['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                       class="view-related-project">
                        View Project <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
/* Styles for related projects component */
.related-projects {
    margin-top: 4rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(0,0,0,0.1);
}

body.dark-mode .related-projects {
    border-top: 1px solid rgba(255,255,255,0.1);
}

.related-title {
    font-size: 2rem;
    margin-bottom: 2rem;
    text-align: center;
    color: var(--text-primary);
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.related-grid .project-card {
    transform: scale(0.98);
    transition: all 0.3s ease;
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    display: flex;
    flex-direction: column;
    height: 100%;
}

body.dark-mode .related-grid .project-card {
    background: var(--dark-bg);
}

.related-grid .project-card:hover {
    transform: scale(1);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.related-grid .card-image {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16/9;
}

.related-grid .card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.related-grid .project-card:hover .card-image img {
    transform: scale(1.05);
}

.related-grid .project-type {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--primary-color);
    color: white;
    padding: 0.35rem 0.85rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    z-index: 1;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
}

.related-grid .card-hover-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.65) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.5s ease;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    padding-bottom: 2rem;
}

.related-grid .project-card:hover .card-hover-overlay {
    opacity: 1;
}

.related-grid .overlay-actions {
    display: flex;
    gap: 1rem;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.5s ease 0.1s;
}

.related-grid .project-card:hover .overlay-actions {
    transform: translateY(0);
    opacity: 1;
}

.related-grid .overlay-btn {
    background: rgba(255, 255, 255, 0.9);
    color: var(--secondary-color);
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.related-grid .overlay-btn:hover {
    background: var(--primary-color);
    color: white;
}

.related-grid .card-content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.related-grid .card-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: var(--text-light);
    line-height: 1.3;
}

.related-grid .card-description {
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    color: var(--text-secondary);
}

.related-grid .tech-stack {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.related-grid .tech-tag {
    background: var(--tech-tag-bg);
    color: var(--tech-tag-color);
    padding: 0.25rem 0.6rem;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.related-grid .more-tag {
    background: rgba(0,0,0,0.05);
    color: #666;
}

body.dark-mode .related-grid .more-tag {
    background: rgba(255,255,255,0.1);
    color: #aaa;
}

.related-grid .tech-tag:hover {
    transform: translateY(-2px);
}

.related-project-action {
    margin-top: auto;
    padding-top: 0.5rem;
}

.view-related-project {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.view-related-project i {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.view-related-project:hover {
    color: var(--accent-color);
}

.view-related-project:hover i {
    transform: translateX(3px);
}

@media (max-width: 768px) {
    .related-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    .related-title {
        font-size: 1.75rem;
    }
}
</style> 