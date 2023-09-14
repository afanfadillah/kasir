<?php 

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idKategori';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['namaKategori','iconKategori','colorKategori','slugKategori'];

    

    public function Function_Name()
    {
        // query builder
    }
}