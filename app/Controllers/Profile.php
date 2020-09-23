<?php namespace App\Controllers;

class Profile extends BaseController
{
	function __construct()
	{
		$this->session = \Config\Services::session();
	}
	public function index()
	{
		$data['username'] = $_SESSION['username'];
		return view('admin/settings/user_profile',$data);
	}

}