<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-测试</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
    <script type="text/javascript" src="http://unpkg.com/iview/dist/iview.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://unpkg.com/iview/dist/styles/iview.css">
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!--主体内容区开始-->
    <div class="right-content" id="app">
      <div class="card">
          <div class="card-form">
              <i-Form ref="formInline" :model="formInline" :rules="ruleInline" :label-width="80">
                  <Form-Item label="账号" prop="user_name">
                      <i-Input type="text" v-model="formInline.user_name" size="large"></i-Input>
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
            var validateName = function(rule, value, callback){ 
                if (value.length >= 10) {
                    callback(new Error('账号长度过长'));
                }else {
                    callback();
                }
            };
            return {
              formInline: {
                  user_name: '',
                  user_email: '',
                  use_desc:''
              },
              loading:false,
              ruleInline: {
                user_name: [
                    { required: true, message: '账号不能为空', trigger:'blur'},
                    { validator: validateName, trigger: 'blur' }
                ],
                user_email: [
                    { required: true, message: '邮箱不能为空', trigger:'blur'},
                    { type: 'email', message: '邮箱格式不正确', trigger:'blur'}
                ],
              },
            }
        },
        mounted: function() {
          
        },
        methods: {
            changeInfo:function(name) {
                var _that = this;
              this.$refs[name].validate((valid) => {
                if (!valid) {
                    _that.$Message.error('验证失败');
                }
              })
            },
             handleReset:function(name) {
                this.$refs[name].resetFields();
            }
        }
    })
</script>



</body>
</html>