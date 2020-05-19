<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class Stok_model extends Model
{
    function getListStokByKodetrx($kode_trx = null){
        return $this->findAll();
    }
}