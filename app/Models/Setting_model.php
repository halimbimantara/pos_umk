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

}