<?php 
namespace App\Controllers;
use App\Models\TransaksiModel;

class Laporan extends BaseController
{
    protected $modelTransaksi;
    public function __construct()
    {
        $this->modelTransaksi = new TransaksiModel();
    }

    public function index()
    {
        $transaksi = $this->modelTransaksi->findAll();

        $dataTransaksi=[];
        foreach ($transaksi as $key => $value) {
            foreach (json_decode($value->itemTransaksi)->data as $i => $item) {
                $dataTransaksi[]=$item;
            }
        }
        dd($dataTransaksi);

        $data = array(
            'title' => 'Laporan',
        );
        return view('laporan', $data);
    }
}