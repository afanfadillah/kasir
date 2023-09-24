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
    public function tambah() {
        // upload file
        $gambar = $this->request->getfile('gambarProduk');
        $gambar->move('assets/img/'.explode(",",$this->request->getVar('kategoriProduk'))[1]);
        $namagambar = $gambar->getName();
       $dataSimpan = [
           'skuProduk' => $this->request->getVar('skuProduk'),
           'namaProduk' => $this->request->getVar('namaProduk'),
           'hargaProduk' => $this->request->getVar('hargaProduk'),
           'kategoriProduk' =>explode(",",$this->request->getVar('kategoriProduk'))[0],
           'tersediaProduk' => '1',
           'gambarProduk' => $namagambar,
       ];
        $exe = $this->modelProduk->insert($dataSimpan);
        if ($exe){
            session()->setFlashdata('success', 'Menu Berhasil Di tambahkan');
            return redirect()->to('menu');
        }
    }
    public function hapus($id){
        $infoGambar = $this->request->getVar('infoGambar');
        unlink('assets/img/'. explode(",",$infoGambar)[0].'/'.explode(",",$infoGambar)[1]);

        $exe = $this->modelProduk->delete($id);
        if ($exe){
            session()->setFlashdata('success', 'Menu Berhasil Di Hapus');
            return redirect()->to('menu');
        }
        
    }
    public function ubah($id){
        $infoGambar = $this->request->getVar('infoGambar');
        
        $gambar = $this->request->getfile('gambarProduk');
        
        if ($gambar->getError() == 4) {
            $namagambar = explode(",",$infoGambar)[1];
        }else {
            unlink('assets/img/'. explode(",",$infoGambar)[0].'/'.explode(",",$infoGambar)[1]);
            $gambar->move('assets/img/'.explode(",",$this->request->getVar('kategoriProduk'))[1]);
            $namagambar = $gambar->getName();
        }
        
        $dataUbah = [
            'skuProduk' => $this->request->getVar('skuProduk'),
            'namaProduk' => $this->request->getVar('namaProduk'),
            'hargaProduk' => $this->request->getVar('hargaProduk'),
            'kategoriProduk' =>explode(",",$this->request->getVar('kategoriProduk'))[0],
            'tersediaProduk' => '1',
            'gambarProduk' => $namagambar
        ];

        $exe = $this->modelProduk->update($id,$dataUbah);
        if($exe) {
            session()->setFlashdata('success', 'Menu Berhasil Di Ubah');
            return redirect()->to('menu');
        }
    }
}
