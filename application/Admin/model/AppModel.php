<?php
namespace app\admin\model;
use think\Model;

class AppModel extends Model{
    /**
	 * @该方法用来拼凑insert语句
	 * @param $tablename:表名，
	 * @param $data：array,以字段名为索引的数组，
	 * @return insertSql
	 */
	public function insertSql($tablename,$data){
	    $sql = " INSERT INTO $tablename ";
        //拼凑字段列表
        $fields = array_keys($data);
        $fields_str = implode(', ', $fields);
        $fields_str = ' (' . $fields_str . ') ';
        //将字段列表拼凑到sql语句中
        $sql .= $fields_str;

        //拼凑值列表
        $values = array_values($data);          //获得所有的值
        $values_str = $this->sqlval($values);
        $values_str = ' (' . $values_str . ') ';

        //将值列表连接到 sql语句中
        $sql .= ' VALUES ' . $values_str;
		return $sql;
	}

    /**
	 * @该方法用来拼凑值列表语句
	 */
    private function sqlval($values){
    	$str = '';
    	foreach($values as $k=>$v){
        	if(is_int($v) || is_float($v)){
        	  $str .= ",".$v;
        	}else{
        	  $str .= ",'".$v."'";
        	}
    	}
    	$returnStr = substr($str,1);
    	return $returnStr;
    }

    /**
    * @该方法用来拼凑update语句
    * @param $tablename:表名，
    * @param $data：array,以字段名为索引的数组，
    * @param $where：条件，
    * @param $noUpdate：data数组中存在但不需要更新的字段
    * @return insertSql
    */
   public function updateSql($tablename,$data,$where,$noUpdate,$isset=false){
       $sql = "UPDATE $tablename SET ";

       //拼凑SET key=val
       foreach ($data as $key => $value){
           if(!in_array($key, $noUpdate)){
               if(is_int($value) || is_float($value)){
                   if($isset){
                       if($value<0){
                           $fields[] = $key.'='.$key.$value;
                       }else{
                           $fields[] = $key.'='.$key .'+'.$value;
                       }
                  }else{
                       $fields[] = $key.'='.$value;
                  }
               }else{
                   $fields[] = $key.'='."'".$value."'";
               }

           }

       }

       $fields_str = implode(',',$fields);
       $sql .= $fields_str;

       //拼凑where条件
       $sql .= $where;
       return $sql;
   }


}
?>
