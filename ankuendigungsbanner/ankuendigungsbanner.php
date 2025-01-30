<?php
/**
 * Plugin Name: Ankündigungsbanner
 * Description: Zeigt eine einzeilige Meldung dem Header an.
 * Version: 202501301
 * Author: Sebastian Meerwald
 */

if (!defined('ABSPATH')) {
    exit; // Sicherheitscheck
}

// Standardwerte setzen
function ab_get_default_message() {
    return ''; // Standardwert für Meldung
}

function ab_get_default_status() {
    return '0'; // Standardwert für Aktivierung
}

function ab_get_default_type() {
    return 'text'; // Standardwert für Meldungstyp
}

function ab_get_default_size() {
    return '18px'; // Standardwert für Schriftgröße
}

// Optionen bei Aktivierung setzen
function ab_activate() {
    add_option('ab_announcement_message', ab_get_default_message());
    add_option('ab_announcement_status', ab_get_default_status());
    add_option('ab_announcement_type', ab_get_default_type());
    add_option('ab_announcement_link', '');
    add_option('ab_announcement_size', ab_get_default_size());
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

// Admin-Menü erstellen
function ab_admin_menu() {
    add_menu_page('Ankündigungsbanner', 'Ankündigungsbanner', 'manage_options', 'announcementbanner', 'ab_settings_page');
}
add_action('admin_menu', 'ab_admin_menu');


// Einstellungsseite rendern
function ab_settings_page() {
    if (isset($_POST['ab_message']) && isset($_POST['ab_status']) && isset($_POST['ab_type']) && isset($_POST['ab_size'])) {
        update_option('ab_announcement_message', sanitize_text_field($_POST['ab_message'])); // HTML entfernen
        update_option('ab_announcement_status', isset($_POST['ab_status']) ? '1' : '0');
        update_option('ab_announcement_type', sanitize_text_field($_POST['ab_type']));
        update_option('ab_announcement_link', esc_url($_POST['ab_link']));
        update_option('ab_announcement_size', sanitize_text_field($_POST['ab_size']));
        echo '<div class="updated notice is-dismissible"><p>Die Einstellungen wurden gespeichert.</p></div>';
    }

    $message = get_option('ab_announcement_message', ab_get_default_message());
    $status = get_option('ab_announcement_status', ab_get_default_status());
    $type = get_option('ab_announcement_type', ab_get_default_type());
    $link = get_option('ab_announcement_link', '');
    $size = get_option('ab_announcement_size', ab_get_default_size());
    $pages = get_pages();
    ?>

    <div class="wrap">
        <h1><?php esc_html_e('Ankündigungsleiste', 'ankuendigungsbanner'); ?></h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="ab_status"><?php esc_html_e('Aktiviert:', 'ankuendigungsbanner'); ?></label></th>
                    <td>
                        <input type="checkbox" id="ab_status" name="ab_status" value="1" <?php checked($status, '1'); ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ab_type"><?php esc_html_e('Meldungstyp:', 'ankuendigungsbanner'); ?></label></th>
                    <td>
                        <select id="ab_type" name="ab_type" class="regular-text">
                            <option value="text" <?php selected($type, 'text'); ?>><?php esc_html_e('Text', 'ankuendigungsbanner'); ?></option>
                            <option value="link" <?php selected($type, 'link'); ?>><?php esc_html_e('Link', 'ankuendigungsbanner'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ab_message"><?php esc_html_e('Meldung:', 'ankuendigungsbanner'); ?></label></th>
                    <td>
                        <input type="text" id="ab_message" name="ab_message" value="<?php echo esc_attr($message); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ab_link"><?php esc_html_e('Link Ziel:', 'ankuendigungsbanner'); ?></label></th>
                    <td>
                        <select id="ab_link" name="ab_link" class="regular-text" <?php echo ($type === 'text') ? 'disabled' : ''; ?>>
                            <option value=""><?php esc_html_e('Kein Link', 'ankuendigungsbanner'); ?></option>
                            <?php foreach ($pages as $page) : ?>
                                <option value="<?php echo esc_url(get_permalink($page->ID)); ?>" <?php selected($link, get_permalink($page->ID)); ?>>
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ab_size"><?php esc_html_e('Schriftgröße:', 'ankuendigungsbanner'); ?></label></th>
                    <td>
                        <input type="text" id="ab_size" name="ab_size" value="<?php echo esc_attr($size); ?>" class="regular-text">
                    </td>
                </tr>
            </table>
            <?php submit_button(__('Speichern', 'ankuendigungsbanner')); ?>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var typeSelect = document.getElementById('ab_type');
                var linkField = document.getElementById('ab_link');

                function toggleLinkField() {
                    if (typeSelect.value === 'link') {
                        linkField.disabled = false;
                    } else {
                        linkField.disabled = true;
                    }
                }

                typeSelect.addEventListener('change', toggleLinkField);
                toggleLinkField();
            });
        </script>
    </div>
    <?php
}

// HTML der Ankündigungsleiste ausgeben
function ab_display_announcement_bar() {
    $status = get_option('ab_announcement_status', ab_get_default_status());
    if ($status === '1') {
        $type = get_option('ab_announcement_type', ab_get_default_type());
        $message = get_option('ab_announcement_message', ab_get_default_message());
        $link = get_option('ab_announcement_link', '');
        $size = get_option('ab_announcement_size', ab_get_default_size());

        echo '<div class="ab-announcement-bar" style="font-size:' . esc_attr($size) . ';">';
        if ($type === 'link' && !empty($link)) {
            echo '<a href="' . esc_url($link) . '" class="ab-announcement-link">' . wp_kses_post($message) . '</a>';
        } else {
            echo wp_kses_post($message);
        }
        echo '</div>';
    }
}
add_action('wp_body_open', 'ab_display_announcement_bar');

// CSS-Styling für die Ankündigungsleiste
function ab_enqueue_styles() {
    echo '<style>
        .ab-announcement-bar {
            background-color: #ffffff;
            color: #333;
            padding: 10px 0;
            text-align: center;
            font-size: inherit;
            line-height: 1.5;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }
        .ab-announcement-link {
            text-decoration: none;
            color: inherit;
            font-weight: bold;
        }
    </style>';
}
add_action('wp_head', 'ab_enqueue_styles');
