<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class Pembelian_model extends Model
{
    protected $table = 'master_pembelian';
    protected $db;

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        // $this->tmdb = new Tmdb(); // declare Tmdb as a new object
    }

    // protected $allowedFields = ['name', 'email'];
    function historyTrxPembelian()
    {
        return $this->findAll();
    }

    function getDetailTrxPembelian($nota_pembelian = null)
    {
    }

    function getLastNotaPembelian()
    {
        $builder = $this->db->table('master_pembelian');
        $builder->select('*');
        $builder->orderby('id_pembelian', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    function getDataProdukBySearch($search = null)
    {
        $builder = $this->db->table('master_pembelian');
        $builder->select('*');
        $builder->orderby('id_pembelian', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    function getHargaBeliTerakhir($kd_produk = null)
    {
        $builder = $this->db->table('trx_pembelian');
        $builder->select('*');
        $builder->where('kd_produk', $kd_produk);
        $builder->orderby('id_pembelian', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    function addDataPembelianTemp($data = null)
    {
        $builder = $this->db->table('trx_pembelian_temp');
        $result = $builder->insert($data);
        return $result;
    }

    function getTempPembelian($kd_trxbeli = null)
    {
        $builder = $this->db->table('trx_pembelian_temp');
        $builder->select('*,(harga*qty) as subtotal');
        $builder->where('kd_trx_pembelian', $kd_trxbeli);
        // $builder->orderby('id_pembelian','DESC');
        $query = $builder->get();
        return $query;
    }

    function getTotalPembelian($kd_trxbeli = null)
    {
        $builder = $this->db->table('trx_pembelian_temp');
        $builder->selectSum('total', FALSE);
        $builder->where('kd_trx_pembelian', $kd_trxbeli);
        $total = $builder->get();
        return $total;
    }

    function delTempPembelian($idtrx = null)
    {
        $builder = $this->db->table('trx_pembelian_temp');
        $builder->where('id_pembelian', $idtrx);
        $result = $builder->delete();
        return $result;
    }

    function selesaipembelian($kd_trxbeli){
        $total = $this->getTempPembelian($kd_trxbeli);
        $builder = $this->db->table('trx_pembelian_temp');
        $query = $builder->select('*,qt');

    }
}
