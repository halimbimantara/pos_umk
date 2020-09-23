<?php namespace App\Controllers;

class Home extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->cekLogin();
	}

	public function cekLogin(){
		$username = $this->session->get('username');
		if(!$username){
			return redirect()->to(base_url('login'));
		}
	}
	public function index()
	{
		$data = array(
			'title'=>"Pos Umkm"
		);
		$data['username'] = $_SESSION['username'];
		return view('main_layout',$data);
	}

	//--------------------------------------------------------------------

}
