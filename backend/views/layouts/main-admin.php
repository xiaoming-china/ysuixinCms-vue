<!doctype html>
<html class="no-js" lang="en" style="overflow:hidden;">
<head>
    <title>管理后台</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
   <link href="/public/admin/tools/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
</head>
<body>

  <header class="nav-header-box">
    <div class="logo"><img src="/public/admin/img/logo.png" width="150px" height="50px"></div>
    <div class="nav-list">
      <ul id="top-menu">
        <li class="on"><a href="/admin/index/index">首页</a></li>
      </ul>
    </div>
    <div class="nav-other">
      <span>欢迎你：<?=Yii::$app->user->identity->username; ?> <a href="/admin/public/logout">【退出】</a></span>
      <span></span>
    </div> 
  </header>
  <div class="main-content">
    <!--左边二级导航开始-->
    <div class="left-nav">
      <ul id="seconde-menu">
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 系统信息</span>
          <div class="sub-nav-item">
            <a href="/admin/index/main" target="main">服务器信息</a>
            <a href="/admin/person-info/person-info" target="main">修改个人信息</a>
          </div>
        </li>
      </ul>
    </div>
    <!--左边二级导航结束-->
    <!--主体内容区开始-->
    <div class="right-content">
      <iframe src="/admin/index/main" frameborder="0" name="main" id="iframe-main" width="100%">
      </iframe>
    </div>
    <!--主体内容区结束-->
  </div>

  <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/layer/2.3/layer.js"></script>
  <script src="/public/admin/js/jquery.nicescroll.js"></script>
  <script src="/public/admin/tools/kindeditor/kindeditor-all-min.js"></script>
  <script src="/public/admin/js/main.js"></script>
  <script src="/public/admin/js/menu.js"></script>

</body>
</html>
