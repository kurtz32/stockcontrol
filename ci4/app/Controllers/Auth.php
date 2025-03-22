<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $encrypter;

    public function __construct()
    {
        $this->encrypter = service('encrypter');
    }

    public function login()
    {
        $userModel = new UserModel();
        $employeeModel = new EmployeeModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        helper(['form', 'url', 'text']);

        $user = $userModel->where('username', $username)->first();
        $employee = $employeeModel->where('username', $username)->first();

        if ($user) {
            $dbpass = $user['password'];
            $verify_pass = password_verify($password, $dbpass);

            if ($verify_pass) {
                $ses_data = [
                    'username' => $user['username'], 'name' => $user['name'], 'isLoggedIn' => true
                ];

                session()->set($ses_data);
                return redirect()->to(base_url('/dashboard'));
            } else {
                return redirect()->to(base_url())->withInput()->with('error', 'Invalid credentials');
            }
        } else if ($employee) {
            $dbpass = $employee['password'];
            $verify_pass = password_verify($password, $dbpass);

            if ($verify_pass) {
                $ses_data = [
                    'id' => $employee['id'], 'department_id' => $employee['department_id'], 'username' => $employee['username'], 'name' => $employee['name'], 'isLoggedIn' => true
                ];

                session()->set($ses_data);
                return redirect()->to(base_url('/department/' . str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($this->encrypter->encrypt($employee['department_id'])))));
            } else {
                return redirect()->to(base_url())->withInput()->with('error', 'Invalid credentials');
            }
        } else {
            return redirect()->to(base_url())->withInput()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
