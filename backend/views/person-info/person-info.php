<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-修改个人信息</title>
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
      <span>欢迎你：管理员 <a href="main/login.html">【退出】</a></span>
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
            <a href="main/main.html" target="main">服务器信息</a>
            <a href="/admin/person-info/person-info">修改个人信息</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 内容管理</span>
          <div class="sub-nav-item">
            <a href="content/publish_content.html" target="main">发布管理</a>
            <a href="comment/comment.html" target="main">评论管理</a>
            <a href="enclosure/enclosure.html" target="main">附件管理</a>
          </div>
        </li>
        <li class="parent-nav-item">
          <span is-selected='true'> <s class="icon-minus"></s> 模型管理</span>
          <div class="sub-nav-item">
            <a href="model/model.html" target="main">模型列表</a>
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
            <a href="template/template.html" target="main">站点模板设置</a>
            <a href="config/config-basic.html" targat="main">站点参数设置</a>
          </div>
        </li>

      </ul>
    </div>
    <!--左边二级导航结束-->
    <!--主体内容区开始-->
    <div class="right-content" id="app">
      <div class="card">
          <Tabs value="name1">
            <Tab-Pane label="修改个人信息" name="name1">
              <div class="card-form">
                  <i-Form ref="formInline" :model="formInline" :rules="ruleInline" :label-width="80">
                      <Form-Item label="账号" prop="user_name">
                          <i-Input type="text" disabled v-model="formInline.user_name" size="large"></i-Input>
                      </Form-Item>
                      <Form-Item label="邮箱" prop="user_email">
                          <i-Input type="text" v-model="formInline.user_email" size="large"></i-Input>
                      </Form-Item>
                      <Form-Item label="描述" prop="use_desc">
                          <i-Input type="textarea" v-model="formInline.user_desc" size="large"></i-Input>
                      </Form-Item>
                      <br>
                      <Form-Item>
                          <i-Button type="primary" 
                          @click="changeInfo('formInline')" 
                          :loading="loading" 
                          style="float: right;width:92px;">
                            <span v-if="!loading">修改</span>
                            <span v-else>Loading...</span>
                          </i-Button>
                      </Form-Item>
                  </i-Form>
              </div>
            </Tab-Pane>
            <Tab-Pane label="修改密码" name="name2">
              <div class="card-form">
                  <i-Form ref="passwordline" :model="passwordline" :rules="passwordrule" :label-width="80">
                      <Form-Item label="旧密码" prop="old_pass">
                          <i-Input type="password"v-model="passwordline.old_pass" size="large"></i-Input>
                      </Form-Item>
                      <Form-Item label="新密码" prop="new_pass">
                          <i-Input type="password" v-model="passwordline.new_pass" size="large"></i-Input>
                      </Form-Item>
                      <Form-Item label="重复密码" prop="reply_new_pass">
                          <i-Input type="password" v-model="passwordline.reply_new_pass" size="large"></i-Input>
                      </Form-Item>
                      <br>
                      <Form-Item>
                          <i-Button type="primary" 
                          @click="changePassword('passwordline')" 
                          :loading="loading" 
                          style="float: right;width:92px;">
                            <span v-if="!loading">修改</span>
                            <span v-else>Loading...</span>
                        </i-Button>
                      </Form-Item>
                  </i-Form>
              </div>
            </Tab-Pane>
          </Tabs>
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
        data:function(){
            var _that = this;
            var validatePassCheck = function(rule, value, callback){ 
                if (value === '') {
                    callback(new Error('请输入重复密码'));
                } else if (value !== _that.passwordline.new_pass) {
                    callback(new Error('新密码密码和重复密码不匹配'));
                } else {
                    callback();
                }
            };
            return {
              formInline: {
                  user_name: '',
                  user_email: '',
                  use_desc:''
              },
              passwordline:{
                  old_pass: '',
                  new_pass: '',
                  reply_new_pass:''
              },
              loading:false,
              ruleInline: {
                user_name: [
                    { required: true, message: '账号不能为空', trigger:'blur'}
                ],
                user_email: [
                    { type: 'email', message: '邮箱格式不正确', trigger:'blur'}
                ],
              },
              passwordrule:{
                  old_pass: [
                      { required: true, message: '旧密码不能为空', trigger:'blur'}
                  ],
                  new_pass: [
                      { required: true, message: '新密码不能为空', trigger:'blur'}
                  ],
                  reply_new_pass: [
                      { validator: validatePassCheck, trigger:'blur'}
                  ],
              }
            }
        },
        mounted: function() {
          this.getUserInfo();
        },
        methods: {
            changeInfo:function(name) {
              this.$refs[name].validate((valid) => {
                if (valid) {
                    var _that = this;
                    _that.loading = true;
                    var params = new URLSearchParams();
                    params.append('user_email', _that.formInline.user_email);
    				        params.append('desc', _that.formInline.use_desc);
                    axios.post('/admin/person-info/person-info',params).then(function (res) {
                       if (res.data.status == 1) {
                           _that.$Message.success({
                              content:'修改成功',
                           });
                       }else{
                            _that.$Message.warning(res.data.message);
                       }
                      _that.loading = false;
                    }).catch(function (error) {
                        _that.$Message.error('请求失败,服务器错误');
                    });
                }
              })
            },
            changePassword:function(name){
              this.$refs[name].validate((valid) => {
                if (valid) {
                    var _that = this;
                    _that.loading = true;
                    var params = new URLSearchParams();
                    params.append('old_pass', _that.passwordline.old_pass);
                    params.append('new_pass', _that.passwordline.new_pass);
                    params.append('reply_new_pass', _that.passwordline.reply_new_pass);
                    axios.post('/admin/person-info/change-password',params).then(function (res) {
                       if (res.data.status == 1) {
                           _that.$Message.success({
                              content:'修改成功',
                              onClose:function(){
                                _that.handleReset(name);
                              }
                           });
                       }else{
                            _that.$Message.warning(res.data.message);
                       }
                       _that.loading = false;
                    }).catch(function (error) {
                        _that.$Message.error('请求失败,服务器错误');
                    });
                }
              })
            },
            getUserInfo:function(){
            	var _that = this;
            	axios.post('/admin/person-info/get-user-info').then(function (res) {
                   if (res.data.status == 1) {
                   	_that.formInline.user_name  = res.data.data.username;
                   	_that.formInline.user_email = res.data.data.email;
                   	_that.formInline.user_desc  = res.data.data.desc;
                   }
                }).catch(function (error) {
                    _that.$Message.error('请求失败,服务器错误');
                });
            },
             handleReset:function(name) {
                this.$refs[name].resetFields();
            }
        }
    })
</script>



</body>
</html>