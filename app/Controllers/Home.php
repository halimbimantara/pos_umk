<?php

namespace App\Controllers;

use App\Models\Auth_model;
use CodeIgniter\Controller;
use CodeIgniter\Database\ConnectionInterface;

class Home extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->connect = \Config\Database::connect();
	}

	public function cekLogin()
	{
		$username = $this->session->get('username');
		if (!$username) {
			return redirect()->to(base_url('login'));
		}
	}
	public function index()
	{
		$data = array(
			'title' => "Pos Umkm"
		);
		if ($this->session->username) {
			$data['username'] = $this->session->username;
			$model = new Auth_model();
			$menu = '';
			foreach ($model->getMenuRole($this->session->roleid)->getResult() as $getmenu) {

				$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							' . $getmenu->menu . '
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
				$menu .=	'<ul class="nav nav-treeview">';
				foreach ($model->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu) {
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
			return view('main_layout', $data);
		} else {
			return redirect()->to(base_url('login'));
		}
	}

	public function updatefile()
	{
		echo "sh " . base_url() . "/scriptGit.sh";
		echo shell_exec("sh " . base_url() . "/scriptGit.sh");
	}

	public function cekPath()
	{
		// $old_path = getcwd();
		// // chdir('/path/to/file');
		// echo $old_path;
		// //make sure to make the shell file executeable first before running the shell_exec function
		// $output = shell_exec($old_path.'/scriptGit.sh');
		// // chdir($old_path);
		$output = shell_exec("git pull https://github.com/halimbimantara/pos_umk.git");
		echo $output;
	}

	//--------------------------------------------------------------------

}
