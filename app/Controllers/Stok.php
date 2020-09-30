<?php

namespace App\Controllers;

use App\Models\Pembelian_model;
use App\Models\Pos;
use App\Models\Produk_model;
use App\Models\Auth_model;

class Stok extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
	}
	public function index()
	{
		
		$mpos = new Produk_model();
		$data['produk'] = $mpos->ceksisastok()->getResult();
		$data['kategori']=$mpos->getListKategori(0)->getResult();

		$data['suplier'] = $mpos->getSuplier()->getResult();
		$data['username'] = $_SESSION['username'];
		$modelaut = new Auth_model();
			$menu = '';
			foreach($modelaut->getMenuRole($this->session->roleid)->getResult() as $getmenu){

				$menu .= '<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							'.$getmenu->menu.'
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>';
				$menu .=	'<ul class="nav nav-treeview">';
					foreach($modelaut->getSubmenuRole($getmenu->menu_id)->getResult() as $getsubmenu){
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
		return view('admin/stok', $data);
	}
}
