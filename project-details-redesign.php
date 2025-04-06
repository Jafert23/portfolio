<?php
// Include the projects data
include 'data/projects.php';

// Include functions
require_once 'includes/functions.php';

// Get the project ID from the URL and sanitize it
$projectId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

// Find the project using the function from functions.php
$project = get_project_by_id($projects, $projectId);

// If project not found, redirect to homepage
if (!$project) {
    header('Location: index.php');
    exit;
}

// Set the page title and meta description
$pageTitle = htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') . ' | Elliot Tindall';
$metaDescription = htmlspecialchars($project['short_description'], ENT_QUOTES, 'UTF-8');

// Include the header
include 'includes/header.php';

// Get related projects using our helper function
$relatedProjects = get_related_projects($projects, $project, 'both', 3);

// Get technologies as an array
$technologies = explode(',', $project['technologies']);
$technologies = array_map('trim', $technologies);
?>

<!-- Custom stylesheet for the redesigned project details page -->
<link rel="stylesheet" href="css/project-details-redesign.css">

<main>
    <div class="project-details-container container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-nav" data-aos="fade-up">
            <a href="project-search.php" class="breadcrumb-link">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
        </div>

        <!-- Project Header -->
        <header class="project-header" data-aos="fade-up">
            <h1 class="project-title"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
            
            <div class="project-meta">
                <div class="meta-item">
                    <span class="category-badge">
                        <?php echo htmlspecialchars(ucfirst($project['category']), ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                </div>
                
                <?php if (!empty($project['date'])): ?>
                <div class="meta-item">
                    <span class="meta-label">Date:</span>
                    <span class="meta-value"><?php echo htmlspecialchars($project['date'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($project['live_link']) && $project['live_link'] !== 'Not Currently Hosted'): ?>
                <div class="meta-item">
                    <a href="<?php echo htmlspecialchars($project['live_link'], ENT_QUOTES, 'UTF-8'); ?>" 
                       class="quick-link" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-external-link-alt"></i> View Live Site
                    </a>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($project['github_link'])): ?>
                <div class="meta-item">
                    <a href="<?php echo htmlspecialchars($project['github_link'], ENT_QUOTES, 'UTF-8'); ?>" 
                       class="quick-link github-link" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-github"></i> View Code
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </header>

        <!-- Project Layout (2-column on desktop, 1-column on mobile) -->
        <div class="project-layout">
            <!-- Left Column: Content -->
            <div class="project-content" data-aos="fade-up">
                <?php if (!empty($project['images']['screenshots']) && count($project['images']['screenshots']) > 0): ?>
                <!-- Featured Image (first screenshot) -->
                <div class="featured-image">
                    <img src="<?php echo htmlspecialchars($project['images']['screenshots'][0], ENT_QUOTES, 'UTF-8'); ?>" 
                         alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>"
                         loading="lazy">
                </div>
                <?php endif; ?>
                
                <!-- Project Description -->
                <div class="project-description">
                    <?php echo nl2br(htmlspecialchars($project['long_description'], ENT_QUOTES, 'UTF-8')); ?>
                </div>
                
                <!-- Technologies -->
                <div class="technologies-section">
                    <h2 class="section-title">Technologies Used</h2>
                    <div class="tech-tags">
                        <?php foreach ($technologies as $tech): ?>
                            <?php if (!empty(trim($tech))): ?>
                            <span class="tech-tag">
                                <?php echo htmlspecialchars($tech, ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Gallery -->
            <?php if (!empty($project['images']['screenshots']) && count($project['images']['screenshots']) > 1): ?>
            <div class="project-gallery" data-aos="fade-up" data-aos-delay="200">
                <h2 class="section-title">Project Gallery</h2>
                <div class="gallery-container<?php echo count($project['images']['screenshots']) > 3 ? ' many-images' : ''; ?>">
                    <?php 
                    // Skip the first image if it's already shown as featured
                    $galleryImages = array_slice($project['images']['screenshots'], 1);
                    
                    foreach ($galleryImages as $index => $image): 
                    ?>
                        <div class="gallery-item" data-image-index="<?php echo $index; ?>">
                            <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8') . ' screenshot ' . ($index + 2); ?>"
                                 loading="lazy">
                            
                            <div class="gallery-overlay">
                                <div class="gallery-caption">
                                    <i class="fas fa-search-plus"></i> View Larger
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <style>
            /* Enhanced gallery styles */
            .project-gallery {
                margin-bottom: calc(var(--spacing-unit) * 3);
            }

            .gallery-container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .gallery-container.many-images {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .gallery-container.many-images > div:first-child {
                grid-column: span 2;
                grid-row: span 2;
            }

            .gallery-item {
                position: relative;
                border-radius: var(--border-radius);
                overflow: hidden;
                box-shadow: var(--card-shadow);
                aspect-ratio: 16/9;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .gallery-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            }

            .gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .gallery-item:hover img {
                transform: scale(1.05);
            }

            .gallery-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, transparent 60%);
                opacity: 0;
                display: flex;
                align-items: flex-end;
                justify-content: center;
                padding: 1.5rem;
                transition: opacity 0.3s ease;
            }

            .gallery-item:hover .gallery-overlay {
                opacity: 1;
            }

            .gallery-caption {
                color: white;
                text-align: center;
                transform: translateY(20px);
                opacity: 0;
                transition: all 0.3s ease 0.1s;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 500;
            }

            .gallery-item:hover .gallery-caption {
                transform: translateY(0);
                opacity: 1;
            }

            @media (max-width: 768px) {
                .gallery-container {
                    grid-template-columns: 1fr;
                }
                
                .gallery-container.many-images {
                    grid-template-columns: repeat(2, 1fr);
                }
                
                .gallery-container.many-images > div:first-child {
                    grid-column: span 2;
                }
            }
            </style>
            <?php endif; ?>
        </div>
        
        <!-- Related Projects Section -->
        <?php include 'components/RelatedProjects.php'; ?>
        
        <!-- Lightbox for gallery images -->
        <div class="lightbox-overlay">
            <div class="lightbox-content">
                <img src="" alt="Project screenshot" id="lightbox-image">
                <button class="lightbox-close" aria-label="Close lightbox">×</button>
                
                <div class="lightbox-controls">
                    <div class="lightbox-nav">
                        <button class="lightbox-prev" aria-label="Previous image"><i class="fas fa-chevron-left"></i></button>
                        <button class="lightbox-next" aria-label="Next image"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    
                    <div class="lightbox-zoom-controls">
                        <button class="zoom-in" aria-label="Zoom in"><i class="fas fa-search-plus"></i></button>
                        <button class="zoom-out" aria-label="Zoom out"><i class="fas fa-search-minus"></i></button>
                        <button class="zoom-reset" aria-label="Reset zoom"><i class="fas fa-redo"></i></button>
                    </div>
                    
                    <div class="lightbox-counter">
                        <span id="current-image">1</span> / <span id="total-images">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- JavaScript for lightbox functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lightbox elements
    const lightboxOverlay = document.querySelector('.lightbox-overlay');
    const lightboxImage = document.querySelector('#lightbox-image');
    const lightboxClose = document.querySelector('.lightbox-close');
    const lightboxPrev = document.querySelector('.lightbox-prev');
    const lightboxNext = document.querySelector('.lightbox-next');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const currentImageEl = document.getElementById('current-image');
    const totalImagesEl = document.getElementById('total-images');
    
    // Zoom elements
    const zoomIn = document.querySelector('.zoom-in');
    const zoomOut = document.querySelector('.zoom-out');
    const zoomReset = document.querySelector('.zoom-reset');
    
    // Zoom variables
    let zoomLevel = 1;
    const zoomFactor = 0.2;
    const maxZoom = 3;
    const minZoom = 1;
    
    // Image dragging variables
    let isDragging = false;
    let startX, startY, translateX = 0, translateY = 0;
    
    // Gallery images array
    const galleryImages = [];
    galleryItems.forEach(item => {
        const imgSrc = item.querySelector('img').src;
        galleryImages.push(imgSrc);
    });
    
    // Update total image count
    totalImagesEl.textContent = galleryImages.length;
    
    let currentImageIndex = 0;
    
    // Open lightbox on gallery item click
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            const imgSrc = this.querySelector('img').src;
            lightboxImage.src = imgSrc;
            currentImageIndex = index;
            updateImageCounter();
            lightboxOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
            resetZoom();
        });
    });
    
    function updateImageCounter() {
        currentImageEl.textContent = currentImageIndex + 1;
    }
    
    // Close lightbox
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxOverlay.addEventListener('click', function(e) {
        if (e.target === lightboxOverlay) {
            closeLightbox();
        }
    });
    
    function closeLightbox() {
        lightboxOverlay.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
        resetZoom();
    }
    
    // Previous image
    lightboxPrev.addEventListener('click', function() {
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        lightboxImage.src = galleryImages[currentImageIndex];
        updateImageCounter();
        resetZoom();
    });
    
    // Next image
    lightboxNext.addEventListener('click', function() {
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        lightboxImage.src = galleryImages[currentImageIndex];
        updateImageCounter();
        resetZoom();
    });
    
    // Zoom functions
    function resetZoom() {
        zoomLevel = 1;
        translateX = 0;
        translateY = 0;
        updateImageTransform();
    }
    
    function updateImageTransform() {
        lightboxImage.style.transform = `scale(${zoomLevel}) translate(${translateX}px, ${translateY}px)`;
    }
    
    // Zoom events
    zoomIn.addEventListener('click', function() {
        zoomLevel = Math.min(maxZoom, zoomLevel + zoomFactor);
        updateImageTransform();
    });
    
    zoomOut.addEventListener('click', function() {
        zoomLevel = Math.max(minZoom, zoomLevel - zoomFactor);
        updateImageTransform();
    });
    
    zoomReset.addEventListener('click', resetZoom);
    
    // Mouse wheel zoom
    lightboxImage.addEventListener('wheel', function(e) {
        e.preventDefault();
        
        // Zoom in or out based on scroll direction
        if (e.deltaY < 0) {
            // Zoom in
            zoomLevel = Math.min(maxZoom, zoomLevel + zoomFactor);
        } else {
            // Zoom out
            zoomLevel = Math.max(minZoom, zoomLevel - zoomFactor);
        }
        
        updateImageTransform();
    });
    
    // Image dragging
    lightboxImage.addEventListener('mousedown', function(e) {
        if (zoomLevel > 1) {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            lightboxImage.style.cursor = 'grabbing';
        }
    });
    
    document.addEventListener('mousemove', function(e) {
        if (isDragging && zoomLevel > 1) {
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            updateImageTransform();
        }
    });
    
    document.addEventListener('mouseup', function() {
        if (isDragging) {
            isDragging = false;
            lightboxImage.style.cursor = 'move';
        }
    });
    
    // Touch events for mobile
    lightboxImage.addEventListener('touchstart', function(e) {
        if (zoomLevel > 1 && e.touches.length === 1) {
            isDragging = true;
            startX = e.touches[0].clientX - translateX;
            startY = e.touches[0].clientY - translateY;
        }
    });
    
    lightboxImage.addEventListener('touchmove', function(e) {
        if (isDragging && zoomLevel > 1 && e.touches.length === 1) {
            translateX = e.touches[0].clientX - startX;
            translateY = e.touches[0].clientY - startY;
            updateImageTransform();
            e.preventDefault(); // Prevent page scrolling while dragging
        }
    });
    
    lightboxImage.addEventListener('touchend', function() {
        isDragging = false;
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightboxOverlay.classList.contains('active')) return;
        
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            lightboxPrev.click();
        } else if (e.key === 'ArrowRight') {
            lightboxNext.click();
        } else if (e.key === '+' || e.key === '=') {
            zoomIn.click();
        } else if (e.key === '-') {
            zoomOut.click();
        } else if (e.key === '0') {
            zoomReset.click();
        }
    });
    
    // Add touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    
    lightboxOverlay.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    lightboxOverlay.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - next image
            lightboxNext.click();
        } else if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - previous image
            lightboxPrev.click();
        }
    }
});
</script>

<style>
/* Enhanced lightbox styles */
.lightbox-overlay {
    backdrop-filter: blur(3px);
}

.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#lightbox-image {
    max-width: 100%;
    max-height: 80vh;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    border-radius: 4px;
    transition: transform 0.3s ease;
    cursor: move;
}

.lightbox-close {
    position: absolute;
    top: -40px;
    right: -10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    color: white;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
}

.lightbox-close:hover {
    background: rgba(255,255,255,0.3);
}

.lightbox-controls {
    margin-top: 1rem;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
    color: white;
}

.lightbox-nav, .lightbox-zoom-controls {
    display: flex;
    gap: 0.5rem;
}

.lightbox-controls button {
    background: rgba(255,255,255,0.15);
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.lightbox-controls button:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.lightbox-counter {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
}

@media (max-width: 768px) {
    .lightbox-controls {
        flex-direction: column;
        align-items: center;
    }
    
    #lightbox-image {
        max-height: 70vh;
    }
}
</style>

<style>
/* Enhanced header styles */
.project-header {
    position: relative;
    margin-bottom: 3rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

body.dark-mode .project-header {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.project-title {
    font-size: 2.75rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    line-height: 1.2;
    position: relative;
}

.project-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: center;
}

.meta-item {
    display: flex;
    align-items: center;
}

.meta-label {
    color: var(--text-secondary);
    margin-right: 0.5rem;
    font-weight: 500;
}

.meta-value {
    font-weight: 500;
    color: var(--text-primary);
}

.category-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.4rem 1rem;
    background-color: var(--primary-color);
    color: white;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
}

.quick-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    padding: 0.4rem 0.75rem;
    border-radius: 4px;
    background: rgba(58, 134, 255, 0.1);
}

.quick-link:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.quick-link.github-link {
    background: rgba(33, 33, 33, 0.1);
    color: #333;
}

body.dark-mode .quick-link.github-link {
    color: #e2e8f0;
    background: rgba(255, 255, 255, 0.1);
}

.quick-link.github-link:hover {
    background: #333;
    color: white;
}

@media (max-width: 768px) {
    .project-title {
        font-size: 2rem;
    }
    
    .project-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .meta-item:first-child {
        margin-bottom: 0.5rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?> 