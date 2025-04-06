<?php
// Include the enhanced projects data
include 'data/projects-enhanced.php';

// Set the page title
$pageTitle = 'Projects | Elliot Tindall | Web Development, Design & Art';
$metaDescription = 'Explore the portfolio projects of Elliot Tindall, including web development, design, art, and other works. Search and filter by category or technology.';

// Process search query if submitted
$searchQuery = '';
$searchResults = [];
$selectedTech = '';
$techFilterResults = [];
$featuredProjects = get_featured_projects($projects);

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $searchQuery = trim($_GET['query']);
    $searchResults = search_projects($projects, $searchQuery);
}

if (isset($_GET['tech']) && !empty($_GET['tech'])) {
    $selectedTech = trim($_GET['tech']);
    $techFilterResults = get_projects_by_technology($projects, $selectedTech);
}

// Get all unique tech tags for the filter dropdown
$allTechTags = [];
foreach ($projects as $project) {
    if (isset($project['tech_tags']) && is_array($project['tech_tags'])) {
        foreach ($project['tech_tags'] as $tag) {
            if (!in_array($tag, $allTechTags)) {
                $allTechTags[] = $tag;
            }
        }
    }
}
sort($allTechTags); // Sort alphabetically

// Include the header
include 'includes/header.php';
?>

<!-- Custom stylesheets -->
<link rel="stylesheet" href="css/projects-redesign.css">
<style>
    /* Additional search-specific styles */
    .search-container {
        max-width: 800px;
        margin: 0 auto 3rem;
    }
    
    .search-form {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .search-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }
    
    .search-button {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .search-button:hover {
        background: #0066cc;
    }
    
    .filter-container {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .tech-filter {
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        min-width: 200px;
    }
    
    .search-results-info {
        margin-bottom: 2rem;
        padding: 1rem;
        background:none;
        border-radius: 4px;
        font-size: 0.95rem;
    }
    
    .no-results {
        text-align: center;
        padding: 3rem 1rem;
        background:none;
        border-radius: 8px;
    }
    
    .no-results h3 {
        margin-bottom: 1rem;
        color: #666;
    }
    
    .search-suggestions {
        margin-top: 2rem;
    }
    
    .search-suggestions ul {
        list-style: disc;
        margin-left: 1.5rem;
    }
    
    .section-divider {
        border-top: 1px solid #eee;
        margin: 3rem 0;
    }
    
    /* Fixed project grid layout - center cards */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin: 0 auto;
        justify-content: center;
    }
    
    /* For larger screens, limit to 3 columns and center */
    @media (min-width: 992px) {
        .projects-grid {
            grid-template-columns: repeat(3, minmax(300px, 350px));
            justify-content: center;
        }
        
        /* Featured projects specific - 2 columns */
        .featured-projects {
            grid-template-columns: repeat(2, minmax(300px, 450px));
            max-width: 950px;
            gap: 2.5rem;
        }
    }
    
    /* For medium screens */
    @media (max-width: 991px) and (min-width: 768px) {
        .projects-grid {
            grid-template-columns: repeat(2, minmax(300px, 1fr));
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Featured projects also use 2 columns but with more width */
        .featured-projects {
            max-width: 850px;
        }
    }
    
    /* For small screens */
    @media (max-width: 767px) {
        .projects-grid {
            grid-template-columns: minmax(280px, 1fr);
            max-width: 400px;
            margin: 0 auto;
        }
    }
    
    /* Make project cards fill their grid area */
    .project-card {
        height: 100%;
        width: 100%;
        margin: 0 auto;
    }
    
    /* Center the category filtered results */
    .category-filtered-results {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
        }
    }
    
    /* Category filter tabs */
    .category-filter-container {
        margin-bottom: 3rem;
    }
    
    .filter-title {
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        font-weight: 600;
    }
    
    .category-tabs {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    
    .category-tab {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.25rem;
        background: white;
        border: 2px solid transparent;
        border-radius: 12px;
        min-width: 140px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        /* Fix for button styling */
        font-family: inherit;
        outline: none;
    }
    
    .category-tab i {
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
        color: var(--text-secondary);
        transition: all 0.3s ease;
    }
    
    .category-tab span {
        font-weight: 500;
        color: var(--text-secondary);
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    
    .category-tab:hover {
        transform: translateY(-5px);
        border-color: var(--primary-color);
    }
    
    .category-tab:hover i,
    .category-tab:hover span {
        color: var(--primary-color);
    }
    
    .category-tab.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        transform: translateY(-5px);
        /* Ensure active state is visible */
        box-shadow: 0 8px 20px rgba(58, 134, 255, 0.3);
    }
    
    .category-tab.active i,
    .category-tab.active span {
        color: white;
    }
    
    
    /* Responsive styles for category tabs */
    @media (max-width: 768px) {
        .category-tabs {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .category-tab {
            min-width: 110px;
            padding: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .category-tab {
            min-width: 100px;
            padding: 0.75rem;
        }
        
        .category-tab i {
            font-size: 1.5rem;
        }
    }
</style>

<main>
    <section class="projects-showcase container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2>Project Portfolio</h2>
            <p class="showcase-intro">
                Welcome to my portfolio! Browse through my projects below, or use the search and filter options 
                to find specific technologies and solutions that interest you.
            </p>
        </div>
        
        <!-- Category Filter Tabs -->
        <div class="category-filter-container" data-aos="fade-up">
            <h3 class="filter-title">Browse by Category</h3>
            <div class="category-tabs" id="category-tabs">
                <button type="button" class="category-tab" data-category="all">
                    <i class="fas fa-th-large"></i>
                    <span>All Projects</span>
                </button>
                <button type="button" class="category-tab" data-category="websites">
                    <i class="fas fa-laptop-code"></i>
                    <span>Web Development</span>
                </button>
                <button type="button" class="category-tab" data-category="art">
                    <i class="fas fa-paint-brush"></i>
                    <span>Design & Art</span>
                </button>
                <button type="button" class="category-tab" data-category="misc">
                    <i class="fas fa-file-alt"></i>
                    <span>Resume & Other</span>
                </button>
            </div>
        </div>
        
        <!-- Search Form -->
        <div class="search-container" data-aos="fade-up">
            <form action="" method="GET" class="search-form">
                <input type="text" name="query" class="search-input" placeholder="Search projects..." 
                       value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="search-button">Search</button>
            </form>
            
            <!-- Technology Filter -->
            <div class="filter-container">
                <select name="tech" class="tech-filter" onchange="this.form.submit()">
                    <option value="">Filter by technology</option>
                    <?php foreach ($allTechTags as $tag): ?>
                        <option value="<?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?>"
                                <?php echo $selectedTech === $tag ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <?php if (!empty($selectedTech)): ?>
                    <a href="?<?php echo !empty($searchQuery) ? 'query=' . urlencode($searchQuery) : ''; ?>" 
                       class="search-button">Clear Filter</a>
                <?php endif; ?>
            </div>
            
            <!-- Search Results Info -->
            <?php if (!empty($searchQuery) || !empty($selectedTech)): ?>
                <div class="search-results-info">
                    <?php if (!empty($searchQuery) && empty($selectedTech)): ?>
                        <p>Showing results for: <strong><?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?></strong> 
                        (<?php echo count($searchResults); ?> projects found)</p>
                    <?php elseif (empty($searchQuery) && !empty($selectedTech)): ?>
                        <p>Showing projects using: <strong><?php echo htmlspecialchars($selectedTech, ENT_QUOTES, 'UTF-8'); ?></strong> 
                        (<?php echo count($techFilterResults); ?> projects found)</p>
                    <?php else: ?>
                        <p>Showing results for: <strong><?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?></strong> 
                        using <strong><?php echo htmlspecialchars($selectedTech, ENT_QUOTES, 'UTF-8'); ?></strong></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Search Results -->
        <?php if (!empty($searchQuery) || !empty($selectedTech)): ?>
            <div class="projects-grid filtered-results" data-aos="fade-up">
                <?php 
                // Determine which results to show
                $resultsToShow = [];
                if (!empty($searchQuery) && !empty($selectedTech)) {
                    // Intersection of search and tech filter results
                    $searchResultIds = array_map(function($p) { return $p['id']; }, $searchResults);
                    $resultsToShow = array_filter($techFilterResults, function($p) use ($searchResultIds) {
                        return in_array($p['id'], $searchResultIds);
                    });
                } elseif (!empty($searchQuery)) {
                    $resultsToShow = $searchResults;
                } elseif (!empty($selectedTech)) {
                    $resultsToShow = $techFilterResults;
                }
                
                if (empty($resultsToShow)):
                ?>
                    <div class="no-results">
                        <h3>No projects found matching your criteria</h3>
                        <p>Try adjusting your search terms or browse the featured projects below.</p>
                    </div>
                <?php 
                else:
                    // Display search results
                    foreach ($resultsToShow as $project): 
                        // Get the first three technologies for the preview
                        $techList = isset($project['tech_tags']) ? $project['tech_tags'] : explode(',', $project['technologies']);
                        if (!is_array($techList)) {
                            $techList = explode(',', $project['technologies']);
                        }
                        $previewTechs = array_slice($techList, 0, 3);
                        
                        // Clean up the technology names
                        $previewTechs = array_map('trim', $previewTechs);
                        
                        // Debug output for art projects
                        if ($project['category'] === 'art') {
                            echo "<!-- Debug: Art project found: " . htmlspecialchars($project['title']) . " -->";
                        }
                ?>
                    <div class="project-card" data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>">
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
                            <?php if (isset($project['featured']) && $project['featured']): ?>
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
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>
            
            <div class="section-divider"></div>
        <?php endif; ?>
        
        <!-- Featured Projects (shown if no search/filter or as additional content) -->
        <?php if (empty($searchQuery) && empty($selectedTech) || (count($resultsToShow ?? []) === 0)): ?>
            <div class="section-header text-center featured-projects-header" data-aos="fade-up">
                <h2>Featured Projects</h2>
                <p class="showcase-intro">
                    Explore some of my highlighted work across different categories.
                </p>
            </div>
            
            <div class="projects-grid featured-projects" data-aos="fade-up">
                <?php 
                // Add counts by category for debugging
                $categoryProjectCount = array('websites' => 0, 'art' => 0, 'misc' => 0);
                
                foreach ($featuredProjects as $project): 
                    // Count projects by category
                    $categoryProjectCount[$project['category']]++;
                    
                    // Get the first three technologies for the preview
                    $techList = isset($project['tech_tags']) ? $project['tech_tags'] : explode(',', $project['technologies']);
                    if (!is_array($techList)) {
                        $techList = explode(',', $project['technologies']);
                    }
                    $previewTechs = array_slice($techList, 0, 3);
                    
                    // Clean up the technology names
                    $previewTechs = array_map('trim', $previewTechs);
                    
                    // Construct alt text for featured projects
                    $featuredAltText = 'Featured project: ' . htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') . '. Category: ' . htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8') . '.';
                    
                    // Debug output for art projects
                    if ($project['category'] === 'art') {
                        echo "<!-- Debug: Art project found in featured: " . htmlspecialchars($project['title']) . " -->";
                    }
                ?>
                    <div class="project-card featured" data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>">
                        <!-- Card image -->
                        <div class="card-image">
                            <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
                                 alt="<?php echo $featuredAltText; ?>"
                                 loading="lazy">
                            
                            <!-- Project type badge -->
                            <div class="project-type">
                                <?php echo htmlspecialchars(ucfirst($project['category']), ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            
                            <!-- Featured badge -->
                            <div class="featured-badge">
                                Featured
                            </div>
                            
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
                
                <?php 
                // Add the debug output for category counts
                echo "<!-- Debug: Project counts by category: " .
                     "websites: " . $categoryProjectCount['websites'] . ", " .
                     "art: " . $categoryProjectCount['art'] . ", " .
                     "misc: " . $categoryProjectCount['misc'] . " -->";
                ?>
            </div>
            
            <!-- Search Suggestions -->
            <?php if (count($resultsToShow ?? []) === 0 && (!empty($searchQuery) || !empty($selectedTech))): ?>
                <div class="search-suggestions" data-aos="fade-up">
                    <h3>Search Suggestions:</h3>
                    <ul>
                        <li>Check your spelling</li>
                        <li>Try more general keywords</li>
                        <li>Try different keywords</li>
                        <li>Try searching for technologies like "React", "JavaScript", or "UI Design"</li>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</main>

<!-- Add scripts -->
<script src="js/projects-redesign.js"></script>

<!-- Add a hidden container with all projects for category filtering -->
<div class="projects-grid all-projects" style="display: none;">
    <?php foreach ($projects as $project): 
        // Get the first three technologies for the preview
        $techList = isset($project['tech_tags']) ? $project['tech_tags'] : explode(',', $project['technologies']);
        if (!is_array($techList)) {
            $techList = explode(',', $project['technologies']);
        }
        $previewTechs = array_slice($techList, 0, 3);
        
        // Clean up the technology names
        $previewTechs = array_map('trim', $previewTechs);
        
        // Construct alt text
        $altText = 'Thumbnail for project: ' . htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') . '. Category: ' . htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8') . '.';
    ?>
        <div class="project-card" data-category="<?php echo htmlspecialchars($project['category'], ENT_QUOTES, 'UTF-8'); ?>">
            <!-- Card image -->
            <div class="card-image">
                <img src="<?php echo htmlspecialchars($project['images']['thumb'], ENT_QUOTES, 'UTF-8'); ?>" 
                     alt="<?php echo $altText; ?>"
                     loading="lazy">
                
                <!-- Project type badge -->
                <div class="project-type">
                    <?php echo htmlspecialchars(ucfirst($project['category']), ENT_QUOTES, 'UTF-8'); ?>
                </div>
                
                <!-- Featured badge if applicable -->
                <?php if (isset($project['featured']) && $project['featured']): ?>
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

<!-- Extra initialization for category tabs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Additional initialization to ensure category tabs work
    const categoryTabs = document.querySelectorAll('.category-tab');
    const searchContainer = document.querySelector('.search-container');
    const projectCards = document.querySelectorAll('.project-card');
    const featuredSection = document.querySelector('.featured-projects-header');
    const featuredProjects = document.querySelector('.featured-projects');
    const allProjectsContainer = document.querySelector('.all-projects');
    
    console.log("Project Search Page - Found " + categoryTabs.length + " category tabs");
    
    // Debug projects by category
    console.log("Checking all project cards and their categories:");
    const categoryCounts = {};
    projectCards.forEach(card => {
        const category = card.getAttribute('data-category');
        const title = card.querySelector('.card-title')?.textContent.trim() || 'Unknown';
        console.log(`Project "${title}" has category: "${category}"`);
        categoryCounts[category] = (categoryCounts[category] || 0) + 1;
    });
    console.log("Category counts:", categoryCounts);
    
    if (categoryTabs.length > 0) {
        categoryTabs.forEach(tab => {
            const tabCategory = tab.getAttribute('data-category');
            console.log("Binding click event to category: " + tabCategory);
            
            tab.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();
                
                const clickedCategory = this.getAttribute('data-category');
                console.log("Category tab clicked: " + clickedCategory);
                
                // Visual feedback first
                categoryTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Hide the featured projects section when category filter is active
                if (clickedCategory !== 'all' && featuredSection && featuredProjects) {
                    featuredSection.style.display = 'none';
                    featuredProjects.style.display = 'none';
                } else if (featuredSection && featuredProjects) {
                    featuredSection.style.display = 'block';
                    featuredProjects.style.display = 'grid';
                }
                
                // Show filtered projects in a new container
                if (clickedCategory !== 'all') {
                    // Create a new container for filtered results if it doesn't exist
                    let filteredContainer = document.querySelector('.category-filtered-results');
                    if (!filteredContainer) {
                        filteredContainer = document.createElement('div');
                        filteredContainer.className = 'projects-grid category-filtered-results';
                        filteredContainer.setAttribute('data-aos', 'fade-up');
                        
                        // Insert before the featured projects section
                        if (featuredSection) {
                            featuredSection.parentNode.insertBefore(filteredContainer, featuredSection);
                        } else {
                            document.querySelector('.projects-showcase').appendChild(filteredContainer);
                        }
                    }
                    
                    // Clear existing content
                    filteredContainer.innerHTML = '';
                    
                    // Clone matching projects from all-projects
                    if (allProjectsContainer) {
                        const matchingProjects = allProjectsContainer.querySelectorAll(`.project-card[data-category="${clickedCategory}"]`);
                        console.log(`Found ${matchingProjects.length} ${clickedCategory} projects to display`);
                        
                        matchingProjects.forEach(project => {
                            const clone = project.cloneNode(true);
                            clone.style.display = 'flex';
                            clone.style.opacity = '0';
                            filteredContainer.appendChild(clone);
                            
                            // Animate in
                            setTimeout(() => {
                                clone.style.opacity = '1';
                                clone.style.transform = 'translateY(0)';
                            }, 50);
                        });
                        
                        filteredContainer.style.display = 'grid';
                    }
                } else {
                    // Remove any category filtered results for "all" tab
                    const filteredContainer = document.querySelector('.category-filtered-results');
                    if (filteredContainer) {
                        filteredContainer.style.display = 'none';
                    }
                }
                
                // Ensure the search container scrolls into view - for ALL categories
                if (searchContainer) {
                    // Small delay to let any UI changes happen first
                    setTimeout(() => {
                        // Get position of search container
                        const searchContainerRect = searchContainer.getBoundingClientRect();
                        const scrollPosition = window.pageYOffset + searchContainerRect.top - 100; 
                        
                        console.log("Scrolling to position: " + scrollPosition + "px for category: " + clickedCategory);
                        
                        // Scroll to position the search bar at the top of the viewport with smooth behavior
                        window.scrollTo({
                            top: scrollPosition,
                            behavior: 'smooth'
                        });
                    }, 300); // Increased delay for better reliability
                } else {
                    console.error("Search container not found!");
                }
            });
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?> 