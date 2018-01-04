<!doctype html>
<html class="no-js" lang="en" style="overflow:hidden;">
<head>
    <title>管理后台</title>
    <meta charset="utf-8" />
    <script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
    <script type="text/javascript" src="http://unpkg.com/iview/dist/iview.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
    <script src="/public/admin/js/jquery.nicescroll.js"></script>
    <script src="/public/admin/js/main.js"></script>
    <script src="/public/admin/js/menu.js"></script>

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
      <span>欢迎你：<?=Yii::$app->user->identity->username; ?> <a href="/admin/public/logout">【退出】</a></span>
      <span></span>
    </div> 
  </header>
  <div class="main-content">
    <!--左边二级导航开始-->
    <div class="left-nav">
     <ul id="seconde-menu">
 <!--         <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 系统信息</span>
          <div class="sub-nav-item">
            <a href="main/main.html">服务器信息</a>
            <a href="/admin/person-info/person-info">修改个人信息</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 内容管理</span>
          <div class="sub-nav-item">
            <a href="/admin/category/category-list">栏目管理</a>
            <a href="content/publish_content.html" target="main">发布管理</a>
            <a href="comment/comment.html" target="main">评论管理</a>
            <a href="enclosure/enclosure.html" target="main">附件管理</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 模型管理</span>
          <div class="sub-nav-item">
            <a href="/admin/model/model-list">模型列表</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 安全设置</span>
          <div class="sub-nav-item">
            <a href="main/main.html" target="main">角色管理</a>
            <a href="main/main.html" target="main">权限管理</a>
            <a href="main/main.html" target="main">修改密码</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 站点设置</span>
          <div class="sub-nav-item">
            <a href="/admin/config/enclosure" target="main">模板设置</a>
            <a href="/admin/config/basic" targat="main">参数设置</a>
          </div>
        </li> -->

      </ul>
    </div>
    <!--左边二级导航结束-->
    <!--主体内容区开始-->
      <?php echo $content ?>
    <!--主体内容区结束-->
  </div>


