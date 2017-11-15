var app = getApp();
// pages/order/detail.js
Page({
  data:{
    info:{},
  },
  onLoad:function(options){
    this.loadDetail();
  },
  loadDetail:function(){
    var that = this;
    wx.request({
      url: app.d.ceshiUrl + '/Api/User/ecode',
      method:'post',
      data: {
        uid: app.d.userId,
      },
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if(status==1){
          var info = res.data.info;
          that.setData({
            info: info,
          });
        }else{
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        }
      },
      fail: function () {
          // fail
          wx.showToast({
            title: '网络异常！',
            duration: 2000
          });
      }
    });
  },

})