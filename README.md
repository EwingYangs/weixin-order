# 项目介绍：

- 用Yii2框架做的一个微信公众号点餐系统，商家接入管理后台之后就可以在后台添加菜式的类型和菜式的名称，客户在微信扫描二维码关注公众号就可以在公众号点餐，下单时提交餐桌号还有相应的信息到商家后台，商家在后台可以查看到订单信息

- 业务流程图如下
![图片1.png](http://g.hiphotos.baidu.com/image/pic/item/314e251f95cad1c869c42804753e6709c93d5192.jpg)

# 效果图如下
- 点餐界面
![图片1.png](http://g.hiphotos.baidu.com/image/pic/item/7dd98d1001e93901af345c1d71ec54e736d196db.jpg)

- 下单页面
![图片1.png](http://c.hiphotos.baidu.com/image/pic/item/f603918fa0ec08fa133ac28453ee3d6d55fbdadf.jpg)

- 管理后台
![图片1.png](http://g.hiphotos.baidu.com/image/pic/item/0dd7912397dda144d3a0bd91b8b7d0a20cf4866c.jpg)

# 项目部署

- 下载项目

        git clone https://github.com/EwingYangs/weixin-order
        
- composer 安装yii库

        cd weixin-order
        composer install
        
- nginx 配置，看根目录的nginx.conf文件

- 数据库配置

    - 创建数据库weixinorder
    - 导入跟目录下的order.sql文件到数据库
    - 在config/db.php 配置数据库信息
 
            return [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=weixinorder',
                'username' => 'root',
                'password' => '123456',
                'charset' => 'utf8',
            ];
        
- 点餐地址（前端） www.order.com
- 后台地址（后台） www.order.com/site/index 账号密码为ppoo/123456

# 其他

- 提示，因为个人原因缺乏支付功能，支付代码已经完成
- 项目交流请QQ联系501978500
