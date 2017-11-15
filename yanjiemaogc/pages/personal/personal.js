var reg = /^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/;
var app = getApp();
Page({
  data:{

    disabled: false,
    userver:false,
    index:1,
    name:'',
    uname:'',
    tel:'',
    address:'',
    logo:'../../images/sssss.png',
    audit:10,
    reason: '无',
    ptype:0
  },
  // 上传图片
  chooseImage: function () {
    var that = this
    wx.chooseImage({
      count: 1,
      sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有  
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
      success: function (res) {
        var imageSrc = res.tempFilePaths[0];
        wx.uploadFile({
          url: app.d.ceshiUrl + '/Api/Shop/uploadbl',
          filePath: imageSrc,
          name: 'img',
          formData: {
            uid: app.d.userId,
            images: that.data.logo
          },
          header: {
            'Content-Type': 'multipart/form-data'
          },
          success: function (res) {
            //console.log('uploadImage success, res is:', res);
            var statusCode = res.statusCode;
            if (statusCode==200){
              wx.showToast({
                title: '上传成功',
                icon: 'success',
                duration: 2000
              })

              that.setData({
                logo:res.data.urls,
                imageSrc
              })
            }
          },
          fail: function ({errMsg}) {
            console.log('uploadImage fail, errMsg is', errMsg)
            wx.showToast({
              title: '上传失败',
              icon: 'success',
              duration: 2000
            })
          }
        })

      },
      fail: function ({errMsg}) {
        console.log('chooseImage fail, err is', errMsg)
        wx.showToast({
          title: '图片选择失败',
          icon: 'success',
          duration: 2000
        })
      }
    })
  },

//店铺名 失焦事件
bindShopname: function(e) {
    this.setData({
      name: e.detail.value
    })
  },

//详细地址  失去焦点事件
addsInputEvent:function(e){
    this.setData({
      address:e.detail.value
    })
 },

 //绑定错误图片
binderrorimg:function(e){
  var logo = e.target.dataset.errorimg;
  this.setData({
    logo
  })
},

onLoad: function (options) {
  //设置头部标题
  var title = options.title;
  wx.setNavigationBarTitle({
    title: title,
  });
},

//窗体加载事件
onShow: function () {
    var that = this;
    var uid = app.d.userId;
    wx.request({
      url: app.d.ceshiUrl + '/Api/Shop/index',
      method: 'post',
      data: {
        uid: uid
      },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var shopInfo = res.data.shop_info;
        if (shopInfo != '') {
          that.setData({
            name: shopInfo.name,
            uname: shopInfo.uname,
            tel: shopInfo.tel,
            audit: shopInfo.audit,
            address: shopInfo.address,
            logo: shopInfo.logo,
            reason: shopInfo.reason
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
  },

//提交认证
formDataCommit: function (e) {
    var that = this;
    console.log(that.data);
    var name = that.data.name;
    var uname = that.data.uname;
    var tel = that.data.tel;
    var address = that.data.address;
    var logo = that.data.logo;
    if (!name){
        wx.showToast({
          title: '请输入店铺名称！',
          duration: 2500
        });
        return false;
    }
    if (!tel) {
      wx.showToast({
        title: '请输入联系电话！',
        duration: 2500
      });
      return false;
    }
    
    wx.request({
      url: app.d.ceshiUrl + '/Api/Shop/audit',
      method: 'post',
      data: { 
        uid:app.d.userId,
        name: name,
        uname: uname,
        tel:tel,
        address: address,
        logo: logo
      },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var status = res.data.status;
        if (status == 1) {
          that.setData({
            disabled: true
          });
          wx.showToast({
              title: '提交成功，请耐心等待审核！',
              duration: 2000
          });
          that.onLoad();
        } else {
          wx.showToast({
            title: res.data.err,
            duration: 2000
          });
        }
        //endInitData
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },

//联系人 失焦事件
bindKeyname(e) {
  this.setData({
    uname: e.detail.value,
  })
},

//手机焦点事件
bindTelInput (e){
    this.setData({
      tel: e.detail.value,
      userver : reg.test(e.detail.value)
    }) 
},

  watch (){
    console.log(1)
  }
})