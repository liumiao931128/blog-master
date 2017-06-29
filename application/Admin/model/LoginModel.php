<?php
namespace app\admin\model;
use app\admin\Model\AppModel;
/**
 * model 主要是用来对用户做一些验证，逻辑等功能
 */
class LoginModel extends AppModel{

    var $tableName = "blog_admin_user";
    public function selectUser($username,$pass){
        $sql = " select * from blog_admin_user where email= "."'$username'"." and password = "."'$pass'"." and status = 1 ";
        $res = $this->query($sql);
        return $res;
    }
}
?>
