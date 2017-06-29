<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\View;


class Role extends Controller
{
    public function role_list(){
        return view('roleList');
    }
}

?>
