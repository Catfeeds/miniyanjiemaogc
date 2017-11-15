<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minijunxishanhgnz/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jquery1.8.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/action.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jCalendar.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jquery.XYTipsWindow.min.2.8.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/mydate.js"></script>
<link href="/minijunxishanhgnz/Public/ht/css/order.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="aaa_pts_show_1">【 全部体验店 】</div>


<div class="aaa_pts_show_2">
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('index');?>">全部体验店</a></div>
    </div>
    <div class="aaa_pts_3">
      <table class="pro_3">
         <tr class="tr_1">  
           <td style="width:100px;">ID</td>
           <td style="width:110px;">申请会员</td>
           <td>店铺名称</td>
           <td style="width:110px;">联系电话</td>
           <td style="width:110px;">负责人</td>
           <td style="width:150px;">申请时间</td>
           <td style="width:100px;">状态</td>
           <td style="width:180px;">操作</td>
         </tr>
         <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sp): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($sp["id"]); ?>">
		      <td><?php echo ($sp["id"]); ?></td>
          <td><?php echo ($sp["u_name"]); ?></td>
          <td><?php echo ($sp["name"]); ?></td>
		      <td><?php echo ($sp["tel"]); ?></td>
		      <td><?php echo ($sp["uname"]); ?></td>
          <td><?php echo ($sp["addtime"]); ?></td>
          <td><?php if($sp["audit"] == 0): ?><label style="color:red;">待审核</label>
            <?php elseif($sp["audit"] == 1): ?><label style="color:green;">已认证</label>
            <?php elseif($sp["audit"] == 2): ?><label style="color:blue;">未通过</label>
            <?php else: ?><label style="color:gray;">未申请</label><?php endif; ?>
          </td>
		      <td>
		        <a href="<?php echo U('show');?>?id=<?php echo ($sp["id"]); ?>">查看</a>
		      </td>
	     </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         <tr>
            <td colspan="10" class="td_2">
                <?php echo ($page); ?> 
             </td>
         </tr>
      </table>
    </div>
    
</div>

<script>
//搜索按钮点击事件
function product_option(){
  $('form').submit(); 
}

//选择商家按钮事件
function win_open(url,width,height){

   height==null ? height=600 : height;
   width==null ?  width=800 : width;
   var myDate=new Date()
   window.open(url,'newwindow'+myDate.getSeconds(),'height='+height+',width='+width);
}

//订单删除方法
function del_id_url(id){
   if(confirm("确认删除吗？"))
   {
	  location='<?php echo U("del");?>?did='+id;
   }
}
</script>
</body>
</html>