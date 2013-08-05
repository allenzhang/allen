-- MySQL dump 10.11
--
-- Host: 10.210.230.70    Database: itsm
-- ------------------------------------------------------
-- Server version	5.5.29-log

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
-- Table structure for table `vs_img`
--

DROP TABLE IF EXISTS `vs_img`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `vs_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL COMMENT 'uuid',
  `website` varchar(50) NOT NULL COMMENT '网站标识',
  `wid` int(4) NOT NULL COMMENT '网站id',
  `zone_id` int(11) NOT NULL COMMENT '网站区域id',
  `weight` int(11) NOT NULL DEFAULT '1' COMMENT '显示权重',
  `address` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `description` varchar(100) DEFAULT NULL COMMENT '图片描述',
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '图片状态（0不显示，1正常显示，2待删除，3已删除）',
  `type` int(4) DEFAULT '1' COMMENT '1:普通, 2:logo,3:新闻图片(缩略图),4:新闻图片(详情页大图)',
  `news_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `vs_img`
--

LOCK TABLES `vs_img` WRITE;
/*!40000 ALTER TABLE `vs_img` DISABLE KEYS */;
INSERT INTO `vs_img` VALUES (3,'51a22db56dbb8.png','yjssm',1,1,0,NULL,'logo',1,2,0),(4,'51a231e944b81.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(5,'51a231f1bc769.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(6,'51a231f7cceb9.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(7,'51a231ffd1515.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(8,'51a232077aaad.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(9,'51a2321849546.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(10,'51a2322a42dfc.jpg','yjssm',1,2,0,NULL,NULL,1,1,0),(11,'51a23258057e3.jpg','yjssm',1,4,0,NULL,'行走轮',1,1,0),(12,'51a2325ed88d7.jpg','yjssm',1,4,0,NULL,'机头轮',1,1,0),(13,'51a232825e114.jpg','yjssm',1,4,0,NULL,'机头瓦盒',1,1,0),(14,'51a2328907b93.jpg','yjssm',1,4,0,NULL,'轮罩',1,1,0),(15,'51a232908c86e.jpg','yjssm',1,4,0,NULL,'其他配件',1,1,0),(16,'51a232d5163f6.jpg','yjssm',1,5,0,NULL,'行业咨询',1,1,0),(17,'51a232dbbf423.jpg','yjssm',1,5,0,NULL,'在线留言',1,1,0),(18,'51a2355908da7.jpg','yjssm',1,3,0,NULL,NULL,1,1,0),(19,'51a2355f5ad8a.jpg','yjssm',1,3,0,NULL,NULL,1,1,0),(20,'51a2356702955.jpg','yjssm',1,3,0,NULL,NULL,1,1,0),(21,'51a36652db7eb.jpg','yjssm',1,5,0,NULL,NULL,1,1,0),(22,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,1),(23,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,2),(24,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,3),(25,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,4),(26,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,5),(27,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,6),(28,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,7),(29,'51a36652db7eb.jpg','yjssm',1,7,1,NULL,NULL,1,3,8);
/*!40000 ALTER TABLE `vs_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vs_news`
--

DROP TABLE IF EXISTS `vs_news`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `vs_news` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `source` varchar(100) DEFAULT NULL COMMENT '来源',
  `content` text NOT NULL COMMENT '新闻正文',
  `website` varchar(50) NOT NULL COMMENT '网站标识',
  `save_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '保存时间',
  `wid` int(11) NOT NULL COMMENT '网站id',
  `zone_id` int(11) NOT NULL COMMENT '区域id',
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '新闻状态（0不显示，1正常显示，2待删除，3已删除）',
  `weight` int(4) NOT NULL DEFAULT '1' COMMENT '显示权重',
  `pub_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  `img_count` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `vs_news`
--

LOCK TABLES `vs_news` WRITE;
/*!40000 ALTER TABLE `vs_news` DISABLE KEYS */;
INSERT INTO `vs_news` VALUES (1,'新型伸缩门车轮的结构与维护','本站','跟着社会的发展以及科技的提高，目前很多的行业里都开始使用各种自动化程度更高的设备，在各种厂房、机关等部分中，一些传统的手推式大门都逐渐被一些具有一定自动化水平伸缩门所代替，目前伸缩门在很大程度上己经得到了普及并逐渐成为一种新的行业尺度，伸缩门是一种由伸缩门机头带动门幅，在大门的两个立柱之间往返运动，从而实现大门的打开或封闭，为了使机头和门幅在门柱间往返运动，该伸缩门的机头和门幅的门柱下端都设置有用于动弹的轮子，以减小摩擦，但因为这些伸缩门是工作在室外的环境中，难免会遭受风吹雨淋，为了保护轮子不受雨水的腐蚀，通常伸缩门都设置了轮罩来遮盖车轮，常见的结构是车轮罩与一片固定板焊接，该固定板与门幅门柱经由点焊焊接，轮子在经由一段时间的使用后，通常需要取下轮罩对车轮进行维修或维护，因此过程比较麻烦，特别是对多个车轮进行维修维护时，大大增加了维护和保养的本钱。\r\n         新型伸缩门车轮罩易拆卸结构，采用了伸缩门门柱卡槽与车轮罩固定板的插片相卡合的结构，因此卡合更加利便快捷，便于对车轮按期进行检查和维护，相对于现有的点焊连接结构，可以大大减少维护时间，降低用户的维护本钱，该车轮罩固定板若结合卡槽与车轮轴卡合的连接方式，可以保证结合的牢固。该车轮罩固定板下端设有一个与车轮轴卡合的卡槽，该卡槽边沿之间的宽度略小于车轮轴的直径，在该车轮轴与该卡槽卡合的位置处沿车轮轴圆柱面设有圆形的沟槽，该车轮罩固定板与伸缩门门柱固定后，该车轮罩固定板的卡槽与该车轮轴的沟槽相互配合定位。\r\n        新型伸缩门车轮罩易拆卸结构包括竖直设置的伸缩门门柱、与门柱相固定的车轮罩固定板和车轮罩，该车轮罩与车轮罩固定板固定连接，设有伸缩门车轮的轮轴在该伸缩门门柱底端与该伸缩门门柱固定连接，该伸缩门门柱上设有至少一个可沿上下方向插设的插槽，车轮罩固定板上对应设置有与伸缩门门柱的插槽配合插设的插片。','yjssm','2013-05-27 14:45:53',1,7,1,1,'2013-07-07 08:00:13',1),(2,'详谈伸缩门特点','本站','智能红外线防爬装置：遇人爬门时,系统会马上报警,从而保障工厂内的财产安全。\r\n特种型材：在高硬度锌铝合金型材上加上不同几何形状筋骨能大大增强其强度，表面经特殊电泳处理，光泽无限，不易粘尘，不被污染气体腐蚀，决不生锈，保新期长。\r\n工程塑料：门体主要塑料件（如管材与管材间的连接，塑料件，门体活动部件等等）采用高质量工程塑料（如PC、PA），韧性高，耐冲击,抗扭曲，耐磨，耐冻，耐晒，不易老化，使用寿命长，免受风雪雷电、日晒雨淋之苦。\r\n智能红外线探头防碰撞装置：门体在关闭过程中遇人或异物30-50cm可自动返回运行，从而保障车辆及行人 的安全。 标准结构:门排内空（即前后相临两大弯主管之间的距离，不含主管尺寸）采用伸缩门标准尺寸320mm（参照国外技术），保证交叉管坚固，并大大减少运行噪音。\r\n不锈钢伸缩门 铝合金伸缩门,独特工艺制作门体主框架型材由塑料件连接而成，连接位的螺丝固定采用隐型设计，提高门体的外观性，型材与塑料件的连接则采用冲、压、钻等工艺，使门体 结构牢固, 绝无焊点。最新交叉连接设计：交叉管采用特殊工艺冲制而成，并配 用超级PA耐磨套，与圆管紧密结合不仅使门排结构更加牢固，而且保证运行更加平滑。\r\n伸缩门的特点美化环境、改善企业面貌、提升企业形象;有助于营造文明企业、文明工厂、文明 城市气氛;提高安全性、即使深夜遇有破坏或翻越，立刻报警。 伸缩门主要用于生活小区，机关学校，企业事业单位、各个工厂，等。','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:16',1),(3,'伸缩门的车轮罩的情况','本站','跟着社会的发展以及科技的提高，目前很多的行业里都开始使用各种自动化程度更高的设备，在各种厂房、机关等部分中，一些传统的手推式大门都逐渐被一些具有一定自动化水平伸缩门所代替.\r\n       目前伸缩门在很大程度上己经得到了普及并逐渐成为一种新的行业尺度，伸缩门是一种由伸缩门机头带动门幅，在大门的两个立柱之间往返运动，从而实现大门的打开或封闭，为了使机头和门幅在门柱间往返运动，该伸缩门的机头和门幅的门柱下端都设置有用于动弹的轮子，以减小摩擦，但因为这些伸缩门是工作在室外的环境中，难免会遭受风吹雨淋，为了保护轮子不受雨水的腐蚀，通常伸缩门都设置了轮罩来遮盖车轮，常见的结构是车轮罩与一片固定板焊接，该固定板与门幅门柱经由点焊焊接，轮子在经由一段时间的使用后，通常需要取下轮罩对车轮进行维修或维护，因此过程比较麻烦，特别是对多个车轮进行维修维护时，大大增加了维护和保养的本钱。本实用新型涉及一种用于伸缩门的配件，尤指一种用作伸缩门车轮护罩与伸缩门立柱利便卡合的伸缩门车轮罩易拆卸结构。新型伸缩门车轮罩易拆卸结构包括竖直设置的伸缩门门柱、与门柱相固定的车轮罩固定板和车轮罩，该车轮罩与车轮罩固定板固定连接，设有伸缩门车轮的轮轴在该伸缩门门柱底端与该伸缩门门柱固定连接，该伸缩门门柱上设有至少一个可沿上下方向插设的插槽，车轮罩固定板上对应设置有与伸缩门门柱的插槽配合插设的插片。','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:18',1),(4,'电动伸缩门的产品特点','本站','电动伸缩门随着我国经济发展的不断壮大，市场竞争日益激烈，能做到在市场中屹立不倒。最重要是厂家在发展自身的过程中找准自己的定位，有了一个大方向后，才能坚定不移的走下去，获得成功。那么我们该如何获得属于自己自身的的定位呢。这一切得要先从市场，消费者身上去找了。\r\n       实用是必须-现在消费者购买的产品，大抵上首先需要其实用性高，那么电动伸缩门的实用性又是体验在何处呢。电动伸缩门主要分为门体和控制只能装置。门体制作优先选用优质不锈钢材料，以平行四边形原理为基础进行交接。以保证伸缩灵活。而驱动器采用特种电机驱动，设有手动离合器并附带蜗轮减速，保证即使在停电时可转为人手驱动，保持使用。而采用伸缩棚格型就会具有启闭平稳开启后占用空间小等的使用特点了。\r\n       艺术也重要-除了实用性得到保证外，其实艺术性也是一个关键。一些电动伸缩门上，采用了一些装饰。这些装饰一般会选用电脉工艺处理，出黎之后附着力更强。在颜色装饰上颜色并长时间不掉色不褪色。并且具有多种颜色可以选择。使用寿命-在使用寿命上，得到保证，最重要是一些小配件的配合和材料选用上，做好才能有长的使用寿命。这些便是电动伸缩门在当前市场上的重要定位了。','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:20',1),(5,'电动伸缩门配件种类','本站','电动伸缩门常用到的配件主要有：电动伸缩门专用遥控器、外用发射控制器、限位磁铁、专用线缆、防撞防爬器等。电动伸缩门主要包括两大项：驱动装置和门体。电动伸缩门驱动装置含：一体减速电动伸缩门电机、离合器、干簧管、限位开关、系统控制主板、红外感应探测器、密封式齿轮电机、控制盒、机箱、LED显示屏等。电动伸缩门的门体主要包括：主材门排、中间交叉杆、轮子、启动轮、防风设计钩等。','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:22',1),(6,'电动伸缩门配件的特点','本站','电动伸缩门这种产品因为其美观实用，广泛应用于企事业单位、学校及工厂大门。这种电动伸缩门具有启闭平稳、透视门体，开启后占用空间小等特点，主要配件的特点如下：　　\r\n        1、材料：采用行业领先的电脉工艺产业高强度铝合金，造型根据的结构特点精心设计而成，从而使型材结构更公道、耐用。材质采用高强度铝合金，强度、密度和耐腐蚀性都明显进步，从而保证了电动伸缩门的使用寿命；光彩方面，经电脉工艺处理，附着力强，可保持颜色鲜艳亮丽，长时间不掉色，不褪色，抗氧化,并可选择：金、银、黑三种颜色。\r\n        2、轮子:电动伸缩门的主动轮与从动轮均选用铸铝合金,配合进口橡胶制作而成,从动轮更采用双轴承装置结构,达到双轮同心作用,不摇摆,在具有美观的外表同时,也增加了耐磨性和可靠性,保证了门体长久运行。\r\n        3、耐磨套：电动伸缩门孔眼都镶有PA耐磨套，并且每个胶管连接位都加上钢平介垫片，真正做到无刺耳的磨擦，无松动，从而使滑动杆平行上下滑动。\r\n        4、机头连接件：采用压铸铝合金制作，克服了塑料连接件存在的不良题目，不受严冷、暴晒的影响，卧置底座增加了一个连接件，受力均匀，行走自如。卧置式四维均缩连杆技术，完全无轨运行，伸缩自如，续步演绎，性能更可靠，宽广沉稳的卧式底座，能经受得起更大的风沙洗礼，能在强风的吹袭下照常运行，屹立不倒。\r\n        5、压铸铝合金连接件：采用压铸铝合金材料连接件，打破常规电动伸缩门主料连接塑料工艺，沉稳的主体坚不可摧，能在烈日暴晒的情况下永不变型，不老化，不变色，永保光辉；连接螺丝坚固不易滑丝，从而运行顺畅、稳定、无噪音，在性能、牢固、耐用方面比其它的普通电动伸缩门连接件强数倍。\r\n　    6、内置式滑块：是根据道槽式装置原理设计而成，滑动平稳自如，永不脱落。','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:24',1),(7,'伸缩门发展现状','本站','自动伸缩门产业态势的变化会随着市场的变化而发展。企业经营与管理已经从过去单一的目标式发展开始向系统化、科学化管理转变。如何从专业的眼光认识自动伸缩门产业的发展和市场的转变，如何用科学的方法对企业的各个层面进行有效的管理，将成为企业未来生存和发展的首要问题。\r\n        有很多的企业的思维仍然停留在创业初期，没有一个适当的规划和执行控制，只是凭借感觉和企业主的个人好恶进行管理。而且在整体管理过程中，由于企业主或者管理人员缺乏相关的专业和管理技巧，使得管理过程控制手段多变，被管理者出现迷茫或者抵触。企业的经营管理混乱，导致企业整体员工工作绩效下降，缺乏企业归属和安全感。如此导入恶性循环，企业在市场的地位便岌岌可危.\r\n        企业的经营与管理需要系统化和科学化的知识，并不能一蹴而就，简单施为。用专业的视角帮助企业认识自动伸缩门产业、开阔思路、理清头绪，引导企业快速有效的找到提高企业竞争能力的方法。以自动伸缩门产业作为切入点，通过对自动伸缩门产业特征和统计数据的全面分析，确定自动伸缩门产业发展概况和基本特征；运用科学的方法和模型，帮助企业掌握市场动向，明确自动伸缩门产业竞争趋势；并在此基础上，对企业发展中遇到的经营及管理方面的问题进行有针对性的分析，为企业解决运行中的阻力提供行之有效的解决思路及方法。\r\n       随着伸缩门业市场原材料成本的增加和技术差异化的缩小，传统伸缩门业的竞争已经遇到瓶颈，随之而来的是企业在新形势下将要面临的伸缩门业竞争新格局，如何在新格局下成就伸缩门业的大好未来，考验的是当下伸缩门企业老总和团队的的智慧。 ','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:26',1),(8,'电动伸缩门的市场竞争','本站','中国电动伸缩门十大品牌评选运动正在炽热进行中，旨在经过评选运动，为电动伸缩门行业的品牌宣传添砖加瓦，到达有用的推进电动伸缩门行业中的品牌建立，把竞争力强的电动伸缩门品牌引荐给广阔消费者及经销商，增强他们对电动伸缩门消费的决心。\r\n       电动伸缩门曾经逐渐构成了财产集群优势，当前曾经构成从原资料、模具制造、电动伸缩门配件、电动伸缩门制品加工等完好的财产链。呈现了一多量规划较大的企业。在出口方面，电动伸缩门行业出现出较强的竞争力，还越来越多的企业开端注重对国内市场的开拓，在市场运作和产物开拓方面，企业的投进力度逐渐加大。但在成果的背面，电动伸缩门财产链条还存在良多缺乏。\r\n       电动伸缩门财产的开展需求一个准确的主题界说--中国电动伸缩门十大品牌。电动伸缩门企业面对着市场竞争、成本压力等晦气要素的影响，当局有责任指导、协助企业。打造强势区域品牌，恰是当局协助企业制造优越的区域情况的主要伎俩，并且刻不容缓。财产的标准开展在于管理。当局须将财产统筹起来，不能呈现见到什么就做什么的乱棍打狗行为，而是要统一结构，将产区下面各个当地的特征区分隔来，整合电动伸缩门各类资本，创立各类专业镇、财产园区等利于财产开展的区域。','yjssm','0000-00-00 00:00:00',1,7,1,1,'2013-07-07 08:00:30',1);
/*!40000 ALTER TABLE `vs_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vs_zone`
--

DROP TABLE IF EXISTS `vs_zone`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `vs_zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website` varchar(50) NOT NULL COMMENT '网站标识',
  `wid` int(4) NOT NULL COMMENT '网站id',
  `description` varchar(50) NOT NULL COMMENT '网站区域描述',
  `status` int(4) NOT NULL DEFAULT '1' COMMENT '图片区域状态（0 取消 1正常）',
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `vs_zone`
--

LOCK TABLES `vs_zone` WRITE;
/*!40000 ALTER TABLE `vs_zone` DISABLE KEYS */;
INSERT INTO `vs_zone` VALUES (1,'yjssm',1,'首页logo',1,'image'),(2,'yjssm',1,'导航图片',1,'image'),(3,'yjssm',1,'首页滚动大图',1,'image'),(4,'yjssm',1,'首页产品小图',1,'image'),(5,'yjssm',1,'首页三幅大图',1,'image'),(6,'yjssm',1,'首页底部logo',1,'image'),(7,'yjssm',1,'永佳伸缩门行业资讯新闻',1,'news'),(8,'yjssm',1,'行业咨询',1,'image');
/*!40000 ALTER TABLE `vs_zone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-05  8:07:21
