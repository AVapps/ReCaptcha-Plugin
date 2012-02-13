<?php
class RecaptchaComponent extends Component {
	function startup(&$controller) {
		if (isset($controller->request->data['recaptcha_challenge_field']) && isset($controller->request->data['recaptcha_response_field'])) {
			$modelClass = $controller->modelClass;
			$controller->request->data[$modelClass]['recaptcha_challenge_field'] = $controller->request->data['recaptcha_challenge_field'];
			$controller->request->data[$modelClass]['recaptcha_response_field'] = $controller->request->data['recaptcha_response_field'];
			$controller->$modelClass->Behaviors->attach('Recaptcha.Validation');
		}
	}
}
