<?php
namespace app\admin\controller;
use \think\Controller;
use \think\View;
use \think\Request;
use \think\Session;
use app\admin\Model\LoginModel as loginModel;
class Login extends Controller
{
    /**
     * 登陆的页面
     * @return [type] [description]
     */
    public function login()
    {
        return view('login');
    }

    /**
     * post 登陆提交
     * @return [type] [description]
     */
    public function post_login(){
        $request  = request();
        $username = $request->param('username');
        if (empty($username)) {
            exit("用户名不能为空");
        }
        $password = $request->param('password');
        if (empty($password)) {
            exit("密码不能为空");
        }
        $pass = md5($password.'blogLm520');
        $query = new loginModel;
        $user = $query->selectUser($username,$pass);
        $username1 = $user[0]['email'];
        $password1 = $user[0]['password'];
        if ($username == $username1 && $pass == $password1 ) {
            Session::set('session_user',$user);
            echo "<script>window.location='/admin/Index/index';</script>";
        }else {
            echo "<p><h3>账号或密码错误,2秒后返回登陆页面...  </a>
                    <script>
                    setTimeout('window.location=\"/admin/Login/login\"',2000);
                    </script>
                    </h3></p>";
        }
    }

    public function logout(){
        Session::delete('session_user');
        $this->redirect("Login/login",array(),0,"退出成功");

    }
}
