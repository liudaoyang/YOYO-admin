<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use think\Request;

class User extends Base
{
    protected $table = 'user';

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * @return \think\response\View
     * 管理员管理首页
     */
    public function index()
    {
        $user = db($this->table)->where('delete_time','eq',null)->order('id desc')->all();
        $count = count($user);
        foreach ($user as $k=>$v){
            if ($v['auth']) {
                $auth = '';
                if (is_array(explode(',',$v['auth']))) {
                    $auth_ids = explode(',',$v['auth']);
                    $auth_data = db('auth')->where('id','in',$auth_ids)->where(['status'=>1])->field('title')->select();
                    foreach ($auth_data as $val){
                        $auth .= "<p>".$val['title']."</p>";
                    }
                }else{
                    $auth = db('auth')->where(['status'=>1,'id'=>$v['auth']])->field('title')->find();
                    $auth .= "<p>".$auth['title']."</p>";
                }
                $user[$k]['auth'] = $auth;
            }
        }
        return view('',['user'=>$user,'count'=>$count]);
    }

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * 修改管理员状态
     */
    public function status()
    {
        $id = input('id');
        $user = db($this->table)->field('status,id')->where(['id'=>$id])->find();
        if ($user['status'] == 1) {
            //禁用
            $res = db($this->table)->where(['id'=>$id])->update(['status'=>0]);
            if ($res) {
                $this->result('',200,'禁用成功,页面加载中!','json');
            }
        }else{
            //启用
            $res = db($this->table)->where(['id'=>$id])->update(['status'=>1]);
            if ($res) {
                $this->result('',200,'启用成功,页面加载中!','json');
            }
        }
        $this->result('',100,'系统错误,请刷新重试!','json');
    }

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * @return \think\response\View
     * 管理员添加修改操作
     */
    public function store()
    {
        $id = input('id');
        if ($this->request->isGet()) {
            if ($id) {
                //修改页面展示
                $user = db($this->table)->where(['id'=>$id])->find();
                return view('',['user'=>$user]);
            }else{
                //新增页面展示
                return view();
            }
        }
        if ($this->request->isPost()) {
            if ($id) {
                //修改数据
                $data = input();
                foreach ($data as $k => $v){
                    if ($v == '') {
                        unset($data[$k]);
                    }
                    if ($k = 'password') {
                        $data[$k] = md5($v);
                    }
                }
                $data['update_time'] = date("Y-m-d H:i:s");
                $res = db($this->table)->where(['id'=>$id])->update($data);
                if ($res) {
                    $this->result('',200,'修改成功,正在为您跳转!','json');
                }else{
                    $this->result('',100,'修改失败,请重试!','json');
                }
            }else{
                //新增数据
                $data = input();
                $data['password'] = md5($data['password']);
                $data['update_time'] = date("Y-m-d H:i:s");
                $data['create_time'] = date("Y-m-d H:i:s");
                $res = db($this->table)->insert($data);
                if ($res) {
                    $this->result('',200,'添加成功,正在为您跳转!','json');
                }else{
                    $this->result('',100,'添加失败,请重试!','json');
                }
            }
        }
    }

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * 软删除 就是将删除时间设置为当前时间
     */
    public function soft_del()
    {
        $ids = input('id');
        //循环删除选择信息
        $fail_user = [];
        foreach ($ids as $v){
            $res = db($this->table)->where(['is_delete'=>1,'id'=>$v])->update(['delete_time'=>time()]);
            if (!$res) {
                //删除失败 返回失败信息
                $fail_user = db($this->table)->where(['id'=>$v])->find();
                continue;
            }
        }
        if ($fail_user) {
            $this->result($fail_user,100,'部分管理员删除失败!','json');
        }else{
            $this->result('',200,'操作成功!','json');
        }
    }

    public function del()
    {
        $id = input('id');
        if ($id) {
            $res = db($this->table)->where(['id'=>$id,'is_delete'=>1])->delete();
            if ($res) {
                $this->result('',200,'永久删除成功!','json');
            }
        }
        $this->result('',100,'系统错误,请刷新重试!','json');
    }

    /**
     * @author Mr.liu <www.teacheryou.cn@gmail.com>
     * @return string
     */
    public function auth($id)
    {
        //查找对应的角色信息
        $auth = db('auth')->where(['status'=>1])->select();
        $user_data = db($this->table)->where(['id'=>$id])->find();
        $auth_data = explode(',',$user_data['auth']);
        foreach ($auth as $k=>$v){
            if (in_array($v['id'],$auth_data)) {
                $auth[$k]['checked'] = 'checked';
            }
        }
        return view('',['auth'=>$auth,'id'=>$id]);
    }

    public function auth_save(Request $request)
    {
        $res = db($this->table)->where(['id'=>$request->uid])->update(['auth'=>$request->auth]);
        if ($res) {
            $this->result('',200,'操作成功','json');
        }
        $this->result('',100,'系统错误','json');
    }
}