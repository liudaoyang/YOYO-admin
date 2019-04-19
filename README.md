YOYO-admin
===============

## 项目介绍

YOYO-admin 是基于(ThinkPHP5.1.*+H-ui admin v3.1)搭建的一款后台管理系统
+ 基础功能[几个简单的增删改查]
+ 无限级分类[感觉有点弱智]
+ Auth权限管理系统[精确到某个方法]
>自己手撸的,没有用官方提供的auth权限系统.会看源码的应该一眼就能看出,Auth之前都是把多个操作方法集中到一个方法里面,后面写权限的时候发现,无法细化权限.导致项目有点紊乱

此系统只是笔主学习之用,大佬勿喷.如果你觉得喜欢可以拿去随意折腾.

## 使用许可：
YOYO-admin 是基于MIT协议的开源框架，它完全免费。你可以免费下载YOYO-admin，用来搭建自己的或者团体的软件。

## 安装

+ 和ThinkPHP安装一样,下载项目到你项目目录,解析目录为public
+ 命令行切换到项目目录 执行composer install 安装TP文件目录


暂时还不支持composer安装

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─admin              后台模块目录
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  │
│  ├─command.php        命令行定义文件
│  ├─common.php         公共函数文件
│  └─tags.php           应用行为扩展定义文件
│
├─config                应用配置目录
│  ├─module_name        模块配置目录
│  │  ├─database.php    数据库配置
│  │  ├─cache           缓存配置
│  │  └─ ...            
│  │
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─cookie.php         Cookie配置
│  ├─database.php       数据库配置
│  ├─log.php            日志配置
│  ├─session.php        Session配置
│  ├─template.php       模板引擎配置
│  └─trace.php          Trace配置
│
├─route                 路由定义目录
│  ├─route.php          路由定义
│  └─...                更多
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~