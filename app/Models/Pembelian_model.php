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

    function getCountTempPembelian($kd_trxbeli = null)
    {
        $builder = $this->db->table('trx_pembelian_temp');
        $builder->select('count(*) total_row');
        $builder->where('kd_trx_pembelian', $kd_trxbeli);
        // $builder->orderby('id_pembelian','DESC');
        $query = $builder->get();
        return $query;
    }

    function getTotalPembelianCetak($kd_trx = null)
    {
        $builder = $this->db->table('trx_pembelian');
        $builder->selectSum('total');
        $builder->where('kd_trx_pembelian', $kd_trx);
        $total = $builder->get();
        return $total;
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

    function selesaipembelian($kd_trxbeli, $id_suplier, $create_by, $keterangan)
    {
        $total = $this->getTotalPembelian($kd_trxbeli)->getRow('total');
        $_query = "INSERT INTO master_pembelian (kd_trx_pembelian,total_pembelian,created_date,created_by,keterangan,id_suplier) VALUES ('" . $kd_trxbeli . "'," . $total . ",'" . date('Y-m-d H:i:s') . "','" . $create_by . "','" . $keterangan . "','" . $id_suplier . "')";
        $result = $this->db->query($_query);
        return $result;
    }

    function addtemptotrx($kd_trxbeli= null)
    {
        $_query="INSERT INTO trx_pembelian (kd_trx_pembelian, kd_produk, nama_barang, harga, qty,stok, total, diskon, keterangan, created_date)  SELECT kd_trx_pembelian, kd_produk, nama_barang, harga, qty, qty stok, total, diskon, keterangan, created_date FROM trx_pembelian_temp WHERE kd_trx_pembelian='".$kd_trxbeli."'";
        $result = $this->db->query($_query);
        return $result;
    }
    function truncatetmp()
    {
        return $this->db->query("TRUNCATE trx_pembelian_temp");
    }

    function testSelect()
    {
        return $this->db->query("SELECT * FROm trx_pembelian_temp");
    }

    /**
     * cetak pembelian
     */
    function cetakPembelian($id_pembelian)
    {
        $builder = $this->db->table('trx_pembelian');
        $builder->select('*');
        $builder->where('kd_trx_pembelian', $id_pembelian);
        $query = $builder->get();
        return $query;
    }


    function getDetailPembelian($kd_trx= null){
        $query="SELECT a.*,b.*,c.nama_suplier
        FROM trx_pembelian a
        LEFT JOIN master_pembelian b on a.kd_trx_pembelian= b.kd_trx_pembelian 
        LEFT JOIN data_suplier c on b.id_suplier = c.id_suplier
        WHERE a.kd_trx_pembelian = '".$kd_trx."'";
        $result =$this->db->query($query);
        return $result;
    }
    /**
     * cek stok pembelian by kd_produk
     */
    function cekStok($kd_produk)
    {
        $_query = "SELECT id_pembelian,kd_trx_pembelian,id_pembelian,kd_produk,stok,harga FROM trx_pembelian WHERE kd_produk = ? AND stok !=0";
        $result = $this->db->query($_query, array($kd_produk));
        return $result;
    }

    public function UpdateStokPembelian($id, $stok)
    {
        $result = $this->db->query("UPDATE trx_pembelian SET stok='$stok' WHERE id_pembelian='$id'");
        return $result;
    }
    // function tes(){
    //     return $this->table('products')
    //                     ->join('categories', 'categories.category_id = products.category_id')
    //                     ->get()
    //                     ->getResultArray();
    // }
}
