<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        $title['title'] = "Login";
        return view('pages/auth/login', ['title' => $title]);
    }

    public function processLogin()
    {
        $usersModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level = $this->request->getPost('level');

        $user = $usersModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password']) && $user['level'] == $level) {
            session()->set('username', $user['username']);
            session()->set('id', $user['id']);
            session()->set('level', $user['level']);
            session()->set('id_emp', $user['id_emp']);

            // Redirect based on user role
            if ($level == 'SUPERADMIN') {
                return redirect()->to(base_url('/dashboard'));
            } else {
                return redirect()->to(base_url('/dashboard'));
            }
            // return redirect()->to(base_url('/dashboard'));
        } else {
            session()->setFlashdata('error', 'Username / Password salah atau peran tidak sesuai');
            return redirect()->to(base_url('/'));
        }
    }

    public function logout()
    {
        $session = \Config\Services::session();

        $session->destroy();

        session()->setFlashdata('success', 'Anda Berhasil Logout!!!');
        return redirect()->to(base_url('/'));
    }
}
