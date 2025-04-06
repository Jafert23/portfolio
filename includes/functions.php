<?php
// includes/functions.php

function get_project_by_id($projects, $id) {
    foreach ($projects as $project) {
        if ($project['id'] === $id) {
            return $project;
        }
    }
    return null;
}

// Add CSRF token functions
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Get related projects based on the current project
 * 
 * @param array $projects All available projects
 * @param array $currentProject The current project being viewed
 * @param string $relationshipType Type of relationship ('category', 'technology', or 'both')
 * @param int $limit Maximum number of related projects to return
 * @return array Array of related projects
 */
function get_related_projects($projects, $currentProject, $relationshipType = 'category', $limit = 3) {
    $relatedProjects = [];
    
    // Get the current project's ID to exclude it from results
    $currentProjectId = $currentProject['id'];
    
    if ($relationshipType === 'category' || $relationshipType === 'both') {
        // Find projects in the same category
        $categoryRelated = array_filter($projects, function($p) use ($currentProject, $currentProjectId) {
            return $p['category'] === $currentProject['category'] && $p['id'] !== $currentProjectId;
        });
        
        $relatedProjects = array_merge($relatedProjects, $categoryRelated);
    }
    
    if ($relationshipType === 'technology' || $relationshipType === 'both') {
        // Get current project technologies as an array
        $currentTechs = explode(',', $currentProject['technologies']);
        $currentTechs = array_map('trim', $currentTechs);
        
        // Find projects with similar technologies
        foreach ($projects as $project) {
            // Skip the current project
            if ($project['id'] === $currentProjectId) {
                continue;
            }
            
            // Skip if already added via category
            if (in_array($project, $relatedProjects)) {
                continue;
            }
            
            // Get project technologies
            $projectTechs = explode(',', $project['technologies']);
            $projectTechs = array_map('trim', $projectTechs);
            
            // Check for technology overlap
            $commonTechs = array_intersect($currentTechs, $projectTechs);
            
            // If there are at least 2 common technologies, consider it related
            if (count($commonTechs) >= 2) {
                $relatedProjects[] = $project;
            }
        }
    }
    
    // Shuffle the results for variety
    shuffle($relatedProjects);
    
    // Limit the number of results
    return array_slice($relatedProjects, 0, $limit);
}
