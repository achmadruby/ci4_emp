<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PendidikanModel;
use App\Models\KaryawanModel;

class PendidikanController extends BaseController
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
        $title['title'] = "Data Pendidikan";
        $pendidikanModel = new PendidikanModel();
        $pendidikan['pendidikan'] = $pendidikanModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/pendidikan/index', ['title' => $title, 'pendidikan' => $pendidikan, 'employeeData' => $employeeData]);
    }

    public function create()
    {
        $title['title'] = "Data Pendidikan - Tambah";
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/pendidikan/create', ['title' => $title, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $pendidikanModel = new PendidikanModel();

        $validationRules = [
            'pendidikan' => 'required|max_length[255]',
        ];

        if ($this->validate($validationRules)) {
            $dataToAdd = [
                'pendidikan' => $this->request->getPost('pendidikan'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $pendidikanModel->insert($dataToAdd);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/pendidikan'));
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
        $title['title'] = "Data Pendidikan - Edit";
        $pendidikanModel = new PendidikanModel();
        $pendidikan['pendidikan'] = $pendidikanModel->getPendidikanById($id);
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/pendidikan/edit', ['title' => $title, 'pendidikan' => $pendidikan, 'employeeData' => $employeeData]);
    }

    public function update($id)
    {
        $pendidikanModel = new PendidikanModel();

        $validationRules = [
            'pendidikan' => 'required|max_length[255]',
        ];

        if ($this->validate($validationRules)) {
            $existingData = $pendidikanModel->find($id);

            if (!$existingData) {
                return $this->response->setJSON(['pendidikan' => 'error', 'message' => 'Data not found.']);
            }

            $dataToUpdate = [
                'pendidikan' => $this->request->getPost('pendidikan'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $pendidikanModel->update($id, $dataToUpdate);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/pendidikan'));
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
        $pendidikanModel = new PendidikanModel();

        $existingData = $pendidikanModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $pendidikanModel->delete($id);

        if ($result) {
            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->back();
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }
}
