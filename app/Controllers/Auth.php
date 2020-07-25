<?php namespace App\Controllers;

class Auth extends \IonAuth\Controllers\Auth
{
    protected $viewsFolder = 'auth';
    public function index()
	{
		$data = array('title'=>"Pos Umkm");
		return view('main_login',$data);
	}
}