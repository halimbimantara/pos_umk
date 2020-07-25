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
		return view('admin/stok', $data);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}
}
