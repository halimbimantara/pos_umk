<?php namespace App\Models;

use CodeIgniter\Model;

class Setting_model extends Model
{
    protected $table = 'settings';
    protected $returnType = 'object';  
    protected $db;

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
    }

    function getSetting()
    {
        return $this->findAll();
    }

    function updateSetting($data = null){
        $builder = $this->db->table('settings');
        $builder->set($data);
        $builder->where('id', 1);
        return $builder->update();
    }

    function showMargin(){
        $query = "SELECT * FROM master_margin ORDER BY create_date DESC LIMIT 0,1";
        $result= $this->db->query($query);
        return $result;
    }

    /**
     * @tipe 
     */
    function showkemasan($tipe){
        $builder = $this->db->table('tb_kemasan');
        $builder->where('tipe', $tipe);
        return $builder->get();
    }


    function settings_role(){
        $builder = $this->db->table('role');
        $builder->select('*');
        return $builder->get();
    }

    function settings_menus(){
        $builder = $this->db->table('role_menu');
        $builder->select('*');
        return $builder->get();
    }

    function settings_katproduk(){
        $builder = $this->db->table('tb_kategori_produk');
        $builder->select('*');
        return $builder->get();
    }

    function settings_all_users(){
        $builder = $this->db->table('users');
        $builder->select('*');
        return $builder->get();
    }

    function settings_all_users_update($id , $data){
        $query = $this->db->table('users')->update($data, array('id' => $id));
        return $query;
    }

    function addUsers($data)
    {
        $builder = $this->db->table('users');
        $result = $builder->insert($data);
        return $result;
    }

    function deleteUsers($id)
    {
        $builder = $this->db->table('users');
        $result = $builder->delete(['id' => $id]);
        return $result;
    }
}