<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use think\Request;

class Role extends Base
{
    public function index()
    {
        $role = db('auth')->order(['sort'=>'desc'])->all();
        return view('',['role'=>$role]);
    }

    public function store()
    {
        $id = input('id');
        if ($this->request->isGet()) {
            if ($id) {
                //修改页面展示
                $role = db("auth")->where(['id'=>$id])->find();
                return view('',['role'=>$role]);
            }else{
                //添加页面展示
                return view('');
            }
        }
        if ($this->request->isPost()) {
            if ($id) {
                //修改
                $data = input();
                $res = db('auth')->where(['id'=>$id])->update($data);
                if ($res) {
                    $this->result('',200,'修改成功!','json');
                }
            }else{
                //新增
                $data = input();
                $data['create_by'] = session('session_id');
                $res = db('auth')->insert($data);
                if ($res) {
                    $this->result('',200,'添加成功!','json');
                }
            }
            $this->result('',100,'系统错误!','json');
        }
    }

    public function del()
    {
        $id = input('id');
        if ($id) {
            $res = db('auth')->where(['id'=>$id])->delete();
            if ($res) {
                $this->result('',200,'删除成功!','json');
            }
        }
        $this->result('',100,'系统错误,请刷新重试!','json');
    }

    public function node($id)
    {
        $node = db('node')->where(['is_auth'=>1])->field('node,title')->select();
        $auth = db('auth')->where(['id'=>$id])->field('content')->find();
        if ($auth['content'] && is_array(explode(',',$auth['content']))) {
            $nodes = explode(',',$auth['content']);
            foreach ($node as $k=>$v){
                foreach ($nodes as $k2=>$v2){
                    if ($v['node'] == $v2) {
                        $node[$k]['checked'] = 'checked';
                    }
                }
            }
        }
        return view('',['node'=>$node,'id'=>$id]);
    }

    public function node_save(Request $request)
    {
        $res = db('auth')->where(['id'=>$request->id])->update(['content'=>$request->node]);
        if ($res) {
            $this->result('',200,'操作成功','json');
        }
        $this->result('',100,'系统错误','json');
    }
}