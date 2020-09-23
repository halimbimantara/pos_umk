<?php

namespace App\Models;

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
        $builder->orderBy('kd_trx_penjualan', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    function getListProduk()
    {
        $builder = $this->db->table('master_produk');
        $builder->select('*');
        $query = $builder->get();
        return $query;
    }


    function deleteproduk($kd_produk)
    {
        $_query = "DELETE FROM trx_penjualan_tmp WHERE kd_produk = ?";
        $result = $this->db->query($_query, array($kd_produk));
        return $result;
    }

    function getTotalProdukQty($kd_trx)
    {
        $builder = $this->db->table('trx_penjualan_tmp');
        $builder->selectSum('qty');
        $builder->where('kd_trx_penjualan', $kd_trx);
        $result = $builder->get();
        return $result;
    }

    function getTotalJenisProduk($kd_trx)
    {
        $query = "SELECT COUNT(*) total
                  FROM (SELECT * FROM trx_penjualan_tmp
                  WHERE kd_trx_penjualan = '$kd_trx'
                  GROUP BY kd_produk) dt";
        $result = $this->db->query($query);
        return $result;
    }
    /**
     * Get Margin
     */

    function getmargin()
    {
        $builder = $this->db->table('master_margin');
        $builder->select('*');
        $builder->orderBy('create_date', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query;
    }

    /**
     * Search produk 
     * return nama,stok,harga eceran ,harga grosir
     */
    function getDataProdukBySearch($search = null)
    {
        $builder = $this->db->table('get_produk_stok');
        $builder->select('*');
        $builder->where('kd_produk =', $search);
        $builder->orLike('nama_produk', $search);
        $builder->orWhere('kd_barcode =', $search);
        $query = $builder->get();
        return $query;
    }

    function getProdukPembelian($search = null)
    {
        $result = $this->db->query("SELECT a.*,sum(b.stok) as stok_total,b.harga 
        FROM master_produk a 
        LEFT JOIN trx_pembelian b ON a.kd_produk = b.kd_produk 
        WHERE a.kd_produk ='" . $search . "' OR a.kd_barcode ='$search' OR a.nama_produk LIKE '%" . $search . "' 
         GROUP by a.kd_produk");
        return $result;
    }

    function getDataProdukSearch($search = null)
    {
        $builder = $this->db->table('master_produk');
        $builder->select('kd_produk,nama_produk');
        $builder->where('kd_produk =', $search);
        $builder->orLike('nama_produk', '%' . $search);
        $builder->orWhere('kd_barcode =', $search);
        $result = $builder->get();
        // $result = $this->db->query($_query);
        return $result;
    }

    function getDataProdukSearchv2($search = null)
    {
        $_query = "SELECT kd_produk,nama_produk,(SELECT 0 ) as tipe FROM master_produk 
                 WHERE nama_produk='" . $search . "'
                 OR nama_produk LIKE '%" . $search . "%'
                 UNION ALL 
                 SELECT id as kd_produk,nama_produk,(SELECT 1 ) as tipe FROM trx_search_temp
                 WHERE nama_produk='" . $search . "'
                 OR nama_produk LIKE '%" . $search . "%' ORDER BY nama_produk  DESC";
        // $_query ="SELECT kd_produk,nama_produk FROM master_produk 
        //          UNION ALL 
        //          SELECT id as kd_produk,nama_produk FROM trx_search_temp
        //          WHERE nama_produk='".$search."'
        //          OR nama_produk LIKE '%".$search."%'";
        // $builder = $this->db->table('master_produk');
        // $builder->select('kd_produk,nama_produk');
        // $builder->where('kd_produk =', $search);
        // $builder->orLike('nama_produk', '%' . $search);
        // $builder->orWhere('kd_barcode =', $search);
        // $query = $builder->get();
        $result = $this->db->query($_query);
        return $result;
    }

    function getDataProdukSearchByKodeTemp($search = null)
    {
        // $_query ="SELECT kd_produk,nama_produk FROM master_produk 
        //          UNION ALL 
        //          SELECT id as kd_produk,nama_produk FROM trx_search_temp
        //          WHERE nama_produk='".$search."'
        //          OR nama_produk LIKE '%".$search."%'";
        $_query = "SELECT id as kd_produk,nama_produk FROM trx_search_temp
                 WHERE id='" . $search . "'";
        // $builder = $this->db->table('master_produk');
        // $builder->select('kd_produk,nama_produk');
        // $builder->where('kd_produk =', $search);
        // $builder->orLike('nama_produk', '%' . $search);
        // $builder->orWhere('kd_barcode =', $search);
        // $query = $builder->get();
        $result = $this->db->query($_query);
        return $result;
    }

    function getDataProdukSearchTemp($search = null)
    {

        $_query = "SELECT * FROM trx_search_temp WHERE nama_produk LIKE '%" . $search . "%'";
        $result = $this->db->query($_query);
        return $result;
    }




    /**
     * Add
     * data 
     * kd_produk,nm_produk,
     */
    function addDataPenjualanTemp($data = array())
    {
        $builder = $this->db->table('trx_penjualan_tmp');
        $result = $builder->insert($data);
        return $result;
    }

    function getTablePenjualantmp($kode_trx = null)
    {
        $result = $this->db->query("SELECT b.gambar_produk as gambar,a.id_penjualan,a.kd_trx_penjualan,a.kd_produk,a.kd_trx_pembelian,a.nama_barang,SUM(qty) qty,a.harga,SUM(a.sub_total) sub_total,a.diskon,a.kd_satuan,a.created_date
        FROM trx_penjualan_tmp a 
        LEFT JOIN master_produk b ON a.kd_produk = b.kd_produk 
        WHERE a.kd_trx_penjualan ='" . $kode_trx . "' GROUP by a.kd_produk");

        // $builder = $this->db->table('trx_penjualan_tmp');
        // $builder->select('id_penjualan,kd_trx_penjualan,kd_produk,kd_trx_pembelian,nama_barang,SUM(qty) qty,harga,SUM(sub_total) sub_total,diskon,kd_satuan,created_date');
        // $builder->where('kd_trx_penjualan', $kode_trx);
        // $builder->groupBy('kd_produk');
        // $query = $builder->get();
        return $result;
    }


    function getTotalPenjualan($kd_trx = null)
    {
        $builder = $this->db->table('trx_penjualan_tmp');
        $builder->selectSum('sub_total');
        $builder->where('kd_trx_penjualan', $kd_trx);
        $total = $builder->get();
        return $total;
    }

    function getKategoriProduk()
    {
        $builder = $this->db->table('tb_kategori_produk');
        $builder->select('*');
        $result = $builder->get();
        return $result;
    }

    function getListSuplier($nama)
    {
        $builder = $this->db->table('data_suplier');
        $builder->select('*');
        $builder->Like('nama_suplier', $nama);
        $result = $builder->get();
        return $result;
    }

    function delTempKasir($id_jualtemp)
    {
        $_query = "DELETE FROM `trx_penjualan_tmp` WHERE `trx_penjualan_tmp`.`id_penjualan` = " . $id_jualtemp;
        $result = $this->db->query($_query);
        return $result;
    }

    //by kdproduk
    function updateAfterDelTempKasir($id_jualtemp)
    {
        //loop 
        $_query = "SELECT * FROM `trx_penjualan_tmp` WHERE ";
    }

    function updateTablePenjualantmp($id_penjualan, $qty)
    {
    }

    function delTablePenjualantmp($id_penjualan = null)
    {
        $_query = "TRUNCATE `trx_penjualan_tmp`";
        $this->db->query($_query);
    }

    function cetakPenjualan($id_penjualan)
    {
        // $_query="SELECT * from trx_penjualan WHERE kd_trx_penjualan ='.$id_penjualan.'";
        // $result = $this->db->query($_query);
        // return $result;
        $builder = $this->db->table('trx_penjualan');
        $builder->select('*');
        $builder->where('kd_trx_penjualan', $id_penjualan);
        $query = $builder->get();
        return $query;
    }

    function getTotalPenjualanCetak($kd_trx = null)
    {
        $builder = $this->db->table('trx_penjualan');
        $builder->selectSum('total');
        $builder->where('kd_trx_penjualan', $kd_trx);
        $total = $builder->get();
        return $total;
    }

    function selesaiTrx()
    {
        $_query = "INSERT INTO trx_penjualan (kd_trx_penjualan,kd_produk,kd_trx_pembelian,nama_barang,harga,qty,total,diskon,kd_satuan,created_date) SELECT kd_trx_penjualan,kd_produk,kd_trx_pembelian,nama_barang,harga,qty,sub_total as total,diskon,kd_satuan,created_date FROM trx_penjualan_tmp";
        $result = $this->db->query($_query);
        $this->delTablePenjualantmp();
        return $result;
    }

    //Search
    function addTotempSearch($data = array())
    {
        $builder = $this->db->table('trx_search_temp');
        $result = $builder->insert($data);
        return $result;
    }


    function updateTempSearch($id, $nama, $harga)
    {
        $builder = $this->db->table('trx_search_temp');
        $builder->set('nama_produk', $nama);
        $builder->set('harga', $harga);
        $builder->where('id', $id);
        return $builder->update();
    }
    /**
     * History Query
 
SELECT b.nama_produk,a.harga,a.stok,a.created_date FROM trx_pembelian a
JOIN master_produk b on b.kd_produk= a.kd_produk
WHERE a.stok > 0
ORDER BY a.created_date  DESC
 

     */
}
