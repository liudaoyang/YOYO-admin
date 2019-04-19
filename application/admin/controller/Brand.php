<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


class Brand extends Base
{
    protected $table = 'brand';
    public function index()
    {
        $data = db($this->table)->alias('b')->join('teacher t','t.id = b.teacher')->field('b.*,t.username teacher_name')->select();
        foreach ($data as $k=>$v){
            $student = '';
            if (!empty($v['student'])){
                if (is_array(explode(',',$v['student']))){
                    $student_ids = explode(',',$v['student']);
                    $student_data = db('student')->where('id','in',$student_ids)->field('id,username')->select();
                    foreach ($student_data as $val){
                        $student .= "<p><a href='javascript:;'>".$val['username']."</a></p>";
                    }
                }else{
                    $student = '还没有添加学生';
                }
            }
            $data[$k]['student_data'] = $student;
        }
        return view('',['data'=>$data]);
    }

    public function create()
    {
        $student = db('student')->where('delete_time','eq',null)->all();
        $teacher = db('teacher')->where('delete_time','eq',null)->all();
        return view('',['student'=>$student,'teacher'=>$teacher]);
    }

    public function save()
    {
        $data = input();
        $data['create_time'] = date("Y-m-d H:i:s");
        $data['update_time'] = date("Y-m-d H:i:s");
        $res = db($this->table)->insert($data);
        if ($res) {
            $this->result('',200,'操作成功','json');
        }
        $this->result('',100,'系统错误','json');
    }

    public function read($id)
    {
        $data = db($this->table)->where(['id'=>$id])->find();
        $data['student'] = explode(',',$data['student']);
        $student = db('student')->where('delete_time','eq',null)->all();
        $teacher = db('teacher')->where('delete_time','eq',null)->all();
        return view('update',['data'=>$data,'student'=>$student,'teacher'=>$teacher]);
    }

    public function delete($id)
    {
        $res = db($this->table)->where(['id'=>$id])->delete();
        if ($res) {
            $this->result('',200,'删除成功','json');
        }
        $this->result('',100,'系统错误','json');
    }
}