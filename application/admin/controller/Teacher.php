<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use think\Request;

class Teacher extends Base
{
    protected $table = 'teacher';
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = db($this->table)->where('delete_time','eq',null)->all();
        return view('',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $data = input();
        $data['add_time'] = date("Y-m-d H:i:s");
        $data['create_time'] = date("Y-m-d H:i:s");
        $res = db($this->table)->data($data)->insert();
        if ($res) {
            $this->result('',200,'添加数据成功!','json');
        }
        $this->result('',100,'系统错误!','json');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = db($this->table)->where(['id'=>$id])->find();
        return view('update',['data'=>$data]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = input();
        $data['update_time'] = date("Y-m-d H:i:s");
        $res = db($this->table)->where(['id'=>$data['id']])->update($data);
        if ($res) {
            $this->result('',200,'修改成功','json');
        }
        $this->result('',100,'系统错误','json');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = db($this->table)->where(['id'=>$id])->delete();
        if ($res) {
            $this->result('',200,'删除成功','json');
        }
        $this->result('',100,'系统错误','json');
    }


}