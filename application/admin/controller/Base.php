<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use think\Controller;
use think\facade\Request;

class Base extends Controller
{
    protected function initialize()
    {
        parent::initialize();
        if (session('session_id')) {
            $user = db('user')->where(['id'=>session('session_id')])->field('auth,username')->find();
            if ($user['username'] != 'admin') {
                if ($user['auth']) {
                    $auth_ids = explode(',',$user['auth']);
                    $node_data = db('auth')->where('id','in',$auth_ids)->where(['status'=>1])->field('content')->select();
                    $auth_node = [];
                    foreach ($node_data as $k=>$v){
                        $node = explode(',',$v['content']);
                        foreach ($node as $val){
                            array_push($auth_node,$val);
                        }
                    }
                    $auth_node = array_unique($auth_node);
                    $str = Request::module().'/'.Request::controller().'/'.Request::action();
                    $str = strtolower($str);
                    if (!in_array($str,$auth_node)) {
//                        $this->redirect('@admin/index/welcome','','302','');
                        $this->error('没有权限!','@admin/index/welcome','','1');
                    }
                }else{
                    session('session_id',null);
                    session('admin',null);
                    if (cookie('admin')) {
                        cookie('admin',null);
                    }
                    $this->redirect('@admin/login/index');
                }
            }
        }
    }
}