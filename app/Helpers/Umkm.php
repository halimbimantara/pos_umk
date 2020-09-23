<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author	: M Halim Bimantara
 *  ==============================================================================
 */

class Umkm
{
    /**
     * Generate nota pembelian
     */
    public function getNotaPembelian($last_nota = null)
    {
        if ($last_nota = null) {
            return date('ymmddHi');
        } else {
            return date('ymmddHi');
        }
    }

    /**
     * Generate nota penjualan
     */
    public function getNotaPenjualan($last_nota = null)
    {
    }
}
