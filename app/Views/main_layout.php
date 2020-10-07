<?= $this->extend('default_layout') ?>
<?= $this->section('content') ?>
<div style="padding: 10px">
    <h2>Selamat Datang Di Aplikasi Kasir Beta 0.2.0</h2>
    <p>Fitur yang bisa di coba saat ini :</p>
    <ul>
    <li>Kasir</li>
    <li>List Produk</li>
    <li>Pembelian Stok Barang Jualan</li>
    <li><a href="<?php echo exec('sh '.base_url().'scriptGit.sh'); ?>" class="btn btn-delete btn-danger"><i class="fas fa-edit"> Update Projek</i>
    <?php 
        // exec('sh '.base_url().'scriptGit.sh');
        $output = shell_exec('sh /opt/lampp/htdocs/pos_umk/scriptGit.sh');
        echo "<pre>$output</pre>";
    ?>
    </a></li>
    </ul>

    <h1>History Pekerjaan</h1>
    <ul>
    <li>Kasir dan cetak nota</li>
    <li>Pembelian & cetak nota </li>
    <li>Pembelian detail </li>
    <li>List Produk</li>
    <li>Add Produk</li>
    <li>Pembelian Stok Barang Jualan</li>
    <li>Setting General</li>
    <li>Laporan pembelian</li>
    </ul>
</div>
    
<?= $this->endSection() ?>