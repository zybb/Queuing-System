var app = getApp();
Page({
  data: {
    items: [
      { name: 'zhongcan', value: '中餐' },
      { name: 'xican', value: '西餐'},
      { name: 'xiaochi', value: '小吃' },
      { name: 'qita', value: '其他' },
    ],
    Name: '',
    Leibie: 'hh',
  },

  //这个函数有问题，没解决
  checkboxChange: function (e) {
    console.log(e.detail.value);
    this.setData({
      Leibie: e.detail.value
    });
    console.log(this.Leibie)
  },

  getname: function (e) {
    console.log(e);
    this.setData({
      Name: e.detail.value
    });
    console.log(this.Name)
  },

  submit:function(){
    //这里加入调用后端接口创建新队列的部分
    wx.showToast({
      title: '队列创建成功',
      duration: 2000
    })
    wx.redirectTo({
      url: '../index/index'
    })
    app.globalData.flag = true
  },
  submit0: function () {
    //这里加入调用后端接口创建新队列的部分
    
    wx.redirectTo({
      url: '../manage/manage'
    })
  }
})

