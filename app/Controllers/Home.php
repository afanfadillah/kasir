<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\KeranjangModel;
class Home extends BaseController
{
    protected $modelKategori;
    protected $modelProduk;
    protected $modelKeranjang;


    function __construct(){
        $this->modelKategori = new KategoriModel();
        $this->modelProduk = new ProdukModel();
        $this->modelKeranjang = new KeranjangModel();
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

        $keranjang=$this->modelKeranjang->findAll();
        if (count($keranjang)>0){
            $keranjang=json_decode($keranjang[0]->data)->data;
        }else{
            $keranjang=[];
        }

        $data = [
            'title'=>'Kasir',
            'kategori'=>$this->modelKategori->findAll(),
            'produk'=>$kategorilist,
            'keranjang'=>$keranjang
        ];
        
        
        return view('dashboard',$data);
    }
    public function welcome(): string
    {
        
        $data = [
            'title'=>'Welcome',
            
        ];
        
        
        return view('welcome',$data);
    }
    public function addKeranjang()
    {
        $id=$this->request->getVar('idProduk');
        $data = [
            'idProduk'=>$id,
        ];
        $produk=$this->modelProduk->where($data)->first();
        $keranjang=$this->modelKeranjang->findAll();
        $itemKerangjang= [];

        if(count($keranjang)==0){
            // kalau keranjang kosong
            foreach ($produk as $key => $value){
                $itemKeranjang[$key]=$value;
            }
            $itemKeranjang['jumlah']= 1;
            $itemKeranjang['keterangan']= '';
            $dataInsert=[
                'id'=>1,
                'data'=>json_encode(['data' => [$itemKeranjang]])
            ];
            $this->modelKeranjang->insert($dataInsert);
        }else{
            // kalau keranjang berisi
            $keranjang = json_decode($keranjang[0]->data)->data;

            foreach ($produk as $key => $value){
                $itemKeranjang[$key]=$value;
            }
            $itemKeranjang['jumlah']= 1;
            $itemKeranjang['keterangan']= '';

            $keranjangNew = array_merge($keranjang, [$itemKeranjang]);
            $jsonKeranjangNew = json_encode( ['data'=>$keranjangNew]);

            // Decode json data ke associative array
            $dataArray = json_decode($jsonKeranjangNew, true);

            // process the data to merge items with the same idProduk and sum their jumlah
            $mergeData = [];
            foreach ($dataArray['data'] as $item) {
                $idProduk = $item['idProduk'];
                if (isset($mergedData[$idProduk])){
                    $mergedData[$idProduk]['jumlah'] += $item['jumlah'];
                }else{
                    $mergedData[$idProduk] = $item;
                }
            }

            // Reindex array to get sequential keys
            $mergedData = array_values($mergedData);

            $dataUpdate = [
                'data' => json_encode(['data' => $mergedData])
            ];
            $this->modelKeranjang->update(1, $dataUpdate);
        }
        $keranjangNew = $this->modelKeranjang->where(['id' => 1])->findAll();
        echo $keranjangNew[0]->data;


    } 
}
