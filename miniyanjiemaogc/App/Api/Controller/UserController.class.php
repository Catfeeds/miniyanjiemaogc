<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class UserController extends PublicController {

	//***************************
	//  获取用户订单数量
	//***************************
	public function getorder(){
		$uid = intval($_REQUEST['userId']);
		if (!$uid) {
			echo json_encode(array('status'=>0,'err'=>'非法操作！errcode：'.__LINE__));
			exit();
		}

		$check = M('exshop')->where('uid='.intval($uid).' AND audit=1')->getField('id');
		if ($check) {
			$usertype = 1;
		}else{
			$usertype = 0;
		}

		$coupons = M('coupons')->where('uid='.intval($uid))->getField('id');
		if ($coupons) {
			$usercoupons = 1;
		}else{
			$usercoupons = 0;
		}

		$order = array();
		$order['pay_num'] = intval(M('order')->where('uid='.intval($uid).' AND status=10 AND del=0')->getField('COUNT(id)'));
		$order['rec_num'] = intval(M('order')->where('uid='.intval($uid).' AND status=30 AND del=0 AND back="0"')->getField('COUNT(id)'));
		$order['finish_num'] = intval(M('order')->where('uid='.intval($uid).' AND status>30 AND del=0 AND back="0"')->getField('COUNT(id)'));
		$order['refund_num'] = intval(M('order')->where('uid='.intval($uid).' AND back>"0"')->getField('COUNT(id)'));
		echo json_encode(array('status'=>1,'orderInfo'=>$order,'usertype'=>$usertype,'usercoupons'=>$usercoupons));
		exit();
	}


	//***************************
	//  获取用户信息
	//***************************
	public function userinfo(){
		/*if (!$_SESSION['ID']) {
			echo json_encode(array('status'=>4));
			exit();
		}*/
		$uid = intval($_REQUEST['uid']);
		if (!$uid) {
			echo json_encode(array('status'=>0,'err'=>'非法操作.'));
			exit();
		}

		$user = M("user")->where('id='.intval($uid))->field('id,name,uname,photo,tel')->find();
		if ($user['photo']) {
			if ($user['source']=='') {
				$user['photo'] = __DATAURL__.$user['photo'];
			}
		}else{
			$user['photo'] = __PUBLICURL__.'home/images/moren.png';

		$user['tel'] = substr_replace($user['tel'],'****',3,4);
		echo json_encode(array('status'=>1,'userinfo'=>$user));
		exit();
		
		}
	}

	//***************************
	//  用户获取体验券信息
	//***************************
	public function ecode(){
		$uid = intval($_REQUEST['uid']);
		if (!$uid) {
			echo json_encode(array('status'=>0,'err'=>'用户信息异常.'));
			exit();
		}

		$info = M('coupons')->where('uid='.intval($uid))->find();
		if (!$info) {
			echo json_encode(array('status'=>0,'err'=>'没有找到体验券信息.'));
			exit();
		}

		$info['order_sn'] = M('order')->where('id='.intval($info['order_id']))->getField('order_sn');

		if ($info['gettime']>0) {
			$info['gettime'] = date("Y-m-d H:i:s",$info['gettime']);
		}
		if ($info['checktime']>0) {
			$info['checktime'] = date("Y-m-d H:i:s",$info['checktime']);
		}

		if ($info['offtime']>0) {
			if ($info['offtime']<time() && intval($info['state'])==1) {
				M('coupons')->where('id='.intval($info['id']))->save(array('state'=>3));
				$info['state'] = 3;
			}
			$info['offtime'] = date("Y-m-d H:i:s",$info['offtime']);
		}

		if (intval($info['state'])==1) {
			$info['desc'] = '待使用';
		}elseif (intval($info['state'])==2) {
			$info['desc'] = '已使用';
		}elseif (intval($info['state'])==3) {
			$info['desc'] = '已过期';
		}else{
			$info['desc'] = '未领取';
		}

		//获取店铺信息
		if (intval($info['shop_id'])) {
			$shop = M('exshop')->where('id='.intval($info['shop_id']))->field('name,tel,address')->find();
			$info['sname'] = $shop['name'];
			$info['tel'] = $shop['tel'];
			$info['address'] = $shop['address'];
		}

		echo json_encode(array('status'=>1,'info'=>$info));
		exit();
	}

	//**********************************
	//  判断用户是否有获取体验券
	//**********************************
	public function getcode(){
		$uid = intval($_REQUEST['uid']);
		if (!$uid) {
			echo json_encode(array('status'=>0));
			exit();
		}

		$info = M('coupons')->where('uid='.intval($uid).' AND state=1')->find();
		if (!$info) {
			echo json_encode(array('status'=>0));
			exit();
		}

		$order_id = intval($_REQUEST['order_id']);
		if ($order_id==0) {
			$order_id = M('order')->where('status>10 AND back="0" AND uid='.intval($uid))->order('addtime desc,id desc')->getField('order_id');
		}

		if (!$order_id) {
			echo json_encode(array('status'=>0));
			exit();
		}

		if (intval($info['order_id'])==intval($order_id)) {
			echo json_encode(array('status'=>1));
			exit();
		}else{
			echo json_encode(array('status'=>0));
			exit();
		}

	}

	//***************************
	//  修改用户信息
	//***************************
	public function user_edit(){
			$time=mktime();
			$arr=$_POST['photo'];		
			if($_POST['photo']!=''){
				$data['photo'] =$arr;
			}

			$user_id=intval($_REQUEST['user_id']);
			$old_pwd=$_REQUEST['old_pwd'];
			$pwd=$_REQUEST['new_pwd'];
			$old_tel=$_REQUEST['old_tel'];
			$uname=$_REQUEST['uname'];
			$tel=$_REQUEST['new_tel'];

			$user_info = M('user')->where('id='.intval($user_id).' AND del=0')->find();
			if (!$user_info) {
				echo json_encode(array('status'=>0,'err'=>'会员信息错误.'));
				exit();
			}

			//用户密码检测
			$data = array();
			if ($pwd) {
				$data['pwd'] = md5(md5($pwd));
				if ($user_info['pwd'] && md5(md5($old_pwd))!==$user_info['pwd']) {
					echo json_encode(array('status'=>0,'err'=>'旧密码不正确.'));
					exit();
				}
			}

			//用户手机号检测
			if ($tel) {
				if ($user_info['tel'] && $old_tel!==$user_info['tel']) {
					echo json_encode(array('status'=>0,'err'=>'原手机号不正确.'));
					exit();
				}
				$check_tel = M('user')->where('tel='.trim($tel).' AND del=0')->count();
				if ($check_tel) {
					echo json_encode(array('status'=>0,'err'=>'新手机号已存在.'));
					exit();
				}
				$data['tel'] = trim($tel);
			}

			if ($uname && $uname!==$user_info['uname']) {
				$data['uname'] = trim($uname);
			}

			if (!$data) {
				echo json_encode(array('status'=>0,'err'=>'您没有输入要修改的信息.'.__LINE__));
				exit();
			}
			//dump($data);exit;
			$result=M("user")->where('id='.intval($user_id))->save($data);
			//echo M("aaa_pts_user")->_sql();exit;
		    if($result){
				echo json_encode(array('status'=>1));
				exit();
			}else{
				echo json_encode(array('status'=>0,'err'=>'操作失败.'));
				exit();
			}
	}

	//***************************
	//  用户反馈接口
	//***************************
	public function feedback(){
		$uid = intval($_REQUEST['uid']);
		if (!$uid) {
			echo json_encode(array('status'=>0,'err'=>'登录状态异常.'));
			exit();
		}

		$con = $_POST['con'];
		if (!$con) {
			echo json_encode(array('status'=>0,'err'=>'请输入反馈内容.'));
			exit();
		}
		$data = array();
		$data['uid'] = $uid;
		$data['message'] = $con;
		$data['addtime'] = time();
		$res = M('fankui')->add($data);
		if ($res) {
			echo json_encode(array('status'=>1));
			exit();
		}else{
			echo json_encode(array('status'=>0,'保存失败！'));
			exit();
		}

	}

	//***************************
	//  用户商品收藏信息
	//***************************
	public function collection(){
		$user_id = intval($_REQUEST['id']);
		if (!$user_id) {
			echo json_encode(array('status'=>0,'err'=>'系统错误，请稍后再试.'));
			exit();
		}

		$pro_sc = M('product_sc');
		$count = $pro_sc->where('uid='.intval($user_id))->count();// 查询满足要求的总记录数
		$Page  = new \Org\Util\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出
		
		$sc_list = $pro_sc->where('uid='.intval($user_id))->order('id desc')->select();
		foreach ($sc_list as $k => $v) {
			$pro_info = M('product')->where('id='.intval($v['pid']).' AND del=0 AND is_down=0')->find();
			if ($pro_info) {
				$sc_list[$k]['pro_name'] = $pro_info['name'];
				$sc_list[$k]['photo'] = __DATAURL__.$pro_info['photo_x'];
				$sc_list[$k]['price_yh'] = number_format($pro_info['price_yh'],2);
			}else{
				$pro_sc->where('id='.intval($v['id']))->delete();
			}
		}

		echo json_encode(array('status'=>1,'sc_list'=>$sc_list));
		exit();
	}

	//***************************
	//  用户单个商品取消收藏
	//***************************
	public function collection_qu(){
	    $sc_id = intval($_REQUEST['id']);
    	if (!$sc_id) {
    		echo json_encode(array('status'=>0,'err'=>'非法操作.'));
    		exit();
    	}

		$product=M("product_sc");
	    $ress = $product->where('id ='.intval($sc_id))->delete(); 
	   //echo $shangchang->_sql();
		if($ress){
		    echo json_encode(array('status'=>1));
		    exit();
		}else{
		    echo json_encode(array('status'=>0,'err'=>'网络异常！'.__LINE__));
		    exit();
	    }
	}

	//***************************
	//  获取用户优惠券
	//***************************
	public function voucher(){
		$uid = intval($_REQUEST['uid']);
		if (!$uid) {
			echo json_encode(array('status'=>0,'err'=>'登录状态异常！'.__LINE__));
			exit();
		}

		//获取未使用或者已失效的优惠券
		$nouse = array();$nouses = array();$offdate = array();$offdates = array();
		$vou_list = M('user_voucher')->where('uid='.intval($uid).' AND status!=2')->select();
		foreach ($vou_list as $k => $v) {
			$vou_info = M('voucher')->where('id='.intval($v['vid']))->find();
			if (intval($vou_info['del'])==1 || $vou_info['end_time']<time()) {
				$offdate['vid'] = intval($vou_info['id']);
				$offdate['full_money'] = floatval($vou_info['full_money']);
				$offdate['amount'] = floatval($vou_info['amount']);
				$offdate['start_time'] = date('Y.m.d',intval($vou_info['start_time']));
				$offdate['end_time'] = date('Y.m.d',intval($vou_info['end_time']));
				$offdates[] = $offdate;
			}elseif ($vou_info['end_time']>time()) {
				$nouse['vid'] = intval($vou_info['id']);
				$nouse['shop_id'] = intval($vou_info['shop_id']);
				$nouse['title'] = $vou_info['title'];
				$nouse['full_money'] = floatval($vou_info['full_money']);
				$nouse['amount'] = floatval($vou_info['amount']);
				if ($vou_info['proid']=='all' || empty($vou_info['proid'])) {
	                $nouse['desc'] = '店内通用';
	            }else{
	                $nouse['desc'] = '限定商品';
	            }
				$nouse['start_time'] = date('Y.m.d',intval($vou_info['start_time']));
				$nouse['end_time'] = date('Y.m.d',intval($vou_info['end_time']));
				if ($vou_info['proid']) {
					$proid = explode(',', $vou_info['proid']);
					$nouse['proid'] = intval($proid[0]);
				}
				$nouses[] = $nouse;
			}
		}

		////获取已使用的优惠券
		$used = array();$useds = array();
		$vouusedlist = M('user_voucher')->where('uid='.intval($uid).' AND status=2')->select();
		foreach ($vouusedlist as $k => $v) {
			$vou_info = M('voucher')->where('id='.intval($v['vid']))->find();
			$used['vid'] = intval($vou_info['id']);
			$used['full_money'] = floatval($vou_info['full_money']);
			$used['amount'] = floatval($vou_info['amount']);
			$used['start_time'] = date('Y.m.d',intval($vou_info['start_time']));
			$used['end_time'] = date('Y.m.d',intval($vou_info['end_time']));
			$useds[] = $used;
		}

		echo json_encode(array('status'=>1,'offdates'=>$offdates,'nouses'=>$nouses,'useds'=>$useds));
		exit();
	}

}