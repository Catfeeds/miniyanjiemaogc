// pages/shop/shop.js
var app = getApp();
Page({
  data:{
    shopList:[],
    page:2,
  },

  stroe:function(e){
    var tel = e.currentTarget.dataset.tel;
    wx.makePhoneCall({
      phoneNumber: tel, //此号码为真实电话号码
      success: function () {
        console.log("拨打电话成功！")
      },
      fail: function () {
        console.log("拨打电话失败！")
      }
    })
  },
  //详情页跳转
  jj: function (e) {
    var proid = e.currentTarget.dataset.pid;
    wx.navigateTo({
      url: "../index/detail?productId=" + proid
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
      url: app.d.ceshiUrl + '/Api/Shop/lists',
      method:'post',
      data: {},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var list = res.data.list;
        that.setData({
          shopList: list
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
      url: app.d.ceshiUrl + '/Api/Shop/get_more',
      method:'post',
      data: {page:page},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var list = res.data.list;
        if (list==''){
          wx.showToast({
            title: '没有更多数据！',
            duration: 2000
          });
          return false;
        }
        //that.initProductData(data);
        that.setData({
          page: page+1,
          shopList: that.data.shopList.concat(list)
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