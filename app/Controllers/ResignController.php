<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ResignModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KaryawanModel;
use App\Models\SertifikatModel;

class ResignController extends BaseController
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
        $title['title'] = "Data Resign";
        $resignModel = new ResignModel();
        $resign['resign'] = $resignModel->getEmployees();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/resign/index', ['title' => $title, 'resign' => $resign, 'employeeData' => $employeeData]);
    }

    public function create()
    {
        $title['title'] = "Data Resign - Tambah";
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->showActiveEmployees();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/resign/create', ['title' => $title, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $resignModel = new ResignModel();

        $empModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeName = $empModel->select('nama')->find($id_emp);

        $validationRules = [
            'id_emp' => 'required|integer',
            'resign_date' => 'required',
        ];

        if ($this->validate($validationRules)) {
            $dataToAdd = [
                'id_emp' => $this->request->getPost('id_emp'),
                'resign_date' => $this->request->getPost('resign_date'),
                'created_by' => $employeeName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $resignModel->insert($dataToAdd);

            if ($result) {
                $empModel = new KaryawanModel();
                $empId = $this->request->getPost('id_emp');
                $empModel->update($empId, ['active' => 'NO']);

                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/resign'));
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
        $title['title'] = "Data Sertifikat - Edit";
        $resignModel = new ResignModel();
        $resign['resign'] = $resignModel->getResignById($id);
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/resign/edit', ['title' => $title, 'resign' => $resign, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function update($id)
    {
        $resignModel = new ResignModel();

        $empModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeName = $empModel->select('nama')->find($id_emp);

        $validationRules = [
            'id_emp' => 'required|integer',
            'resign_date' => 'required',
        ];

        if ($this->validate($validationRules)) {
            $existingData = $resignModel->find($id);

            if (!$existingData) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
            }

            $dataToUpdate = [
                'id_emp' => $this->request->getPost('id_emp'),
                'resign_date' => $this->request->getPost('resign_date'),
                'created_by' => $employeeName,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $resignModel->update($id, $dataToUpdate);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/resign'));
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
        $resignModel = new ResignModel();

        $existingData = $resignModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $resignModel->delete($id);

        if ($result) {
            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->back();
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $title['title'] = "Data Resign - Detail";
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->getKaryawanById($id);

        $departmentId = $emp['emp']['id_dept'];
        $departmentData = $empModel->getDepartmentById($departmentId);

        $statusId = $emp['emp']['id_status'];
        $statusData = $empModel->getStatusById($statusId);

        $pendidikanId = $emp['emp']['id_pendidikan'];
        $pendidikanData = $empModel->getPendidikanById($pendidikanId);

        $serifikatModel = new SertifikatModel();
        $SertifikatData = $serifikatModel->getSertifikat($id);

        $resignModel = new ResignModel();
        $resignDateData = $resignModel->getResignDateById($id);

        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);

        return view('pages/resign/detail', [
            'title' => $title,
            'emp' => $emp,
            'departmentData' => $departmentData,
            'statusData' => $statusData,
            'pendidikanData' => $pendidikanData,
            'employeeData' => $employeeData,
            'SertifikatData' => $SertifikatData,
            'resignDateData' => $resignDateData,
        ]);
    }
}
