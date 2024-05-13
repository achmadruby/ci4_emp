<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_dept',
        'id_status',
        'id_pendidikan',
        'id_card',
        'no_absen',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_kk',
        'agama',
        'join_date',
        'active',
        'no_hp',
        'email',
        'jurusan',
        'image',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function showActiveEmployees()
    {
        return $this->select('employees.*, departement.*, status.*, pendidikan.*, employees.id as empid')
            ->join('departement', 'departement.id = employees.id_dept')
            ->join('status', 'status.id = employees.id_status')
            ->join('pendidikan', 'pendidikan.id = employees.id_pendidikan')
            ->where('active', 'YES')
            ->findAll();
    }

    public function getKaryawanById($id)
    {
        return $this->find($id);
    }

    public function getEmployees()
    {
        return $this->select('employees.*, departement.*, status.*, pendidikan.*, employees.id as empid')
            ->join('departement', 'departement.id = employees.id_dept')
            ->join('status', 'status.id = employees.id_status')
            ->join('pendidikan', 'pendidikan.id = employees.id_pendidikan')
            ->findAll();
    }

    public function getActiveEmployees()
    {
        return $this->select('employees.*')
            ->where('active', 'Yes')
            ->findAll();
    }

    public function getDepartmentById($id_dept)
    {
        return $this->db->table('departement')
            ->where('id', $id_dept)
            ->get()
            ->getRowArray();
    }

    public function getStatusById($id_status)
    {
        return $this->db->table('status')
            ->where('id', $id_status)
            ->get()
            ->getRowArray();
    }

    public function getPendidikanById($id_pendidikan)
    {
        return $this->db->table('pendidikan')
            ->where('id', $id_pendidikan)
            ->get()
            ->getRowArray();
    }

    public function countEmployees()
    {
        return $this->countAll();
    }

}
