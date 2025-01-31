<?php

if (!defined('ABSPATH')) {
    exit;
}

// Menüpunkt im Admin-Panel hinzufügen
function ab_add_admin_menu() {
    add_options_page('Ankündigungsbanner', 'Ankündigungsbanner', 'manage_options', 'ankuendigungsbanner', 'ab_render_admin_settings_page');
}
add_action('admin_menu', 'ab_add_admin_menu');

// Admin-Seite rendern
function ab_render_admin_settings_page() {
    include AB_PLUGIN_DIR . 'templates/admin-settings-form.php';
}

// Einstellungen speichern
function ab_save_admin_settings() {
    if (isset($_POST['ab_settings_submit'])) {
        update_option('ab_announcement_message', sanitize_text_field($_POST['ab_announcement_message']));
        update_option('ab_announcement_status', isset($_POST['ab_announcement_status']) ? '1' : '0');
        update_option('ab_announcement_type', sanitize_text_field($_POST['ab_announcement_type']));
        update_option('ab_announcement_link', esc_url($_POST['ab_announcement_link']));
        update_option('ab_announcement_size', sanitize_text_field($_POST['ab_announcement_size']));
    }
}
add_action('admin_post_ab_save_settings', 'ab_save_admin_settings');
