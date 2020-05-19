<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author	: M Halim Bimantara
 *  ==============================================================================
 */

class TimeHelper
{
    public function formateDateToPattern($datetime,$pattern)
    {
        return new DateTime($datetime->format($pattern));
    }
    public function mantab(){
        echo "hoss";
    }
}