<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\controller;


use think\Image;

class Tag extends Base
{
    public function index()
    {
        $data = db('tag')->all();
        return view('',['data'=>$data]);
    }

    public function create()
    {
        if ($this->request->isGet()) {
            return view();
        }
        if ($this->request->isPost()) {
            $str = input('post.tname');
            if(empty($str)){
                $this->result('','100','参数错误!','json');
            }else{
                $str=nl2br(trim($str));
                $tnames=explode("<br />", $str);
                foreach ($tnames as $k => $v) {
                    $v=trim($v);
                    if(!empty($v)){
                        $data['tname']=$v;
                        db('tag')->insert($data);
                    }
                }
                $this->result('',200,'添加成功!','json');
            }
        }
    }

    public function update()
    {
        $id = input('tid');
        if ($this->request->isGet()) {
            $data = db('tag')->where(['tid'=>$id])->find();
            return view('',['data'=>$data]);
        }
        if ($this->request->isPost()) {
            $data = input('post.');
            $res = db('tag')->update($data);
            if ($res) {
                $this->result('',200,'操作成功!','json');
            }else{
                $this->result('',100,'系统错误!','json');
            }
        }
    }

    public function del($id)
    {
        $res = db('tag')->where(['tid'=>$id])->delete();
        if ($res) {
            $this->result('',200,'操作成功!','json');
        }else{
            $this->result('',100,'系统错误!','json');
        }
    }

    public function upload()
    {
        if ($this->request->isGet()) {
            return view();
        }

        if ($this->request->isPost()) {
//            $file = request()->file('file');.microtime()
            //给上传的文件添加统一的水印
            $image = Image::open(request()->file('file'));
            $save_path = 'static/upload/'.date('Y-m-d-H').'/';
            if (!file_exists($save_path)) {
                mkdir($save_path,0777,true);
            }
            $file_name = $save_path.time().rand(1,1000).'.png';
            $image->text('create by Mr.liu','static/admin/fonts/test.ttf',20,'#ffffff')->water('yoyo.png',9,50)->save($file_name);


//            // 移动到框架应用根目录/uploads/ 目录下
//            $info = $file->move( 'static/upload');
//            if($info){
//                // 成功上传后 获取上传信息
//                return json(['url'=>$info->getSaveName(),'status'=>200]);
//            }else{
//                // 上传失败获取错误信息
//                return json(['url'=>$info->getError(),'status'=>100]);
//            }
        }
    }

    public function uediter()
    {
        if ($this->request->isGet()) {
            return view();
        }
        if ($this->request->isPost()) {
            $data = input('post.');
            $data['content']=htmlspecialchars_decode($data['content']);

        }
    }

}