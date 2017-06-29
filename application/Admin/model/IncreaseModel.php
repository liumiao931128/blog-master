<?php
namespace app\admin\model;
use app\admin\Model\AppModel;
/**
 * model 主要是用来对用户做一些验证，逻辑等功能
 */
class IncreaseModel extends AppModel{

    var $tableName = "blog_admin_user";
    /**
     * 添加后台用户的数据
     * @param  [type] $data      [description]
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function insertUser($data,$tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $sql  = $this->insertSql($tableName,$data);
		$res = $this->query($sql);
		return $res;
    }

    /**
     * 查询用户是否存在
     * @param  [type] $userName  [description]
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function queryUserName($userName,$tableName=''){
        if (!$tableName) {
            # code...
            $tableName = $this->tableName;
        }
        $sql = " select email from  ". $tableName ." where email = "."'$userName'" ;
        $res = $this->query($sql);
        return $res;
    }
}
?>
