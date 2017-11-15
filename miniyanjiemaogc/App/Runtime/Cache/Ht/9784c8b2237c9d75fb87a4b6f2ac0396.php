<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minijunxishanhgnz/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minijunxishanhgnz/Public/ht/js/action.js"></script>
</head>
<body>

<div class="aaa_pts_show_1">【 产品管理 】</div>

<div class="aaa_pts_show_2">
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('Product/index');?>">全部产品</a></div>
       <div class="aaa_pts_4"><a href="<?php echo U('Product/add');?>">添加产品</a></div>
    </div>
    <div class="aaa_pts_3">
      
      <div class="pro_4 bord_1">
         <div class="pro_5">产品名称：<input type="text" class="inp_1 inp_6" id="name" value="<?php echo ($name); ?>"></div>
         <div class="pro_5">
               推荐产品：
               <select class="inp_1 inp_6" id="tuijian">
			      <option value="">全部产品</option>
                  <option value="1" <?php echo $tuijian=='1' ? 'selected="selected"' : NULL ?>>推荐产品</option>
                  <option value="0" <?php echo $tuijian=='0' ? 'selected="selected"' : NULL ?>>非推荐产品</option>
	           </select>
         </div>  
         <div class="pro_6"><input type="button" class="aaa_pts_web_3" value="搜 索" style="margin:0;" onclick="product_option(0);"></div>
      </div>
      
      <table class="pro_3">
         <tr class="tr_1">
           <td style="width:80px;">ID</td>
           <td style="width:90px;">图片</td>
           <td style="width:130px;">所属店铺</td>
           <td>产品名称</td>
           <td style="width:100px;">价格/元</td>
           <td style="width:80px;">人气</td>
           <td style="width:110px;">属性(点击修改)</td>
           <td style="width:100px;">推荐</td>
           <td style="width:300px;">操作</td>
         </tr>
         <tbody id="news_option">
         <!-- 遍历 -->
          <?php if(is_array($productlist)): $i = 0; $__LIST__ = $productlist;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
             <td><?php echo ($v["id"]); ?></td>
             <td style="padding:3px 0;"><img src="/minijunxishanhgnz/Data/<?php echo ($v["photo_x"]); ?>" width="80px" height="80px"/></td>
             <td><?php echo ($v["shangchang"]); ?></td>
             <td><?php echo ($v["name"]); ?></td>
             <td><?php echo ($v["price_yh"]); ?></td>
             <td><?php echo ($v["renqi"]); ?></td>
             <td><p id="new_<?php echo ($v["id"]); ?>"><?php if($v["is_show"] == 1): ?><a class="label blue" onclick="pro_new(<?php echo ($v["id"]); ?>,1);">新品上市<?php else: ?><a class="label err" onclick="pro_new(<?php echo ($v["id"]); ?>,0);">非新品<?php endif; ?></a></p>
              <p id="hot_<?php echo ($v["id"]); ?>" style="margin-top:5px;"><?php if($v["is_hot"] == 1): ?><a class="label succ" onclick="pro_hot(<?php echo ($v["id"]); ?>,1);">热卖商品<?php else: ?><a class="label err" onclick="pro_hot(<?php echo ($v["id"]); ?>,0);">非热卖<?php endif; ?></a></p>
              <p id="zk_<?php echo ($v["id"]); ?>" style="margin-top:5px;"><?php if($v["is_sale"] == 1): ?><a class="label fail" onclick="pro_zk(<?php echo ($v["id"]); ?>,1);">折扣商品<?php else: ?><a class="label err" onclick="pro_zk(<?php echo ($v["id"]); ?>,0);">非折扣<?php endif; ?></a></p>
             </td>
             <td><?php if($v["type"] == 1): ?><label style="color:green;">推荐</label><?php endif; ?></td>
            <td>
              <!-- <?php if($v["pro_buff"] != ''): ?><a href="<?php echo U('Product/pro_guige');?>?pid=<?php echo ($v["id"]); ?>">
              <?php else: ?>
              <a href="<?php echo U('Product/set_attr');?>?pid=<?php echo ($v["id"]); ?>"><?php endif; ?><font style="color:red;">属性设置</font></a> | -->
              <a href="<?php echo U('set_tj');?>?pro_id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&name=<?php echo ($name); ?>&shop_id=<?php echo ($shop_id); ?>&tuijian=<?php echo ($tuijian); ?>">推荐</a> |
              <a href="<?php echo U('Product/add');?>?id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&name=<?php echo ($name); ?>&shop_id=<?php echo ($shop_id); ?>&tuijian=<?php echo ($tuijian); ?>">修改</a> |
              <a onclick="del_id_urls(<?php echo ($v["id"]); ?>)">删除</a>
             </td>
           </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
         <!-- 遍历 -->
         </tbody>
         <tr>
            <td colspan="10" class="td_2">
                  <?php echo ($page_index); ?>  
             </td>
         </tr>
      </table>      
    </div>
    
</div>
<script>
function product_option(page){
	
	var pid = $('#pid').val();
	if(pid == ''){
		pid = $('#ppid').val();
	}
  var obj={
	   "name":$("#name").val(),
	   "shop_id":pid,
	   "tuijian":$("#tuijian").val()
	  }
	  //alert(obj);exit();
  var url='?page='+page;
  $.each(obj,function(a,b){
	  url+='&'+a+'='+b;
	 });
  location=url;
}

function del_id_urls (pro_id) {
  if (confirm('您确定要删除吗？')) {
    location.href="<?php echo U('del');?>?did="+pro_id;
  };
}

//新品设置
function pro_new(pro_id,type){
  if (!pro_id) {
    return;
  }
  $.post("<?php echo U('Product/set_new');?>",{pro_id:pro_id},function(data){
    if (data.status==1) {
      if (type==1) {
        document.getElementById('new_'+pro_id).innerHTML='<a class="label err" onclick="pro_new('+pro_id+',0);">非新品</if></a>';
      }else{
        document.getElementById('new_'+pro_id).innerHTML='<a class="label blue" onclick="pro_new('+pro_id+',1);">新品上市</if></a>';
      }
    }else{
      alert('操作失败，请稍后再试！');
      return false;
    }
  },'json');
}

//热销设置
function pro_hot(pro_id,type){
  if (!pro_id) {
    return;
  }
  $.post("<?php echo U('Product/set_hot');?>",{pro_id:pro_id},function(data){
    if (data.status==1) {
      if (type==1) {
        document.getElementById('hot_'+pro_id).innerHTML='<a class="label err" onclick="pro_hot('+pro_id+',0);">非热卖</if></a>';
      }else{
        document.getElementById('hot_'+pro_id).innerHTML='<a class="label succ" onclick="pro_hot('+pro_id+',1);">热卖商品</if></a>';
      }
    }else{
      alert('操作失败，请稍后再试！');
      return false;
    }
  },'json');
}

//折扣设置
function pro_zk(pro_id,type){
  if (!pro_id) {
    return;
  }
  $.post("<?php echo U('Product/set_zk');?>",{pro_id:pro_id},function(data){
    if (data.status==1) {
      if (type==1) {
        document.getElementById('zk_'+pro_id).innerHTML='<a class="label err" onclick="pro_zk('+pro_id+',0);">非折扣</if></a>';
      }else{
        document.getElementById('zk_'+pro_id).innerHTML='<a class="label fail" onclick="pro_zk('+pro_id+',1);">折扣商品</if></a>';
      }
    }else{
      alert('操作失败，请稍后再试！');
      return false;
    }
  },'json');
}
</script>
</body>
</html>