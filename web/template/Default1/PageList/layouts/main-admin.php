<!doctype html>
<html class="no-js" lang="en" style="overflow:hidden;">
<head>
    <title>管理后台</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/zTree/zTreeStyle.css" rel="stylesheet" type="text/css" />
    <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
    <script src="/public/admin/js/jquery.nicescroll.js"></script>
    <script src="/public/admin/js/main.js"></script>
    <script src="/public/admin/js/menu.js"></script>
    <script src="http://vuejs.org/js/vue.min.js"></script>
    <script src="http://unpkg.com/iview/dist/iview.min.js"></script>
    <script src="/public/admin/js/jquery.ztree.core.js"></script>
</head>
<body>

  <header class="nav-header-box">
    <div class="logo"><img src="/public/admin/img/logo.png" width="150px" height="50px"></div>
    <div class="nav-list">
      <ul id="top-menu">
        <!-- <li class="on"><a href="/admin/index/index">首页</a></li> -->
      </ul>
    </div>
    <div class="nav-other">
      <span>欢迎你：<?=
        isset(Yii::$app->user->identity->username) ? 
        Yii::$app->user->identity->username : ''; 
      ?> 
          <a href="#" id="logout">【退出】</a>
      </span>
      <span></span>
    </div> 
  </header>
  <div class="main-content">
    <!--左边二级导航开始-->
    <div class="left-nav">
     <ul id="seconde-menu"></ul>
    </div>
    <!--左边二级导航结束-->
    <!--主体内容区开始-->
      <?php echo $content ?>
    <!--主体内容区结束-->
  </div>


