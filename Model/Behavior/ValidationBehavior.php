<?php
class ValidationBehavior extends ModelBehavior {
    function beforeValidate(&$model)
    {
        $model->validate['recaptcha_response_field'] = array(
            'required' => true,
            'allowEmpty' => false,
            'message' => "Recaptcha must be verified"
        );
        return true;
    }

    // This method is not required
    function checkRecaptcha(&$model, $data, $target)
    {
        App::import('Vendor', 'Recaptcha.recaptchalib');
        $privatekey = Configure::read('Recaptcha.Private');
        $res = recaptcha_check_answer(
            $privatekey,
            $_SERVER['REMOTE_ADDR'],
            $model->data[$model->alias][$target],
            $data['recaptcha_response_field']
        );
        return $res->is_valid;
    }
}
