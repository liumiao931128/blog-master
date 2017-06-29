<?php
namespace app\admin\model;
use app\admin\Model\AppModel;
/**
 * model 主要是用来对用户做一些验证，逻辑等功能
 */
class FuncsModel extends AppModel{

    var $tableName = "blog_admin_funcs";
    /**
     * 添加后台模块管理的数据
     * @param  [type] $data      [description]
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function insertFuncs ($data,$tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $sql  = $this->insertSql($tableName,$data);
		$res = $this->query($sql);
		return $res;
    }

    /**
     * 模块列表查询
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function funcsList($funcDesc,$tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $where = "";
        if($funcDesc){
			$where = ' where func_desc LIKE "%' . $funcDesc . '%" ' ;
		}
        $sql = " select * from ".$tableName.$where." ORDER BY add_time desc ";
        $res = $this->query($sql);
		return $res;
    }
    /**
     * 查询出一级模块的名字
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function funcsDesc($tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $sql = " select id,pid,func_desc from ".$tableName." where pid = '0' ORDER BY add_time desc ";
        $res = $this->query($sql);
		return $res;
    }
    /**
     * 查询出所有模块的名字
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function funcsDescList($tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $sql = " select id,pid,func_desc from ".$tableName." ORDER BY add_time desc ";
        $res = $this->query($sql);
		return $res;
    }

    /**
     * 删除一条数据
     * @param  [type] $funcsId   [description]
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function deleteFuncs($funcsId,$tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $sql = " delete from ".$tableName." where id =  ".$funcsId;
        $res = $this->query($sql);
		return $res;
    }
    /**
     * 查询一条数据
     * @param  [type] $funcsId   [description]
     * @param  string $tableName [description]
     * @return [type]            [description]
     */
    public function selFuncs($funcsId,$tableName=''){
        if(!$tableName){
            $tableName = $this->tableName;
        }
        $sql = " select * from ".$tableName." where id = ".$funcsId;
        $res = $this->query($sql);
		return $res;
    }

    public function updateFuncs($arr){
        $sql = $this->updateSql('blog_admin_funcs',$arr,' where id ='.$arr['id'],array('id'));
		$res = $this->query($sql);
        return $res;
    }
}
?>
