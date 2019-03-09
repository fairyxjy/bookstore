
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `a1787tushu`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', '超级管理员'),
(2, '111', '698d51a19d8a121ce581499d7b701668', '管理员');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT '0',
  `goodid` int(11) DEFAULT '0',
  `sums` int(11) DEFAULT '1',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id自然编号',
  `pid` int(6) NOT NULL COMMENT '分类类型',
  `title` varchar(60) NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `pid`, `title`) VALUES
(1, 1, '人文社科图书'),
(2, 1, '工业技术图书'),
(3, 1, '经济管理图书'),
(4, 1, '人文社科图书'),
(5, 1, '考试图书'),
(7, 2, '最新活动');

-- --------------------------------------------------------

--
-- 表的结构 `content1`
--

CREATE TABLE IF NOT EXISTS `content1` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(4) NOT NULL DEFAULT '0' COMMENT '类型id',
  `categoryid` int(4) NOT NULL DEFAULT '0' COMMENT '分类id',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '详细介绍',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `apv` int(4) NOT NULL DEFAULT '0' COMMENT '点击',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `content1`
--

INSERT INTO `content1` (`id`, `pid`, `categoryid`, `title`, `content`, `addtime`, `apv`) VALUES
(34, 0, 7, '添加一条促销信息', '<p>添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息添加一条促销信息</p>', '2018-03-22 11:36:29', 1),
(2, 2, 7, '测试', '<p>压顶地<br/></p>', '2018-03-20 06:48:50', 29),
(3, 2, 7, '添加一条测试', '<p>dfdfdsf<br/></p>', '2018-03-20 06:48:50', 10),
(4, 2, 7, '添加一条测试aaa', '<p>dsdfdfdfsdfdsf<br/></p>', '2018-03-20 06:48:50', 6),
(5, 2, 7, 'dfdfsdfdsf', '<p>sdfsdf<br/></p>', '2018-03-20 06:48:50', 11),
(6, 2, 7, '添加一条测试', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试</p>', '2018-03-20 06:48:50', 5),
(7, 6, 7, '添加一条测试', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试</p>', '2018-03-20 06:48:50', 8),
(32, 0, 8, '添加一条测试', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试</p>', '2018-03-20 06:48:50', 0),
(33, 0, 7, '新书上市便宜', '<p>新书上市便宜新书上市便宜新书上市便宜新书上市便宜新书上市便宜新书上市便宜新书上市便宜</p>', '2018-03-20 06:48:50', 1);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(4) NOT NULL DEFAULT '0' COMMENT '类型id',
  `categoryid` int(4) NOT NULL DEFAULT '0' COMMENT '分类id',
  `pnumber` varchar(50) DEFAULT NULL COMMENT '商品号',
  `title` varchar(50) DEFAULT NULL COMMENT '名称',
  `amount` int(11) DEFAULT '0' COMMENT '商品数量',
  `cishu` int(11) DEFAULT '0',
  `mprice` decimal(11,2) DEFAULT NULL COMMENT '市场价',
  `sprice` decimal(11,2) DEFAULT NULL COMMENT '会员价',
  `content` text COMMENT '详细介绍',
  `apv` int(4) NOT NULL DEFAULT '0' COMMENT '点击',
  `img` varchar(50) DEFAULT NULL COMMENT '图片',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isnice` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `pid`, `categoryid`, `pnumber`, `title`, `amount`, `cishu`, `mprice`, `sprice`, `content`, `apv`, `img`, `status`, `addtime`, `isnice`) VALUES
(10, 1, 2, 'dfdfd', '沈石溪动物小说', 0, 4, '34.00', '343.00', '<p>dfdsff<br/></p>', 79, '1.jpg', 0, '2018-03-20 06:48:50', 1),
(11, 1, 2, 'dfdfd', '人性的弱点', 31, 3, '34.00', '343.00', '<p>dfsdf<br/></p>', 87, '2.jpg', 0, '2018-03-20 06:48:50', 0),
(12, 1, 2, 'dfdfds3', '添加一条测试添加', 0, 3, '3400.00', '3000.00', '<p>34343<br/></p>', 16, '3.jpg', 0, '2018-03-20 06:48:50', 1),
(13, 1, 1, 'dfdfds3', '添加一条测试添加', 31, 2, '34.00', '22.00', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试<img src="/ueditor/php/upload/image/20171114/1510663146606532.jpg" title="1510663146606532.jpg" alt="16pic_2630608_b.jpg"/><br/></p>', 49, '4.jpg', 0, '2018-03-20 06:48:50', 0),
(14, 1, 4, 'dfdfds3', '添加一条测试添加', 33, 0, '34.00', '22.00', '<p>mysqld-nt.exemysqld-nt.exemysqld-nt.exemysqld-nt.exemysqld-nt.exe<br/></p>', 14, '5.jpg', 0, '2018-03-20 06:48:50', 1),
(15, 1, 2, 'dfdfds3', '添加一条测试添加', 0, 32, '258.00', '200.00', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加', 37, '6.jpg', 0, '2018-03-20 06:48:50', 1),
(16, 1, 3, 'dfdfds31', '添加一条测试添加', 32, 1, '444.00', '333.00', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加</p>', 61, '1.jpg', 0, '2018-03-20 06:48:50', 0),
(17, 1, 4, 'ddfsdf22', '添加一条测试', 211, 11, '500.00', '480.00', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试<br/></p>', 249, '4.jpg', 0, '2018-03-20 06:48:50', 1),
(19, 1, 2, 'dfdfds3ss', '添加一条测试', 31, 2, '258.00', '200.00', '<p>dsd添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试</p>', 66, '3.jpg', 0, '2018-03-20 06:48:50', 0),
(20, 1, 2, '2223', '添加一条测试', 20, 0, '258.00', '200.00', '<p>添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试添加一条测试<br/></p>', 1, '2.jpg', 0, '2018-03-20 06:48:50', 1),
(21, 1, 2, 'dfdfds3112', '新书测试', 33, 0, '34.00', '22.00', '<p>新书测试新书测试新书测试新书测试新书测试<br/></p>', 1, '6532978.jpg', 0, '2018-03-20 06:48:50', 1),
(22, 1, 3, '000651saa3', '添加一个图书', 1000, 0, '33.00', '20.00', '<p>dsfdfsdfsdfdsf<img src="/ueditor/php/upload/image/20180322/1521718646841916.jpeg" title="1521718646841916.jpeg" alt="wKgBs1Z5XouAYVc-ABr5Y8BRXH472.jpeg" width="343" height="216"/></p>', 1, '730798.jpg', 0, '2018-03-22 11:37:37', 0);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onumber` varchar(50) DEFAULT NULL COMMENT '订单号',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `spc` varchar(50) DEFAULT NULL COMMENT '订单商品',
  `slc` varchar(50) DEFAULT NULL COMMENT '订单商品数量',
  `sex` varchar(50) DEFAULT NULL COMMENT '性别',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `tel` varchar(50) DEFAULT NULL COMMENT '电话',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `shff` varchar(50) DEFAULT NULL COMMENT '收货方式',
  `zfff` varchar(50) DEFAULT NULL COMMENT '支付方式',
  `leaveword` varchar(100) DEFAULT NULL COMMENT '留言',
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `xname` varchar(20) DEFAULT NULL COMMENT '下单人',
  `zt` varchar(50) DEFAULT NULL COMMENT '状态',
  `total` varchar(50) DEFAULT NULL COMMENT '总计',
  `kuaidi` varchar(50) DEFAULT NULL COMMENT '快递名称',
  `knumber` varchar(50) NOT NULL COMMENT '快递编号',
  `receiver` varchar(20) DEFAULT NULL COMMENT '收货人',
  `th` int(2) NOT NULL DEFAULT '0' COMMENT '是否退货',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `onumber`, `userid`, `spc`, `slc`, `sex`, `address`, `tel`, `email`, `shff`, `zfff`, `leaveword`, `addtime`, `xname`, `zt`, `total`, `kuaidi`, `knumber`, `receiver`, `th`) VALUES
(8, '201803221935144', 4, NULL, NULL, '未知', '详细地址详细地址', '15236222222', 'dkf@152.com', '快递', '支付宝支付', '', '2018-03-22 11:35:14', 'ff', '已收货', NULL, '中通物流', '343434', '李明f', 0),
(7, '201803221933244', 4, NULL, NULL, '未知', '详细地址详细地址', '15236222222', 'dkf@152.com', '快递', '网银支付', '', '2018-03-22 11:33:24', 'ff', '已下单', NULL, NULL, '', '李明f', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ordersta`
--

CREATE TABLE IF NOT EXISTS `ordersta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordersid` int(11) NOT NULL DEFAULT '0' COMMENT '订单号',
  `goodid` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `price` decimal(11,2) DEFAULT '0.00' COMMENT '商品价格',
  `nums` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `addtime` date NOT NULL,
  `userid` varchar(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `categoryid` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `zt` varchar(11) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `ordersta`
--

INSERT INTO `ordersta` (`id`, `ordersid`, `goodid`, `price`, `nums`, `addtime`, `userid`, `categoryid`, `zt`) VALUES
(8, 7, 11, '343.00', 1, '2018-03-22', '4', 2, '已下单'),
(7, 6, 11, '343.00', 1, '2018-03-22', '4', 2, '购买成功'),
(6, 5, 14, '22.00', 2, '2018-03-22', '4', 4, '购买成功'),
(5, 4, 11, '343.00', 1, '2018-03-20', '3', 2, '已退货'),
(9, 8, 13, '22.00', 2, '2018-03-22', '4', 1, '已收货');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL COMMENT '妮称',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` varchar(50) DEFAULT NULL COMMENT 'email地址',
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `img` varchar(50) DEFAULT 'avatar.png' COMMENT '头像',
  `sex` varchar(255) DEFAULT NULL COMMENT '性别',
  `tel` varchar(50) DEFAULT NULL COMMENT '电话号',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `account`, `nickname`, `password`, `email`, `addtime`, `img`, `sex`, `tel`, `address`, `status`) VALUES
(1, '1', '李明', '1', 'dkf@152.com', '2018-03-21 06:37:05', '3663147.jpg', '男', '15236222222', '详细地址详细地址', 0),
(2, '2', '夺要', '2', 'dkf@152.com', '2018-03-20 06:57:05', 'avatar.png', '', '15236222222', '详细地址详细地址', 0),
(4, 'ff', '李明f', 'ff', '', '2018-03-22 11:24:01', 'avatar.png', '未知', '15236222222', '详细地址详细地址', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
