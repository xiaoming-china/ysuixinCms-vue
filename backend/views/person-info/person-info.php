
    <!--主体内容区开始-->
    <div class="right-content" id="app" v-cloak>
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
                            <span v-if="!loading1">修改</span>
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
              loading1:false,
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
                    $ajax(
                        '/admin/person-info/person-info',
                        {
                          user_email:_that.formInline.user_email,
                          desc:_that.formInline.use_desc
                        }, 
                        'post',
                        function(res){
                           _that.$Message.success({
                              content:'修改成功',
                           });
                           _that.loading = false;
                        },
                        function(res){
                          _that.loading = false;
                        }
                    );
                }
              })
            },
            changePassword:function(name){
              this.$refs[name].validate((valid) => {
                if (valid) {
                    var _that = this;
                    _that.loading1 = true;
                    $ajax(
                        '/admin/person-info/change-password',
                        {
                          old_pass:_that.passwordline.old_pass,
                          new_pass:_that.passwordline.new_pass,
                          reply_new_pass:_that.passwordline.reply_new_pass
                        }, 
                        'post',
                        function(res){
                           _that.$Message.success({
                              content:'修改成功',
                           });
                           _that.loading1 = false;
                        },
                        function(res){
                          _that.loading1 = false;
                        }
                    );
                }
              })
            },
            getUserInfo:function(){
            	var _that = this;
              $ajax(
                  '/admin/person-info/get-user-info',
                  '', 
                  'post',
                  function(res){
                    _that.formInline.user_name  = res.data.username;
                    _that.formInline.user_email = res.data.email;
                    _that.formInline.user_desc  = res.data.desc;
                  },
                  function(res){
                    _that.loading = true;
                  }
              );

            },
             handleReset:function(name) {
                this.$refs[name].resetFields();
            }
        }
    })
</script>



</body>
</html>