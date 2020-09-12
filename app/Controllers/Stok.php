<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Produk_model;

class Stok extends BaseController
{
	public function index()
	{
		
		$mpos = new Produk_model();
		$data['produk'] = $mpos->ceksisastok()->getResult();
		$data['kategori']=$mpos->getListKategori(0)->getResult();

		$data['suplier'] = $mpos->getSuplier()->getResult();
		return view('admin/stok', $data);
	}
}
