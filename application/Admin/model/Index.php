<?php
namespace app\admin\model;
use think\Model;
class Index extends Model
{
    public function userInfo(){
        $sql = " select * from blog_users ";
        $res = $this->query($sql);
        return $res;
    }
}
?>
