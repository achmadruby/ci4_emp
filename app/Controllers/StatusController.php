<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StatusModel;
use App\Models\KaryawanModel;

class StatusController extends BaseController
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
        $title['title'] = "Data Status";
        $statusModel = new StatusModel();
        $status['status'] = $statusModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/status/index', ['title' => $title, 'status' => $status, 'employeeData' => $employeeData]);
    }

    public function create()
    {
        $title['title'] = "Data Status - Tambah";
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/status/create', ['title' => $title, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $statusModel = new StatusModel();

        $validationRules = [
            'status' => 'required|max_length[255]',
        ];

        if ($this->validate($validationRules)) {
            $dataToAdd = [
                'status' => $this->request->getPost('status'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $statusModel->insert($dataToAdd);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/status'));
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
        $title['title'] = "Data Status - Edit";
        $statusModel = new StatusModel();
        $status['status'] = $statusModel->getStatusById($id);
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/status/edit', ['title' => $title, 'status' => $status, 'employeeData' => $employeeData]);
    }

    public function update($id)
    {
        $statusModel = new StatusModel();

        $validationRules = [
            'status' => 'required|max_length[255]',
        ];

        if ($this->validate($validationRules)) {
            $existingData = $statusModel->find($id);

            if (!$existingData) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
            }

            $dataToUpdate = [
                'status' => $this->request->getPost('status'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $statusModel->update($id, $dataToUpdate);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/status'));
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
        $statusModel = new StatusModel();

        $existingData = $statusModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $statusModel->delete($id);

        if ($result) {
            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->back();
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }
}
