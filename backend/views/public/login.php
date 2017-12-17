<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台登录</title>
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
</head>
<style> 
    body{
        background: #f1f2f7;
    }
    #app {position: absolute;
        width:400px;
        height:280px;
        left:50%;
        top:30%;
        margin-left:-200px;
        margin-top:-100px;
        border:1px solid #2d8cf0;
        border-radius: 5px;
    }
    .logo-header{
        background:#2d8cf0;
        height: 55px;
        line-height: 55px;
        font-size: 15px;
        text-align: center;
        color: #fff;
    }
    .logo-box{
        width: 80%;
        margin: 0 auto;
        margin-top: 20px;
    }
</style>
<body>
<div id="app" v-cloak>
    <div class="logo-header">后台登录</div>
    <div class="logo-box">
        <i-Form ref="formInline" :model="formInline" :rules="ruleInline">
            <Form-Item prop="username">
                <i-Input type="text" v-model.trim="formInline.username" 
                placeholder="账号" 
                size="large">
                    <Icon type="ios-person-outline" slot="prepend"></Icon>
                </i-Input>
            </Form-Item>
            <Form-Item prop="password">
                <i-Input type="password" v-model.trim="formInline.password" 
                placeholder="密码" 
                size="large">
                    <Icon type="ios-locked-outline" slot="prepend"></Icon>
                </i-Input>
            </Form-Item>
            <br>
            <Form-Item>
             <i-Button type="primary" 
                @click="logo('formInline')"
                long size="large" :disabled="loading">
                <span v-if="!loading">登录</span>
                <span v-else>Loading...</span>
              </i-Button>
            </Form-Item>
        </i-Form>
    </div>
</div>

  <script src="/public/admin/js/jquery-1.8.1.min.js"></script>
  <script src="/public/admin/js/jquery.nicescroll.js"></script>
  <script src="http://vuejs.org/js/vue.min.js"></script>
  <script src="http://unpkg.com/iview/dist/iview.min.js"></script>
  <script src="/public/admin/js/main.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            loading:false,
            formInline: {
                username: '',
                password: ''
            },
             ruleInline: {
                username: [
                    { required: true, message: '账号不能为空', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: '密码不能为空', trigger: 'blur' }
                ]
            }
        },
        mounted: function () {
            var _that = this;
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    _that.logo('formInline');
                }
            });
        },
        methods: {
            logo(name) {
                var _that = this;
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        _that.loading = true;
                        $ajax(
                            '/admin/public/login', 
                            _that.formInline, 
                            'post',
                            function(res){
                                _that.$Message.success({
                                   content:'登录成功',
                                   onClose:function(){
                                    location.href = res.url;
                                   }
                                });
                            },
                            function(res){
                                _that.loading = false;
                                _that.$Message.error(res.message);
                            },
                            false
                          );
                    } else {
                        _that.$Message.error('账号或者密码不能为空');
                    }
                });
            }
        }
    })
</script>
</body>
</html>