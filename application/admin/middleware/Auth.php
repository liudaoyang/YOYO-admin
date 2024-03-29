<?php
/**
 * @author Mr.liu <www.teacheryou.cn@gmail.com>
 */

namespace app\admin\middleware;
use service\NodeService as service;
use think\Db;


/**
 * 系统权限访问管理
 * Class Auth
 * @package app\admin\middleware
 */
class Auth
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function handle($request, \Closure $next)
    {
        list($module, $controller, $action) = [$request->module(), $request->controller(), $request->action()];
        $access = $this->buildAuth($node = service::parseNodeStr("{$module}/{$controller}/{$action}"));
        // 登录状态检查
        if (!empty($access['is_login']) && !session('user')) {
            $msg = ['code' => 0, 'msg' => '抱歉，您还没有登录获取访问权限！', 'url' => url('@admin/login')];
            return $request->isAjax() ? json($msg) : redirect($msg['url']);
        }
        // 访问权限检查
        if (!empty($access['is_auth']) && !auth($node)) {
            return json(['code' => 0, 'msg' => '抱歉，您没有访问该模块的权限！']);
        }
        // 模板常量声明
        app('view')->init(config('template.'))->assign(['classuri' => service::parseNodeStr("{$module}/{$controller}")]);
        return $next($request);
    }

    /**
     * 根据节点获取对应权限配置
     * @param string $node 权限节点
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function buildAuth($node)
    {
        $info = Db::name('node')->cache(true, 30)->where(['node' => $node])->find();
        return [
            'is_menu'  => intval(!empty($info['is_menu'])),
            'is_auth'  => intval(!empty($info['is_auth'])),
            'is_login' => empty($info['is_auth']) ? intval(!empty($info['is_login'])) : 1,
        ];
    }
}
