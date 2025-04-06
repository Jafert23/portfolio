<?php
// Include the projects data
include 'data/projects.php';

// Set the page title
$pageTitle = 'Elliot Tindall | Portfolio';
$metaDescription = 'Explore Elliot Tindall\'s portfolio featuring web development, design, and creative projects.';

// Include the header
include 'includes/header.php';

// Define featured projects (can be customized)
$featuredProjectIds = ['project3', 'project2', 'project4'];
?>

<!-- Custom stylesheet for the redesigned projects page -->
<link rel="stylesheet" href="css/projects-redesign.css">

<main>
    <section class="projects-showcase container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2>My Projects</h2>
            <p class="showcase-intro">
                Explore my collection of work spanning web development, design, and creative experiments. 
                Each project reflects my passion for clean code, intuitive user experience, and innovative design.
            </p>
            
            <!-- Search link -->
            <div class="search-link-container" style="margin-top: 1.5rem;">
                <a href="project-search.php" class="search-link-button" style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: var(--primary-color); color: white; text-decoration: none; border-radius: 4px; font-weight: 500; transition: all 0.3s ease;">
                    <i class="fas fa-search" style="margin-right: 0.5rem;"></i> Advanced Project Search
                </a>
            </div>
        </div>

        <!-- Advanced filtering system -->
        <div class="filter-system" data-aos="fade-up">
            <button class="filter-button active" data-filter="all">All Projects</button>
            <button class="filter-button" data-filter="websites">Web Development</button>
            <button class="filter-button" data-filter="art">Design & Art</button>
            <button class="filter-button" data-filter="misc">Other</button>
        </div>

        <!-- Projects grid with improved card design -->
        <div class="projects-grid" data-aos="fade-up">
            <?php foreach ($projects as $index => $project): 
                // Determine if this is a featured project
                $isFeatured = in_array($project['id'], $featuredProjectIds);
                
                // Get the first three technologies for the preview
                $techList = explode(',', $project['technologies']);
                $previewTechs = array_slice($techList, 0, 3);
                
                // Clean up the technology names
                $previewTechs = array_map('trim', $previewTechs);
            ?>
                <div class="project-card <?php echo $isFeatured ? 'featured' : ''; ?>" 
                     data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>">
                    
                    <!-- Card image -->
                    <div class="card-image">
                        <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"
                             loading="lazy">
                        
                        <!-- Project type badge -->
                        <div class="project-type">
                            <?php echo htmlspecialchars(ucfirst($project['category']), ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        
                        <!-- Featured badge if applicable -->
                        <?php if ($isFeatured): ?>
                        <div class="featured-badge">
                            Featured
                        </div>
                        <?php endif; ?>
                        
                        <!-- Hover overlay with actions -->
                        <div class="card-hover-overlay">
                            <div class="overlay-actions">
                                <a href="project-details-redesign.php?id=<?php echo htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   class="overlay-btn">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                
                                <?php if (!empty($project['live_link']) && $project['live_link'] !== 'Not Currently Hosted'): ?>
                                <a href="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="overlay-btn">
                                    <i class="fas fa-external-link-alt"></i> Live Demo
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card content -->
                    <div class="card-content">
                        <h3 class="card-title">
                            <?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        
                        <p class="card-description">
                            <?php echo htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        
                        <!-- Technology tags preview -->
                        <div class="tech-stack">
                            <?php foreach ($previewTechs as $tech): ?>
                                <span class="tech-tag">
                                    <?php echo htmlspecialchars($tech, ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            <?php endforeach; ?>
                            
                            <?php if (count($techList) > 3): ?>
                                <span class="tech-tag">+<?php echo count($techList) - 3; ?> more</span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Card footer with actions -->
                        <div class="card-footer">
                            <a href="project-details-redesign.php?id=<?php echo htmlspecialchars($project['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                               class="view-project">
                                View Project <i class="fas fa-arrow-right"></i>
                            </a>
                            
                            <?php if (!empty($project['live_link']) && $project['live_link'] !== 'Not Currently Hosted'): ?>
                            <a href="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="live-demo">
                                Live Demo <i class="fas fa-external-link-alt"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Loading animation for when filtering -->
        <div class="loading-animation">
            <div class="loading-spinner"></div>
            <p>Loading projects...</p>
        </div>
    </section>
</main>

<!-- Optional: Add Masonry.js for improved layout -->
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>

<!-- Custom JavaScript for the projects page -->
<script src="js/projects-redesign.js"></script>

<?php include 'includes/footer.php'; ?> 