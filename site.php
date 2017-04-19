<?php

class Krp_packageModuleSite extends WeModuleSite {

    public function doWebMysetting() {
        echo 'mysetting';
    }

    public function doWebGoods() {
        echo 'mysetting';
    }

    public function doWebUserlist() {
        echo 'mysetting';
    }

    public function doWebWinlist() {
        echo 'mysetting';
    }

    public function doMobileIndex() {
        global $_W;

        echo 'index';
    }

    public function doMobilePlay() {
        global $_GPC;
        echo 'index';
    }

    public function doMobileWinlist() {
        echo 'index';
    }

}