<?php
namespace app\admin\controller;
class AppPublic{
    /**
     * 去除左右的空格
     * @param  [type] $center [description]
     * @return [type]         [description]
     */
    function trim($center) {
        $center =  trim("$center");
        $center= rtrim("$center");
        $center= ltrim("$center");
        return $center;
    }
}
?>
