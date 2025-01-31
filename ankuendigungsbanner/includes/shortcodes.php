<?php

if (!defined('ABSPATH')) {
    exit;
}

// Shortcode für das Ankündigungsbanner
function ab_announcement_shortcode() {
    ob_start();
    include AB_PLUGIN_DIR . 'templates/announcement-bar.php';
    return ob_get_clean();
}
add_shortcode('announcement_bar', 'ab_announcement_shortcode');
