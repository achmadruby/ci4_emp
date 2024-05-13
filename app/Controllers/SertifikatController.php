<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SertifikatModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KaryawanModel;
use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;

class SertifikatController extends BaseController
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
        $title['title'] = "Data Sertifikat";
        $sertifikatModel = new SertifikatModel();
        $sertifikat['sertifikat'] = $sertifikatModel->getEmployees();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/sertifikat/index', ['title' => $title, 'sertifikat' => $sertifikat, 'employeeData' => $employeeData]);
    }

    public function create()
    {
        $title['title'] = "Data Sertifikat - Tambah";
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->getActiveEmployees();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/sertifikat/create', ['title' => $title, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function store()
    {
        $sertifikatModel = new SertifikatModel();

        $validationRules = [
            'id_emp' => 'required|integer',
            'sertifikat' => 'required|max_length[255]',
            // 'file' => 'uploaded[image]|max_size[image,4096]|is_image[image]',
            'file' => 'uploaded[file]|max_size[file,4096]|mime_in[file,application/pdf]',
        ];

        if ($this->validate($validationRules)) {
            $file = $this->request->getFile('file');

            if ($file->isValid() && !$file->hasMoved()) {
                $file->move(ROOTPATH . 'public/uploads/sertifikat');

                $fileName = $file->getName();
            }

            $dataToAdd = [
                'id_emp' => $this->request->getPost('id_emp'),
                'sertifikat' => $this->request->getPost('sertifikat'),
                'file' => isset($fileName) ? $fileName : null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $sertifikatModel->insert($dataToAdd);

            if ($result) {
                session()->setFlashdata("success", "Berhasil disimpan!");
                return redirect()->to(base_url('/sertifikat'));
            } else {
                session()->setFlashdata("error", "Data gagal ditambahkan.");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("error", "Data gagal ditambahkan.");
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $title['title'] = "Data Sertifikat - Edit";
        $sertifikatModel = new SertifikatModel();
        $sertifikat['sertifikat'] = $sertifikatModel->getSertifikatById($id);
        $empModel = new KaryawanModel();
        $emp['emp'] = $empModel->findAll();
        $employeModel = new KaryawanModel();
        $id_emp = session()->get('id_emp');
        $employeeData = $employeModel->select('nama, image')->find($id_emp);
        return view('pages/sertifikat/edit', ['title' => $title, 'sertifikat' => $sertifikat, 'emp' => $emp, 'employeeData' => $employeeData]);
    }

    public function update($id)
    {
        $sertifikatModel = new SertifikatModel();

        $namaSertifikat = $this->request->getPost('sertifikat');
        $fileSertifikat = $this->request->getFile('file');

        if ($fileSertifikat->isValid() && !$fileSertifikat->hasMoved()) {
            $filename = $fileSertifikat->getRandomName();
            $fileSertifikat->move(ROOTPATH . 'public/uploads/sertifikat', $filename);

            $updatedData = [
                'sertifikat' => $namaSertifikat,
                'file' => $filename,
            ];
        } else {
            $updatedData = [
                'sertifikat' => $namaSertifikat,
            ];
        }

        $result = $sertifikatModel->update($id, $updatedData);

        if ($result) {
            session()->setFlashdata("success", "Berhasil diupdate!");
            return redirect()->to(base_url('/sertifikat'));
        } else {
            session()->setFlashdata("error", "Data gagal diupdate.");
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $sertifikatModel = new SertifikatModel();

        $existingData = $sertifikatModel->find($id);

        if (!$existingData) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data not found.']);
        }

        $result = $sertifikatModel->delete($id);

        if ($result) {
            $filePath = ROOTPATH . 'public/uploads/sertifikat/' . $existingData['file'];
            if ($existingData['file'] && file_exists($filePath)) {
                unlink($filePath);
            }

            session()->setFlashdata("success", "Berhasil dihapus!");
            return redirect()->to(base_url('/sertifikat'));
        } else {
            session()->setFlashdata("error", "Data gagal dihapus.");
            return redirect()->back();
        }
    }

    public function viewPdf($fileName)
    {
        $filePath = ROOTPATH . 'public/uploads/sertifikat/' . $fileName;
        $dompdf = new Dompdf();

        if (file_exists($filePath)) {
            $dompdf->loadHtml($fileName);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($fileName);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found: ' . $fileName);
        }
    }

    // public function viewPdf($fileName)
    // {
    //     $filePath = ROOTPATH . 'public/uploads/sertifikat/' . $fileName;

    //     $pdf = new Fpdi();
    //     $pdf->AddPage();
    //     $pdf->setSourceFile($fileName);
    //     $tplId = $pdf->importPage(1);
    //     $pdf->useTemplate($tplId, 10, 10, 100);

    //     $pdf->Output();
    // }
}
