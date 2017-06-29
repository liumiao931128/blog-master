<?php
namespace app\admin\model;
use think\Model;
/**
 * model 主要是用来对用户做一些验证，逻辑等功能
 */
class IndexModel extends Model
{
    public function userInfo(){
        $sql = " select * from blog_users ";
        $res = $this->query($sql);
        return $res;

    }

    public function funcsList($pid){
        $where = "";
        if(!empty($pid)){
        	$where = 'where pid='.$pid;
        }
        $sql = " select * from blog_admin_funcs ".$where;
        $res = $this->query($sql);
        return $res;
    }
}
?>
