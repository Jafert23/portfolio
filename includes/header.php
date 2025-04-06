<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?? 'Elliot Tindall | Portfolio'; ?></title>
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Lightbox CSS (if needed) -->
    <link rel="stylesheet" href="css/lightbox.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS CSS for Scroll Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Roboto&display=swap" rel="stylesheet">
    <!-- Meta Tags for SEO -->
    <meta name="description" content="Elliot Tindall - Creative Technologist with a passion for art, design, and technology.">
    <meta name="keywords" content="Elliot Tindall, Creative Technologist, Web Developer, Designer, Artist">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<!-- Fixed Navigation Menu -->
<nav aria-label="Main Navigation">
    <div class="menu-toggle" aria-label="Toggle Menu">
        <i class="fa-solid fa-bars"></i>
    </div>
    <ul class="menu">
        <li><a href="#"style="pointer-events: none;"></a></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="#"style="pointer-events: none;"></a></li>
        <li><a href="project-search.php">Projects</a></li>
        <li><a href="#"style="pointer-events: none;"></a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="#"style="pointer-events: none;"></a></li>
        <!-- Add more menu items as needed -->
    </ul>
</nav>

<!-- Parallax Header Section -->
<header class="parallax-header">
    <div class="parallax-overlay">
        <h1>Elliot Tindall</h1>
        <p class="tagline">Creative Technologist &amp; Developer</p>
    </div>
</header>
