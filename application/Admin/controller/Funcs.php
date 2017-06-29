<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\View;
use app\admin\Model\FuncsModel as funcsModel;
use app\admin\Model\Page;
use app\admin\controller\AppPublic as appPublic;


class Funcs extends Controller
{
    /**
     * @param 获取模块名的list
     * @return [type] [description]
     */
    public function funcs_list(){
        $request  = request();
        $appPublic = new appPublic;
        $funcDesc = $appPublic->trim(isset($_REQUEST['funcs_desc'])?$_REQUEST['funcs_desc']:'');
        $funcsList = new funcsModel;
        $data = $funcsList->funcsList($funcDesc);
        $page = new Page($data,5);
        $count = count($data);
        // var_dump($page);die();
        $this->assign("page",$page);
        $this->assign("count",$count);
        $this->assign("funcdesc",$funcDesc);
        return $this->fetch("funcsList");

    }

    /**
     * @param 添加的页面处理
     * @return [type] [description]
     */
    public function addfuncs(){
        $funcsDesc = new funcsModel;
        $data = $funcsDesc->funcsDesc();
        // var_dump($data);die();
        $this->assign("data",$data);
        return $this->fetch("addfuncs");
    }

    /**
     * @param post 添加一条数据
     */
    public function post_add_funcs(){
        $request  = request();
        $funcDesc = $request->param('func_desc');
        if (empty($funcDesc)) {
            exit("模块名不能为空");
        }
        $controller = $request->param('controller');
        if (empty($controller)) {
            exit("控制器名不能为空");
        }
        $action = $request->param('action');
        if (empty($action)) {
            exit("方法名不能为空");
        }
        $pidPname = $request->param('pname');
        $pid = $request->param('pid');
        if ($pid == 0) {
            $pname = "无";
        }else {
            $pname = $pidPname;
        }
        $data = array();
        $data['func_desc']    = $funcDesc;
        $data['controller']   = $controller;
        $data['action']       = $action;
        $data['pid']          = $pid;
        $data['pname']       = $pname;
        $data['add_time']     = date("Y-m-d H:i:s");
        $funcs = new funcsModel;
        $res = $funcs->insertFuncs($data);
        return(json_encode(array('code'=>1,'msg'=>"添加成功")));
    }
    /**
     * @param 删除一条数据
     * @param  [type] $funcsId [description]
     * @return [type]          [description]
     */
    public function deleteFuncs($funcsId){
        $funcs = new funcsModel;
        $res = $funcs->deleteFuncs($funcsId);
        return(json_encode(array('code'=>1,'msg'=>"删除成功")));
    }
    /**
     * @param 编辑页面
     * @return [type] [description]
     */
    public function editfuncs(){
        $request  = request();
        $funcsId = $request->param('funcsId');
        $funcsDesc = new funcsModel;
        $data = $funcsDesc->selFuncs($funcsId);
        $funcsDescList = $funcsDesc->funcsDescList();
        $list = $data[0];
        $funid = $list['pid'];
        $this->assign("funid",$funid);
        $this->assign("list",$list);
        $this->assign("funcsDescList",$funcsDescList);
        return $this->fetch("editfuncs");
    }

    public function postEditFuncs(){
        $request  = request();
        $funcsId = $request->param('funcsId');
        $funcDesc = $request->param('func_desc');
        if (empty($funcDesc)) {
            exit("模块名不能为空");
        }
        $controller = $request->param('controller');
        if (empty($controller)) {
            exit("控制器名不能为空");
        }
        $action = $request->param('action');
        if (empty($action)) {
            exit("方法名不能为空");
        }
        $pidPname = $request->param('pname');
        $pid = $request->param('pid');
        if ($pid == 0) {
            $pname = "无";
        }else {
            $pname = $pidPname;
        }
        $data = array();
        $data['id']    = $funcsId;
        $data['func_desc']    = $funcDesc;
        $data['controller']   = $controller;
        $data['action']       = $action;
        $data['pid']          = $pid;
        $data['pname']       = $pname;
        $data['update_time']     = date("Y-m-d H:i:s");
        $funcs = new funcsModel;
        $res = $funcs->updateFuncs($data);
        return(json_encode(array('code'=>1,'msg'=>"修改")));
    }


}

?>
