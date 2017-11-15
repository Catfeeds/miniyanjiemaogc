<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minijunxishanhgnz/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/action.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/plugins/xheditor/xheditor-1.2.1.min.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/plugins/xheditor/xheditor_lang/zh-cn.js"></script>
<script>
if(<?= $_SESSION['appkey'];?> == 1607 && <?= $id;?> <= 0){
	$(function(){
		var id = $('#city').val();
		aaa_china_city_ajax(id,'quyu');
	})
}
</script>
<style>
  .pro_2_logo{width:<?php echo $logo['width'];?>px; height:<?php echo $logo['height'];?>px;}
  .pro_2_vip{width:<?php echo $vip_width;?>px; height:<?php echo $vip_height;?>px;}
</style>
</head>
<body>

<div class="aaa_pts_show_1">【 店铺管理 】</div>

<div class="aaa_pts_show_2">
    

    <div class="aaa_pts_3">
      <form action="<?php echo U('Shangchang/add');?>" method="post" onsubmit="return ac_from();" enctype="multipart/form-data">
      <ul class="aaa_pts_5">
         <li>
         <div style="color:#c00; font-size:14px; padding-left:20px;">
            说明：店铺添加修改
         </div>
         </li>
         <li>
            <div class="d1">店铺名称:</div>
            <div>
              <input class="inp_1" name="name" id="name" value="<?php echo ($shangchang["name"]); ?>"/>
            </div>
         </li>
         <li>
          <div class="d1">店铺分类:</div>
          <div>
            <select class="inp_1" name="cid" id="cid" style="width:150px;margin-right:5px;">
                <!-- 遍历 -->
                <option value="">选择分类</option>
                <?php if(is_array($clist)): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v["id"] == $shangchang['cid']): ?>selected="selected"<?php endif; ?>>-- <?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                <!-- 遍历 -->
              </select>
          </div>
        </li>
         <li>
          <div class="d1">所 在 地:</div>
          <div>
				    <select class="inp_1 inp_3" id="sheng" name="sheng" onchange="china_city_ajax(this.value,'city')">
			      <option value="">省份</option>
				      <?php echo ($output_sheng); ?>
            </select>
            <select class="inp_1 inp_3" name="city" id="city" onchange="china_city_ajax(this.value,'quyu')">
			      <option value="">城市</option>
              <?php echo ($output_city); ?> 
            </select>
            <select class="inp_1 inp_3"  id="quyu" name="quyu">
			        <option value="">区</option>
              <?php echo ($output_quyu); ?> 
            </select>
            <div style="width:100%; margin-top:5px;">
              <input class="inp_1" name="address" id="address" value="<?php echo ($shangchang["address"]); ?>"/>
            </div>
          </div>
         </li>
         <li>
            <div class="d1">经纬度:</div>
            <div>
              <input class="inp_1" name="location" id="location" value="<?php echo ($shangchang["location_x"]); ?>,<?php echo ($shangchang["location_y"]); ?>"/>
              <input type="button" value="选择位置" class="aaa_pts_web_3" style="margin-left:15px;" onclick="win_open('<?php echo U('Baidumap/index');?>',1280,800)">
            </div>
         </li>
         <li>
            <div class="d1">联系电话:</div>
            <div>
              <input class="inp_1" name="tel" id="tel" value="<?php echo ($shangchang["tel"]); ?>"/>
              &nbsp;&nbsp;&nbsp;“11位的手机号”或者按 “区号加电话号码” 的格式，例如“02028783721”
            </div>
         </li>
         <li>
            <div class="d1">负责人:</div>
            <div>
              <input class="inp_1" name="uname" id="uname" value="<?php echo ($shangchang["uname"]); ?>"/>
            </div>
         </li>
         <li>
            <div class="d1">负责人手机:</div>
            <div>
              <input class="inp_1" name="utel" id="utel" value="<?php echo ($shangchang["utel"]); ?>"/>
              &nbsp;&nbsp;&nbsp;“11位的手机号”
            </div>
         </li>
         <li>
            <div class="d1">QQ:</div>
            <div>
              <input class="inp_1" name="qq" id="qq" value="<?php echo ($shangchang["qq"]); ?>"/>
           
            </div>
         </li>
         <!-- <li>
           <strong style="font-size:16px; color:#0c0;"> 微信支付设置</strong>
           <span style="display: inline-block; padding-left:15px;">微信账号？<a style="color:#c00" href="https://pay.weixin.qq.com/index.php/core/home/login?return_url=%2F" target="_blank">立即申请</a></span>
         </li>
         <li>
            <div class="d1">APPID:</div>
            <div>
              <input class="inp_1" name="wx_appid" id="wx_appid" value="<?php echo ($shangchang["wx_appid"]); ?>"/>
              &nbsp;&nbsp;&nbsp;appid是微信公众账号的唯一标识。
            </div>
         </li>
         <li>
            <div class="d1">APP_SECRET:</div>
            <div>
              <input class="inp_1" name="wx_secret" id="wx_secret" value="<?php echo ($shangchang["wx_secret"]); ?>"/>
              &nbsp;&nbsp;&nbsp;
            </div>
         </li>
         <li>
            <div class="d1">商户号:</div>
            <div>
              <input class="inp_1" name="wx_mch_id" id="wx_mch_id" value="<?php echo ($shangchang["wx_mch_id"]); ?>"/>
              &nbsp;&nbsp;&nbsp;微信支付商户号，商户申请微信支付后，由微信支付分配的商户收款账号。
            </div>
         </li>
         <li>
            <div class="d1">API密钥:</div>
            <div>
              <input class="inp_1" name="wx_key" id="wx_key" value="<?php echo ($shangchang["wx_key"]); ?>"/>
              &nbsp;&nbsp;&nbsp;交易过程生成签名的密钥，仅保留在商户系统和微信支付后台。
            </div>
         </li> -->
          <li>
            <div style="color:#c00; font-size:14px; padding-left:20px;">logo大小：100px * 100px 店铺广告图:  480px * 150px</div>
         </li>
         <li>
            <div class="d1">店铺LOGO:</div>
            <div>
              <?php if ($shangchang['logo']) { ?>
                  <img src="/minijunxishanhgnz/Data/<?php echo $shangchang['logo']; ?>" width="80" height="80" style="margin-bottom: 3px;" /><br />
              <?php } ?>
              <input type="file" name="logo" id="logo" style="width:160px;" />
            </div>
         </li>
         <li>
            <div class="d1">广告图:</div>
            <div>
              <?php if ($shangchang['vip_char']) { ?>
                  <img src="/minijunxishanhgnz/Data/<?php echo $shangchang['vip_char']; ?>" width="240" height="80" style="margin-bottom: 3px;" /><br />
              <?php } ?>
              <input type="file" name="vip_char" id="vip_char" style="width:160px;" />
            </div>
         </li>
         <li>
            <div class="d1">店铺广告语:</div>
            <div>
              <input class="inp_1" name="intro" id="intro" value="<?php echo ($shangchang["intro"]); ?>" style="width:400px;"/>
            </div>
         </li>
         <li>
           <div style="color:#c00; font-size:14px; padding-left:20px;">商家店铺的广告语</div>
         </li>
         <li>
            <div class="d1">店铺介绍:</div>
            <div>
              <textarea class="inp_1 inp_2" name="content" id="content"/><?php echo ($shangchang["content"]); ?></textarea>
            </div>
         </li>
<?php if($_SESSION['admininfo']['qx']==4){ ?>
         <li>
            <div class="d1">排序:</div>
            <div>
              <input class="inp_1" name="sort" id="sort" value="<?php echo ($shangchang["sort"]); ?>"/> &nbsp;&nbsp;
            </div>
         </li>
<?php }?>
         <li>
            <div class="d1">状态:</div>
            <div>
                <input type="checkbox" name="status" <?php echo !$shangchang['status'] && $id>0 ? null : 'checked="checked"' ?>/> 显示/隐藏
            </div>
         </li>
         <li><input type="submit" name="submit" value="提交" class="aaa_pts_web_3" border="0">
            <input type="hidden" name="id" value="<?php echo ($shangchang["id"]); ?>">
         </li>
      </ul>
      </form>
         
    </div>
    
</div>
<script>
function ac_from(){

  var name=document.getElementById('name').value;
  
  if(name.length<3){
	  alert('店铺名称不能少于3个字符.');
	  return false;
	} 

  var cid=document.getElementById('cid').value;
  if(!cid){
    alert('请选择店铺分类.');
    return false;
  } 
  
  var sheng=document.getElementById('sheng').value;
  var city=document.getElementById('city').value;
  if(!sheng || !city){
	  alert('请选择区域');
	  return false;
	} 
  
  var utel=document.getElementById('utel').value;
  if(utel!=''){
	  if(!utel.match(/^[0-9]{11}$/)){
		  alert('负责人手机号码格式不正确');
		  return false;
		}
  } 
  
}

//初始化编辑器
$('#content').xheditor({
  skin:'nostyle' ,
  upImgUrl:'<?php echo U("Upload/xheditor");?>'
});

//区域选择
function china_city_ajax(id,obj_id){
   $('#district').html('<option value="">区</option>');
   $.ajax({
		 url:'<?php echo U("Public/china_city");?>',
		 type:'GET',
		 timeout:30000,
		 data:{'id':id},
		 dataType:"json",
		 error: function(){
			$('#loding').hide();
			alert('请求失败，请检查网络');
		 },
		 success:function(data){
			var text=obj_id=='city' ? '<option value="">城市</option>' : '<option value="">区</option>';
			$.each(data,function (a,b){
				text+='<option value="'+b.id+'">'+b.name+'</option>';
			});
			$('#'+obj_id).html(text);
		 }
	 });
}

</script>
</body>
</html>