var app = getApp();
Page({
  data: {
    // banner
    imgUrls: [
      '/images/more/2.png',
      '/images/more/3.jpg',
      '/images/more/5.jpg',
    ],
    indicatorDots: true, //是否显示面板指示点
    autoplay: true, //是否自动切换
    interval: 3000, //自动切换时间间隔,3s
    duration: 1000, //  滑动动画时长1s
    avatarUrl:'/images/more/ct.png',
    imageSrc:'/images/more/zheyangpeng.png',
    imageSrc1: [
      //'/images/more/zhongcan.png',
      '/images/more/xican.png',
      //'/images/more/xiaochi.png',
     // '/images/more/qita.png'
    ],
    aa: [
      {
        nickName: "西餐",
      },
      {
        nickName: "日料",
      },
      {
        nickName: "粤菜",
      },
      {
        nickName: "川菜",
      },
      {
        nickName: "小吃",
      },
      {
        nickName: "甜点",
      },
      {
        nickName: "奶茶",
      },
      {
        nickName: "test",
      },
    ],
  },

  durationChange: function (e) {
    this.setData({
      duration: e.detail.value
    })
  },
  call:function(){
    wx.navigateTo({
      url: '/pages/getnumber/getnumber',
    })
  }
})
