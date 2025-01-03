<?php
class CookieConsentStyleGenerator {
    public static function generate_custom_css() {
        $options = get_option('cookie_consent_settings');
        if (!$options) return '';

        $css = '<style>';
        
        // Estilos do aviso
        if (!empty($options['background_color'])) {
            $css .= '.cookie-notice { background: ' . esc_attr($options['background_color']) . '; }';
        }
        if (!empty($options['text_color'])) {
            $css .= '.cookie-notice { color: ' . esc_attr($options['text_color']) . '; }';
        }
        if (!empty($options['font_family'])) {
            $css .= '.cookie-notice { font-family: ' . esc_attr($options['font_family']) . '; }';
        }
        if (!empty($options['font_size'])) {
            $css .= '.cookie-notice { font-size: ' . esc_attr($options['font_size']) . '; }';
        }

        // Raio da borda do botão
        if (!empty($options['button_radius'])) {
            $css .= '.cookie-notice .cookie-button { border-radius: ' . esc_attr($options['button_radius']) . ' !important; }';
        }

        // Tamanho do botão
        if (!empty($options['button_size'])) {
            switch ($options['button_size']) {
                case 'small':
                    $css .= '.cookie-button { padding: 5px 10px; font-size: 12px; }';
                    break;
                case 'medium':
                    $css .= '.cookie-button { padding: 10px 20px; font-size: 14px; }';
                    break;
                case 'large':
                    $css .= '.cookie-button { padding: 15px 30px; font-size: 16px; }';
                    break;
            }
        }

        $css .= '</style>';
        return $css;
    }
}