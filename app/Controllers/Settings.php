<?php

namespace App\Controllers;

use App\Models\Setting_model;
use CodeIgniter\Database\ConnectionInterface;
use App\Models\Auth_model;

class Settings extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->connect = \Config\Database::connect();
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
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
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
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('admin/settings/penjualan_setting', $data);
	}

	public function updateGeneralSetting()
	{
		$logo = $this->request->getFile('file_upload');
		$logo->move(ROOTPATH . 'resources/uploads');

		$data = [
			'nama_usaha' => $this->request->getPost('nama_usaha'),
			'alamat_usaha' => $this->request->getPost('alamat_usaha'),
			'no_tlpn' => $this->request->getPost('no_tlpn'),
			'no_wa' => $this->request->getPost('no_wa'),
			'logo' => $logo->getName()
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

	public function addroles()
	{
		$data = [
			'role' => $this->request->getPost('nama_roles')
		];
		$model = new Setting_model();
		$update = $model->addRole($data);
		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Insert Role Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/userroles'));
		}
	}

	public function addMenu()
	{
		$data = [
			'menu' => $this->request->getPost('nama_menu')
		];
		$model = new Setting_model();
		$add = $model->addMenu($data);
		if ($add) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Insert Menu successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/usermenu'));
		}
	}

	public function updateMenu()
	{
		$data = [
			'menu' => $this->request->getPost('nama_menu')
		];
		$id = $this->request->getPost('id');
		$model = new Setting_model();
		$update = $model->updateMenu($id, $data);
		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update Menu successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/usermenu'));
		}
	}

	public function deleteMenu()
	{
		$data = [
			'menu' => $this->request->getPost('menu')
		];
		$id = $this->request->getPost('id');
		$model = new Setting_model();
		$update = $model->deleteMenu($id);
		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Delete Menu successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/usermenu'));
		}
	}

	// sub menu

	public function addMenusub()
	{
		$data = [
			'menu_id' => $this->request->getPost('nama_menu'),
			'submenu' => $this->request->getPost('nama_submenu'),
			'url' => $this->request->getPost('url')
		];
		$model = new Setting_model();
		$add = $model->addMenusub($data);
		if ($add) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Insert Menu successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/usermenu'));
		}
	}

	public function updateMenusub()
	{
		$data = [
			'menu_id' => $this->request->getPost('nama_menu'),
			'submenu' => $this->request->getPost('nama_submenu'),
			'url' => $this->request->getPost('url')
		];
		$id = $this->request->getPost('id');
		$model = new Setting_model();
		$update = $model->updateMenusub($id, $data);
		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update Menu successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/usermenu'));
		}
	}

	public function deleteMenusub()
	{
		$data = [
			'submenu' => $this->request->getPost('menu')
		];
		$id = $this->request->getPost('id');
		$model = new Setting_model();
		$update = $model->deleteMenusub($id);
		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Delete Menu successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/usermenu'));
		}
	}

	// end sub menu

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
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
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
		$data['roles'] = $model->settings_role()->getResult();
		$data['username'] = $_SESSION['username'];
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('admin/settings/userroles_view', $data);
	}

	public function userrolesedit($role_id)
	{
		$model = new Setting_model();
		$data = array();
		$data['role_id'] = $role_id;
		$data['nama_role'] = $model->getRoleMenu($role_id)->getRow()->role;
		$data['getmenu'] = $model;
		$data['username'] = $this->session->username;
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('admin/settings/userroles_view_edit', $data);
	}

	public function  getSubmenu($id)
	{
		$model = new Setting_model();
		return $model->submenuusers($id);
	}

	public function usermenu()
	{
		$model = new Setting_model();
		$data = array();
		$data['roles_menu'] = $model->settings_menus()->getResult();
		$data['menus'] = $model;
		$data['username'] = $_SESSION['username'];
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('admin/settings/userrolesmenu_view', $data);
	}

	public function setingkategori()
	{
		$model = new Setting_model();
		$data = array();
		$data['kategoriprod'] = $model->settings_katproduk()->getResult();
		$data['username'] = $_SESSION['username'];
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('admin/settings/kategoriprod_view', $data);
	}

	public function all_user_settings()
	{
		$model = new Setting_model();
		$data = array();
		$data['setting_all_user'] = $model->settings_all_users()->getResult();
		$data['role'] = $model->settings_role()->getResult();
		$data['username'] = $_SESSION['username'];
		$modelaut = new Auth_model();
		$menu = '';
		foreach ($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

			$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
			$menu .=	'<ul class="nav nav-treeview">';
			foreach ($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
				$menu .=	'<li class="nav-item">
								<a href="' . base_url("$getsubmenu->url") . '" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>' . $getsubmenu->submenu . '</p>
								</a>
							</li>';
			}
			$menu .= '</ul>';

			$menu .= '</li>';
		}

		$data['menu'] = $menu;
		return view('admin/settings/all_user_view', $data);
	}

	public function roleSubmite()
	{
		$data = [
			'aktif' => $this->request->getPost('aktif')
		];
		$role_id = $this->request->getPost('role_id');
		$menu_id = $this->request->getPost('menu_id');
		$submenu_id = $this->request->getPost('submenu_id');
		$model = new Setting_model();
		$roleAcces = $model->roleAcces($role_id, $menu_id, $submenu_id)->getRow();

		if ($roleAcces) {
			$update = $model->updateSettingRole($data, $role_id, $menu_id, $submenu_id);
		} else {
			$data['role_id'] = $role_id;
			$data['menu_id'] = $menu_id;
			$data['submenu_id'] = $submenu_id;
			$update = $model->insertSettingRole($data);
		}

		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update General Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/userrolesedit/' . $role_id));
		}
	}

	public function roleSubmiteInsert()
	{
		$data = [
			'insert' => $this->request->getPost('insert')
		];
		$role_id = $this->request->getPost('role_id');
		$menu_id = $this->request->getPost('menu_id');
		$submenu_id = $this->request->getPost('submenu_id');
		$model = new Setting_model();
		$roleAcces = $model->roleAcces($role_id, $menu_id, $submenu_id)->getRow();

		if ($roleAcces) {
			$update = $model->updateSettingRole($data, $role_id, $menu_id, $submenu_id);
		} else {
			$data['role_id'] = $role_id;
			$data['menu_id'] = $menu_id;
			$data['submenu_id'] = $submenu_id;
			$update = $model->insertSettingRole($data);
		}

		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update General Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/userrolesedit/' . $role_id));
		}
	}

	public function roleSubmiteUpdate()
	{
		$data = [
			'update' => $this->request->getPost('update')
		];
		$role_id = $this->request->getPost('role_id');
		$menu_id = $this->request->getPost('menu_id');
		$submenu_id = $this->request->getPost('submenu_id');
		$model = new Setting_model();
		$roleAcces = $model->roleAcces($role_id, $menu_id, $submenu_id)->getRow();

		if ($roleAcces) {
			$update = $model->updateSettingRole($data, $role_id, $menu_id, $submenu_id);
		} else {
			$data['role_id'] = $role_id;
			$data['menu_id'] = $menu_id;
			$data['submenu_id'] = $submenu_id;
			$update = $model->insertSettingRole($data);
		}

		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update General Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/userrolesedit/' . $role_id));
		}
	}

	public function roleSubmiteDelete()
	{
		$data = [
			'delete' => $this->request->getPost('delete')
		];
		$role_id = $this->request->getPost('role_id');
		$menu_id = $this->request->getPost('menu_id');
		$submenu_id = $this->request->getPost('submenu_id');
		$model = new Setting_model();
		$roleAcces = $model->roleAcces($role_id, $menu_id, $submenu_id)->getRow();

		if ($roleAcces) {
			$update = $model->updateSettingRole($data, $role_id, $menu_id, $submenu_id);
		} else {
			$data['role_id'] = $role_id;
			$data['menu_id'] = $menu_id;
			$data['submenu_id'] = $submenu_id;
			$update = $model->insertSettingRole($data);
		}

		if ($update) {
			// Deklarasikan session flashdata dengan tipe success
			session()->setFlashdata('success', 'Update General Setting successfully');
			// Redirect halaman ke product
			return redirect()->to(base_url('settings/userrolesedit/' . $role_id));
		}
	}

	public function all_user_edit()
	{
		$model = new Setting_model();
		$id_suplier = $this->request->getVar('suplier_id');
		$data = array(
			'first_name' => $this->request->getVar('enama_suplier'),
			'username' => $this->request->getVar('username'),
			'phone'  => $this->request->getVar('eno_sales'),
			'alamat'  => $this->request->getVar('ealamat'),
			'active'  => $this->request->getVar('eketerangan'),
			'email'  => $this->request->getVar('email')
			// 'created_date'  => date('Y-m-d')
		);

		if ($this->request->getPost('password') != '') {
			$data['password'] = sha1(base64_encode($this->request->getPost('password')));
		}

		$r_update = $model->settings_all_users_update($id_suplier, $data);
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
		$r_delete = $model->deleteUsers($id);
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
