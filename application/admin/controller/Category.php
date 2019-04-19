<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;

class Category extends Base
{
    protected $table = 'category';
    public function index()
    {
        $cate = new \app\admin\model\Category();
        $cate_data = $cate->select();
        $cate_data = $cate->cateTree($cate_data);
        return view('',['data'=>$cate_data]);
    }

    public function create()
    {
        $cate = new \app\admin\model\Category();
        if ($this->request->isPost()) {
            $data = input('post.');
            $res = $cate->save($data);
            if ($res) {
                $this->success('添加成功!',url('admin/category/index'));
            }else{
                $this->error('添加失败!');
            }
        }
        if ($this->request->isGet()) {
            $cate_data = $cate->select();
            $cate_data = $cate->cateTree($cate_data);
            return view('',['data'=>$cate_data]);
        }
    }

    public function update($id)
    {
        $cate = new \app\admin\model\Category();
        $data = $cate->where('id',$id)->find();
        $cate_data = $cate->select();
        $cate_data = $cate->cateTree($cate_data);
        return view('',['data'=>$data,'cate_data'=>$cate_data]);
    }

    public function store()
    {
        $data = input('post.');
        $cate = new \app\admin\model\Category();
        $res = $cate->update($data);
        if ($res) {
            $this->success('修改成功!',url('admin/category/index'));
        }else{
            $this->error('修改失败!');
        }
    }

    public function del($id)
    {
        $cate = new \app\admin\model\Category();
        //查找该ID下面所有的子分类
        $all_cate = $cate->all();
        $child_cate = $this->search_child($all_cate,$id);
        array_push($child_cate,$id);
        $res = $cate->whereIn('id',$child_cate)->delete();
        if ($res) {
            $this->result('',200,'删除成功','json');
        }
        $this->result('',100,'系统错误','json');
    }

    function search_child($all_cate,$id){
        static $child_ids = [];
        foreach ($all_cate as $k=>$v){
            if ($v['pid'] == $id) {
                array_push($child_ids,$v['id']);
                unset($all_cate[$k]);
                $this->search_child($all_cate,$v['id']);
            }
        }
        return $child_ids;
    }
}