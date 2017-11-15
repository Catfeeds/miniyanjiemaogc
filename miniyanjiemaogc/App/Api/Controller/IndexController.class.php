<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends PublicController {
	//***************************
	//  首页数据接口
	//***************************
    public function index(){
    	//如果缓存首页没有数据，那么就读取数据库
    	/***********获取首页顶部轮播图************/
    	$ggtop=M('guanggao')->order('sort desc,id asc')->field('id,photo')->limit(10)->select();
		foreach ($ggtop as $k => $v) {
			$ggtop[$k]['photo']=__DATAURL__.$v['photo'];
		}
    	/***********获取首页顶部轮播图 end************/

        //======================
        //首页推荐商家12个
        //======================
        $shop = M('shangchang')->where('status=1 AND type=1')->field('id,logo')->limit(12)->select();
        foreach ($shop as $k => $v) {
            $shop[$k]['logo'] = __DATAURL__.$v['logo'];
        }

    	//======================
    	//首页推荐产品
    	//======================
    	$pro_list = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND type=1')->order('sort desc,id desc')->field('id,name,photo_x,price_yh,shiyong')->limit(8)->select();
    	foreach ($pro_list as $k => $v) {
    		$pro_list[$k]['photo_x'] = __DATAURL__.$v['photo_x'];
    	}

        //======================
        //首页前四个分类
        //======================
        $first = M('indeximg')->where('1=1')->order('sort asc')->limit(4)->select();
        foreach ($first as $k => $v) {
            $first[$k]['imgs'] = __DATAURL__.$v['photo'];
        }

        //后四个
        $last = M('indeximg')->where('1=1')->order('sort asc')->limit('4,4')->select();
        foreach ($last as $k => $v) {
            $last[$k]['imgs'] = __DATAURL__.$v['photo'];
        }

    	echo json_encode(array('ggtop'=>$ggtop,'prolist'=>$pro_list,'shop'=>$shop,'first'=>$first,'last'=>$last));
    	exit();
    }

    //***************************
    //  首页产品 分页
    //***************************
    public function getlist(){
        $page = intval($_REQUEST['page']);
        $limit = intval($page*8)-8;

        $pro_list = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND type=1')->order('sort desc,id desc')->field('id,name,photo_x,price_yh,shiyong')->limit($limit.',8')->select();
        foreach ($pro_list as $k => $v) {
            $pro_list[$k]['photo_x'] = __DATAURL__.$v['photo_x'];
        }

        echo json_encode(array('prolist'=>$pro_list));
        exit();
    }

    public function ceshi(){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<32;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        echo $str;
    }

}