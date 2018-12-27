//logs.js
Page({
  data: {
    phone: '',
    password: ''
  },

  // 获取输入账号 
  phoneInput: function (e) {
    this.setData({
      phone: e.detail.value
    })
  },

  // 获取输入密码 
  passwordInput: function (e) {
    this.setData({
      password: e.detail.value
    })
  },

  // 登录 
  login: function () {
    if (this.data.phone.length == 0 || this.data.password.length == 0) {
      wx.showToast({
        title: '请填写完整',
        icon: 'loading',
        duration: 1500
      })
    } 
    
    else {
      // 这里修改成跳转的页面
    //  var httpRequest = new XMLHttpRequest();
    //  httpRequest.open('POST', 'http://10.210.1.134/Queuing/src/account', true); 
    //  httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //  httpRequest.send({"username":data.phone,"password":data.password,"flag":"1"});
      /**
       * 获取数据后的处理程序
       */
    //  httpRequest.onreadystatechange = function () {
    //    if (httpRequest.readyState == 4 && httpRequest.status == 200) {//验证请求是否发送成功
    //      var json = httpRequest.responseText;//获取到服务端返回的数据
    //      console.log(json);
    //    }
    //  };
      wx.showToast({
        title: '登录成功',
        icon: 'success',
        duration: 2000
      });

      wx.redirectTo({
        url: '/pages/index/index',
      })
    }
  },
  

  
  //跳转到注册界面
  register: function () {
    wx.redirectTo({
      url: '../register/register',
    });
  }
})
