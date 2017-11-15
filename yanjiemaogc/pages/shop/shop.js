// pages/shop/shop.js
var app = getApp();
Page({
  data:{
    shopList:[],
    page:2,
  },

  stroe:function(e){
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '../shop_store/shop_store?shopId='+id,
      success: function(res){
        // success
      },
      fail: function() {
        // fail
      },
      complete: function() {
        // complete
      }
    })
  },
  //详情页跳转
  jj: function (e) {
    var proid = e.currentTarget.dataset.pid;
    wx.navigateTo({
      url: "../product/detail?productId=" + proid
    })
  },
  onLoad:function(options){
    //设置头部标题
    var title = options.title;
    wx.setNavigationBarTitle({
      title: title,
      success: function () {
      },
    });
    // 页面初始化 options为页面跳转所带来的参数
    var that = this;
    wx.request({
      url: app.d.ceshiUrl + '/Api/Shangchang/index',
      method:'post',
      data: {},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var store_list = res.data.store_list;
        that.setData({
          shopList:store_list,
        });
      },
      error:function(e){
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },

  //点击加载更多
getMore:function(e){
  var that = this;
  var page = that.data.page;
  wx.request({
      url: app.d.ceshiUrl + '/Api/Shangchang/get_more',
      method:'post',
      data: {page:page},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var store_list = res.data.store_list;
        if(store_list==''){
          wx.showToast({
            title: '没有更多数据！',
            duration: 2000
          });
          return false;
        }
        //that.initProductData(data);
        that.setData({
          page: page+1,
          shopList:that.data.shopList.concat(store_list)
        });
      },
      error:function(e){
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
},

  onReady:function(){
    // 页面渲染完成
  },
  onShow:function(){
    // 页面显示
  },
  onHide:function(){
    // 页面隐藏
  },
  onUnload:function(){
    // 页面关闭
  }
})