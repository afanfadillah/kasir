<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\KeranjangModel;
use App\Models\TransaksiModel;
class Home extends BaseController
{
    protected $modelKategori;
    protected $modelProduk;
    protected $modelKeranjang;
    protected $modelTransaksi;


    function __construct(){
        $this->modelKategori = new KategoriModel();
        $this->modelProduk = new ProdukModel();
        $this->modelKeranjang = new KeranjangModel();
        $this->modelTransaksi = new TransaksiModel();
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

        $total = 0;

        if (count($keranjang)>0){
            $keranjang=json_decode($keranjang[0]->data)->data;

            foreach ($keranjang as $key => $value) {
                $total = $total + ((int)$value->jumlah * (int)$value->hargaProduk);

            }


        }else{
            $keranjang=[];
        }

        $data = [
            'title'=>'Kasir',
            'kategori'=>$this->modelKategori->findAll(),
            'produk'=>$kategorilist,
            'keranjang'=>$keranjang,
            'total'=>$total,
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
public function hapusKeranjang()
    {
        $id=$this->request->getVar('idProduk');
        $keranjang=$this->modelKeranjang->findAll();
        $keranjang = json_decode($keranjang[0]->data)->data;
        $itemKeranjang = [];

        foreach ($keranjang as $key => $value){
            if ($value->idProduk !== $id){
                $itemKeranjang[] = $value;
            }
        }

        $dataUpdate = [
            'data' => json_encode(['data' => $itemKeranjang])
        ];
        $this->modelKeranjang->update(1,$dataUpdate);

        $keranjangNew = $this->modelKeranjang->where(['id' => 1])->findAll();
        echo $keranjangNew[0]->data;
    }

    public function bayarPesanan()
    {
        $keranjang = $this->modelKeranjang->where(['id' => 1])->findAll();

        if (count($keranjang) == 0){
            echo json_encode(['status' => false]);
            exit;  // program berhenti membaca coding di baris ini

        }
        $keranjang = json_decode($keranjang[0]->data)->data;
        if (count($keranjang) > 0){
            echo json_encode(['status'=> true]);
        }else{
            echo json_encode(['status'=> false]);
        };
    }
    public function simpanTransaksi()
    {
        $keranjangRaw = $this->modelKeranjang->where(['id'=> 1])->findAll();
        $keranjang = json_decode($keranjangRaw[0]->data)->data;
        $grandTotal = 0;
        foreach ($keranjang as $key => $value) {
            $grandTotal = $grandTotal + ((int)$value->jumlah * (int)$value->hargaProduk);
        }
        if ((int)$grandTotal > (int)$this->request->getVar('cash')) {
            $uangKurang = (int)$grandTotal-(int)$this->request->getVar('cash');
            session()->setFlashdata('failed','Uang kurang sebesar '.  number_to_currency((float)$uangKurang,'IDR','id_ID') );
            
            return redirect()->to('gagal');
        }

        $dataSimpan = [
            'emailKasirTransaksi' => user()->email,
            'grandTotalTransaksi' => $grandTotal,
            'cashTransaksi' => $this->request->getVar('cash'),
            'itemTransaksi' => $keranjangRaw[0]->data,
            'tanggalBayarTransaksi' => date("Y-m-d H:i:s")

        ];
        if ($this->modelTransaksi->insert($dataSimpan)){
            $this->modelKeranjang->delete(1);
            if (((int)$this->request->getVar('cash')-(int)$grandTotal) > 0){
                $kembalian=(int)$this->request->getVar('cash')-(int)$grandTotal;
                session()->setFlashdata('messsage','kembalian sebesar '.  number_to_currency((float)$kembalian,'IDR','id_ID') );
                
            }
            return redirect()->to('sukses');
        }
    }
    public function suksesTransaksi(){
        $data = [
            'title'=>'Pembayaran Sukses',
            
        ];
        
        
        return view('sukses',$data);
    }
    public function gagalTransaksi(){
        $data = [
            'title'=>'Pembayaran Gagal',
            
        ];
        
        
        return view('gagal',$data);
    }
}
