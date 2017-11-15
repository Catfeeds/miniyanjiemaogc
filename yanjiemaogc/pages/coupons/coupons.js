var reg = /^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/;
var app = getApp();
Page({
  data:{
    disabled: false,
    code:''
  },

//窗体加载事件
onLoad: function (options) {

},

//联系人 失焦事件
bindKeycode(e) {
  console.log(e.detail.value);
  this.setData({
    code: e.detail.value
  })
},

//提交认证
formDataCommit: function (e) {
    var that = this;
    var voucode = that.data.code;
    if (!voucode){
        wx.showToast({
          title: '请输入电子券认证码！',
          duration: 2500
        });
        return false;
    }
    
    wx.request({
      url: app.d.ceshiUrl + '/Api/Shop/checkcode',
      method: 'post',
      data: { 
        uid:app.d.userId,
        voucode: voucode
      },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if (status == 1) {
          wx.showToast({
              title: '验证成功！',
              duration: 2000
          });
          var codeId = res.data.id;
          setTimeout(function () {
            wx.navigateTo({
              url: '../coupons/checkinfo?codeId=' + codeId,
            });
          }, 2500);

        } else {
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        }
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  }

})