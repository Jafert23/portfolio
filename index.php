<!-- index.php -->
<?php
$pageTitle = 'Elliot Tindall | Creative Technologist & Developer Portfolio';
$metaDescription = 'Portfolio of Elliot Tindall, a creative technologist and developer specializing in web development, design, and art projects. Explore skills, experience, and featured work.';
include 'includes/header.php';
?>

<main class="about-page">

    <!-- Introduction Section -->
    <section class="introduction rellax" data-rellax-speed="-2" id="introduction" data-aos="fade-up">
        <div class="container">
            <div class="profile-pic" data-aos="fade-right">
                <img src="images/profile.png" alt="Elliot Tindall" loading="lazy">
            </div>
            <div class="bio">
                <p>
                    <?php
                    echo nl2br("I am a passionate, driven, and creative individual with an interest in art, design, and technology. My interdisciplinary background allows me to bridge the gap between the technical and creative realms, bringing innovative solutions to complex problems. With a strong foundation in both humanities and computing, I strive to create experiences that are not only functional but also aesthetically engaging. I'm always eager to learn new technologies and collaborate with others who share my passion for innovation.");
                    ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="skills" data-aos="fade-up">
        <h2>Technical Familiarity</h2>
        
        <div class="skills-container">
            <!-- Frontend Technologies -->
            <div class="skill-category">
                <h3><i class="fa-solid fa-code"></i> Frontend</h3>
                <div class="tech-grid">
                    <div class="tech-card">
                        <i class="fa-brands fa-html5"></i>
                        <span>HTML5</span>
                    </div>
                    <div class="tech-card">
                        <i class="fa-brands fa-css3-alt"></i>
                        <span>CSS3</span>
                    </div>
                    <div class="tech-card">
                        <i class="fa-brands fa-js"></i>
                        <span>JavaScript</span>
                    </div>
                    <div class="tech-card">
                        <i class="fa-brands fa-react"></i>
                        <span>React</span>
                    </div>
                </div>
            </div>

            <!-- Backend Technologies -->
            <div class="skill-category">
                <h3><i class="fa-solid fa-server"></i> Backend</h3>
                <div class="tech-grid">
                    <div class="tech-card">
                        <i class="fa-brands fa-node-js"></i>
                        <span>Node.js</span>
                    </div>
                    <div class="tech-card">
                        <i class="fa-brands fa-php"></i>
                        <span>PHP</span>
                    </div>
                    <div class="tech-card">
                        <i class="fa-solid fa-database"></i>
                        <span>MySQL</span>
                    </div>
                </div>
            </div>

            <!-- Other Languages -->
            <div class="skill-category">
                <h3><i class="fa-solid fa-laptop-code"></i> Other Languages</h3>
                <div class="tech-grid">
                    <div class="tech-card">
                        <i class="fa-brands fa-python"></i>
                        <span>Python</span>
                    </div>
                    <div class="tech-card">
                        <i class="fa-solid fa-code"></i>
                        <span>R</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience" data-aos="fade-up">
        <h2>Experience</h2>
        <div class="timeline">
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-date">Dec 2022 - Sep 2023</div>
                <div class="timeline-content">
                    <h3>Content Curator/Historian</h3>
                    <span>Golisano Institute for Business</span>
                    <p>
                        Assisted in managing the Institute's website, including adding and changing content. Interviewed local business owners, institute professors/administration, and students for a documentary on the founding of the institute.
                    </p>
                </div>
            </div>
            <!-- Add more timeline items as needed -->
        </div>
    </section>

    <!-- Education Section -->
    <section class="education" data-aos="fade-up">
        <h2>Education</h2>
        <div class="education-item">
            <h3>Bachelor of Science in Humanities, Computing, and Design</h3>
            <span>Rochester Institute of Technology | Expected Graduation: Spring 2025</span>
        </div>
        <!-- Add more education items as needed -->
    </section>

    <!-- Interests Section -->
    <section class="interests" data-aos="fade-up">
        <h2>Interests</h2>
        <p>
            In my free time, I enjoy playing music; I play three instruments: piano, French horn, and drums (rock). Listening to music and attending live shows are among my favorite activities. I stay active by working out, sailing, and skiing. I also have a passion for art and design; I create digital art and enjoy designing and finding 3D models for my 3D printer.
        </p>
    </section>

    <!-- Call to Action Section -->
    <section class="call-to-action" data-aos="fade-up">
        <h2>Let's Work Together</h2>
        <p>Feel free to reach out if you're looking for a developer or have a project in mind.</p>
        <a href="contact.php" class="btn">Contact Me</a>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
