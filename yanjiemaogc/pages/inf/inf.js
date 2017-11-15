// pages/inf/inf.js
var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    page: 2,
    newsList: []
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    //设置头部标题
    var title = options.title;
    wx.setNavigationBarTitle({
      title: title,
      success: function () {
      },
    });
    //获取所有新闻
    var that = this;
    wx.request({
      url: app.d.ceshiUrl + '/Api/News/index',
      method: 'post',
      data: {},
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var list = res.data.list;
        that.setData({
          newsList: list
        });
        console.log(list)
      },

      fail: function (err) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      }
    })
  },

  //点击加载更多
  loadMore: function () {
    var that = this;
    var page = that.data.page;
    wx.request({
      url: app.d.ceshiUrl + '/Api/News/getlist',
      method: 'post',
      data: { page: page },
      header: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      success: function (res) {
        var list = res.data.list;
        if (list == '') {
          wx.showToast({
            title: '没有更多数据！',
            duration: 2000
          });
          return false;
        }

        that.setData({
          page: page + 1,
          newsList: that.data.newsList.concat(list)
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      }
    })
  },

  // 资讯
  jumpDetails: function (e) {
    var newsId = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '../news/news?newsId=' + newsId,
      success: function (res) {
        // success
      },
      fail: function () {
        // fail
      },
      complete: function () {
        // complete
      }
    })
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    this.onLoad();
  },

})