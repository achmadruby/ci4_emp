<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartementModel;
use App\Models\KaryawanModel;
use App\Models\PendidikanModel;
use App\Models\StatusModel;
use App\Models\SertifikatModel;
use CodeIgniter\HTTP\ResponseInterface;

class KaryawanController extends BaseController
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

    protected $helpers = ['form'];

    public function index()
    {
        $title['title'] = "Data Karyawan";
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->showActiveEmployees();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/emp/index', ['title' => $title, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function create()
    {
        $title['title'] = "Data Karyawan - Tambah";
        $deptModel = new DepartementModel;
        $dept['dept'] = $deptModel->findAll();
        $statusModel = new StatusModel;
        $status['status'] = $statusModel->findAll();
        $pendidikanModel = new PendidikanModel;
        $pendidikan['pendidikan'] = $pendidikanModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/emp/create', ['title' => $title, 'dept' => $dept, 'status' => $status, 'pendidikan' => $pendidikan, 'employeeData' => $employeeData]);
    }

    public function edit($id)
    {
        $title['title'] = "Data Karyawan - Edit";
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->getKaryawanById($id);
        $deptModel = new DepartementModel;
        $dept['dept'] = $deptModel->findAll();
        $statusModel = new StatusModel;
        $status['status'] = $statusModel->findAll();
        $pendidikanModel = new PendidikanModel;
        $pendidikan['pendidikan'] = $pendidikanModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/emp/edit', ['title' => $title, 'emp' => $emp, 'dept' => $dept, 'status' => $status, 'pendidikan' => $pendidikan, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $empModel = new KaryawanModel();

        $id_emp = session()->get('id_emp');
        $employeeName = $empModel->select('nama')->find($id_emp);

        $validationRules = [
            'id_dept' => 'required|integer',
            'id_status' => 'required|integer',
            'id_pendidikan' => 'required|integer',
            'id_card' => 'required|max_length[255]',
            'no_absen' => 'required|integer',
            'nik' => 'required|max_length[255]',
            'nama' => 'required|max_length[255]',
            'tempat_lahir' => 'required|max_length[255]',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required|in_list[PRIA,WANITA]',
            'alamat' => 'required|max_length[255]',
            'no_kk' => 'required|max_length[255]',
            'agama' => 'required|in_list[ISLAM,KATOLIK,PROTESTAN,HINDU,BUDDHA,KONGHUCU]',
            'join_date' => 'required',
            'active' => 'required|in_list[YES,NO]',
            'no_hp' => 'required|max_length[255]',
            'email' => 'required|max_length[255]',
            'jurusan' => 'required|max_length[255]',
            'image' => 'uploaded[image]|max_size[image,4096]|is_image[image]',
        ];

        if ($this->validate($validationRules)) {
            $image = $this->request->getFile('image');

            if ($image->isValid() && !$image->hasMoved()) {
                $image->move(ROOTPATH . 'public/uploads/foto');

                $imageName = $image->getName();
            }

            $dataToAdd = [
                'id_dept' => $this->request->getPost('id_dept'),
                'id_status' => $this->request->getPost('id_status'),
                'id_pendidikan' => $this->request->getPost('id_pendidikan'),
                'id_card' => $this->request->getPost('id_card'),
                'no_absen' => $this->request->getPost('no_absen'),
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_kk' => $this->request->getPost('no_kk'),
                'agama' => $this->request->getPost('agama'),
                'join_date' => $this->request->getPost('join_date'),
                'active' => $this->request->getPost('active'),
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'jurusan' => $this->request->getPost('jurusan'),
                'image' => isset($imageName) ? $imageName : null,
                'created_by' => $employeeName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $empModel->insert($dataToAdd);

            if ($result) {
                session()->setFlashdata("success", "Data Berhasil Ditambahkan!!!");
                return redirect()->to(base_url('/emp'));
            } else {
                session()->setFlashdata("error", "Data Gagal Ditambahkan!!!");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Data Gagal Ditambahkan!!!");
            return redirect()->back();
        }
    }

    public function update($id)
    {
        $empModel = new KaryawanModel();

        $dept = $this->request->getPost('id_dept');
        $status = $this->request->getPost('id_status');
        $pendidikan = $this->request->getPost('id_pendidikan');
        $card = $this->request->getPost('id_card');
        $no_absen = $this->request->getPost('no_absen');
        $nik = $this->request->getPost('nik');
        $nama = $this->request->getPost('nama');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $alamat = $this->request->getPost('alamat');
        $no_kk = $this->request->getPost('no_kk');
        $agama = $this->request->getPost('agama');
        $join_date = $this->request->getPost('join_date');
        $active = $this->request->getPost('active');
        $no_hp = $this->request->getPost('no_hp');
        $email = $this->request->getPost('email');
        $jurusan = $this->request->getPost('jurusan');
        $image = $this->request->getFile('image');

        if ($image->isValid() && !$image->hasMoved()) {
            $filename = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/foto', $filename);

            $updatedData = [
                'id_dept' => $dept,
                'id_status' => $status,
                'id_pendidikan' => $pendidikan,
                'id_card' => $card,
                'no_absen' => $no_absen,
                'nik' => $nik,
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'no_kk' => $no_kk,
                'agama' => $agama,
                'join_date' => $join_date,
                'active' => $active,
                'no_hp' => $no_hp,
                'email' => $email,
                'jurusan' => $jurusan,
                'image' => $filename,
            ];
        } else {
            $updatedData = [
                'id_dept' => $dept,
                'id_status' => $status,
                'id_pendidikan' => $pendidikan,
                'id_card' => $card,
                'no_absen' => $no_absen,
                'nik' => $nik,
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'no_kk' => $no_kk,
                'agama' => $agama,
                'join_date' => $join_date,
                'active' => $active,
                'no_hp' => $no_hp,
                'email' => $email,
                'jurusan' => $jurusan,
            ];
        }

        $result = $empModel->update($id, $updatedData);

        if ($result) {
            session()->setFlashdata("success", "Berhasil diupdate!");
            return redirect()->to(base_url('/emp'));
        } else {
            session()->setFlashdata("error", "Data gagal diupdate.");
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $empModel = new KaryawanModel();

        $existingData = $empModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $empModel->delete($id);

        if ($result) {
            $imagePath = ROOTPATH . 'public/uploads/foto/' . $existingData['image'];
            if ($existingData['image'] && file_exists($imagePath)) {
                unlink($imagePath);
            }

            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->to(base_url('/emp'));
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $title['title'] = "Data Karyawan - Detail";
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

        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);

        return view('pages/emp/detail', [
            'title' => $title,
            'emp' => $emp,
            'departmentData' => $departmentData,
            'statusData' => $statusData,
            'pendidikanData' => $pendidikanData,
            'employeeData' => $employeeData,
            'SertifikatData' => $SertifikatData,
        ]);
    }
}
