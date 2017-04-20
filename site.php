<?php

class Krp_packageModuleSite extends WeModuleSite
{

    public function doWebMysetting()
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $set=pdo_get('krp_package_set',array('uniacid'=>$uniacid));
        if ($_W['ispost']) {
            $data = array(
                'uniacid'=>$uniacid,
                'actname' => $_GPC['actname'],
                'starttime' => strtotime($_GPC['starttime']),
                'endtime' => strtotime($_GPC['endtime']),
                'opportunity' => $_GPC['opportunity'],
                'roundmin' => $_GPC['roundmin'],
                'roundmax' => $_GPC['roundmax'],
                'okgoodnum' => $_GPC['okgoodnum'],
            );
            if($set==''){
                pdo_insert('krp_package_set',$data);
            }else{
                pdo_update('krp_package_set',$data,array('uniacid'=>$uniacid));
            }
            message('保存成功。','refresh');
        }

        include $this->template('mysetting');
    }

    public function doWebGoods()
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        if ($_W['ispost']!='') {
            $data=array(
                'uniacid'=>$uniacid,
                'name'=>$_GPC['name'],
                'imgurl'=>$_GPC['imgurl'],
                'kucun'=>$_GPC['kucun'],
                'probability'=>$_GPC['probability'],
            );
            if($_GPC['id']==''){
                pdo_insert('krp_package_good',$data);
            }else{
                pdo_update('krp_package_good',$data,array('id'=>$_GPC['id']));
            }
        }
        $list=pdo_getall('krp_package_good',array('uniacid'=>$uniacid));

        include $this->template('goods');
    }

    public function doWebDelgood(){
        global $_GPC;
        pdo_delete('krp_package_good',array('id'=>$_GPC['id']));

        header("location:".$this->createWebUrl('goods'));
    }

    public function doWebUserlist()
    {
        echo 'mysetting';
    }

    public function doWebWinlist()
    {
        echo 'mysetting';
    }

    public function doMobileIndex()
    {
        global $_W;

        echo 'index';
    }

    public function doMobilePlay()
    {
        global $_GPC;
        echo 'index';
    }

    public function doMobileWinlist()
    {
        echo 'index';
    }

}