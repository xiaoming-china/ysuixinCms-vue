<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-首页</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
    <script type="text/javascript" src="http://unpkg.com/iview/dist/iview.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <header class="nav-header-box">
    <div class="logo">logo</div>
    <div class="nav-list">
      <ul>
        <li class="on">首页</li>
        <li>控制面板</li>
        <li>内容</li>
        <li>用户</li>
        <li>模块</li>
        <li>设置</li>
      </ul>
    </div>
    <div class="nav-other">
      <span>欢迎你：管理员 <a href="/admin/public/logout">【退出】</a></span>
      <span></span>
    </div> 
  </header>
  <div class="main-content">
    <!--左边二级导航开始-->
    <div class="left-nav">
      <ul>
        <li class="parent-nav-item">
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
        </li>

      </ul>
    </div>
    <!--左边二级导航结束-->
    <!--主体内容区开始-->
    <div class="right-content" id="app">
      <div class="card">
          <div class="first-title">系统信息</div>
          <ul>
            <li> <em>操作系统</em> <span>Linux</span> </li>
            <li> <em>运行环境</em> <span>Apache</span> </li>
            <li> <em>PHP运行方式</em> <span>fpm-fcgi</span> </li>
            <li> <em>MYSQL版本</em> <span>5.6.35-log</span> </li>
            <li> <em>产品名称</em> <span>意随心内容管理系统</span> </li>
            <li> <em>产品版本</em> <span>2.0.5</span> </li>
            <li> <em>上传附件限制</em> <span>50M</span> </li>
            <li> <em>执行时间限制</em> <span>300秒</span> </li>
            <li> <em>剩余空间</em> <span>33387.98M</span> </li>    
        </ul>
      </div>
      <div class="card">
          <div class="first-title">开发者信息</div>
          <ul>
            <li> <em>开发者名称</em> <span>意随心</span> </li>
            <li> <em>邮箱</em> <span>1036753791@qq.com</span> </li>
        </ul>
      </div>
      <div class="card">
          <div class="first-title">登录日志</div>
          <i-Table stripe :columns="columns1" :data="login_log"></i-Table>
      </div>

    </div>
    <!--主体内容区结束-->
  </div>

  <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
  <script src="/public/admin/js/jquery.nicescroll.js"></script>
  <script src="/public/admin/js/main.js"></script>
  <script src="/public/admin/js/menu.js"></script>

<script>
    new Vue({
        el: '#app',
        data: {
          columns1: [
            {
                title: '登录账号',
                key: 'username'
            },
                        {
                title: '登录时间',
                key: 'created_at'
            },
            {
                title: '登录IP',
                key: 'ip'
            }
        ], 
       login_log: []
      },
      mounted: function() {
        this.login_list();
      },
      methods: {
          msg:function(data){
              this.$Message.warning(data)
          },
          login_list:function(){
            var _this = this;
            axios.get('/admin/index/main').then(function (res) {
              if(res.data.status == 1){
                var data = res.data.data.login_list;
                var length = data.length;
                for (var i = 0; i < length; i++) {
                  _this.login_log.push({
                    created_at: data[i].created_at,
                    username:data[i].username,
                    ip:data[i].ip
                  });
                }
              }else{
                _this.msg('请求错误');
              }
            })
            .catch(function (error) {
              _this.msg('请求失败,服务器错误');
            });
          }
      }
    })
  </script>



</body>
</html>