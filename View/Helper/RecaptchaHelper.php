<?php
App::uses('AppHelper', 'View/Helper');
class RecaptchaHelper extends AppHelper {
    public $helpers = array('Form');

    function show($options = array())
    {
        if (isset($options['theme'])) {
            if (!in_array($options['theme'], array('dark', 'light'))) {
                $options['theme'] = 'light';
            }
        }
        $theme = $options['theme'];
        $size = $options['size'];
        $successCallback = isset($options['success-callback']) ? $options['success-callback'] : 'setResponseToken';
        App::import('Vendor', 'Recaptcha.recaptchalib');
        $publickey = Configure::read('captcha_public_key');
        $html = '<script type="text/javascript">
            var RecaptchaOptions = ' . json_encode($options) . ';
                
              var setResponseToken = function(response) {                                
                var recaptchaResponseldFie = document.getElementsByName("recaptcha_response_field")[0];
                recaptchaResponseldFie.setAttribute("value", response);  
              };

        </script>';
        if (isset($recaptcha_error)) {
            $html .= $recaptcha_error . '<br/>';
        }
        $html .= "
        <input type='hidden' name='recaptcha_response_field'/>
        <div class='g-recaptcha' data-sitekey='$publickey' 
data-theme='$theme 'data-size='$size' data-callback='$successCallback'></div>";

        return $html .= recaptcha_get_html($publickey, null, true);
    }

    function error() {
        return $this->Form->error('recaptcha_response_field');
    }
}
