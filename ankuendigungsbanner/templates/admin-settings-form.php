<?php

$message = get_option('ab_announcement_message', '');
$status = get_option('ab_announcement_status', '0');
$type = get_option('ab_announcement_type', 'text');
$link = get_option('ab_announcement_link', '');
$size = get_option('ab_announcement_size', '18px');
?>

<div class="wrap">
    <h1>Ankündigungsbanner Einstellungen</h1>
    <form method="post" action="<?= admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="ab_save_settings">
        <?php wp_nonce_field('ab_save_settings_nonce'); ?>

        <table class="form-table">
            <tr>
                <th scope="row"><label for="ab_announcement_message">Nachricht</label></th>
                <td><input type="text" name="ab_announcement_message" id="ab_announcement_message" value="<?= esc_attr($message); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row">Aktivieren</th>
                <td><input type="checkbox" name="ab_announcement_status" value="1" <?= checked($status, '1', false); ?>></td>
            </tr>
            <tr>
                <th scope="row"><label for="ab_announcement_link">Link</label></th>
                <td><input type="url" name="ab_announcement_link" id="ab_announcement_link" value="<?= esc_attr($link); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="ab_announcement_size">Schriftgröße</label></th>
                <td><input type="text" name="ab_announcement_size" id="ab_announcement_size" value="<?= esc_attr($size); ?>" class="regular-text"></td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="ab_settings_submit" class="button button-primary" value="Speichern">
        </p>
    </form>
</div>
