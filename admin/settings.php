<?php
class CookieConsentSettings {
    private $options;

    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function add_settings_page() {
        add_options_page(
            'Configurações do Aviso de Cookies',
            'Aviso de Cookies',
            'manage_options',
            'cookie-consent',
            array($this, 'render_settings_page')
        );
    }

    public function register_settings() {
        register_setting('cookie_consent_options', 'cookie_consent_settings');

        add_settings_section(
            'cookie_consent_main',
            'Personalização do Aviso de Cookies',
            null,
            'cookie-consent'
        );

        $fields = array(
            'background_color' => 'Cor de Fundo',
            'text_color' => 'Cor do Texto',
            'notice_text' => 'Texto do Aviso',
            'button_text' => 'Texto do Botão',
            'button_size' => 'Tamanho do Botão',
            'button_radius' => 'Raio da Borda do Botão',
            'font_family' => 'Fonte',
            'font_size' => 'Tamanho da Fonte'
        );

        foreach ($fields as $field => $label) {
            add_settings_field(
                $field,
                $label,
                array($this, 'render_field'),
                'cookie-consent',
                'cookie_consent_main',
                array('field' => $field)
            );
        }
    }

    public function render_field($args) {
        $options = get_option('cookie_consent_settings');
        $field = $args['field'];
        $value = isset($options[$field]) ? $options[$field] : '';

        switch ($field) {
            case 'notice_text':
                ?>
                <textarea name="cookie_consent_settings[<?php echo $field; ?>]" rows="3" cols="50"><?php 
                    echo esc_textarea($value ?: 'Este site utiliza cookies para melhorar sua experiência de navegação. Ao continuar navegando, você concorda com a nossa Política de Privacidade.'); 
                ?></textarea>
                <?php
                break;
            case 'button_text':
                ?>
                <input type="text" name="cookie_consent_settings[<?php echo $field; ?>]" 
                       value="<?php echo esc_attr($value ?: 'Aceitar'); ?>">
                <?php
                break;
            case 'button_radius':
                ?>
                <input type="text" name="cookie_consent_settings[<?php echo $field; ?>]" 
                       value="<?php echo esc_attr($value ?: '4px'); ?>" placeholder="4px">
                <p class="description">Digite o valor em px, rem ou %</p>
                <?php
                break;
            case 'button_size':
                ?>
                <select name="cookie_consent_settings[<?php echo $field; ?>]">
                    <option value="small" <?php selected($value, 'small'); ?>>Pequeno</option>
                    <option value="medium" <?php selected($value, 'medium'); ?>>Médio</option>
                    <option value="large" <?php selected($value, 'large'); ?>>Grande</option>
                </select>
                <?php
                break;
            case 'font_family':
                ?>
                <select name="cookie_consent_settings[<?php echo $field; ?>]">
                    <option value="Arial" <?php selected($value, 'Arial'); ?>>Arial</option>
                    <option value="Helvetica" <?php selected($value, 'Helvetica'); ?>>Helvetica</option>
                    <option value="sans-serif" <?php selected($value, 'sans-serif'); ?>>Sans-serif</option>
                    <option value="Georgia" <?php selected($value, 'Georgia'); ?>>Georgia</option>
                </select>
                <?php
                break;
            case 'font_size':
                ?>
                <input type="text" name="cookie_consent_settings[<?php echo $field; ?>]" 
                       value="<?php echo esc_attr($value); ?>" placeholder="14px">
                <?php
                break;
            default:
                ?>
                <input type="color" name="cookie_consent_settings[<?php echo $field; ?>]" 
                       value="<?php echo esc_attr($value); ?>">
                <?php
                break;
        }
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h2>Configurações do Aviso de Cookies</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('cookie_consent_options');
                do_settings_sections('cookie-consent');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}