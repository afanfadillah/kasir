<?php

namespace App\Controllers;
use App\Models\KategoriModel;
class Home extends BaseController
{
    protected $modelKategori;
    function __construct(){
        $this->modelKategori = new KategoriModel();
    }
    public function index(): string
    {
        $data = [
            'title'=>'Kategori',
            'kategori'=>$this->modelKategori->findAll()
        ];
        
        
        return view('dashboard',$data);
    }
}
