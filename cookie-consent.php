<?php
/**
 * Plugin Name: Aviso de Cookies
 * Plugin URI: https://devjean.com.br/
 * Description: Plugin simples para exibir aviso de consentimento de cookies
 * Version: 1.0.0
 * Author: Dev Jean Krause
 * Author URI: https://devjean.com.br/
 * Text Domain: cookie-consent
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/style-generator.php';

class CookieConsent {
    private $settings;

    public function __construct() {
        add_action('wp_footer', array($this, 'display_cookie_notice'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_head', array($this, 'output_custom_styles'));
        
        $this->settings = new CookieConsentSettings();
    }

    public function activate() {
        $default_settings = array(
            'background_color' => '#000000',
            'text_color' => '#ffffff',
            'button_size' => 'medium',
            'button_radius' => '4px',
            'font_family' => 'Arial',
            'font_size' => '14px',
            'notice_text' => 'Este site utiliza cookies para melhorar sua experiência de navegação. Ao continuar navegando, você concorda com a nossa Política de Privacidade.',
            'button_text' => 'Aceitar'
        );
        
        if (!get_option('cookie_consent_settings')) {
            update_option('cookie_consent_settings', $default_settings);
        }
    }

    public function deactivate() {
        // Desativação do plugin
    }

    public function enqueue_styles() {
        wp_enqueue_style('cookie-consent-style', plugins_url('css/style.css', __FILE__));
        wp_enqueue_script('cookie-consent-script', plugins_url('js/script.js', __FILE__), array('jquery'), '1.0.0', true);
    }

    public function output_custom_styles() {
        echo CookieConsentStyleGenerator::generate_custom_css();
    }

    public function display_cookie_notice() {
        if (!isset($_COOKIE['cookie_consent'])) {
            include 'templates/cookie-notice.php';
        }
    }
}

// Inicialização do plugin
$cookie_consent = new CookieConsent();
register_activation_hook(__FILE__, array($cookie_consent, 'activate'));
register_deactivation_hook(__FILE__, array($cookie_consent, 'deactivate'));