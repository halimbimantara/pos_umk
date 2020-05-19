<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = array('title'=>"Pos Umkm");
		return view('main_layout',$data);
	}

	//--------------------------------------------------------------------

}
