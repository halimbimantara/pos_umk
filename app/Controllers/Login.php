<?php namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
		$data = array('title'=>"Pos Umkm");
		return view('main_login',$data);
	}

	//--------------------------------------------------------------------

}
