<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\View;
use app\admin\Model\IncreaseModel as increaseModel;


class Increase extends Controller
{
    public function user(){
        return view('user_add');
    }
    /**
     * 后台添加用户
     * @date 2017-06-26
     * @name liumiao
     */
    public function user_add(){
        $request  = request();
        $userName = $request->param('username'); //获取后台管理用户的名字
        if(empty($userName)){
            exit("用户名不能为空");
        }
        $email = $request->param('email'); //获取后台用户账号
        if (empty($email)) {
            exit("用户账号不能为空");
        }
        $password = $request->param('password'); //获取后台管理用户的密码
        if (empty($password)) {
            exit("用户密码不能为空");
        }
        $status   = $request->param('status');     //获取后台管理用户的账户状态
        $data = array();
        $data['username']   = $userName;
        $data['email']   = $email;
        $data['password']   = md5($password.'blogLm520');
        $data['status']     = $status;
        $data['add_time']   = date("Y-m-d H:i:s");
        $user= new increaseModel;
        $userAdd = $user->insertUser($data);
        return(json_encode(array('code'=>1,'msg'=>$userAdd)));
    }
    /**
     * 添加的时候，验证账户是否唯一
     * @return [type] [description]
     */
    public function queryUserName($email=null){
        $user= new increaseModel;
        $userName = $user->queryUserName($email);
        if (!empty($userName)) {
            # code...
            return(json_encode(array('code'=>1,'msg'=>$userName)));
        }else {
            return(json_encode(array('code'=>0,'msg'=>$userName)));
        }

    }
}

?>
