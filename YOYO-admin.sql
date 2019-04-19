SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `sort` smallint(6) unsigned DEFAULT '0' COMMENT '排序权重',
  `desc` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_by` bigint(11) unsigned DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `content` text COMMENT '权限节点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色';

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES ('1', '超级管理员', '1', '0', '系统权限账号', '26', '2019-04-04 14:20:07', 'admin/index/welcome,admin/index/index,admin/login/logout,admin/login/index,admin/login/login,admin/premission/index,admin/premission/save,admin/role/index,admin/role/store,admin/user/index,admin/user/status,admin/user/store,admin/user/soft_del,admin/user/del,index/index/index,index/index/hello,admin/role/del,admin/brand/index,admin/brand/create,admin/brand/save,admin/brand/read,admin/brand/delete,admin/role/node,admin/role/node_save,admin/student/index,admin/student/create,admin/student/save,admin/student/read,admin/student/edit,admin/student/delete,admin/teacher/index,admin/teacher/create,admin/teacher/save,admin/teacher/read,admin/teacher/edit,admin/teacher/delete,admin/user/auth,admin/user/auth_save');
INSERT INTO `auth` VALUES ('2', '管理员', '1', '0', '部分权限账号', '26', '2019-04-04 14:20:25', 'admin/index/welcome,admin/index/index,admin/login/logout,admin/login/index,admin/login/login');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '班级名称',
  `desc` varchar(255) DEFAULT NULL COMMENT '班级介绍',
  `teacher` varchar(255) DEFAULT NULL COMMENT '老师',
  `student` varchar(255) DEFAULT NULL COMMENT '学生',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  `is_delete` enum('1','0') DEFAULT '1' COMMENT '是否可以删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='brand';

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('1', '11', '班级名称', '3', '2,3,4,5', '2019-04-04 11:14:41', '2019-04-04 11:14:41', null, '1');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '分类名称',
  `keywords` varchar(50) DEFAULT NULL COMMENT '关键词',
  `sort` int(6) DEFAULT NULL COMMENT '排序',
  `desc` varchar(50) DEFAULT NULL COMMENT '描述',
  `pid` int(11) DEFAULT '0' COMMENT '父级ID',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='category';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '中国', '国家', null, '我们的国家', '0', '2019-04-08 09:54:27');
INSERT INTO `category` VALUES ('2', '重庆', '雾都', null, '最热的城市', '1', '2019-04-08 09:56:08');
INSERT INTO `category` VALUES ('3', '四川名称2', '四川关键词', null, '四川描述', '1', '2019-04-08 09:57:03');

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '是否可设置为菜单',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `is_login` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动登录控制',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='系统节点';

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', 'admin/index/welcome', '后台欢迎页面', '0', '1', '1', '2019-04-02 10:16:38');
INSERT INTO `node` VALUES ('2', 'admin/index/index', '后台主页', '0', '1', '1', '2019-04-02 10:17:08');
INSERT INTO `node` VALUES ('3', 'admin/login/logout', '退出登录', '0', '1', '1', '2019-04-02 11:27:04');
INSERT INTO `node` VALUES ('4', 'admin/login/index', '登录页面', '0', '1', '1', '2019-04-02 15:46:16');
INSERT INTO `node` VALUES ('5', 'admin/login/login', '登录', '0', '1', '1', '2019-04-02 15:46:24');
INSERT INTO `node` VALUES ('6', 'admin/premission/index', '权限首页', '0', '1', '1', '2019-04-02 15:46:38');
INSERT INTO `node` VALUES ('7', 'admin/premission/save', '权限保存', '0', '1', '1', '2019-04-02 15:46:58');
INSERT INTO `node` VALUES ('8', 'admin/role/index', '角色首页', '0', '1', '1', '2019-04-02 15:47:03');
INSERT INTO `node` VALUES ('9', 'admin/role/store', '角色操作', '0', '1', '1', '2019-04-02 15:47:09');
INSERT INTO `node` VALUES ('10', 'admin/user/index', '管理员首页', '0', '1', '1', '2019-04-02 15:47:55');
INSERT INTO `node` VALUES ('11', 'admin/user/status', '管理员禁用', '0', '1', '1', '2019-04-02 15:48:06');
INSERT INTO `node` VALUES ('12', 'admin/user/store', '管理员操作', '0', '1', '1', '2019-04-02 15:48:37');
INSERT INTO `node` VALUES ('13', 'admin/user/soft_del', '管理员软删除', '0', '1', '1', '2019-04-02 15:48:51');
INSERT INTO `node` VALUES ('14', 'admin/user/del', '管理员删除', '0', '1', '1', '2019-04-02 15:48:58');
INSERT INTO `node` VALUES ('15', 'index/index/index', '前台首页', '0', '1', '1', '2019-04-02 15:49:05');
INSERT INTO `node` VALUES ('16', 'index/index/hello', '前台欢迎页面', '0', '1', '1', '2019-04-02 15:49:14');
INSERT INTO `node` VALUES ('17', 'admin/role/del', '删除角色', '0', '1', '1', '2019-04-03 10:33:15');
INSERT INTO `node` VALUES ('18', 'admin/brand/index', '班级列表', '0', '1', '1', '2019-04-04 16:52:36');
INSERT INTO `node` VALUES ('19', 'admin/brand/create', '创建班级页面展示', '0', '1', '1', '2019-04-04 16:52:39');
INSERT INTO `node` VALUES ('20', 'admin/brand/save', '添加班级', '0', '1', '1', '2019-04-04 16:52:51');
INSERT INTO `node` VALUES ('21', 'admin/brand/read', '修改班级页面展示', '0', '1', '1', '2019-04-04 16:53:06');
INSERT INTO `node` VALUES ('22', 'admin/brand/delete', '删除班级', '0', '1', '1', '2019-04-04 16:53:18');
INSERT INTO `node` VALUES ('23', 'admin/role/node', '节点授权展示', '0', '1', '1', '2019-04-04 16:53:40');
INSERT INTO `node` VALUES ('24', 'admin/role/node_save', '节点授权保存', '0', '1', '1', '2019-04-04 16:53:53');
INSERT INTO `node` VALUES ('25', 'admin/student/index', '学生列表首页', '0', '1', '1', '2019-04-04 16:54:01');
INSERT INTO `node` VALUES ('26', 'admin/student/create', '添加学生页面', '0', '1', '1', '2019-04-04 16:54:11');
INSERT INTO `node` VALUES ('27', 'admin/student/save', '添加学生', '0', '1', '1', '2019-04-04 16:54:19');
INSERT INTO `node` VALUES ('28', 'admin/student/read', '修改学生页面展示', '0', '1', '1', '2019-04-04 16:54:28');
INSERT INTO `node` VALUES ('29', 'admin/student/edit', '修改学生', '0', '1', '1', '2019-04-04 16:54:49');
INSERT INTO `node` VALUES ('30', 'admin/student/delete', '删除学生', '0', '1', '1', '2019-04-04 16:55:51');
INSERT INTO `node` VALUES ('31', 'admin/teacher/index', '老师列表', '0', '1', '1', '2019-04-04 16:55:59');
INSERT INTO `node` VALUES ('32', 'admin/teacher/create', '添加老师列表', '0', '1', '1', '2019-04-04 16:56:08');
INSERT INTO `node` VALUES ('33', 'admin/teacher/save', '老师保存', '0', '1', '1', '2019-04-04 16:56:21');
INSERT INTO `node` VALUES ('34', 'admin/teacher/read', '修改老师页面展示', '0', '1', '1', '2019-04-04 16:56:27');
INSERT INTO `node` VALUES ('35', 'admin/teacher/edit', '修改老师', '0', '1', '1', '2019-04-04 16:56:32');
INSERT INTO `node` VALUES ('36', 'admin/teacher/delete', '删除老师', '0', '1', '1', '2019-04-04 16:57:04');
INSERT INTO `node` VALUES ('37', 'admin/user/auth', '用户节点授权页面展示', '0', '1', '1', '2019-04-04 16:57:26');
INSERT INTO `node` VALUES ('38', 'admin/user/auth_save', '用户节点授权保存', '0', '1', '1', '2019-04-04 16:57:32');
INSERT INTO `node` VALUES ('39', 'admin/tag/index', '标签列表', '0', '1', '1', '2019-04-19 12:09:37');
INSERT INTO `node` VALUES ('40', 'admin/tag/create', '创建标签', '0', '1', '1', '2019-04-19 12:09:47');
INSERT INTO `node` VALUES ('41', 'admin/tag/update', '修改标签', '0', '1', '1', '2019-04-19 12:09:51');
INSERT INTO `node` VALUES ('42', 'admin/tag/del', '删除标签', '0', '1', '1', '2019-04-19 12:09:58');
INSERT INTO `node` VALUES ('43', 'admin/category/index', '分类列表', '0', '1', '1', '2019-04-19 12:10:09');
INSERT INTO `node` VALUES ('44', 'admin/category/create', '创建分类页面展示', '0', '1', '1', '2019-04-19 12:10:21');
INSERT INTO `node` VALUES ('45', 'admin/category/update', '修改分类', '0', '1', '1', '2019-04-19 12:10:29');
INSERT INTO `node` VALUES ('46', 'admin/category/store', '添加分类', '0', '1', '1', '2019-04-19 12:10:36');
INSERT INTO `node` VALUES ('47', 'admin/category/del', '删除分类', '0', '1', '1', '2019-04-19 12:10:40');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '名字',
  `email` varchar(50) DEFAULT NULL COMMENT '邮件',
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `add_time` datetime DEFAULT NULL COMMENT '加入时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  `is_delete` enum('1','0') DEFAULT '0' COMMENT '是否可以删除 0 可以 1不可以',
  `sex` enum('3','2','1') DEFAULT '3' COMMENT '性别 1 男 2女 3 不公开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='student\r\n';

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', 'daoyang', 'www.teacheryou.cn@gmail.com', '13399809110', '2019-04-03 17:18:51', '2019-04-03 17:18:51', null, null, '0', '3');

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签主键',
  `tname` varchar(10) NOT NULL DEFAULT '' COMMENT '标签名',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='tag\r\n';

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '666');

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '名字',
  `email` varchar(50) DEFAULT NULL COMMENT '邮件',
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `add_time` datetime DEFAULT NULL COMMENT '加入时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  `is_delete` enum('1','0') DEFAULT '0' COMMENT '是否可以删除 0 可以 1不可以',
  `sex` enum('3','2','1') DEFAULT '3' COMMENT '性别 1 男 2女 3 不公开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='teacher';

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('3', 'daoyang', 'daoyang@daoyang.com', '13399809110', '2019-04-03 17:08:56', '2019-04-03 17:08:56', null, null, '0', '3');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `is_login` enum('1','0') DEFAULT '0' COMMENT '是否登录 1是 0不是',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_delete` enum('1','0') DEFAULT '1' COMMENT '是否可以删除',
  `times` int(11) DEFAULT '0' COMMENT '登录次数',
  `status` enum('1','0') DEFAULT '1' COMMENT '是否禁用 0禁用 1启用',
  `sex` enum('3','2','1') DEFAULT '3' COMMENT '性别 1男 2女 3不公开',
  `auth` text COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', null, '2019-03-28 09:37:34', '2019-03-29 16:18:39', '2019-04-04 17:52:35', '1', null, '0', '15', '1', '3', null);
