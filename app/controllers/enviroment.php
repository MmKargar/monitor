<?php

use Rakit\Validation\Validator;

class Enviroment extends Controller
{

    public function index()
    {
        $settings = Setting::findOrFail(1);
        $this->view('settings/index', [
            'settings' => $settings
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator;
            // make it
            $validation = $validator->make($_POST + $_FILES, [
                'time_delay' => 'required|max:190|numeric',
                'refresh_rate'  => 'required|max:190|numeric',
            ]);

            // then validate
            $validation->validate();

            if ($validation->fails()) {
                // handling errors
                $errors = $validation->errors();
                $settings = Setting::findOrFail(1);

                // call_user_func_array([$this ,  'create' ] ,  ['errors' => $errors] );
                $this->view('settings/index', [
                    'settings' => $settings,
                    'errors' => $errors,
                    'validate-error' => true
                ]);
                die();
            }

            // if every thing is ok update the settings 
            $setting = Setting::findOrFail(1);
            $setting->update([
                'time_delay'   => $_POST['time_delay'],
                'refresh_rate' => $_POST['refresh_rate']
            ]);
            $success = [
                'message' => 'Settings Updated Successfully.'
            ];
            $settings = Setting::findOrFail(1);
            $this->view('settings/index', [
                'success' => $success,
                'settings' => $settings
            ]);
            die();
        }
    }
}
