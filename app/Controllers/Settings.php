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
}
