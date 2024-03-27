<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KaryawanModel;
use App\Models\ResignModel;
use App\Models\DepartementModel;
use App\Models\UserModel;

class DashboardController extends BaseController
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
        $employeModel = new KaryawanModel();
        $jumlahKaryawan = $employeModel->countEmployees();

        $resignModel = new ResignModel();
        $jumlahKaryawanNonaktif = $resignModel->countResign();

        $deptModel = new DepartementModel();
        $dept = $deptModel->countDept();

        $userModel = new UserModel();
        $user = $userModel->countUser();

        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);

        $title['title'] = "Dashboard";
        return view('pages/dashboard/index', [
            'title' => $title,
            'employeeData' => $employeeData,
            'jumlahKaryawan' => $jumlahKaryawan,
            'jumlahKaryawanNonaktif' => $jumlahKaryawanNonaktif,
            'dept' => $dept,
            'user' => $user,
        ]);
    }
}
