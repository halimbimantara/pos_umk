<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Produk_model;
use App\Models\Auth_model;

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
		$model = new Auth_model();
		$menu = '';
			foreach($model->getMenuRole($this->session->roleid)->getResult() as $getmenu){

				$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							'.$getmenu->menu.'
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
				$menu .=	'<ul class="nav nav-treeview">';
					foreach($model->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu){
						$menu .=	'<li class="nav-item">
								<a href="'.base_url("$getsubmenu->url").'" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>'.$getsubmenu->submenu.'</p>
								</a>
							</li>';
					}
				$menu .= '</ul>';

				$menu .= '</li>';
			}

			$data['menu'] = $menu;
		return view('laporan/penjualan_pembelian.php',$data);
	}

}