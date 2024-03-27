<?php

namespace App\Models;

use CodeIgniter\Model;

class ResignModel extends Model
{
    protected $table = 'resign';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_emp',
        'resign_date',
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

    public function getResignById($id)
    {
        return $this->find($id);
    }

    public function getEmployees()
    {
        return $this->select('resign.*, employees.*, resign.id as resignid')
            ->join('employees', 'employees.id = resign.id_emp')
            ->findAll();
    }

    public function countResign()
    {
        return $this->countAll();
    }
}
