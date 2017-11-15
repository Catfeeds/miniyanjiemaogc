<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>拾取坐标系统</title><link href="<?php echo ($path); ?>Css/public.css" rel="stylesheet" type="text/css" />
	  <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2&services=true" ></script>
	  <script type="text/javascript" src="<?php echo ($path); ?>Js/tangram.js"></script>
	  <script type="text/javascript" src="<?php echo ($path); ?>Js/mapext.js"></script>
	  <script type="text/javascript" src="<?php echo ($path); ?>Js/public.js"></script>
	  <script type="text/javascript">DomReady.ready(localsearch);</script>
 </head>


<body onresize="mapResize()"><div class="content"><div class="LogoCon clear"><div class="logo"><img src="<?php echo ($path); ?>logo.gif" width="146" height="80" border="0" /></div><div class="search map_search"><input type="text" class="text" id="localvalue" value="请输入关键字进行搜索" onfocus="foucs_(this,'请输入关键字进行搜索','')" onblur="blur_(this,'请输入关键字进行搜索','')" callback="beginsearch(l_local)"/><input class="button" type="button" value="百度一下" id="localsearch" /><label class="pointLabel" for="pointLabel"><input type="checkbox" onfocus="this.blur()" id="pointLabel" />坐标反查</label><span class="searchTip" id="searchTip"></span></div><div style="width:400px;position:relative;float:right;"><div style="color:#666;line-height:25px;">当前坐标点如下：</div>

<div>
<input type="text" readonly id="pointInput" style="display:inline-block;background:#EBEBE4;border:#7F9DB9 solid 1px;color:#555;width:160px;height:30px;line-height:30px;font-size:14px;font-weight:700; display:block; float:left;" />
<span id="copyButton" style="display:block; float:left; padding:0;"><input type="button" value="确定并关闭" id="copyPoint" style="margin:0; margin-left:8px;float:right; height:32px; line-height:32px;" onclick="baidu_map_return()"/></span>
</div>

<span id="copyMessage" style="width:50px;position:absolute;top:5px;right:175px;*right:170px;color:#f00;display:none">确定并关闭</span><div style="color:#777;margin-top:5px;display:none">(默认显示地图中心点坐标,鼠标左键单击后显示单击点的坐标)</div></div></div><div class="dt_nav"><span class="result" id="resultNum"></span><ul class="nav"><li><div class="l"><b id="curCity"></b><span>[<a id="curCityText" onclick="showPop()">更换城市</a>]</span></div><span class="r"></span></li><li><div class="l"><b>当前层级：<span id="ZoomNum"></span>级</b></div><span class="r"></span></li></ul></div><div id="wrapper"><div id="MapHolder" style="overflow:hidden; width:100%;"></div><!--右侧地图Info begin--><div id="MapInfo" style="display:none;"><div id="txtPanel"><h3>功能简介：</h3><p class="tip_info">1、支持地址 精确/模糊 查询；<br/>2、支持POI点坐标显示、复制；<br/>3、坐标鼠标跟随显示；<br/>4、<font color="red">支持坐标查询(需要将坐标反查框勾选)；</font><br/></p><h3>使用说明：</h3><p class="tip_info">1、获取坐标并复制：<br/><span class="tip_info_em">1)、在搜索框中搜索关键词后，左侧列表中会有该点的坐标，点击该条信息或地图上该点，都会将坐标显示在地图右上角的Input框中,然后点击复制按钮，该点坐标就复制成功了;<br />2)、在地图上用鼠标左键单击地图，就能将该点坐标显示在地图右上角的Input框中,然后点击复制按钮，该点坐标就复制成功了;</span>2、坐标反查：<br/><span class="tip_info_em">1)、先勾选住 搜索框后面的 <font color="red">坐标反查框</font><br />2)、输入一个正确的坐标(比如：116.307629,40.058359)，点击按钮 <b>百度一下</b>，就能将该点显示在地图上、切换地图，<font color="red">如果解析成功，还能返回一个地址</font></span></p></div></div><!--右侧地图Info end--><!--地图上边右边透明立体边框 begin--><div id="shad"><div id="shad_v"></div><div id="shad_h"></div></div><!--地图上边右边透明立体边框 end--></div></div><!--更换城市 begin--><div style="width: 382px; display: none; left: 5px; top: 139px; height: 344px;" class="map_popup" id="map_popup"><div class="popup_main"><div class="title">城市列表</div><div class="sel_city" style="height: 320px; overflow-y: auto;overflow-x:hidden;margin:0;padding-left:5px">
 

</div><button onclick="hidePop()"></button></div><div class="poput_shadow" style="height: 291px;width:100%"></div></div><!--更换城市 end--> 
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F21b27145da0487d1e9f52a8e5576e564' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
<script>loadBody();</script>
<script>
function baidu_map_return(e){
   var obj=document.getElementById('pointInput').value;
   if(obj==''){
	  alert('请点击地图上的某一点获取坐标');
	  return;   
   }
   window.opener.document.getElementById('location').value=obj;
   window.close();
}
</script>
</html>