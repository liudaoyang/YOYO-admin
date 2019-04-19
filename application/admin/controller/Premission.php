<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use service\NodeService;

class Premission extends Base
{
    protected $table = 'node';

    public function index()
    {
        //需要查询所有的方法以及控制器
        $all_nodes = NodeService::getNodeTree(env('app_path'));
        $node = [];
        foreach ($all_nodes as $k=>$v){
            $nodes = db($this->table)->field('node,title')->where(['node'=>$v])->find();
            if ($nodes) {
                $node[$k] = $nodes;
            }else{
                $node[$k]['title'] = '';
                $node[$k]['node'] = $v;
            }
        }
        return view('',['title' => '系统节点管理', 'node'=>$node]);
    }

    /**
     * 保存节点变更
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $node = input('node');
            $node_data = db($this->table)->where(['node'=>$node])->find();
            if ($node_data) {
                //修改
                $res = db($this->table)->where(['node'=>$node])->update(['title'=>input('node_name')]);
                if ($res) {
                    $this->result('',200,'修改节点成功!','json');
                }
            }else{
                //新增
                $res = db($this->table)->insert(['node'=>$node,'title'=>input('node_name')]);
                if ($res) {
                    $this->result('',200,'新增节点成功!','json');
                }
            }
            $this->result('',100,'系统错误,请刷新重试!','json');
        }
    }
}