<?php namespace App\Models;

use CodeIgniter\Model;

class Auth_model extends Model
{
    protected $table = 'settings';
    protected $returnType = 'object';  
    protected $db;

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
    }

    function getMenuRole($role_id){
        $builder = $this->db->query("SELECT a.* , b.role as role_name , b.id as role_id ,
        d.menu , d.id as menu_id, e.submenu
        FROM users a 
        LEFT JOIN role b ON a.role = b.id
        LEFT JOIN role_akses c ON a.role = c.role_id
        LEFT JOIN role_menu d ON c.menu_id = d.id
        LEFT JOIN role_submenu e ON c.submenu_id = e.id
        WHERE c.aktif = '1' AND c.role_id = '".$role_id."' GROUP by d.id
        ");
        return $builder;
    }
    function getSubmenuRole($menu_id){
        $builder = $this->db->table('role_submenu');
        $builder->select('*');
        $builder->where('menu_id', $menu_id);
        return $builder->get();
    }

    function getMenuRoleInsert($role_id){
        $builder = $this->db->query("SELECT a.* , b.role as role_name , b.id as role_id 
        FROM users a 
        LEFT JOIN role b ON a.role = b.id
        LEFT JOIN role_akses c ON a.role = c.role_id
        LEFT JOIN role_menu d ON c.menu_id = d.id
        LEFT JOIN role_submenu e ON c.submenu_id = e.id
        WHERE c.aktif = '1'
        ");
        return $builder;
    }
  
}
