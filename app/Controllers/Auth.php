<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LogModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        // Direct view, no lockout
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();

        // Sanitize input
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));

        $username = $model->where('username', $username)->first();

        if ($username && password_verify($password, $username['password'])) {

            $session->regenerate();
            $session->set([
                'user_id' => $username['id'],
                'username' => $username['username'],
                'name' => $username['name'],
                'role' => $username['role'],
                'logged_in' => true,
                'last_activity' => time()
            ]);

            // Log login
            $logModel = new LogModel();
            $logModel->addLog('Login: ' . $username['name'], 'LOGIN');

            return redirect()->to('/dashboard');

        } else {
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        $logModel = new LogModel();
        $logModel->addLog('Logout', 'LOGOUT');

        session()->destroy();
        return redirect()->to('/login');
    }
}