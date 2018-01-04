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
            $ajax(
                '/admin/index/main',
                '', 
                'get',
                function(res){
                  var data = res.data.login_list;
                  var length = data.length;
                  for (var i = 0; i < length; i++) {
                    _this.login_log.push({
                      created_at: data[i].created_at,
                      username:data[i].username,
                      ip:data[i].ip
                    });
                  }
                },
                function(res){
                  console.log('请求失败,服务器错误');
                }
            );
          }
      }
    })
  </script>



</body>
</html>