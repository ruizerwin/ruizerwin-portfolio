<?php
declare(strict_types=1);

$base_path = __DIR__;

require $base_path . '/includes/helpers/functions.php';

$page_css_files = [
    'assets/css/pages/home.css',
    'assets/css/pages/about.css',
    'assets/css/pages/resume.css',
    'assets/css/pages/portfolio.css',
    'assets/css/pages/services.css',
    'assets/css/pages/contact.css',
];

$page_sections = [
    'home',
    'about',
    'resume',
    'portfolio',
    'services',
    'contact',
];

require $base_path . '/includes/boot.php';
require $base_path . '/includes/head.php';
?>

<body class="index-page">

<?php require $base_path . '/includes/header.php'; ?>

<main class="main">
    <?php
    foreach ($page_sections as $section) {
        $section_file = $base_path . '/pages/' . $section . '.php';

        if (!is_file($section_file)) {
            trigger_error('Missing section file: ' . $section_file, E_USER_WARNING);
            continue;
        }

        require $section_file;
    }
    ?>
</main>

<?php
require $base_path . '/includes/footer.php';
require $base_path . '/includes/scripts.php';