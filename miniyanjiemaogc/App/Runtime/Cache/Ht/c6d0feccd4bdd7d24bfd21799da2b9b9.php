<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="renderer" content="webkit">
<title>乐仁后台管理系统</title>
<link href="/minijunxishanhgnz/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/action.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jquery.js"></script>
</head>
<body>
<!--top-->
<div id="top">
   <div class="top_1">小程序后台管理系统</div>
   <div class="top_2">
      您好：<font style="color:#738a19;"><?php echo $_SESSION['admininfo']['name']; ?></font> ，欢迎使用 <?php echo $_SESSION['system']['sysname'];?> 后台程序！
      <a href="index">主菜单</a> |
      <a href="<?php echo U('Login/logout');?>">注销</a>
   </div>
</div>
<div class="clear"></div>
<!--body-->
<div id="mybody">
  <div class="body_2">
     <div class="body_1">
      <!-- 判断登录权限给予不同菜单显示 -->
        <div class="aaa_pts_left_1" onclick="left_open(this,'zh')">综合管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="zh">
 <ul class="aaa_pts_left_2">
   <!-- <li>
       <a href="<?php echo U('More/pweb_gl');?>" target="iframe">前台管理</a>
   </li> -->
   <li>
       <a href="<?php echo U('More/indeximg');?>" target="iframe">首页图标设置</a>
   </li>
   <li>
       <a href="<?php echo U('More/setup');?>" target="iframe">小程序配置</a>
   </li>
   <!-- <li>
       <a href="<?php echo U('More/fankui');?>" target="iframe">用户反馈</a>
   </li> -->
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'user')">会员管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="user">
   <ul class="aaa_pts_left_2">
     <li><a href="<?php echo U('User/index');?>" target="iframe">会员管理</a></li>
   </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'shangchang')">店铺管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="shangchang">
 <ul class="aaa_pts_left_2">
  <li>
       <a href="<?php echo U('Sccat/add');?>" target="iframe">添加店铺分类</a>
   </li>
   <li>
       <a href="<?php echo U('Sccat/index');?>" target="iframe">店铺分类管理</a>
   </li>
   <li>
       <a href="<?php echo U('Shangchang/add');?>" target="iframe">添加店铺</a>
   </li>
   <li>
       <a href="<?php echo U('Shangchang/index');?>" target="iframe">店铺管理</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'join')">加盟审核管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="join">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('Join/index');?>" target="iframe">体验店</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'product')">产品管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="product">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('Product/add');?>" target="iframe">添加产品</a>
   </li>
   <li>
       <a href="<?php echo U('Product/index');?>" target="iframe">产品管理</a>
   </li>
   <!-- <li>
       <a href="<?php echo U('ProAttribute/add');?>" target="iframe">添加产品属性</a>
   </li>
   <li>
       <a href="<?php echo U('ProAttribute/index');?>" target="iframe">产品属性管理</a>
   </li> -->
 </ul>
</div>

<!-- <div class="aaa_pts_left_1" onclick="left_open(this,'panic')">抢购产品管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="panic">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('Panic/add');?>" target="iframe">添加抢购产品</a>
   </li>
   <li>
       <a href="<?php echo U('Panic/index');?>" target="iframe">抢购产品管理</a>
   </li>
 </ul>
</div> -->

<div class="aaa_pts_left_1" onclick="left_open(this,'brand')">品牌管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="brand">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('Brand/add');?>" target="iframe">添加品牌</a>
   </li>
   <li>
       <a href="<?php echo U('Brand/index');?>" target="iframe">品牌管理</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'order')">订单管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="order">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('Order/index');?>" target="iframe">全部订单</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'nav')">分类管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="nav">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('Category/add');?>" target="iframe">添加分类</a>
   </li>
   <li>
       <a href="<?php echo U('Category/index');?>" target="iframe">分类管理</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'news')">资讯管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="news">
 <ul class="aaa_pts_left_2">
   <li>
       <a href="<?php echo U('News/add');?>" target="iframe">添加资讯</a>
   </li>
   <li>
       <a href="<?php echo U('News/index');?>" target="iframe">资讯管理</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'voucher')">优惠券管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="voucher">
 <ul class="aaa_pts_left_2">
    <li>
       <a href="<?php echo U('Voucher/add');?>" target="iframe">添加优惠券</a>
   </li>
   <li>
       <a href="<?php echo U('Voucher/index');?>" target="iframe">优惠券管理</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'coupons')">电子券管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="coupons">
 <ul class="aaa_pts_left_2">
    <li>
       <a href="<?php echo U('Coupons/add');?>" target="iframe">添加电子券</a>
   </li>
   <li>
       <a href="<?php echo U('Coupons/index');?>" target="iframe">电子券管理</a>
   </li>
 </ul>
</div>

<div class="aaa_pts_left_1" onclick="left_open(this,'advertisement')">广告管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="advertisement">
 <ul class="aaa_pts_left_2">
   <li>
      <a href="<?php echo U('Guanggao/index');?>" target="iframe">广告管理</a>
   </li>
   <li>
    <a href="<?php echo U('Guanggao/add');?>" target="iframe">添加广告</a>
   </li>
 </ul>
</div>

<?php if(intval($_SESSION['admininfo']['qx'])==4) { ?>
<div class="aaa_pts_left_1" onclick="left_open(this,'adminuser')">管理员管理</div>
<div class="aaa_pts_left_3" style="display:none;" id="adminuser">
   <ul class="aaa_pts_left_2">
     <li><a href="<?php echo U('Adminuser/add');?>" target="iframe">添加管理员</a></li>
     <li><a href="<?php echo U('Adminuser/adminuser');?>" target="iframe">管理员管理</a></li>
   </ul>
</div>
<?php } ?>
       <!-- 判断登录权限给予不同菜单显示 -->
     </div>
     <div class="body_3">
       <!-- 判断登录权限给予不同首页显示 -->
        <iframe src='<?php echo U("Page/adminindex");?>' id='iframe' name='iframe'></iframe>
       <!-- 判断登录权限给予不同首页显示 -->
     </div>
  </div>
</div>

<!--bottom-->
<div id="bottom">
   <?php echo ($copy); ?>
</div>
</body>
</html>