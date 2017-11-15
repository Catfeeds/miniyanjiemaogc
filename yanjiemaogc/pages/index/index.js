var app = getApp();
var bmap = require('../budu-map/bmap-wx.min.js'); 
var app = getApp();
var wxMarkerData = [];
//index.js
Page({
  data: {
    'address':'定位中',
    ak:"AXMRrsEZ0CGfogyRENeexOTkHxauhZtz",   //填写申请到的ak 
    imgUrls: [],
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000,
    circular: true,
    productData: [],
    proCat:[],
    page: 2,
    index: 2,
    shop:[],
    // 滑动
    imgUrl: [],
    kbs:[],
    lastcat:[]
  },
//跳转商品列表页   
listdetail:function(e){
    console.log(e.currentTarget.dataset.title)
    wx.navigateTo({
      url: '../listdetail/listdetail?title='+e.currentTarget.dataset.title,
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
//跳转商品搜索页  
suo:function(e){
    wx.navigateTo({
      url: '../search/search',
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
//跳转抢购商品页  
qiang:function(e){
    wx.navigateTo({
      url: '../panic/panic',
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
//跳转优惠券页面  
li:function(e){
    wx.navigateTo({
      url: '../ritual/ritual',
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
newpro:function(e){
    wx.navigateTo({
      url: '../user/shoucang?ptype=new',
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
category:function(e){
    console.log(e.currentTarget.dataset.title)
    wx.navigateTo({
      url: '../shop/shop',
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

//前三个分类跳转
list: function (e) {
  var ptype =e.currentTarget.dataset.ptype;
  var title =e.currentTarget.dataset.text;
  wx.navigateTo({
    url: '../listdetail/listdetail?cat_id='+ptype+'&title='+title
  });
},

//后五个个分类跳转
other: function(e){
  var ptype =e.currentTarget.dataset.ptype;
  var title =e.currentTarget.dataset.text;
  if(ptype=='news'){
    wx.navigateTo({
      url: '../inf/inf?title=' + title
    });
  }else if(ptype=='vou'){
    wx.navigateTo({
      url: '../ritual/ritual?title=' + title
    });
  }else if(ptype=='join'){
    wx.navigateTo({
      url: '../personal/personal?title=' + title
    });
  }else if(ptype=='offline'){
    wx.navigateTo({
      url: '../exshop/exshop?title=' + title
    });
  } else if (ptype == 'shop') {
    wx.navigateTo({
      url: '../shop/shop?title=' + title
    });
  }
},

//品牌街跳转商家详情页
jj:function(e){
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
//点击加载更多
getMore:function(e){
  var that = this;
  var page = that.data.page;
  wx.request({
      url: app.d.ceshiUrl + '/Api/Index/getlist',
      method:'post',
      data: {page:page},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var prolist = res.data.prolist;
        if(prolist==''){
          wx.showToast({
            title: '没有更多数据！',
            duration: 2000
          });
          return false;
        }
        //that.initProductData(data);
        that.setData({
          page: page+1,
          productData:that.data.productData.concat(prolist)
        });
        //endInitData
      },
      fail:function(e){
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      }
    })
},

  changeIndicatorDots: function (e) {
    this.setData({
      indicatorDots: !this.data.indicatorDots
    })
  },
  changeAutoplay: function (e) {
    this.setData({
      autoplay: !this.data.autoplay
    })
  },
  intervalChange: function (e) {
    this.setData({
      interval: e.detail.value
    })
  },
  durationChange: function (e) {
    this.setData({
      duration: e.detail.value
    })
  },
//  商品连接数据 
  initProductData: function (data){
    for(var i=0; i<data.length; i++){
      console.log(data[i]);
      var item = data[i];
      item.Price = item.Price/100;
      // item.Price = 100;
      item.ImgUrl = app.d.hostImg + item.ImgUrl;
      
    }
  },
  onLoad: function (options) {
    var that = this;
    wx.request({
      url: app.d.ceshiUrl + '/Api/Index/index',
      method:'post',
      data: {},
      header: {
        'Content-Type':  'application/x-www-form-urlencoded'
      },
      success: function (res) {  
        var ggtop = res.data.ggtop;
        var procat = res.data.procat;
        var prolist = res.data.prolist;
        var shop = res.data.shop;
        var first = res.data.first;
        var last = res.data.last;
        //that.initProductData(data);
        that.setData({
          imgUrls:ggtop,
          proCat:procat,
          productData:prolist,
          shop:shop,
          kbs:first,
          lastcat:last
        });
        //endInitData
      },
      fail:function(e){
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  // 定位
      // var that = this;  
    /* 获取定位地理位置 */  
    // 新建bmap对象   
    var BMap = new bmap.BMapWX({   
        ak: that.data.ak,
    });     
    var fail = function(data) {   
        console.log(data);  
    };   
    var success = function(data) {   
        //返回数据内，已经包含经纬度  
        console.log(data);  
        //使用wxMarkerData获取数据  
        //  = data.wxMarkerData;  
wxMarkerData=data.originalData.result.addressComponent.city
        //把所有数据放在初始化data内  
        console.log(wxMarkerData)
        that.setData({   
            // markers: wxMarkerData,
            // latitude: wxMarkerData[0].latitude,  
            // longitude: wxMarkerData[0].longitude,  
            address: wxMarkerData 
        });  
    }   
    // 发起regeocoding检索请求   
    BMap.regeocoding({   
        fail: fail,   
        success: success  
    });      


  },
  onShareAppMessage: function () {
    return {
      title: '眼睫毛工厂',
      path: '/pages/index/index',
      success: function(res) {
        // 分享成功
      },
      fail: function(res) {
        // 分享失败
      }
    }
  }



});