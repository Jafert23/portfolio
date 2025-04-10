<?php
/**
 * Enhanced Projects Data Structure
 * Provides improved search and filtering capabilities
 */

$projects = [
    [
        // Moodboard
        'id' => 'moodboard',
        'title' => 'Moodboard',
        'short_description' => 'A React app that generates a moodboard based on a user-provided prompt.',
        'long_description' => 'Moodboard is a React app that generates a moodboard based on a user-provided prompt. It uses the Pexels API to help generate the moodboard.',
        'technologies' => 'React.js, Pexels API, JavaScript, HTML5, CSS3',
        'live_link' => 'https://moodboard.creativeelliot.com',
        'category' => 'websites',
        'images' => [
            'thumb' => 'images/moodboard/thumb.png',
            'screenshots' => [
                'images/moodboard/screenshot1.png',
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['React', 'JavaScript', 'HTML5', 'CSS3', 'Pexels API'],
        'featured' => true,
        'date' => '',
        'skills' => ['Frontend Development', 'API Integration', 'UI Design'],
        'type' => 'Web Application',
        'github_link' => 'https://github.com/Jafert23/MoodBoard-Machine.git',
        'keywords' => ['moodboard', 'inspiration', 'design', 'images']
    ],
    [
        // Environmental Sustainability & AI
        'id' => 'project4',
        'title' => 'Environmental Sustainability & AI',
        'short_description' => 'Research project exploring AI applications for environmental conservation and sustainability',
        'long_description' => "This project investigates how artificial intelligence can be harnessed to enhance environmental sustainability efforts.",
        'technologies' => 'React.js, Node.js, JavaScript, HTML5, CSS3, Adobe Illustrator',
        'live_link' => 'https://ai-sustainability.creativeelliot.com',
        'category' => 'websites',
        'images' => [
            'thumb' => 'images/ai-sustainability/thumb.png',
            'screenshots' => [
                'images/ai-sustainability/screenshot1.png',
                'images/ai-sustainability/screenshot2.png',
                'images/ai-sustainability/screenshot3.png',
                'images/ai-sustainability/screenshot4.png'
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['React', 'Node.js', 'JavaScript', 'HTML5', 'CSS3'],
        'featured' => true,
        'date' => '',
        'skills' => ['Web Development', 'Research', 'Data Visualization'],
        'type' => 'Research Website',
        'github_link' => '',
        'keywords' => ['environment', 'sustainability', 'AI', 'climate']
    ],
    [
        // Well/Informed
        'id' => 'project3',
        'title' => 'Well/Informed',
        'short_description' => 'Medical research platform that simplifies complex information using AI-generated summaries',
        'long_description' => "Well/Informed is a digital platform designed to simplify and centralize complex medical information. By aggregating research articles, clinical trials, and expert knowledge, it provides users with AI-generated summaries, making vast medical data more accessible and easier to understand for both professionals and the general public.",
        'technologies' => 'React.js, Node.js, Express.js, OpenAI API, PubMed API, Firebase',
        'live_link' => 'https://wellinformed.web.app/',
        'category' => 'websites',
        'images' => [
            'thumb' => 'images/project3/thumb.png',
            'screenshots' => [
                'images/project3/screenshot1.png',
                'images/project3/screenshot2.png',
                'images/project3/screenshot3.png',
                'images/project3/screenshot5.jpg',
                'images/project3/screenshot6.jpg',
                'images/project3/screenshot7.jpg',
                'images/project3/screenshot8.jpg',
                'images/project3/screenshot9.jpg',
                'images/project3/screenshot10.jpg',
                'images/project3/screenshot11.jpg',
                'images/project3/screenshot12.jpg',
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['React', 'Node.js', 'Express', 'OpenAI', 'PubMed API', 'Firebase'],
        'featured' => false,
        'date' => '',
        'skills' => ['Full-stack Development', 'API Integration', 'AI Implementation'],
        'type' => 'Web Platform',
        'github_link' => 'https://github.com/Jafert23/WELLINFORMED-BUILD.git',
        'keywords' => ['medical', 'healthcare', 'research', 'AI', 'summaries']
    ],
    [
        // Discover Japan
        'id' => 'project2',
        'title' => 'Discover Japan - A Personal Travel Guide',
        'short_description' => 'Interactive travel guide showcasing Japanese culture, destinations, and personal experiences',
        'long_description' => "Discover Japan - A Personal Travel Guide is an insightful project inspired by my memorable journey through Japan. The guide offers a curated exploration of the country's rich culture, history, and natural beauty, aimed at travelers seeking an authentic Japanese experience.",
        'technologies' => 'HTML5, CSS3, JavaScript, Responsive Design',
        'live_link' => 'https://japan.creativeelliot.com', 
        'category' => 'websites',
        'images' => [
            'thumb' => 'images/project2/thumb.png',
            'screenshots' => [
                'images/project2/screenshot1.png',
                'images/project2/screenshot2.png',
                'images/project2/screenshot3.png',
                'images/project2/screenshot4.png',
                'images/project2/screenshot5.png',
                'images/project2/screenshot6.png',
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['HTML5', 'CSS3', 'JavaScript', 'Responsive Design'],
        'featured' => true,
        'date' => '',
        'skills' => ['Web Design', 'Content Creation', 'Photography'],
        'type' => 'Travel Website',
        'github_link' => '',
        'keywords' => ['japan', 'travel', 'guide', 'culture', 'interactive']
    ],
    [
        // Meta Frontend Developer Capstone
        'id' => 'Meta Frontend Developer Capstone',
        'title' => 'Meta Frontend Developer Capstone',
        'short_description' => 'Little Lemon restaurant Website',
        'long_description' => 'The Final Project of my 7 week Front-End Developer Course',
        'technologies' => 'HTML, CSS, JavaScript, Figma, GIT, APIs',
        'live_link' => 'https://restaurant.creativeelliot.com', 
        'category' => 'websites',
        'images' => [
            'thumb' => '/#',
            'screenshots' => [
                '/#',
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['HTML', 'CSS', 'JavaScript', 'Figma', 'Git', 'APIs'],
        'featured' => false,
        'date' => '',
        'skills' => ['Frontend Development', 'UI Design', 'Web Design'],
        'type' => 'Web Application',
        'github_link' => 'https://github.com/Jafert23/ReactCapstone.git',
        'keywords' => ['restaurant', 'meta', 'capstone', 'frontend']
    ],
    [
        // Linux Crash Course
        'id' => 'project1',
        'title' => 'Linux Crash Course',
        'short_description' => 'A how-to website focused on the Linux Operating System.',
        'long_description' => "Command Line Consultants - Linux How-To Guide is a comprehensive website designed to educate users on the fundamentals and advanced features of Linux-based operating systems. Developed as a collaborative team project, the guide serves as an accessible resource for both beginners and intermediate users who wish to enhance their proficiency with Linux.",
        'technologies' => 'PHP, HTML5, CSS3, JavaScript, MySQL, Figma',
        'live_link' => 'https://commandlineconsultants.com',
        'category' => 'websites',
        'images' => [
            'thumb' => 'images/project1/thumb.png',
            'screenshots' => [
                'images/project1/screenshot4.png',
                'images/project1/screenshot3.png',
                'images/project1/screenshot2.png',
                'images/project1/screenshot1.png',
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['PHP', 'HTML5', 'CSS3', 'JavaScript', 'MySQL', 'Figma'],
        'featured' => false,
        'date' => '',
        'skills' => ['Web Development', 'Technical Writing', 'Collaboration'],
        'type' => 'Educational Website',
        'github_link' => 'https://github.com/DkalCode/Command-Line-Consultants.git',
        'keywords' => ['linux', 'tutorial', 'command line', 'education']
    ],
    [
        // Throwie Digital Art
        'id' => "throwieProject",
        'title' => "Throwie Digital Art & Photoshop",
        'short_description' => "I created a personal throwie of my signature, then photoshopped it onto a location at RIT that I photographed.",
        'long_description' => "This project merges street-inspired graffiti with real-world photography. I first designed a throwie—a graffiti-style rendering of my signature—using digital art tools. Then, I used Photoshop to composite it seamlessly onto a photograph I took at Rochester Institute of Technology. The final result is a fun, stylized blend of digital art and on-site photography, showcasing how creative expression can intersect with technology.",
        'technologies' => "Photoshop, Adobe Illustrator, Camera",
        'live_link' => "",
        'category' => "art",
        'images' => [
            'thumb' => "images/throwie/screenshot2.jpg",
            'screenshots' => [
                "images/throwie/screenshot1.jpg",
                "images/throwie/screenshot2.jpg"
            ]
        ],
        // Enhanced fields
        'tech_tags' => ['Photoshop', 'Illustrator', 'Digital Photography'],
        'featured' => true,
        'date' => '',
        'skills' => ['Digital Art', 'Photo Editing', 'Photography'],
        'type' => 'Digital Artwork',
        'github_link' => '',
        'keywords' => ['graffiti', 'digital art', 'photography', 'composite']
    ],
    [
        // Brand Design Package
        'id' => "BrandDesign",
        'title' => "Brand Design Package",
        'short_description' => "I created a brand re-design for a local business.",
        'long_description' => "A logo, business card, and a letterhead for the spa and salon 'Ape and Canary'.",
        'technologies' => "Photoshop, Adobe Illustrator",
        'live_link' => "",
        'category' => "art",
        'images' => [
            'thumb' => "images/logoproject/thumb.png",
            'screenshots' => [
                "images/logoproject/thumb.png",
                "images/logoproject/screenshot3.png",
                "images/logoproject/screenshot2.png",
                "images/logoproject/screenshot1.png"
            ]
        ],
        // Enhanced fields
        'tech_tags' => ['Photoshop', 'Illustrator', 'Branding'],
        'featured' => true,
        'date' => '',
        'skills' => ['Logo Design', 'Brand Identity', 'Graphic Design'],
        'type' => 'Branding Project',
        'github_link' => '',
        'keywords' => ['branding', 'logo', 'business', 'design', 'identity']
    ],
    [
        // Radio Telescope Guide
        'id' => 'cardboard-radio-telescope-guide',
        'title' => 'Cardboard Radio Telescope Assembly Guide',
        'short_description' => 'A step-by-step guide showcasing the creation of a cardboard radio telescope, including transmitter and receiver models.',
        'long_description' => 'This project involves building a cardboard model of a radio telescope, complete with a signal transmitter and receiver. The project was documented in a step-by-step guide, which was designed to be both visually appealing and educational. The guide highlights the process of crafting the components and assembling them into a functional model. It was created as part of a graphic design course to demonstrate instructional design and DIY crafting.',
        'technologies' => 'Cardboard, Paint, Camera, Adobe Photoshop, Adobe Illustrator, Adobe InDesign, Hot Glue',
        'live_link' => '',
        'category' => 'art',
        'images' => [
            'thumb' => 'images/radio-telescope/thumb.jpg',
            'screenshots' => [
                'images/radio-telescope/rt1.jpg',
                'images/radio-telescope/rt2.jpg',
                'images/radio-telescope/rt3.jpg',
                'images/radio-telescope/rt4.jpg',
                'images/radio-telescope/rt5.jpg',
                'images/radio-telescope/rt6.jpg',
                'images/radio-telescope/rt7.jpg',
                'images/radio-telescope/rt8.jpg'
            ],
        ],
        // Enhanced fields
        'tech_tags' => ['Photoshop', 'Illustrator', 'InDesign', 'Crafting'],
        'featured' => false,
        'date' => '',
        'skills' => ['Instructional Design', 'Craft Documentation', 'Photography'],
        'type' => 'DIY Guide',
        'github_link' => '',
        'keywords' => ['guide', 'craft', 'telescope', 'DIY', 'educational']
    ],
    [
        // Toy Boat in Iceland
        'id' => 'toyBoatIceland',
        'title' => 'Toy Boat in Iceland',
        'short_description' => 'I combined a photograph of a toy boat with a scenic shot from Iceland to create a playful, composite image.',
        'long_description' => 'This project merges a miniature world with the dramatic Icelandic landscape. I first photographed a toy boat under controlled lighting, ensuring the angle and perspective matched the majestic backdrop I captured in Iceland. Using Photoshop, I composited the two images together, adjusting shadows, color balance, and scale for a realistic yet whimsical effect. The final piece highlights how storytelling can be achieved by blending small-scale subjects with grand natural vistas, breathing new life into the ordinary.',
        'technologies' => 'Adobe Photoshop, Adobe Illustrator, Camera',
        'live_link' => '',
        'category' => 'art',
        'images' => [
            'thumb' => 'images/toyboat/thumb.jpg',
            'screenshots' => [
                'images/toyboat/toyboat.jpg',
            ]
        ],
        // Enhanced fields
        'tech_tags' => ['Photoshop', 'Illustrator', 'Photography', 'Composite'],
        'featured' => false,
        'date' => '',
        'skills' => ['Photo Editing', 'Composition', 'Creative Photography'],
        'type' => 'Digital Composite',
        'github_link' => '',
        'keywords' => ['Iceland', 'composite', 'photography', 'miniature']
    ],
    [
        // Resume
        'id' => 'Resume',
        'title' => 'Resume-January_2025',
        'short_description' => 'My professional resume',
        'long_description' => "Current professional resume highlighting my skills, experience, and education.",
        'technologies' => 'Microsoft Word',
        'live_link' => 'https://drive.google.com/file/d/1YEVp2RC6Gj2i_Taox3dFQMFRnQ64lOfM/view?usp=sharing',
        'category' => 'misc',
        'images' => [
            'thumb' => 'images/resume/600x400_resume.svg',
            'screenshots' => [],
        ],
        // Enhanced fields
        'tech_tags' => ['Microsoft Word', 'Document Design'],
        'featured' => true,
        'date' => '',
        'skills' => ['Resume Design', 'Professional Writing'],
        'type' => 'Document',
        'github_link' => '',
        'keywords' => ['resume', 'cv', 'professional', 'career']
    ]
];

/**
 * Helper functions for project data
 */

/**
 * Get all featured projects
 */
function get_featured_projects($allProjects) {
    return array_filter($allProjects, function($project) {
        return isset($project['featured']) && $project['featured'] === true;
    });
}

/**
 * Get projects by technology
 */
function get_projects_by_technology($allProjects, $technology) {
    return array_filter($allProjects, function($project) use ($technology) {
        if (isset($project['tech_tags']) && is_array($project['tech_tags'])) {
            return in_array($technology, $project['tech_tags']);
        }
        return false;
    });
}

/**
 * Search projects by keyword
 */
function search_projects($allProjects, $query) {
    if (empty($query)) return [];
    
    $query = strtolower(trim($query));
    $results = [];
    
    foreach ($allProjects as $project) {
        // Search in title, descriptions
        if (
            stripos($project['title'], $query) !== false ||
            stripos($project['short_description'], $query) !== false ||
            stripos($project['long_description'], $query) !== false
        ) {
            $results[] = $project;
            continue;
        }
        
        // Search in tech tags
        if (isset($project['tech_tags']) && is_array($project['tech_tags'])) {
            foreach ($project['tech_tags'] as $tag) {
                if (stripos($tag, $query) !== false) {
                    $results[] = $project;
                    continue 2; 
                }
            }
        }
        
        // Search in keywords
        if (isset($project['keywords']) && is_array($project['keywords'])) {
            foreach ($project['keywords'] as $keyword) {
                if (stripos($keyword, $query) !== false) {
                    $results[] = $project;
                    continue 2;
                }
            }
        }
    }
    
    return $results;
}
?>
