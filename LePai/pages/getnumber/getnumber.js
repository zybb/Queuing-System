var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    current: 0
  },

  click: function () {
    this.setData({
      current: 1,
    }),
    app.globalData.Num = app.globalData.Num + 1
  },
})