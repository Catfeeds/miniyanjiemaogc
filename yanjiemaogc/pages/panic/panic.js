// pages/panic/panic.js
var app = getApp();
Page({
  data:{
    pro:[],
    page:2
  },
   like:function(e){
    console.log(e.currentTarget.dataset.state);
    var state = e.currentTarget.dataset.state;
    if(state==1){
      wx.showToast({
          title: '抢购还未开始！',
          duration: 3000
        });
        return false;
    }else if(state==2){
      wx.showToast({
          title: '抢购已经结束！',
          duration: 3000
        });
        return false;
    }else if(state==3){
      wx.showToast({
          title: '商品已经被抢光了！',
          duration: 3000
        });
        return false;
    }
    var pid = e.currentTarget.dataset.pid;
    wx.navigateTo({
      url: '../order/pay?buynum=1&productId='+pid,
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

    //点击加载更多
getMore:function(e){
  var that = this;
  var page = that.data.page;
  wx.request({
      url: app.d.ceshiUrl + '/Api/Product/getmorepanic',
      method:'post',
      data: {page:page},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var list = res.data.pro;
        if(list==''){
          wx.showToast({
            title: '没有更多数据！',
            duration: 2000
          });
          return false;
        }
        //that.initProductData(data);
        that.setData({
          page: page+1,
          pro:that.data.pro.concat(list)
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

onLoad:function(options){
    // 页面初始化 options为页面跳转所带来的参数
    var that = this;
    //ajax请求数据
    wx.request({
      url: app.d.ceshiUrl + '/Api/Product/panic',
      method:'post',
      data: {},
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var list = res.data.pro;
        that.setData({
          pro: list
        })
      },
      fail: function(e){
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      }
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