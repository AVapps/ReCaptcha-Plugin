<?php
App::uses('AppHelper', 'View/Helper');
class RecaptchaHelper extends AppHelper {
	public $helpers = array('Form');

	function show($options = array()) {
		if (isset($options['theme'])) {
			if (!in_array($options['theme'], array('red', 'white', 'blackglass', 'clean'))) {
				$options['theme'] = 'red';
			}
		}
		App::import('Vendor', 'Recaptcha.recaptchalib');
		$publickey = Configure::read('Recaptcha.Public');
		$html = '<script type="text/javascript">var RecaptchaOptions = ' . json_encode($options) . ';</script>';
		if (isset($recaptcha_error)) {
			$html .= $recaptcha_error . '<br/>';
		}
		return $html .= recaptcha_get_html($publickey);
	}

	function error() {
		return $this->Form->error('recaptcha_response_field');
	}
}
