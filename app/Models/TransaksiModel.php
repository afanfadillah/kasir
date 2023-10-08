<?php 

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'idTransaksi';
    protected $returnType = 'object';
    protected $allowedFields= ['emailKasirTransaksi','grandTotalTransaksi','cashTransaksi','itemTransaksi','tanggalBayarTransaksi'];
}