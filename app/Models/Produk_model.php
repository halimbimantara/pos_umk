<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class Produk_model extends Model
{
    protected $table = 'master_produk';
    protected $returnType = 'object';  
    protected $db;

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
    }

    function addProduk($data = null)
    {
        $builder = $this->db->table('master_produk');
        $result = $builder->insert($data);
        return $result;
    }
}