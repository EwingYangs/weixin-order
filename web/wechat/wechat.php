<?php
class WeChat{
	private $_appid;
	private $_appsecret;
	private $_token;
	private $tpl;
	private $access_token;

	public function __construct($appid,$appsecret,$token){
		$this->_appid = $appid;
		$this->_appsecret = $appsecret;
		$this->_token = $token;
		$this->tpl = require('params.php');
	}
	
	/**
		*_request():发出请求
		*@curl:访问的URL
		*@https：安全访问协议
		*@method：请求的方式，默认为get
		*@data：post方式请求时上传的数据
	**/
	private function _request($curl, $https=true, $method='get', $data=null){
		$ch = curl_init();//初始化
		curl_setopt($ch, CURLOPT_URL, $curl);//设置访问的URL
		curl_setopt($ch, CURLOPT_HEADER, false);//设置不需要头信息
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//只获取页面内容，但不输出
		if($https){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//不做服务器认证
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//不做客户端认证
		}
		if($method == 'post'){
			curl_setopt($ch, CURLOPT_POST, true);//设置请求是POST方式
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置POST请求的数据
		}
		$str = curl_exec($ch);//执行访问，返回结果
		curl_close($ch);//关闭curl，释放资源
		return $str;
	}
	
	/**
		*_getAccesstoken()：获取access token
	**/
	private function _getAccesstoken(){
		if($this->access_token){
			return $this->access_token;
		}
		$file = 'wechat/accesstoken'; //用于保存access token
		if(file_exists($file)){ //判断文件是否存在
			$content = file_get_contents($file); //获取文件内容
			$content = json_decode($content);//json解码
			if(time()-filemtime($file)<$content->expires_in) //判断文件是否过期
				return $content->access_token;//返回access token
		}
		$content = $this->_request("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->_appid."&secret=".$this->_appsecret); //获取access token的json对象
		file_put_contents($file, $content); //保存json对象到指定文件
		$content = json_decode($content);//进行json解码
		return $content->access_token;//返回access token
	}
	
	/** 
		*_getTicket():获取ticket，用于以后换取二维码
		*@expires_secords：二维码有效期（秒）
		*@type ：二维码类型（临时或永久）
		*@scene：场景编号
	**/
	public function _getTicket($expires_secords = 604800, $type = "temp", $scene = 1){ 
		 if($type == "temp"){//临时二维码的处理
			 $data = '{"expire_seconds":'.$expires_secords.', "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$scene.'}}}';//临时二维码生成所需提交数据
			return $this->_request("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->_getAccesstoken(),true, "post", $data);//发出请求并获得ticket
		 } else { //永久二维码的处理
			 $data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene.'}}}';//永久二维码生成所需提交数据
			return $this->_request("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->_getAccesstoken(),true, "post", $data);//发出请求并获得ticket
		 }
	}
	
	/**
		*_getQRCode():获取二维码
		*@expires_secords：二维码有效期（秒）
		*@type：二维码类型
		*@scene：场景编号
	**/
	public function _getQRCode($expires_secords,$type,$scene){
		$content = json_decode($this->_getTicket($expires_secords,$type,$scene));//发出请求并获得ticket的json对象
		$ticket = $content->ticket;//获取ticket
		$image = $this->_request("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket)
		);//发出请求获得二维码图像
		$file = "./".$type.$scene.".jpg";// 可以将生成的二维码保存到本地，便于使用
		file_put_contents($file, $image);//保存二维码
		return $image;
	}

	/**
	 * [根据code获取用户的oppenId]
	 * @AuthorHTL
	 * @DateTime  2017-03-05T13:12:06+0800
	 * @param     [type]                   $code [description]
	 * @return    [type]                         [description]
	 */
	public function getOpenIdByCode($code){
		$content = $this->_request('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->_appid.'&secret='.$this->_appsecret.'&code='.$code.'&grant_type=authorization_code');
		$content = json_decode($content);
		$this->access_token = $content->access_token;
		return $content->openid;
	}

	public function getUserInfoByOpenId($openid){
		$content = $this->_request('https://api.weixin.qq.com/sns/userinfo?access_token='.$this->access_token.'&openid='.$openid);
		$content = json_decode($content);
		return $content;
	}

	public function valid()//检查安全性
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    /**
     * [自动回复消息]
     * @AuthorHTL
     * @DateTime  2017-02-28T23:09:49+0800
     * @return    [type]                   [description]
     */
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//获得用户发送信息
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		switch($postObj->MsgType){
			case 'event':
				$this->_doEvent($postObj);
				break;
			case 'text':
				$this->_doText($postObj);
				
				break;
			case 'image':
				$this->_doImage($postObj);
				break;
			case 'voice':
				$this->_doVoice($postObj);
				break;
			case 'video':
				$this->_doVideo($postObj);
				break;
			case 'location':
				$this->_doLocation($postObj);
				break;
			default: exit;
		}
	}
	private function _doLocation($postObj){
		 
		$str = sprintf($this->tpl['text'],$postObj->FromUserName,$postObj->ToUserName,time(),"您所在位置的经度是：".$postObj->Location_Y."，纬度是：".$postObj->Location_X."!");
		echo $str;
	}
	private function _doEvent($postObj){ //事件处理
		switch($postObj->Event){
			case  'subscribe': //订阅
				$this->_doSubscribe($postObj);
				break;
			case 'unsubscribe': //取消订阅
				$this->_doUnsubscribe($postObj);
				break;
			case 'CLICK':
				$this->_doClick($postObj);
				break;
			default:;
		}
	}


/**
	  *_doClick():处理菜单点击事件
	  *@postObj:响应的消息对象
	**/
	private function _doClick($postObj){
		//获取服务器推送的消息，标题，内容，图片，连接等，拼成数组
		if($postObj->EventKey == 'new'){//按钮的名称
			$news = array(
				array('title'=>' 曝郑智进亚洲足球先生三甲 恒大夺亚冠或可当选 ',
					'descrption'=>'北京时间11月9日消息，据《体坛周报》报道，2015年“亚洲足球先生”即将于本月底揭晓，中国国家队和广州恒大队双料队长郑智已进入最后的3名候选人名单，如果恒大本赛季最终夺得亚冠，郑智将有很大可能第二度夺得这项荣誉。',
					picurl=>'http://k.sinaimg.cn/n/transform/20151109/rWfJ-fxknius9759492.jpg/w5705ff.jpg',
					url=>'http://sports.sina.com.cn/china/afccl/2015-11-09/doc-ifxknius9759639.shtml'),
				array('title'=>' 西甲-C罗哑火J罗复出 皇马2-3遭逆转首负丢榜首 ',
					'descrption'=>'北京时间11月9日03：30（西班牙当地时间8日20：30），2015/16赛季西班牙足球甲级联赛第11轮一场焦点战在皮斯胡安球场展开角逐，皇家马德里客场2比3不敌塞维利亚，拉莫斯倒钩进球后伤退，因莫比莱、巴内加和洛伦特连续进球，贝尔助攻J罗伤停补时扳回一城。皇马遭遇赛季首负丢失榜首。',
					picurl=>'http://k.sinaimg.cn/n/transform/20151109/sFo8-fxknutf1614882.jpg/w570151.jpg',
					url=>'http://sports.sina.com.cn/g/laliga/2015-11-09/doc-ifxknutf1614642.shtml'),
					
				array('title'=>' 西甲-C罗哑火J罗复出 皇马2-3遭逆转首负丢榜首 ',
					'descrption'=>'北京时间11月9日03：30（西班牙当地时间8日20：30），2015/16赛季西班牙足球甲级联赛第11轮一场焦点战在皮斯胡安球场展开角逐，皇家马德里客场2比3不敌塞维利亚，拉莫斯倒钩进球后伤退，因莫比莱、巴内加和洛伦特连续进球，贝尔助攻J罗伤停补时扳回一城。皇马遭遇赛季首负丢失榜首。',
					picurl=>'http://k.sinaimg.cn/n/transform/20151109/sFo8-fxknutf1614882.jpg/w570151.jpg',
					url=>'http://sports.sina.com.cn/g/laliga/2015-11-09/doc-ifxknutf1614642.shtml')
			);
			$count = count($news);
			for($i=0;$i<count($news);$i++)
				$it .= sprintf($this->tpl['item'],$news[$i]['title'],$news[$i]['description'],$news[$i]['picurl'],$news[$i]['url']);
			$content = sprintf($this->tpl['list'],$postObj->FromUserName,$postObj->ToUserName,time(),$count, $it);
			echo $content;
		}	
	}



	private function _doSubscribe($postObj){
		$tpltext = $this->tpl['text'];
		$str = sprintf($tpltext,$postObj->FromUserName,$postObj->ToUserName,time(),'欢迎您关注点餐公众号！');
		echo $str;
	}
	
	private function _doUnsubscribe($postObj){
		//把用户的信息从数据库中删除
	}
	
	private function _doText($postObj){
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$keyword = trim($postObj->Content);
		$time = time();
		$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";             
		if(!empty( $keyword ))
		{
			if($keyword == "hello")
				$contentStr = "Welcome to wechat  PHP 39 world!";
			if($keyword == "PHP")
				$contentStr = "最流行的网页编程语言！";
			if($keyword == "JAVA")
				$contentStr = "较流行的网页编程语言！";
				$msgType = "text";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
		}
        exit;	
	}
	
	/**
	  *_sendMusic():发送音乐
	  *@postObj:响应的消息对象
	**/
	private function _sendMusic($postObj){
		$content = $postObj->Content;
		$content = mb_substr($content,2,mb_strlen($content,'utf-8')-2,'utf-8');//删除字符串前两个字符（删除”歌曲“）
		$arr = explode('@',$content);//分解歌曲和歌手到数组
		$song = $arr[0];
		$singer = '';
		if(isset($arr[1])){//生成有歌曲和歌手的音乐搜索地址
			$singer = $arr[1];
			$curl = 'http://box.zhangmen.baidu.com/x?op=12&count=1&title='.$arr[0].'$$'.$arr[1].'$$$$';
		}
		else //搜索仅有歌曲的地址
			$curl = 'http://box.zhangmen.baidu.com/x?op=12&count=1&title='.$arr[0].'$$';
		$response = $this->_request($curl, false);//开始搜索
		$res = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);//搜索结果解析
		$encode = $res->url->encode;
		$decode = $res->url->decode;
		$musicurl = mb_substr($encode, 0, mb_strrpos($encode, '/', 'utf-8') + 1,'utf-8').
		mb_substr($decode, 0, mb_strrpos($decode, '&', 'utf-8'),'utf-8');
		//file_put_contents('./tmp', mb_substr($encode, 0, mb_strrchr($encode, '/', 'utf-8') + 1,'utf-8'));//生成歌曲的实际地址
		$str = sprintf($this->tpl['music'],$postObj->FromUserName,$postObj->ToUserName,time(),$arr[0],$arr[1],$musicurl,$musicurl,"");//发送歌曲到用户
		echo $str;
		exit;
	}

	private function _doImage($postObj){
		
		$str = sprintf($tpltext,$postObj->FromUserName,$postObj->ToUserName,time(),'您发送的图片在'.$postObj->PicUrl."。");
		echo $str;
	}
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}


	/**
	  * _sendAll()：群发消息
	**/
	public function _sendAll($content){
		$tpl = '{
		   			"touser":[
		   				%s
		   			],
					"msgtype": "text",
					"text": { "content": "%s"}
				}';
		$curl = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$this->_getAccesstoken();
	
		$users = $this->_getUserList();//获取所有的用户
		$u = '';
		for($i=0;$i<count($users);$i++){
			$u .= '"'.$users[$i].'"';
			if($i < count($users) -1)
				$u .= ',';
		}	
		$data = sprintf($tpl,$u,$content);
		$result = $this->_request($curl, true, "post", $data);
		$result = json_decode($result);
		if($result->errcode == 0){
			return true;
		}else{
			return false;
		}
	}

	/**
	* _addMedia()：添加素材
	**/
	public function _addMedia($type, $file){
		$curl='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->_getAccesstoken().'&type='.$type;
		$data['type']=$type;
		$data['media']='@'.$file;
		$result = $this->_request($curl, true, "post", $data);
		echo $result;
	}


	/**
	* _getUserList()：获取用户列表，返回openid数组
	**/
	public function _getUserlist(){
		$url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->_getAccesstoken();
		$content = $this->_request($url);
		$content = json_decode($content);
		$users = $content->data->openid;
		return $users;
	}


	/*
	*创建菜单
	*/
	public function _createMenu($data){
		$url = " https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->_getAccesstoken();
		
		$result = $this->_request($url,true,"post",$data);
		$result = json_decode($result);
		if($result->errcode == 0){
			echo "创建成功！";
		}else{
			echo "创建失败！";
		}
	}


	/*
	*获取查询菜单
	**/
	public function _queryMenu(){
		$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->_getAccesstoken();
		$menu = $this->_request($url);
		return $menu;
	}
}
?>
