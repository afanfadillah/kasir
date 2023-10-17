<?php 

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    

    protected $allowedFields = ['id','data','onHold'];


   public function updateKeranjang($data,$where) {
    $this->db->table($this->table)->where($where)->update($data);
    
   }
}