<?php
namespace app\admin\controller;
use \think\Controller;
use \think\View;
use \think\Session;
use \think\Request;
use app\admin\model\IndexModel as indexModel;
use app\admin\Model\FuncsModel as funcsModel;
/**
 * controller  主要使用来接受用户的信息不做任何数据业务的操作
 */
class index extends Controller
{
    public function index(){
        $funcsDesc = new funcsModel;
        $data = $funcsDesc->funcsDesc();
        $session = Session::get("session_user");
        $username = $session[0]['username'];
        return $this->fetch("index",[
            'data'=>$data,
            'username'=>$username
        ]);
    }
    public function welcome(){
        return $this->fetch("welcome");
    }
    public function descList(){
        $request  = request();
        $funcsId = $request->param('funcsId');
        $funcsDesc = new indexModel;
        $data = $funcsDesc->funcsList($funcsId);
        return(json_encode(array('code'=>1,'data'=>$data,'msg'=>"ok")));
    }
}
