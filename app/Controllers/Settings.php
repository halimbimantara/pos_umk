<?php

namespace App\Controllers;

use App\Models\Setting_model;

class Settings extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
	}
	/**
	 * apps setting
	 */
	public function index()
	{
		$model = new Setting_model();
		$data = array();
		$data['data'] = $model->getSetting();
		// var_dump($data['nama_apps']);
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/general', $data);
	}

	/**
	 * Role Administrator / Owner
	 * Penjualan Setting
	 * 1.Setting Margin
	 * 2.
	 */
	public function psetting()
	{
		$model = new Setting_model();
		$data = array();
		$data['margin'] = $model->showMargin()->getRow();
		// var_dump($data['nama_apps']);
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/penjualan_setting', $data);
	}

	public function updateGeneralSetting()
	{
		$data = [
			'nama_usaha' => $this->request->getPost('nama_usaha'),
			'alamat_usaha' => $this->request->getPost('alamat_usaha'),
			'no_tlpn' => $this->request->getPost('no_tlpn'),
			'no_wa' => $this->request->getPost('no_wa'),
		];
		$model = new Setting_model();
		$update = $model->updateSetting($data);
		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update General Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings'));
		}
	}
	public function updateMargin()
	{
		$data = [
			'nama_usaha' => $this->request->getPost('nama_usaha'),
			'alamat_usaha' => $this->request->getPost('alamat_usaha')
		];
		$model = new Setting_model();
		$update = $model->updateSetting($data);

		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update General Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/psetting'));
		}
	}


	/**
	 * Satuan / Kemasan
	 */

	public function settingsatuan()
	{
		$model = new Setting_model();
		$data = array();
		$data['k1'] = $model->showkemasan(0)->getResult();
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/setting_satuan', $data);
	}

	public function updatesatuan()
	{
	}

	public function deletesatuan()
	{
	}

	public function userroles()
	{
		$model = new Setting_model();
		$data = array();
		$data['roles']=$model->settings_role()->getResult();
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/userroles_view', $data);
	}

	public function usermenu()
	{
		$model = new Setting_model();
		$data = array();
		$data['roles_menu']=$model->settings_menus()->getResult();
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/userrolesmenu_view', $data);
	}

	public function setingkategori(){
		$model = new Setting_model();
		$data = array();
		$data['kategoriprod']=$model->settings_katproduk()->getResult();
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/kategoriprod_view', $data);
	}

	public function all_user_settings(){
		$model = new Setting_model();
		$data = array();
		$data['setting_all_user']=$model->settings_all_users()->getResult();
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/all_user_view', $data);
	}

	public function all_user_edit()
	{
		$model = new Setting_model();
		$id_suplier=$this->request->getVar('suplier_id');
		$data = array(
			'first_name' => $this->request->getVar('enama_suplier'),
			'username' => $this->request->getVar('username'),
			'phone'  => $this->request->getVar('eno_sales'),
			'alamat'  => $this->request->getVar('ealamat'),
			'active'  => $this->request->getVar('eketerangan'),
			'email'  => $this->request->getVar('email')
			// 'created_date'  => date('Y-m-d')
		);

		if($this->request->getPost('password') != ''){
			$data['password'] = sha1(base64_encode($this->request->getPost('password')));
		}

		$r_update = $model->settings_all_users_update($id_suplier,$data);
		if ($r_update != NULL) {
			session()->setFlashdata('success', 'Update Users successfully');
		} else {
			session()->setFlashdata('failed', 'Update Users failed');
		}
		return redirect()->to(base_url('settings/all_user_settings'));
	}

	public function usersDelete()
    {
        $model = new Setting_model();
		$id = $this->request->getPost('suplier_id');
		$r_delete =$model->deleteUsers($id);
		if ($r_delete != NULL) {
			session()->setFlashdata('success', 'Delete Users successfully');
		} else {
			session()->setFlashdata('failed', 'Delete Users failed');
		}
		return redirect()->to(base_url('settings/all_user_settings'));
    }

	public function all_user_add()
	{
		$model = new Setting_model();
		$data = array(
			'first_name' => $this->request->getVar('enama_suplier'),
			'username' => $this->request->getVar('username'),
			'password' => sha1(base64_encode($this->request->getPost('password'))),
			'phone'  => $this->request->getVar('eno_sales'),
			'alamat'  => $this->request->getVar('ealamat'),
			'active'  => $this->request->getVar('eketerangan'),
			'email'  => $this->request->getVar('email')
			// 'created_date'  => date('Y-m-d')
		);

		$r_update = $model->addUsers($data);
		if ($r_update != NULL) {
			session()->setFlashdata('success', 'Add Users successfully');
		} else {
			session()->setFlashdata('failed', 'Add Users failed');
		}
		return redirect()->to(base_url('settings/all_user_settings'));
	}
}
