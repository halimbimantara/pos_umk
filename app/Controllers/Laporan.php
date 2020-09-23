<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Produk_model;

class Laporan extends BaseController
{
	protected $request;
	function __construct()
	{
		$request = \Config\Services::request();
		$this->session = \Config\Services::session();
    }

    public function index()
	{
		// $mpos= new Produk_model();
		// $data = [
		// 	'pager' => $mpos->pager,
		// 	'produk' => $mpos->paginate(10),
		// ];
		$data['username'] = $_SESSION['username'];
		return view('laporan/penjualan_pembelian.php',$data);
	}

}