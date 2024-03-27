<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KaryawanModel;

class UserController extends BaseController
{
    protected $filters = ['auth'];

    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        if (!$this->session->has('user_id')) {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        $title['title'] = "Data User";
        $userModel = new UserModel();
        $user['user'] = $userModel->getEmployees();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/user/index', ['title' => $title, 'user' => $user, 'employeeData' => $employeeData]);
    }

    public function create()
    {
        $title['title'] = "Data User - Tambah";
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/user/create', ['title' => $title, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $userModel = new UserModel();

        $validationRules = [
            'id_emp' => 'required|integer',
            'username' => 'required|max_length[255]',
            'password' => 'required|max_length[255]',
            'level' => 'required|in_list[SUPERADMIN,ADMIN]',
        ];

        if ($this->validate($validationRules)) {
            $dataToAdd = [
                'id_emp' => $this->request->getPost('id_emp'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'level' => $this->request->getPost('level'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $userModel->insert($dataToAdd);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/user'));
            } else {
                session()->setFlashdata("error", "Data Gagal Ditambahkan!!!");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Data Gagal Ditambahkan!!!");
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $title['title'] = "Data User - Edit";
        $userModel = new UserModel();
        $user['user'] = $userModel->getUserById($id);
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/user/edit', ['title' => $title, 'user' => $user, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $validationRules = [
            'id_emp' => 'required|integer',
            'username' => 'required|max_length[255]',
            'level' => 'required|in_list[SUPERADMIN,ADMIN]',
        ];

        if ($this->validate($validationRules)) {
            $dataToUpdate = [
                'id_emp' => $this->request->getPost('id_emp'),
                'username' => $this->request->getPost('username'),
                'level' => $this->request->getPost('level'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $password = $this->request->getPost('password');
            if (!empty ($password)) {
                $dataToUpdate['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            $result = $userModel->update($id, $dataToUpdate);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Diperbarui!!!");
                return redirect()->to(base_url('/user'));
            } else {
                session()->setFlashdata("error", "Data Gagal Diperbarui!!!");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Data Gagal Diperbarui!!!");
            return redirect()->back();
        }
    }


    public function delete($id)
    {
        $userModel = new UserModel();

        $existingData = $userModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $userModel->delete($id);

        if ($result) {
            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->back();
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }
}
