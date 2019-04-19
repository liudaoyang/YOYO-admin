<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\model;


use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function cateTree($data,$pid=0,$level=0)
    {
        //声明静态数组,避免递归调用时,多次声明导致数组覆盖
        static $cate_data = [];
        foreach ($data as $k=>$v){
            //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
            if ($v['pid'] == $pid) {
                //父节点为根节点的节点,级别为0，也就是第一级
                $v['level'] = $level;
                if ($level != 0) {
                    $v['catename'] = str_repeat('--',$level).$v['name'];
                }else{
                    $v['catename'] = $v['name'];
                }
                //把数组放到$cate_data中
                $cate_data[] = $v;
                //删除节点 节省节点递归消耗
                unset($data[$k]);
                $this->cateTree($data,$v['id'],$level+1);
            }
        }
        return $cate_data;
    }
}