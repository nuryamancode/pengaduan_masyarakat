<?php

namespace App\Models;

use CodeIgniter\Model;

class Tindakan extends Model
{
    protected $table = 'tindakan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'keterangan',
        'lampiran',
        'id_pengaduan',
        'id_user',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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

    public function getTindakanWithExcludedStatuses($excludedStatuses)
    {
        return $this->select('tindakan.*, pengaduan.status, pengaduan.data_mentah, pengaduan.id_user as pengadu_id')
            ->join('pengaduan', 'pengaduan.id = tindakan.id_pengaduan')
            ->whereNotIn('pengaduan.status', $excludedStatuses)
            ->findAll();
    }

    public function getTindakanUserLogged($excludedStatuses, $userId)
{
    return $this->select('tindakan.*, pengaduan.status, pengaduan.data_mentah, pengaduan.id_user as pengadu_id')
        ->join('pengaduan', 'pengaduan.id = tindakan.id_pengaduan')
        ->where('pengaduan.id_user', $userId)
        ->whereNotIn('pengaduan.status', $excludedStatuses)
        ->findAll();
}

}
