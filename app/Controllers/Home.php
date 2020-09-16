<?php namespace App\Controllers;

class Home extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data = array(
			'title'=>"Pos Umkm"
		);
		if($this->session->username){
			$data['username'] = $this->session->username;
			return view('main_layout',$data);
		} else {
			return redirect()->to(base_url('login'));
		}
	}

	//--------------------------------------------------------------------

}
