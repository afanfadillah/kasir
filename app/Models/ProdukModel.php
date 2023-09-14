<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'idProduk';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';
    

    protected $allowedFields = ['skuProduk','namaProduk','hargaProduk','tersediaProduk','gambarProduk','kategoriProduk'];


    function getAllproduk(){
        $builder = $this->table('produk');
        $builder->join('kategori', 'kategori.idKategori = produk.kategoriProduk','LEFT');
        return $builder;
    }
}