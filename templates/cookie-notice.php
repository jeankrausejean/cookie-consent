<?php
$options = get_option('cookie_consent_settings');
$notice_text = !empty($options['notice_text']) ? $options['notice_text'] : 'Este site utiliza cookies para melhorar sua experiência de navegação. Ao continuar navegando, você concorda com a nossa Política de Privacidade.';
$button_text = !empty($options['button_text']) ? $options['button_text'] : 'Aceitar';
?>
<div id="cookie-notice" class="cookie-notice">
    <div class="cookie-notice-container">
        <p><?php echo wp_kses_post($notice_text); ?></p>
        <button id="cookie-accept" class="cookie-button"><?php echo esc_html($button_text); ?></button>
    </div>
</div>