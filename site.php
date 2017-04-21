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
        $pindex = max(1, intval($_GPC['page']));
        $psize = 25;
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
        $list=pdo_fetchall("select * from ".tablename('krp_package_good')." where uniacid=:uniacid  limit " . (($pindex - 1) * $psize) . "," . $psize, array(':uniacid'=>$uniacid));
        $total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('krp_package_good') . " where uniacid=:uniacid ", array(':uniacid'=>$uniacid));
        $pager = pagination($total, $pindex, $psize);

        include $this->template('goods');
    }

    public function doWebDelgood(){
        global $_GPC;
        pdo_delete('krp_package_good',array('id'=>$_GPC['id']));

        header("location:".$this->createWebUrl('goods'));
    }

    public function doWebDeluser(){
        global $_GPC;
        pdo_delete('krp_package_user',array('id'=>$_GPC['id']));

        header("location:".$this->createWebUrl('userlist'));
    }

    public function doWebDelwinuser(){
        global $_GPC;
        pdo_delete('krp_package_winlist',array('id'=>$_GPC['id']));

        header("location:".$this->createWebUrl('winlist'));
    }

    public function doWebUserlist()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $pindex = max(1, intval($_GPC['page']));
        $psize = 25;
        $condition='';
        if($_GPC['excel']!=1){
            $condition=" limit ".(($pindex - 1) * $psize) . "," . $psize;
        }
        $list=pdo_fetchall("select * from ".tablename('krp_package_user')." where uniacid=:uniacid  ".$condition,array(':uniacid'=>$uniacid));
        $total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('krp_package_user') . " where uniacid=:uniacid ", array(':uniacid'=>$uniacid));
        $pager = pagination($total, $pindex, $psize);
        if($_GPC['excel']==1){
            $this->export($list, array(
                'title' => '参与列表' . date('Y-m-d H点i分', time()),
                'columns' => array(
                    array('title' => 'openid', 'field' => 'openid', 'width' => 12),
                    array('title' => '昵称', 'field' => 'nickname', 'width' => 12),
                    array('title' => '头像', 'field' => 'headimgurl', 'width' => 12),
                    array('title' => '手机号', 'field' => 'tel', 'width' => 12),
                    array('title' => '真实姓名', 'field' => 'name', 'width' => 12)
                )
            ));
        }

        include $this->template('userlist');
    }

    public function doWebWinlist()
    {
        global $_W,$_GPC;
        $uniacid = $_W['uniacid'];
        $pindex = max(1, intval($_GPC['page']));
        $psize = 25;
        $condition='';
        if($_GPC['excel']!=1){
            $condition=" limit ".(($pindex - 1) * $psize) . "," . $psize;
        }
        $list=pdo_fetchall("select * from ".tablename('krp_package_winlist')." where uniacid=:uniacid  ".$condition,array('uniacid'=>$uniacid));
        $total = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('krp_package_winlist') . " where uniacid=:uniacid ", array(':uniacid'=>$uniacid));
        $pager = pagination($total, $pindex, $psize);
        foreach($list as &$v){
            $userinfo=pdo_get('krp_package_user',array('id'=>$v['userid']));
            $goodinfo=pdo_get('krp_package_good',array('id'=>$v['goodid']));
            $v['openid']=$userinfo['openid'];
            $v['nickname']=$userinfo['nickname'];
            $v['headimgurl']=tomedia($userinfo['headimgurl']);
            $v['tel']=$userinfo['tel'];
            $v['name']=$userinfo['name'];
            $v['goodname']=$goodinfo['name'];
            $v['goodimgurl']=tomedia($goodinfo['imgurl']);
            $v['time']=date('Y-m-d H:i:s',$v['time']);
        }
        unset($v);
        if($_GPC['excel']==1){
            $this->export($list, array(
                'title' => '获奖名单' . date('Y-m-d H点i分', time()),
                'columns' => array(
                    array('title' => 'openid', 'field' => 'openid', 'width' => 12),
                    array('title' => '昵称', 'field' => 'nickname', 'width' => 12),
                    array('title' => '头像', 'field' => 'headimgurl', 'width' => 12),
                    array('title' => '手机号', 'field' => 'tel', 'width' => 12),
                    array('title' => '真实姓名', 'field' => 'name', 'width' => 12),
                    array('title' => '奖品名称', 'field' => 'goodname', 'width' => 12),
                    array('title' => '奖品图片', 'field' => 'goodimgurl', 'width' => 12),
                    array('title' => '获奖时间', 'field' => 'time', 'width' => 12),
                )
            ));
        }

        include $this->template('winlist');
    }

    public function export($list, $params = array())
    {
        if (PHP_SAPI == 'cli') {
            exit('This example should only be run from a Web Browser');
        }

        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('全景红包')->setLastModifiedBy('全景红包')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
        $sheet = $excel->setActiveSheetIndex(0);
        $rownum = 1;

        foreach ($params['columns'] as $key => $column) {
            $sheet->setCellValue($this->column($key, $rownum), $column['title']);

            if (!empty($column['width'])) {
                $sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
            }
        }

        ++$rownum;
        $len = count($params['columns']);

        foreach ($list as $row) {
            $i = 0;

            while ($i < $len) {
                $value = (isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : '');
                $sheet->setCellValue($this->column($i, $rownum), $value);
                ++$i;
            }

            ++$rownum;
        }
        $excel->getActiveSheet()->setTitle($params['title']);
        $filename = urlencode($params['title'] . '-' . date('Y-m-d H:i', time()));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $writer->save('php://output');
        exit();
    }

    protected function column_str($key)
    {
        $array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ');
        return $array[$key];
    }

    protected function column($key, $columnnum = 1)
    {
        return $this->column_str($key) . $columnnum;
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