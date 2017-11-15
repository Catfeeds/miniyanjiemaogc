<?php
namespace Ht\Controller;
use Think\Controller;
class JoinController extends PublicController{

	/*
	* 获取、查询所有订单数据
	*/
	public function index(){
		//搜索
		//构建搜索条件
		$condition = array();
		$where = '1=1';

		//分页
		$count = M('exshop')->where($where)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)

		//分页跳转的时候保证查询条件
		foreach($condition as $key=>$val) {
			$Page->parameter[$key]  =  urlencode($val);
		}

		//头部描述信息，默认值 “共 %TOTAL_ROW% 条记录”
		$Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
		//上一页描述信息
	    $Page->setConfig('prev', '上一页');
	    //下一页描述信息
	    $Page->setConfig('next', '下一页');
	    //首页描述信息
	    $Page->setConfig('first', '首页');
	    //末页描述信息
	    $Page->setConfig('last', '末页');
	    /*
	    * 分页主题描述信息 
	    * %FIRST%  表示第一页的链接显示  
	    * %UP_PAGE%  表示上一页的链接显示   
	    * %LINK_PAGE%  表示分页的链接显示
	    * %DOWN_PAGE% 	表示下一页的链接显示
	    * %END%   表示最后一页的链接显示
	    */
	    $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');

		$show    = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = M('exshop')->where($where)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($list as $k => $v) {
			$list[$k]['addtime'] = date("Y-m-d H:i",$v['addtime']);
			$list[$k]['u_name'] = M('user')->where('id='.intval($v['uid']))->getField('name');
		}
		//echo $where;
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板

	}

	/*
	*
	* 查看订单详情
	*/
	public function show(){
		//获取传递过来的id
		$id = intval($_REQUEST['id']);
		if(!$id) {
			$this->error('系统错误.');
			exit();
		}

		//根据订单id获取订单数据还有商品信息
		$info = M('exshop')->where('id='.intval($id))->find();
		if (!$info) {
			$this->error('体验店信息异常.');
			exit();
		}
		
		$info['addtime'] = date("Y-m-d H:i",$info['addtime']);
		$info['cname'] = M('user')->where('id='.intval($info['uid']))->getField('name');

		$this->assign('info',$info);
		$this->display();
	}

	//*************************
	// 企业会员 审核
	//*************************
	public function shenhe(){
		$id = intval($_POST['id']);
		$check = M('exshop')->where('id='.intval($id))->find();
		if (!$check) {
			$this->error('体验店信息异常！');
			exit();
		}

		$audit = intval($_POST['audit']);
		$reason = trim($_POST['reason']);
		if (!$reason) {
			$reason = '无';
		}

		$up = array();
		$up['audit'] = $audit;
		$up['reason'] = $reason;
		$res = M('exshop')->where('id='.intval($id))->save($up);
		if ($res) {
			$this->success('操作成功！');
			exit();
		}else{
			$this->error('操作失败！');
			exit();
		}
	}


	/*
	*
	*  订单删除方法
	*/
	public function del(){
		//以后删除还要加权限登录判断
		$id = intval($_GET['did']);
		$check_info = $this->order->where('id='.intval($id))->find();
		if (!$check_info) {
			$this->error('系统错误，请稍后再试.');
		}

		$up = array();
		$up['del'] = 1;
		$res = $this->order->where('id='.intval($id))->save($up);
		if ($res) {
			$this->success('操作成功.');
		}else{
			$this->error('操作失败.');
		}
	}

}