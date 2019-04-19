<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use think\Request;

class Login extends Base
{
    protected $table = 'user';

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * 页面初始化方法 检测玩家是否已经登录
     */
    protected function initialize()
    {
        parent::initialize();
        if (!empty(session('admin')) && $this->request->action() !== 'logout') {
            $this->redirect('@admin/index/index');
        }
    }

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * @return \think\response\View
     * 显示登录页面
     */
    public function index()
    {
        return view('login');
    }

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * @param Request $request
     * 登录操作
     */
    public function login(Request $request)
    {
        $data = $request->param();
        if (empty($data)) {
            $this->result('',100,'信息接收错误,请刷新重试!','json');
        }
        if (!captcha_check($data['verify'])) {
            $this->result('',101,'验证码错误,请刷新重试!','json');
        }
        $user = db($this->table)->where(['username'=>$data['username']])->find();
        if (!$user) {
            $this->result('',100,'用户名错误,请确认后重试!','json');
        }
        if (md5($data['password']) != $user['password']) {
            $this->result('',100,'密码错误,请确认后重试!','json');
        }
        //登录成功
        db($this->table)->where(['id'=>$user['id']])->update(['times'=>++$user['times'],'is_login'=>1]);
        if ($data['online'] == 1) {
            session('session_id',$user['id']);
            session('admin',$user);
            cookie('admin',$user,60*60*24*7);
            $this->result('',200,'登录成功,正在为您跳转后台首页!','json');
        }else{
            session('session_id',$user['id']);
            session('admin',$user);
            $this->result('',200,'登录成功,正在为您跳转后台首页!','json');
        }
    }

    public function logout()
    {
        //修改数据库信息
        db($this->table)->where(['id'=>session('session_id')])->update(['is_login'=>0,'last_login_time'=>date("Y-m-d H:i:s")]);
        //删除session信息
        session('session_id',null);
        session('admin',null);
        //检测是否有cookie信息 有就删除cookie
        if (cookie('admin')) {
            cookie('admin',null);
        }
        $this->redirect('@admin/login/index');
    }
}