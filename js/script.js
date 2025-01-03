jQuery(document).ready(function($) {
    $('#cookie-accept').on('click', function() {
        // Define o cookie com validade de 30 dias
        let date = new Date();
        date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
        document.cookie = "cookie_consent=accepted; expires=" + date.toUTCString() + "; path=/";
        
        // Remove o aviso
        $('#cookie-notice').fadeOut();
    });
});