<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\ConnectionInterface;

class Register extends BaseController
{
	protected $session;
	function __construct()
	{
		helper('form','url');
		$this->validation = \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->connect = \Config\Database::connect();
	}

	public function index()
	{	
		$data = array('title'=>"Pos Umkm",'username' => "" );
		return view('v_register',$data);
	}

	public function posRegister(){
        $nama   = $this->request->getPost('nama');
        $email   = $this->request->getPost('email');
		$username   = $this->request->getPost('username');
        $password   = sha1(base64_encode($this->request->getPost('password')));
        $no_hp   = $this->request->getPost('no_hp');
        $alamat   = $this->request->getPost('alamat');
		
		$val = $this->validate([
            'nama' => 'required',
            'email' => 'required',
			'username' => 'required',
            'password' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required'
        ]);
        
		if(!$val){
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
			session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->validation->getErrors());
            // kembali ke halaman login
            return redirect()->to(base_url('register'));
        } else {
            
            $data = [
                'first_name' => $nama,
                'email' => $email,
                'username' => $username,
                'password'  => $password,
                'phone'  => $no_hp
                // 'alamat' => $alamat
            ];
            $this->connect->table('users')->insert($data);

            session()->setFlashdata('success', 'Selamat register anda telah berhasil');
            return redirect()->to(base_url('register'));
        }
	}

	public $login = [
		'username' => 'required',
		'password' => 'required'
	];
	 
	public $register_errors = [
		'username' => [
			'required'      => 'Username wajib diisi'
		],
		'password' => [
			'required'      => 'Password wajib diisi'
		]
	];

	public function logout(){
		$this->session->destroy();
		return redirect()->to(base_url('login'));
	}

	//--------------------------------------------------------------------

}
