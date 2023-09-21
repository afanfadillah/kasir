<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
class Home extends BaseController
{
    protected $modelKategori;
    protected $modelProduk;
    function __construct(){
        $this->modelKategori = new KategoriModel();
        $this->modelProduk = new ProdukModel();
    }
    public function index(): string
    {
        $kategori= $this->request->getVar('kat');

        if ($kategori){
            $where=['kategoriProduk'=>$kategori];

            $kategorilist=$this->modelProduk->getAllProduk()->where($where)->get()->getResult();
        }
        else {
            $kategorilist=$this->modelProduk->getAllproduk()->get()->getResult();
        }
        $data = [
            'title'=>'Kasir',
            'kategori'=>$this->modelKategori->findAll(),
            'produk'=>$kategorilist
        ];
        
        
        return view('dashboard',$data);
    }
}
