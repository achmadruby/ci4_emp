<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DepartementModel;
use App\Models\KaryawanModel;

class DepartementController extends BaseController
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
        $title['title'] = "Data Departement";
        $deptModel = new DepartementModel();
        $dept['dept'] = $deptModel->findAll();

        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);

        return view('pages/dept/index', [
            'title' => $title, 
            'dept' => $dept,
            'employeeData' => $employeeData
        ]);
    }

    public function create()
    {
        $title['title'] = "Data Departement - Tambah";
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/dept/create', ['title' => $title, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $deptModel = new DepartementModel();

        $validationRules = [
            'departement' => 'required|max_length[255]',
        ];

        if ($this->validate($validationRules)) {
            $dataToAdd = [
                'departement' => $this->request->getPost('departement'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $deptModel->insert($dataToAdd);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/dept'));
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
        $title['title'] = "Data Departement - Edit";
        $deptModel = new DepartementModel();
        $dept['dept'] = $deptModel->getDeptById($id);
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/dept/edit', ['title' => $title, 'dept' => $dept, 'employeeData' => $employeeData]);
    }

    public function update($id)
    {
        $deptModel = new DepartementModel();

        $validationRules = [
            'departement' => 'required|max_length[255]',
        ];

        if ($this->validate($validationRules)) {
            $existingData = $deptModel->find($id);

            if (!$existingData) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
            }

            $dataToUpdate = [
                'departement' => $this->request->getPost('departement'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $deptModel->update($id, $dataToUpdate);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/dept'));
            } else {
                session()->setFlashdata("error", "Data Gagal Ditambahkan!!!");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Data Gagal Ditambahkan!!!");
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $deptModel = new DepartementModel();

        $existingData = $deptModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $deptModel->delete($id);

        if ($result) {
            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->back();
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }
}
