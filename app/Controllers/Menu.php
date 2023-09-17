<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
class Menu extends BaseController
{
    protected $modelKategori;
    protected $modelProduk;
    function __construct(){
        $this->modelKategori = new KategoriModel();
        $this->modelProduk = new ProdukModel();
    }
    public function index(): string
    {
        $data = [
            'title'=>'Menu',
            'kategori'=>$this->modelKategori->findAll(),
            'produk'=>$this->modelProduk->getAllproduk()->get()->getResult()
        ];
        
        
        return view('menu',$data);
    }
}
