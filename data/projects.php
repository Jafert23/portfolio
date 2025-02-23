<?php
/**
 * README
 * ------------------------------------------------------------------
 * This file contains the $projects array used across the website
 * (e.g., in about.php) to display project listings.
 *
 * Each project is an associative array with the following fields:
 *
 *  - 'id'                A unique string identifier, used in URLs (e.g., project.php?id=XYZ).
 *  - 'title'             The name/title of your project (e.g., "Well/Informed").
 *  - 'short_description' A short teaser for the project (displayed in the gallery overlay).
 *  - 'long_description'  A more detailed overview shown on the project details page.
 *  - 'technologies'      A comma-separated list (or string) of the tech used.
 *  - 'live_link'         A URL if the project is viewable/live online.
 *  - 'category'          A label to group or filter projects (e.g., "websites", "art", "misc").
 *  - 'images'            An array of image file paths:
 *     • 'thumb'          Path to the thumbnail image used in the project gallery.
 *     • 'screenshots'    An array of full-size or additional screenshots for the project page.
 *
 * Example usage in about.php:
 *      foreach ($projects as $project) {
 *          echo $project['title'];
 *          // etc...
 *      }
 *
 * Adding a New Project:
 *   1. Create a new array item with all required fields (id, title, etc.).
 *   2. Ensure 'id' is unique.
 *   3. Set 'category' to one of the desired filters ("websites", "art", "misc"), or another if you prefer.
 *   4. Provide at least one thumbnail image in 'images' => ['thumb' => 'path/to/file'].
 *   5. (Optional) Add multiple screenshot paths in 'images' => ['screenshots' => [...]].
 *
 * ------------------------------------------------------------------
 */

// data/projects.php

$projects = [
    [
        'id' => 'project3',
        'title' => 'Well/Informed',
        'short_description' => 'Well/Informed simplifies complex medical information by aggregating research and clinical trials, and enhancing understanding with AI-generated summaries.',
        'long_description' => "Well/Informed is a digital platform designed to simplify and centralize complex medical information. By aggregating research articles, clinical trials, and expert knowledge, it provides users with AI-generated summaries, making vast medical data more accessible and easier to understand for both professionals and the general public. The platform's goal is to empower individuals to stay well-informed about health advancements, enabling better decision-making and improved health literacy.

        Please note that some functions are currently no longer operational due to a recent update to the PubMed API. We are working to resolve this and restore full functionality as soon as possible.",
        'technologies' => 'React.js, Node.js, Express.js, OpenAI API, PubMed API, Axios, JavaScript, REST API, JSON, HTML5, CSS3, CORS, OAuth, Firebase',
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
    ],
    [
        'id' => 'project1',
        'title' => 'Linux Crash Course',
        'short_description' => 'A how-to website focused on the Linux Operating System.',
        'long_description' => "Command Line Consultants - Linux How-To Guide is a comprehensive website designed to educate users on the fundamentals and advanced features of Linux-based operating systems. Developed as a collaborative team project, the guide serves as an accessible resource for both beginners and intermediate users who wish to enhance their proficiency with Linux.

As the front-end developer and content researcher, my responsibilities included:
- Designing the User Interface: Creating a user-friendly and intuitive layout to facilitate easy navigation and enhance the learning experience.
- Content Creation: Conducting thorough research to produce accurate and informative content, ensuring that complex concepts are explained clearly.
- Responsive Design Implementation: Utilizing modern web technologies to ensure the website is accessible across various devices and screen sizes.

The website offers a structured approach to learning, featuring detailed tutorials and step-by-step instructions on various topics such as:
- Basic Command-Line Usage: Introducing users to essential commands and navigation techniques within the Linux terminal.
- System Administration: Guidance on managing user accounts, permissions, and system processes.
- Shell Scripting: Tutorials on writing scripts to automate tasks and improve efficiency.
- Networking Concepts: Explaining network configuration, troubleshooting, and security practices.
- Troubleshooting and Support: Providing solutions to common issues and errors encountered in Linux environments.

The project culminated as our final assignment, and we were proud to receive an A, reflecting the quality and effort of the work we invested. The success of Command Line Consultants showcases our ability to work effectively as a team, combining technical skills with educational content development to create a valuable learning resource.",
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
    ],
    [
        'id' => 'project2',
        'title' => 'Discover Japan - A Personal Travel Guide',
        'short_description' => 'A travel guide based on my personal trip to Japan.',
        'long_description' => "Discover Japan - A Personal Travel Guide is an insightful project inspired by my memorable journey through Japan. The guide offers a curated exploration of the country's rich culture, history, and natural beauty, aimed at travelers seeking an authentic Japanese experience.

Purpose and Overview:
The project serves as a comprehensive travel companion, providing readers with:
- Destination Highlights: In-depth information on major cities like Tokyo, Kyoto, and Osaka, as well as lesser-known locales, including historical landmarks, temples, and natural wonders.
- Cultural Insights: An exploration of Japanese traditions, festivals, and customs to help travelers appreciate the local way of life.
- Culinary Adventures: Recommendations for must-try foods, from street snacks to traditional cuisine, along with dining etiquette tips.
- Travel Tips: Practical advice on transportation, accommodation options, language basics, and navigating the country efficiently.
- Personal Anecdotes: Sharing experiences, challenges, and surprises encountered during the trip to add a personal touch and engage readers.

Some Features and Functionality:
- Interactive Maps: Highlighting key locations and suggested itineraries.
- Photo Galleries: Showcasing images of destinations, cultural events, and culinary delights.
- User Engagement: Allowing readers to leave comments or share their own experiences.

My Role:
I undertook this project individually, combining my passion for travel and storytelling to create an informative and visually appealing guide. Responsibilities included:
- Content Writing: Crafting detailed articles and descriptions for each section.
- Photography: Capturing images during my trip to enhance the visual appeal.
- Website Design: Developing the layout and aesthetic to reflect the essence of Japan.",
        'technologies' => 'HTML5, CSS3, JavaScript, Responsive Design',
        'live_link' => 'Not Currently Hosted', // Replace with your actual link
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
    ],
            // Add more projects here...
    [
        'id' => 'project4',
        'title' => 'Environmental Sustainability & AI',
        'short_description' => 'A final research project exploring advanced AI techniques to promote environmental sustainability.',
        'long_description' => "This project investigates how artificial intelligence can be harnessed to enhance environmental sustainability efforts. It delves into AI applications such as predictive analytics for climate modeling, optimization algorithms for resource management, and machine learning techniques for monitoring and reducing pollution. The project aims to provide insights into integrating AI solutions to address environmental challenges effectively.",
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
    ],
    [
        
          "id" => "throwieProject",
          "title"=> "Throwie Digital Art & Photoshop",
          "short_description"=> "I created a personal throwie of my signature, then photoshopped it onto a location at RIT that I photographed.",
          "long_description"=> "This project merges street-inspired graffiti with real-world photography. I first designed a throwie—a graffiti-style rendering of my signature—using digital art tools. Then, I used Photoshop to composite it seamlessly onto a photograph I took at Rochester Institute of Technology. The final result is a fun, stylized blend of digital art and on-site photography, showcasing how creative expression can intersect with technology.",
          "technologies"=> "Photoshop, Adobe Illustrator, Camera",
          "live_link"=> "",
          "category"=> "art",
          "images"=> [
            "thumb"=> "images/throwie/screenshot2.jpg",
            "screenshots"=> [
              "images/throwie/screenshot1.jpg",
              "images/throwie/screenshot2.jpg"
            ]
          ]
        
    ],
   
    [
        'id' => 'cardboard-radio-telescope-guide', // Unique identifier for the project
        'title' => 'Cardboard Radio Telescope Assembly Guide', // Name of the project
        'short_description' => 'A step-by-step guide showcasing the creation of a cardboard radio telescope, including transmitter and receiver models.', // Short teaser for the project
        'long_description' => 'This project involves building a cardboard model of a radio telescope, complete with a signal transmitter and receiver. The project was documented in a step-by-step guide, which was designed to be both visually appealing and educational. The guide highlights the process of crafting the components and assembling them into a functional model. It was created as part of a graphic design course to demonstrate instructional design and DIY crafting.',
        'technologies' => 'Cardboard, Paint, Camera, Adobe Photoshop, Adobe Illustrator, Adobe InDesign, Hot Glue', // Tools and technologies used
        'live_link' => '', // Optional: Add a live link if applicable (e.g., to a project page)
        'category' => 'art', // Category or grouping
        'images' => [
            'thumb' => 'images/radio-telescope/thumb.jpg', // Thumbnail image for the gallery
            'screenshots' => [
                'images/radio-telescope/rt1.jpg',
                'images/radio-telescope/rt2.jpg',
                'images/radio-telescope/rt3.jpg',
                'images/radio-telescope/rt4.jpg',
                'images/radio-telescope/rt5.jpg',
                'images/radio-telescope/rt6.jpg',
                'images/radio-telescope/rt7.jpg',
                'images/radio-telescope/rt8.jpg'
                 // Additional screenshots
            ],
        ],
    ],
    [
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
        ]
    ]
];
