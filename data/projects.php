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
        'technologies' => 'React.js, Node.js, Express.js, ChatGPT API, PubMed API, Axios, JavaScript, REST API, JSON, HTML5, CSS3, CORS, OAuth, Firebase',
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

The website offers a structured approach to learning, featuring detailed tutorials and step-by-step instructions on various topics such as:
- Basic Command-Line Usage: Introducing users to essential commands and navigation techniques within the Linux terminal.
- System Administration: Guidance on managing user accounts, permissions, and system processes.
- Shell Scripting: Tutorials on writing scripts to automate tasks and improve efficiency.
- Networking Concepts: Explaining network configuration, troubleshooting, and security practices.
- Troubleshooting and Support: Providing solutions to common issues and errors encountered in Linux environments.

As the front-end developer and content researcher, my responsibilities included:
- Designing the User Interface: Creating a user-friendly and intuitive layout to facilitate easy navigation and enhance the learning experience.
- Content Creation: Conducting thorough research to produce accurate and informative content, ensuring that complex concepts are explained clearly.
- Responsive Design Implementation: Utilizing modern web technologies to ensure the website is accessible across various devices and screen sizes.

The project culminated as our final assignment, and we were proud to receive an A grade, reflecting the quality and effort invested. The success of Command Line Consultants showcases our ability to work effectively as a team, combining technical skills with educational content development to create a valuable learning resource.",
        'technologies' => 'PHP, HTML5, CSS3, JavaScript, MySQL',
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
    [
        'id' => 'project4',
        'title' => 'Environmental Monitoring W/ AI',
        'short_description' => 'A Guide to AI Technologies in Environmental Monitoring',
        'long_description' => "A Guide to AI Technologies in Environmental Monitoring. This project explores how advanced AI techniques can be utilized to monitor and analyze environmental data, from climate patterns to pollution levels. By leveraging real-time data feeds and machine learning models, the application aims to provide insights for researchers, policymakers, and communities focused on conservation and sustainability.",
        'technologies' => 'React.js, Node.js, JavaScript, HTML5, CSS3',
        'live_link' => 'https://react-app.creativeelliot.com',
        'category' => 'websites',
        'images' => [
            'thumb' => '',
            'screenshots' => [],
        ],
    ],
    // Add more projects here...
];
