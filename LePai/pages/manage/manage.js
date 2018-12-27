var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    current: 1,
  },

  click: function () {
    this.setData({
      current: 0,
    })  
  },
})