-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: localhost    Database: weixinorder
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `new`
--

DROP TABLE IF EXISTS `new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `create_at` varchar(45) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新闻表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new`
--

LOCK TABLES `new` WRITE;
/*!40000 ALTER TABLE `new` DISABLE KEYS */;
/*!40000 ALTER TABLE `new` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(32) NOT NULL COMMENT '管理员昵称',
  `mail` varchar(150) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `tel` varchar(150) NOT NULL COMMENT '管理员电话',
  `password` varchar(35) NOT NULL COMMENT '管理员登录密码',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '管理员登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ppoo','jiaying.yang@qq.com','13250150526','e10adc3949ba59abbe56e057f20f883e',1489323209);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_a_info`
--

DROP TABLE IF EXISTS `w_a_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_a_info` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '餐厅ID',
  `room_name` varchar(45) NOT NULL COMMENT '餐厅名称',
  `room_addr` varchar(150) NOT NULL DEFAULT '' COMMENT '餐厅地址',
  `table_number` int(11) NOT NULL DEFAULT '0' COMMENT '餐桌数量表',
  `admin_id` int(11) NOT NULL COMMENT '餐厅所属的管理员',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='餐厅基本信息设置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_a_info`
--

LOCK TABLES `w_a_info` WRITE;
/*!40000 ALTER TABLE `w_a_info` DISABLE KEYS */;
INSERT INTO `w_a_info` VALUES (1,'仙庙烧鸡','广州市荔湾区汾水',50,41,1487949198,1488086016);
/*!40000 ALTER TABLE `w_a_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_info`
--

DROP TABLE IF EXISTS `w_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '推送消息ID',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '推送消息标题',
  `content` text NOT NULL COMMENT '推送消息内容',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '推送消息时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='消息推送表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_info`
--

LOCK TABLES `w_info` WRITE;
/*!40000 ALTER TABLE `w_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `w_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_menu`
--

DROP TABLE IF EXISTS `w_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜式ID',
  `menu_name` varchar(45) NOT NULL DEFAULT '' COMMENT '菜式名称',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '单价',
  `menu_type` int(11) NOT NULL DEFAULT '1' COMMENT '菜式分类ID,默认是1',
  `menu_number` int(11) NOT NULL DEFAULT '0' COMMENT '菜式数量',
  `menu_logo` varchar(45) NOT NULL DEFAULT '' COMMENT '菜式logo图片',
  `update_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间（时间戳）',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间（时间戳）',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已经删除（0没有删除，1表示删除）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='门店菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_menu`
--

LOCK TABLES `w_menu` WRITE;
/*!40000 ALTER TABLE `w_menu` DISABLE KEYS */;
INSERT INTO `w_menu` VALUES (1,'水煮牛肉',30,1,20,'uploads/58a7b4e5172e1.jpg',1487385829,1485928662,0),(2,'化州糖水',30,5,20,'uploads/58a703411b92e.jpg',1487340353,1485928685,0),(3,'台湾蛋蒲（人气小吃）',15,5,30,'uploads/58a7026c9acb9.jpg',1487340140,1487340140,0),(4,'红烧乳猪',30,1,20,'uploads/58a7b2289d3bb.jpg',1487385128,1487385128,0),(5,'清远鸡',50,1,50,'uploads/58a7b2441c57a.jpg',1487385156,1487385156,0),(6,'红烧虾仁',36,1,30,'uploads/58a7b4afb0c2c.jpg',1487385775,1487385609,0);
/*!40000 ALTER TABLE `w_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_menu_type`
--

DROP TABLE IF EXISTS `w_menu_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_menu_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `type_name` varchar(45) NOT NULL COMMENT '分类名称',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除（0没有删除，1已经删除）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='菜式分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_menu_type`
--

LOCK TABLES `w_menu_type` WRITE;
/*!40000 ALTER TABLE `w_menu_type` DISABLE KEYS */;
INSERT INTO `w_menu_type` VALUES (1,'粤菜',0),(2,'点心',0),(3,'食堂',0),(4,'小吃',0),(5,'台湾菜',0),(6,'甜品',0),(7,'校园美食',0),(8,'小炒',0),(9,'推荐',0),(10,'面食',0),(11,'水果',0),(12,'测试',0);
/*!40000 ALTER TABLE `w_menu_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_order`
--

DROP TABLE IF EXISTS `w_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_order` (
  `id` varchar(32) NOT NULL COMMENT '订单ID，随机生成',
  `user_id` int(11) NOT NULL COMMENT '客户ID',
  `order_status` int(11) NOT NULL DEFAULT '0' COMMENT '订单状态(0等待接单，1商户已收单)',
  `order_time` int(11) NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `pay_status` int(11) NOT NULL DEFAULT '0' COMMENT '支付状态（0未支付，1支付完成）',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间（时间戳）',
  `total_price` int(11) NOT NULL DEFAULT '0' COMMENT '订单的总价',
  `table_number` tinyint(4) NOT NULL COMMENT '订单所在的桌子编号',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '订单备注',
  `people` int(4) NOT NULL DEFAULT '0' COMMENT '就餐人数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表（下单表）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_order`
--

LOCK TABLES `w_order` WRITE;
/*!40000 ALTER TABLE `w_order` DISABLE KEYS */;
INSERT INTO `w_order` VALUES ('1456972',1,1,1489205813,1,1489205815,60,15,'不要辣',5),('5648795',1,0,1489205813,1,1489205815,70,14,'不要辣',4);
/*!40000 ALTER TABLE `w_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_order_detail`
--

DROP TABLE IF EXISTS `w_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `menu_id` int(11) NOT NULL COMMENT '菜式ID',
  `menu_number` int(11) NOT NULL DEFAULT '0' COMMENT '菜式数量',
  `menu_price` int(11) NOT NULL DEFAULT '0' COMMENT '菜式单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='订单详情表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_order_detail`
--

LOCK TABLES `w_order_detail` WRITE;
/*!40000 ALTER TABLE `w_order_detail` DISABLE KEYS */;
INSERT INTO `w_order_detail` VALUES (1,1456972,1,1,30),(2,1456972,2,1,30),(3,5648795,4,1,30),(4,5648795,6,1,36);
/*!40000 ALTER TABLE `w_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_table`
--

DROP TABLE IF EXISTS `w_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '桌子编号ID',
  `table_qrcode_pic` varchar(150) NOT NULL COMMENT '桌子对应的二维码支付图片',
  `table_qrcode_url` varchar(150) NOT NULL COMMENT '桌子对应的二维码支付连接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='门店桌子编号表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_table`
--

LOCK TABLES `w_table` WRITE;
/*!40000 ALTER TABLE `w_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `w_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `w_user`
--

DROP TABLE IF EXISTS `w_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `w_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户id',
  `nickName` varchar(45) NOT NULL COMMENT '微信名称',
  `avatarUrl` varchar(45) NOT NULL COMMENT '微信头像',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0：未知、1：男、2：女',
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '客户积分',
  `openid` varchar(45) NOT NULL COMMENT '用户微信标识，公众号获取',
  `unionid` varchar(50) NOT NULL DEFAULT '' COMMENT '微信跟小程序通用的用户ID',
  `create_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='客户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `w_user`
--

LOCK TABLES `w_user` WRITE;
/*!40000 ALTER TABLE `w_user` DISABLE KEYS */;
INSERT INTO `w_user` VALUES (1,'嘉颖YJY','http://wx.qlogo.cn/mmopen/qiaEh4ooRLe0oqRqeBJ',1,0,'oP4OrvwxfELTrc-F__Sie7L8rsV0','',1489203843);
/*!40000 ALTER TABLE `w_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-08 22:01:40
