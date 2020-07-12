<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
 
class Pos_model extends Model
{
    protected $db;
    protected $table = 'master_penjualan';

    function __construct()
    {
        parent::__construct();
        $db      = \Config\Database::connect();
        // $this->tmdb = new Tmdb(); // declare Tmdb as a new object
    }
    function getLastNotaPenjualan()
    {
        $builder = $this->db->table('master_pembelian');
        $builder->select('*');
        $builder->orderBy('kd_trx_penjualan','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    function getListProduk(){
        $builder = $this->db->table('master_produk');
        $builder->select('*');
        $query = $builder->get(); 
        return $query;
    }

    /**
     * Get Margin
     */

     function getmargin(){
        $builder = $this->db->table('master_margin');
        $builder->select('*');
        $builder->orderBy('create_date','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
     }

    /**
     * Search produk 
     * return nama,stok,harga eceran ,harga grosir
     */
    function getDataProdukBySearch($search = null){
        $builder = $this->db->table('get_produk_stok');
        $builder->select('*');
        $builder->where('kd_produk =',$search);
        $builder->orLike('nama_produk',$search);
        $builder->orWhere('kd_barcode =',$search); 
        $query = $builder->get(); 
        return $query;
    }

    function getDataProdukSearch($search = null){
        $builder = $this->db->table('master_produk');
        $builder->select('*');
        $builder->where('kd_produk =',$search);
        $builder->orLike('nama_produk',$search);
        $builder->orWhere('kd_barcode =',$search); 
        $query = $builder->get(); 
        return $query;
    }


    /**
     * Add
     * data 
     * kd_produk,nm_produk,
     */
    function addDataPenjualanTemp($data = array()){
        $builder = $this->db->table('trx_penjualan_tmp');
        $result = $builder->insert($data);
        return $result;
    }

    function getTablePenjualantmp($kode_trx = null){
        $builder = $this->db->table('trx_penjualan_tmp');
        $builder->select('*,(harga*qty) as subtotal');
        $builder->where('kd_trx_penjualan', $kode_trx);
        $query = $builder->get();
        return $query;
    }

    function getTotalPenjualan($kd_trx = null)
    {
        $builder = $this->db->table('trx_penjualan_tmp');
        $builder->selectSum('sub_total');
        $builder->where('kd_trx_penjualan', $kd_trx);
        $total = $builder->get();
        return $total;
    }

    function getListSuplier($nama){
        $builder = $this->db->table('data_suplier');
        $builder->select('*');
        $builder->Like('nama_suplier',$nama);
        $result = $builder->get();
        return $result;
    }


    function updateTablePenjualantmp($id_penjualan,$qty){

    }

    function delTablePenjualantmp($id_penjualan){
        $_query="TRUNCATE `trx_penjualan_tmp`";
        $this->db->query($_query);
    }
}
/**
 * History Query
 
SELECT b.nama_produk,a.harga,a.stok,a.created_date FROM trx_pembelian a
JOIN master_produk b on b.kd_produk= a.kd_produk
WHERE a.stok > 0
ORDER BY a.created_date  DESC
 

*/