<?php

namespace App\Models;

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

    function editproduk($id, $data)
    {
        $query = $this->db->table('master_produk')->update($data, array('kd_produk' => $id));
        return $query;
    }
    function showproduk()
    {
        $query = "SELECT a.*,c.kategori,sum(b.stok) as stok_total,b.harga harga_jual 
        FROM master_produk a 
        LEFT JOIN (SELECT * FROM trx_pembelian
        WHERE id_pembelian IN (
            SELECT MAX(id_pembelian)
            FROM trx_pembelian
            GROUP BY nama_barang
        ) ) b ON a.kd_produk = b.kd_produk 
    
        LEFT JOIN tb_kategori_produk c ON a.id_kategori=c.id
        GROUP by a.kd_produk";
        $result = $this->db->query($query);
        return $result;
    }

    /**
     * tipe k1,k2,k3
     */
    function getListKemasan($tipe=null){
        $builder = $this->db->table('tb_kemasan');
        $builder->select('*');
        $builder->where('tipe', $tipe);
        $builder->orderBy('nama', 'ASC');
        $query = $builder->get();
        return $query;
    }

    function getListKategori(){
        $builder = $this->db->table('tb_kategori_produk');
        $builder->select('*');
        $builder->orderBy('kategori', 'ASC');
        $query = $builder->get();
        return $query;
    }

    function ceksisastok()
    {
        $query = "SELECT a.*,sum(b.stok) as stok_total  
        FROM master_produk a 
        LEFT JOIN trx_pembelian b ON a.kd_produk = b.kd_produk 
         GROUP by a.kd_produk";
        $result = $this->db->query($query);
        return $result;
    }


    /**
     * Get Suplier
     */

    function getSuplier()
    {
        $builder = $this->db->table('data_suplier');
        $builder->select('*');
        $builder->where('status', 0);
        $builder->orderBy('created_date', 'DESC');
        $query = $builder->get();
        return $query;
    }


    /**
     * TODO
     * id
     */
    function getProdukSuplier($id)
    {
        $query = "SELECT a.*,b.nama_suplier FROM suplier_pembelian a LEFT JOIN data_suplier b on a.id_suplier= b.id_suplier 
                  WHERE a.id_suplier=" . $id . " GROUP BY a.kd_produk";
        $result = $this->db->query($query);
        return $result;
    }

    function addSuplier($data = null)
    {
        $builder = $this->db->table('data_suplier');
        $result = $builder->insert($data);
        return $result;
    }

    /**
     * Update Delete
     */
    function deleteSuplier($id, $data)
    {
        $query = $this->db->table('data_suplier')->update($data, array('id_suplier' => $id));
        return $query;
    }

    function updateSuplier($id, $data)
    {
        $query = $this->db->table('data_suplier')->update($data, array('id_suplier' => $id));
        return $query;
    }

    function cekBarcode($barcode)
    {
        $builder = $this->db->table('master_produk');
        $builder->select('*');
        $builder->where('kd_barcode', $barcode);
        $query = $builder->countAllResults();;
        return $query;
    }
}
