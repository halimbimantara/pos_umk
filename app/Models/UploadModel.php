<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UploadModel extends Model
{
    protected $table;
 
    public function __construct() {
 
        parent::__construct();
        $db = \Config\Database::connect();
        $this->table = $this->db->table('users');
    }
 
    public function get_uploads()
    {
        return $this->table->get()->getResultArray();
    }
    public function update_gambar($data , $username)
    {
        return $this->table->update($data, array('username' => $username));
    }
} 