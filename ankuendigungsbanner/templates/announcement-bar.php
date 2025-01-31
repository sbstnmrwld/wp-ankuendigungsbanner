<?php

$message = get_option('ab_announcement_message', '');
$status = get_option('ab_announcement_status', '0');
$type = get_option('ab_announcement_type', 'text');
$link = get_option('ab_announcement_link', '');
$size = get_option('ab_announcement_size', '18px');

if ($status === '1' && !empty($message)) :
?>
    <div class="ab-announcement-bar" style="font-size: <?= esc_attr($size); ?>;">
        <?php if (!empty($link)) : ?>
            <a href="<?= esc_url($link); ?>" target="_blank"><?= esc_html($message); ?></a>
        <?php else : ?>
            <?= esc_html($message); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
