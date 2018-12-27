Page({

  /**
   * 页面的初始数据
   */
  data: {
    VerificationCode: '',
    Code: '',
    NewChanges: '',
    NewChangesAgain: '',
    success: false,
    state: ''
  },

  return_home: function (e) {
    wx.navigateTo({
      url: '/pages/login/login',
    })

  },
 
  getname: function (e) {
    console.log(e);
    this.setData({
      Code: e.detail.value
    })
  },
  handleNewChanges: function (e) {
    console.log(e);
    this.setData({
      NewChanges: e.detail.value
    })
  },
  handleNewChangesAgain: function (e) {
    console.log(e);
    this.setData({
      NewChangesAgain: e.detail.value
    })

  },
  
  success: function (res) {
    wx.showToast({
      title: '提交成功~',
      icon: 'loading',
      duration: 2000
    })
    console.log(res)
    that.setData({
      success: true
    })
  },

  submit: function (e) {
    var that = this
    if (this.data.Code == '') {
      wx.showToast({
        title: '请输入用户名',
        image: '/images/more/error.png',
        duration: 2000
      })
      return
    } 
    
    else if (this.data.NewChanges == '') {
      wx.showToast({
        title: '请输入密码',
        image: '/images/more/error.png',
        duration: 2000
      })
      return
    } 
    
    else if (this.data.NewChangesAgain != this.data.NewChanges) {
      wx.showToast({
        title: '两次密码不一致',
        image: '/images/more/error.png',
        duration: 2000
      })
      return
    }

    else {
      wx.redirectTo({
        url: '/pages/login/login',
      })
    } 
    
    //提交之后数据库插入用户信息
  //  else {
  //    var that = this
  //    var phone = that.data.phone;
      //wx.request({
      //  url: getApp().globalData.baseUrl + '/Coachs/insert',
      //  method: "POST",
      //  data: {
      //    coachid: phone,
      //    coachpassword: that.data.NewChanges
      //  },
      //  header: {
      //    "content-type": "application/x-www-form-urlencoded"
      //  },
      //  success: function (res) {
      //    wx.showToast({
      //      title: '提交成功~',
      //      icon: 'loading',
      //      duration: 2000
      //     })
      //    console.log(res)
      //    that.setData({
      //      success: true
      //    })
    //    }
    //  })
  //  }
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})