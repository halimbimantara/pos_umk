<?php namespace App\Controllers;

use CodeIgniter\Database\ConnectionInterface;
use App\Models\UploadModel;
use App\Models\Auth_model;

class Profile extends BaseController
{
	function __construct()
	{
		helper('form');
		$this->session = \Config\Services::session();
		$this->connect = \Config\Database::connect();
		$this->model_upload = new UploadModel();
	}
	public function index()
	{
		$username = $this->session->username;
		$data['username'] = $username;

		$sqlcek        = "SELECT * FROM users WHERE username='$username'";
		$querycek      = $this->connect->query($sqlcek)->getResult();
		$ceking        = count($querycek);

		$data['users'] = $querycek;

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

		if (!$this->validate([]))
        {
            $data['validation'] = $this->validator;
            $data['uploads'] = $this->model_upload->get_uploads();
			return view('admin/settings/user_profile',$data);
		}
	}

	public function process()
    {
 
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to(base_url('profile'));
        }
 
        $validated = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,8096]'
        ]);
  
        if ($validated == FALSE) {
             
            // Kembali ke function index supaya membawa data uploads dan validasi
            return $this->index();
 
        } else {
 
            $avatar = $this->request->getFile('file_upload');
			$avatar->move(ROOTPATH . 'resources/uploads/logo');
 
            $data = [
				'image' => $avatar->getName(),
				'first_name' => $this->request->getPost('first_name'),
				'email' => $this->request->getPost('email'),
				'phone' => $this->request->getPost('phone')
			];
			
			if($this->request->getPost('password') != ''){
				$data['password'] = sha1(base64_encode($this->request->getPost('password')));
			}
     
            $this->model_upload->update_gambar($data , $this->session->username);
            return redirect()->to(base_url('profile'))->with('success', 'Upload successfully'); 
        }
 
    }

}