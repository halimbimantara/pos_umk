<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\ConnectionInterface;

class Login extends BaseController
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
		if($this->session->username == ""){
			$data = array('title'=>"Pos Umkm",'username' => "" );
			return view('main_login',$data);
		} else {
			return redirect()->to(base_url('home'));
		}
	}

	public function posLogin(){
		$username   = $this->request->getPost('username');
		$password   = sha1(base64_encode($this->request->getPost('password')));
		
		$sqlcek        = "SELECT * FROM users WHERE username='$username' AND password='$password' ";
		$querycek      = $this->connect->query($sqlcek);
		$ceking        = count($querycek->getResult());

		$sqlcek2        = "SELECT * FROM users WHERE username='$username' AND password='$password' AND active = '1' ";
		$querycek2      = $this->connect->query($sqlcek2)->getResult();
		$ceking2        = count($querycek2);

		$val = $this->validate([
			'username' => 'required',
        	'password' => 'required'
		]);
        $data = [
            'username'  => $username,
            'password'  => $password
        ];
		if(!$val){
            // mengembalikan nilai input yang sudah dimasukan sebelumnya
			session()->setFlashdata('inputs', $this->request->getPost());
            // memberikan pesan error pada saat input data
            session()->setFlashdata('errors', $this->validation->getErrors());
            // kembali ke halaman login
            return redirect()->to(base_url('login'));
        } else {
			if($ceking == 0 && $ceking2 == 0){
				session()->setFlashdata('danger', 'Maaf username atau pasword anda salah');
				return redirect()->to(base_url('login'));
			} elseif($ceking > 0 && $ceking2 == 0){
				session()->setFlashdata('danger', 'Maaf username anda belum aktive silahkan hubungi pihak admin');
				return redirect()->to(base_url('login'));
			} else {
				$_SESSION['username'] = $username;
				return redirect()->to(base_url('home'));
			}
            // menuju ke halaman home
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
