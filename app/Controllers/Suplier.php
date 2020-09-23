<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Pos_model;
use App\Models\Produk_model;

class Suplier extends BaseController
{
	protected $request;
	function __construct()
	{
		$request = \Config\Services::request();
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$mpos = new Produk_model();
		$m_margin = new Pos_model();
		$data = [
			'suplier' => $mpos->getSuplier()->getResult()
		];
		$data['username'] = $_SESSION['username'];
		return view('admin/suplier/suplier_view', $data);
	}

	/**
	 * Detail 
	 */
	public function detail($idSuplier)
	{
		$model = new Produk_model();
		$data = $model->getProdukSuplier($idSuplier);
		$data = [
			'nama_suplier' => $data->getRow()->nama_suplier,
			'produk' => $data->getResult()
		];
		$data['username'] = $_SESSION['username'];
		return view('admin/suplier/suplier_produk', $data);
	}


	public function add()
	{
		$model = new Produk_model();
		$data = array(
			'nama_suplier' => $this->request->getVar('nama_suplier'),
			'alamat' => $this->request->getVar('alamat'),
			'no_tlpn' => $this->request->getVar('no_tlpn'),
			'sales_hp'  => $this->request->getVar('no_sales'),
			'keterangan'  => $this->request->getVar('keterangan'),
			'created_date'  => date('Y-m-d')
		);

		$response = array();
		$r_insert = $model->addSuplier($data);
		if ($r_insert != NULL) {
			session()->setFlashdata('success', 'Add Suplier successfully');
		} else {
			session()->setFlashdata('failed', 'Add Suplier failed');
		}
		return redirect()->to(base_url('suplier'));
	}

	public function edit()
	{
		$model = new Produk_model();
		$id_suplier=$this->request->getVar('suplier_id');
		$data = array(
			'no_tlpn' => $this->request->getVar('eno_tlpn'),
			'nama_suplier' => $this->request->getVar('enama_suplier'),
			'sales_hp'  => $this->request->getVar('eno_sales'),
			'alamat'  => $this->request->getVar('ealamat'),
			'keterangan'  => $this->request->getVar('eketerangan'),
			'created_date'  => date('Y-m-d')
		);

		$r_update = $model->updateSuplier($id_suplier,$data);
		if ($r_update != NULL) {
			session()->setFlashdata('success', 'Update Suplier successfully');
		} else {
			session()->setFlashdata('failed', 'Update Suplier failed');
		}
		return redirect()->to(base_url('suplier'));
	}

	public function delete()
    {
        $model = new Produk_model();
		$id = $this->request->getPost('suplier_id');
		$data = array('status'=> 1);
        $r_delete =$model->deleteSuplier($id,$data);
		if ($r_delete != NULL) {
			session()->setFlashdata('success', 'Delete Suplier successfully');
		} else {
			session()->setFlashdata('failed', 'Delete Suplier failed');
		}
		return redirect()->to(base_url('suplier'));
    }
}
