<?php
/**
 * Plugin Name: Ankündigungsbanner
 * Description: Zeigt eine einzeilige Meldung im Header an.
 * Version: 2025013112
 * Author: Sebastian Meerwald
 */

if (!defined('ABSPATH')) {
    exit;
}

// Plugin-Pfade definieren
define('AB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AB_PLUGIN_URL', plugin_dir_url(__FILE__));

// Dateien einbinden
require_once AB_PLUGIN_DIR . 'includes/admin-settings.php';
require_once AB_PLUGIN_DIR . 'includes/shortcodes.php';

// Optionen bei Aktivierung setzen
function ab_activate() {
    add_option('ab_announcement_message', '');
    add_option('ab_announcement_status', '0');
    add_option('ab_announcement_type', 'text');
    add_option('ab_announcement_link', '');
    add_option('ab_announcement_size', '18px');
}
register_activation_hook(__FILE__, 'ab_activate');

// Optionen bei Deaktivierung löschen
function ab_deactivate() {
    delete_option('ab_announcement_message');
    delete_option('ab_announcement_status');
    delete_option('ab_announcement_type');
    delete_option('ab_announcement_link');
    delete_option('ab_announcement_size');
}
register_deactivation_hook(__FILE__, 'ab_deactivate');

// Frontend-Styles einbinden
function ab_enqueue_frontend_styles() {
    wp_enqueue_style('ab_frontend_style', AB_PLUGIN_URL . 'assets/css/frontend.css', [], filemtime(AB_PLUGIN_DIR . 'assets/css/frontend.css'));
}
add_action('wp_enqueue_scripts', 'ab_enqueue_frontend_styles');

// Ankündigungsleiste anzeigen
function ab_display_announcement_bar() {
    $status = get_option('ab_announcement_status', '0');
    if ($status === '1') {
        include AB_PLUGIN_DIR . 'templates/announcement-bar.php';
    }
}
add_action('wp_body_open', 'ab_display_announcement_bar');
