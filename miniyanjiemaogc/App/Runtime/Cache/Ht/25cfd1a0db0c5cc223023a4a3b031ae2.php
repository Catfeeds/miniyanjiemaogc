<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minijunxishanhgnz/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/action.js"></script>
</head>
<body>

<div class="aaa_pts_show_1">【 品牌管理 】</div>

<div class="aaa_pts_show_2">
    
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('index');?>">全部品牌</a></div>
       <div class="aaa_pts_4"><a href="<?php echo U('add');?>">添加品牌</a></div>
    </div>
    <div class="aaa_pts_3">
      
      <div class="pro_4 bord_1">
         <div class="pro_5">品牌名称：<input type="text" class="inp_1 inp_6" id="name" value="<?php echo $name;?>"></div>
         <div class="pro_6"><input type="button" class="aaa_pts_web_3" value="搜 索" style="margin:0;" onclick="product_option(0);"></div>
      </div>
      
      <table class="pro_3">
         <tr class="tr_1">
           <td style="width:100px;">ID</td>
           <td style="width:220px;">logo图片</td>
           <td>品牌名称</td>
           <td style="width:120px;">是否推荐</td>
           <td style="width:180px;">操作</td>
         </tr>
         <tbody id="news_option">
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><tr>
		      <td><?php echo ($b["id"]); ?></td>
          <td><img src="/minijunxishanhgnz/Data/<?php echo ($b["photo"]); ?>" width="70px" height="70px"></td>
          <td><?php echo ($b["name"]); ?></td>
          <td><?php if($b["type"] == 1): ?><label style="color:green;">是</label><?php else: ?>否<?php endif; ?></td>
          <td class="obj_1">
            <a href="<?php echo U('set_tj');?>?id=<?php echo ($b["id"]); ?>" >推荐</a> | 
		        <a href="<?php echo U('add');?>?id=<?php echo ($b["id"]); ?>" >修改</a>
			  | <a onclick="del_id_url2(<?php echo ($b["id"]); ?>)">删除</a>
		   </td>
	    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         </tbody>
         <tr>
            <td colspan="10" class="td_2">
                 <?php echo ($page); ?>  
             </td>
         </tr>
      </table>      
    </div>
    
</div>
<script>
function product_option(page){
  var brand_name = $('#name').val();
  location="<?php echo U('index');?>?brand_name="+brand_name; 
}

function del_id_url2(id){
   if(confirm("确认删除吗？"))
   {
	  location='<?php echo U("del");?>?did='+id;
   }
}

</script>
</body>
</html>