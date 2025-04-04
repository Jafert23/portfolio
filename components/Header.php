<?php
/**
 * Header Component
 * 
 * A reusable header component that includes the HTML head section,
 * navigation, and optional hero/parallax section.
 * 
 * @param string $pageTitle Page title for SEO
 * @param string $metaDescription Meta description for SEO (optional)
 * @param bool $showParallax Whether to show the parallax header (default: true)
 */

// Default values
$metaDescription = $metaDescription ?? 'Elliot Tindall - Creative Technologist with a passion for art, design, and technology.';
$showParallax = $showParallax ?? true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?? 'Elliot Tindall | Portfolio'; ?></title>
    
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/lightbox.css">
    
    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS CSS for Scroll Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Roboto&display=swap" rel="stylesheet">
    
    <!-- Meta Tags for SEO -->
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <meta name="keywords" content="Elliot Tindall, Creative Technologist, Web Developer, Designer, Artist">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php include 'components/Navigation.php'; ?>

<?php if ($showParallax): ?>
<!-- Parallax Header Section -->
<header class="parallax-header">
    <div class="parallax-overlay">
        <h1>Elliot Tindall</h1>
        <p class="tagline">Creative Technologist &amp; Developer</p>
    </div>
</header>
<?php endif; ?> 